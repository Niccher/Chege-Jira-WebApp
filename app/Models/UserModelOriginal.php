<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;
use App\Entities\User;

class UserModel extends ShieldUserModel
{
    protected $returnType = User::class;
    protected $allowedFields = [
        'email', // Add email field to allowed fields
        'username',
        'first_name',
        'last_name',
        'bio',
        'avatar',
        'newsletter',
        'active',
        'activate_hash',
        'status',
        'status_message',
        'force_pass_reset',
        'permissions',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $validationRules = [
        'username'      => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'email'         => 'required|valid_email',
        'first_name'    => 'required|max_length[50]',
        'last_name'     => 'required|max_length[50]',
        'password'      => 'required|min_length[8]',
    ];

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        // First, find in auth_identities table
        $db = \Config\Database::connect();
        $builder = $db->table('auth_identities');
        $result = $builder->select('user_id')
            ->where('secret', $email)
            ->where('type', 'email_password')
            ->get()
            ->getRow();

        if (!$result) {
            return null;
        }

        return $this->find($result->user_id);
    }

    /**
     * Override find method to include email field
     */
    public function find($id = null)
    {
        $user = parent::find($id);

        if ($user) {
            // Get email from auth_identities table
            $db = \Config\Database::connect();
            $builder = $db->table('auth_identities');
            $result = $builder->select('secret')
                ->where('user_id', $user->id)
                ->where('type', 'email_password')
                ->get()
                ->getRow();

            if ($result) {
                $user->email = $result->secret;
            }
        }

        return $user;
    }

    /**
     * Override save method to handle email properly
     */
    public function save($data): bool
    {
        // If we have an email in the data, we need to handle it separately
        if (is_array($data) && isset($data['email'])) {
            $email = $data['email'];
            unset($data['email']); // Remove email from data array

            // Save the user data
            $result = parent::save($data);

            if ($result && isset($data['id'])) {
                // Update email in auth_identities
                $this->updateEmailIdentity($data['id'], $email);
            }

            return $result;
        }

        return parent::save($data);
    }

    /**
     * Update email in auth_identities table
     */
    private function updateEmailIdentity(int $userId, string $email): bool
    {
        $db = \Config\Database::connect();
        $builder = $db->table('auth_identities');

        // Check if identity exists
        $exists = $builder->where('user_id', $userId)
            ->where('type', 'email_password')
            ->countAllResults();

        if ($exists > 0) {
            // Update existing
            return $builder->where('user_id', $userId)
                ->where('type', 'email_password')
                ->update(['secret' => $email]);
        } else {
            // Insert new
            return $builder->insert([
                'user_id' => $userId,
                'type'    => 'email_password',
                'secret'  => $email,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
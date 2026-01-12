<?php

namespace App\Controllers\Auth;

use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegister;
use App\Models\UserModel;
use App\Entities\User;
use CodeIgniter\Shield\Authentication\Passwords;

class RegisterController extends ShieldRegister
{
    protected $helpers = ['auth'];

    public function registerAction()
    {
        // Custom validation rules for Shield setup
        $rules = [
            'firstName' => 'required|max_length[50]',
            'lastName'  => 'required|max_length[50]',
            'username'  => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'     => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please provide a valid email address'
                ]
            ],
            'password'   => [
                'rules'  => 'required|min_length[8]|strong_password',
                'errors' => [
                    'min_length' => 'Password must be at least 8 characters',
                    'strong_password' => 'Password must contain letters and numbers'
                ]
            ],
            'confirmPassword' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Passwords do not match'
                ]
            ],
            'terms' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if email already exists in auth_identities
        $userModel = new UserModel();
        $existingUser = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email already registered. Please use a different email or try to login.');
        }

        try {
            // Create user entity
            $user = new User([
                'first_name' => $this->request->getPost('firstName'),
                'last_name'  => $this->request->getPost('lastName'),
                'username'   => $this->request->getPost('username'),
                'email'      => $this->request->getPost('email'),
                'newsletter' => $this->request->getPost('newsletter') ? 1 : 0,
                'active'     => 0, // Not active until email verification
            ]);

            // Save the user
            $userModel->save($user);
            $userId = $userModel->getInsertID();

            // Retrieve the saved user
            $user = $userModel->findById($userId);

            // Create email identity with password
            $user->createEmailIdentity([
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);

            // Generate activation hash
            $user->activate_hash = bin2hex(random_bytes(32));
            $userModel->save($user);

            // Send activation email
            helper('email');
            if (sendActivationEmail($user, $user->activate_hash)) {
                // Clear password from session for security
                $this->session->removeTempdata('_ci_old_input');

                return redirect()->to('/auth/verify-email')
                    ->with('success', 'Registration successful! Please check your email for activation link.')
                    ->with('email', $user->email);
            } else {
                // If email fails, still show success but warn about email
                return redirect()->to('/auth/verify-email')
                    ->with('warning', 'Registration successful, but we couldn\'t send the activation email. Please contact support.')
                    ->with('email', $user->email);
            }

        } catch (\Exception $e) {
            log_message('error', 'Registration error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Registration failed. Please try again later.');
        }
    }
}
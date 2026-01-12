<?php

namespace App\Entities;

use CodeIgniter\Shield\Entities\User as ShieldUser;

class User extends ShieldUser
{
    protected $attributes = [
        'first_name'    => null,
        'last_name'     => null,
        'username'      => null,
        'email'         => null, // Add email attribute
        'bio'           => null,
        'avatar'        => null,
        'newsletter'    => false,
        'activate_hash' => null,
        'active'        => 0,
    ];

    protected $casts = [
        'first_name'    => 'string',
        'last_name'     => 'string',
        'username'      => 'string',
        'email'         => 'string', // Add email cast
        'bio'           => 'string',
        'avatar'        => 'string',
        'newsletter'    => 'bool',
        'activate_hash' => 'string',
        'active'        => 'int',
    ];

    /**
     * Get email attribute
     */
    public function getEmail(): ?string
    {
        if (isset($this->attributes['email'])) {
            return $this->attributes['email'];
        }

        // If not set, get from identities
        foreach ($this->identities as $identity) {
            if ($identity->type === 'email_password') {
                $this->attributes['email'] = $identity->secret;
                return $identity->secret;
            }
        }

        return null;
    }

    /**
     * Set email attribute
     */
    public function setEmail(string $email): self
    {
        $this->attributes['email'] = $email;
        return $this;
    }
}
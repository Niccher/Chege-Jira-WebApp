<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AccountController extends BaseController
{
    /**
     * Display verify email page
     */
    public function verifyEmailView(): string
    {
        return view('\App\Views\auth\verify_email');
    }

    /**
     * Activate account with token
     */
    public function activateAccount($token = null): string
    {
        $userModel = new UserModel();

        if (empty($token)) {
            return view('\App\Views\auth\activate_account', [
                'status' => 'invalid_token',
                'email' => $this->request->getGet('email')
            ]);
        }

        // Find user by activation token
        $user = $userModel->where('activate_hash', $token)
            ->first();

        if (!$user) {
            return view('\App\Views\auth\activate_account', [
                'status' => 'invalid_token',
                'email' => $this->request->getGet('email')
            ]);
        }

        // Check if already activated
        if ($user->active) {
            return view('\App\Views\auth\activate_account', [
                'status' => 'already_activated',
                'email' => $user->email
            ]);
        }

        // Check if token expired
        if ($user->activate_hash_expires && strtotime($user->activate_hash_expires) < time()) {
            return view('\App\Views\auth\activate_account', [
                'status' => 'expired_token',
                'email' => $user->email
            ]);
        }

        // Activate user
        $user->active = 1;
        $user->activate_hash = null;
        $user->activate_hash_expires = null;
        $userModel->save($user);

        // Send welcome email
        helper('email');
        sendWelcomeEmail($user);

        return view('\App\Views\auth\activate_account', [
            'status' => 'success',
            'email' => $user->email
        ]);
    }

    /**
     * Resend activation email
     */
    public function resendActivation(): ResponseInterface
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Email not found');
            }

            if ($user->active) {
                return redirect()->to('/auth/login')->with('error', 'Account already activated');
            }

            // Generate new activation token
            $user->activate_hash = bin2hex(random_bytes(32));
            $user->activate_hash_expires = date('Y-m-d H:i:s', time() + 86400);
            $userModel->save($user);

            // Send activation email
            helper('email');
            if (sendActivationEmail($user, $user->activate_hash)) {
                return redirect()->to('/auth/verify-email')
                    ->with('success', 'Activation email sent!')
                    ->with('email', $user->email);
            }
        }

        return redirect()->back()->with('error', 'Failed to resend activation email');
    }

    /**
     * Display locked account page
     */
    public function lockedView(): string
    {
        return view('\App\Views\auth\locked');
    }
}
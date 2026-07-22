<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ForgotPasswordController extends BaseController
{
    /**
     * Display forgot password form
     */
    public function forgotPasswordView(): string
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        $data = [
            'title' => 'Forgot Password • Chege JIRA',
        ];

        return view('\App\Views\auth\forgot_password', $data);
    }

    /**
     * Handle the forgot password form submission
     */
    public function forgotPasswordAction(): ResponseInterface
    {
        $rules = [
            'email' => 'required|valid_email',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $userModel = new UserModel();

        // Find user by email (checking identity manually since generic findByCredentials might vary)
        // Actually, our custom UserModel allows finding by email if we fix the logic, 
        // but let's query the auth_identities table or use Shield's provider correctly.
        
        // Since we are fixing the flow, let's look up the user using the Shield provider
        $user = auth()->getProvider()->findByCredentials(['email' => $email]);

        if (empty($user)) {
            // Security: Don't reveal if email exists or not, but for UX usually we just say "If that email exists..."
            // For this specific requested flow, let's just say "check your email".
            return redirect()->back()->with('success', 'If an account with that email exists, we have sent a reset link.');
        }

        // Generate Reset Token
        $token = bin2hex(random_bytes(32));
        $user->reset_hash = $token;
        $user->reset_expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiration
        $userModel->save($user);

        // Send Email
        helper('email');
        if (sendPasswordResetEmail($user, $token)) {
             return redirect()->back()->with('success', 'Reset link sent! Please check your email.');
        }

        return redirect()->back()->with('error', 'Unable to send email. Please contact support.');
    }
}
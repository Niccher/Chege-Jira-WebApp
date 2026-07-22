<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ResetPasswordController extends BaseController
{
    /**
     * Display reset password form
     */
    public function resetPasswordView(): string
    {
        $token = $this->request->getGet('token');
        $email = $this->request->getGet('email');

        // Basic validation that token exists
        if (empty($token) || empty($email)) {
             return redirect()->to('/auth/login')->with('error', 'Invalid password reset link.');
        }

        $data = [
            'title' => 'Reset Password • Chege JIRA',
            'token' => $token,
            'email' => $email,
        ];

        return view('\App\Views\auth\reset_password', $data);
    }

    /**
     * Handle reset password
     */
    public function resetPasswordAction(): ResponseInterface
    {
        $rules = [
            'token' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|strong_password',
            'confirmPassword' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        
        // Find user by email
        $user = auth()->getProvider()->findByCredentials(['email' => $email]);

        if (!$user) {
             return redirect()->to('/auth/login')->with('error', 'Invalid request.');
        }

        // Verify Token and Expiry
        // Note: reset_hash and reset_expires_at are custom fields we added
        if ($user->reset_hash !== $token) {
            return redirect()->back()->withInput()->with('error', 'Invalid or expired token.');
        }

        if (strtotime($user->reset_expires_at) < time()) {
             return redirect()->back()->withInput()->with('error', 'Token has expired. Please request a new one.');
        }

        // Update Password
        // Shield's User entity handles password hashing automatically when 'password' field is set?
        // Shield User Entity uses accessors/mutators or Fillable?
        // Actually Shield users store password in auth_identities.
        // We need to use the Identity Provider to update the password.
        
        $users = auth()->getProvider();
        $user->password = $password; // This sets the plain text password on the entity
        
        // We also need to clear the reset token
        $user->reset_hash = null;
        $user->reset_expires_at = null;

        // Saving the user via the Model *should* trigger Shield's password update logic 
        // IF the Entity handles it correctly. 
        // Shield Entity `setPassword` mutator usually handles hashing but storage is in identities.
        // Let's rely on Shield's $userModel->save($user) handling it if $user is a Shield Entity.
        // Since we extend Shield User now (in one of the previous fixes), checking that...
        // Wait, earlier we fixed App\Entities\User to extend Shield\Entities\User.
        
        if ($users->save($user)) {
            return redirect()->to('/auth/login')
                ->with('success', 'Password reset successful! You can now login with your new password.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update password. Please try again.');
    }
}
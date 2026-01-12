<?php

namespace App\Controllers\Auth;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Entities\User;
use App\Controllers\BaseController;
use CodeIgniter\Shield\Authentication\Passwords;

class RegisterController extends BaseController
{
    use \CodeIgniter\Shield\Traits\Viewable;

    /**
     * Display registration form
     */
    public function registerView(): string
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        $data = [
            'title' => 'Register • ChegeOS',
        ];

        return view('\App\Views\auth\register', $data);
    }

    /**
     * Handle registration
     */
    public function registerAction(): ResponseInterface
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Validate
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

        // Check if email exists
//        $userModel = new UserModel();
//        $existingUser = $userModel->where('email', $this->request->getPost('email'))->first();

        // Check if email exists
        $userModel = new UserModel();
        $existingUser = $userModel->findByCredentials(['email' => $this->request->getPost('email')]);

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email already registered. Please use a different email.');
        }

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email already registered. Please use a different email.');
        }

        // Create user
        $user = new User([
            'first_name' => $this->request->getPost('firstName'),
            'last_name'  => $this->request->getPost('lastName'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'newsletter' => $this->request->getPost('newsletter') ? 1 : 0,
            'active'     => 0, // Require email activation
        ]);

        // Save user
        $userModel->save($user);
        $userId = $userModel->getInsertID();

        // Get the saved user
        $user = $userModel->findById($userId);

        // Create email identity with password
        $user->createEmailIdentity([
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // Generate activation hash
        $user->activate_hash = bin2hex(random_bytes(32));
        $user->activate_hash_expires = date('Y-m-d H:i:s', time() + 86400); // 24 hours
        $userModel->save($user);

        // Send activation email
        helper('email');
        if (sendActivationEmail($user, $user->activate_hash)) {
            return redirect()->to('/auth/verify-email')
                ->with('success', 'Registration successful! Please check your email for activation link.')
                ->with('email', $user->email);
        } else {
            return redirect()->to('/auth/verify-email')
                ->with('warning', 'Registration successful, but we couldn\'t send the activation email. Please contact support.')
                ->with('email', $user->email);
        }
    }
}
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
    public function registerView()
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
     * Handle registration using Shield's proper flow
     */
    public function registerAction(): ResponseInterface
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Check if registration is allowed
        if (! setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', 'Registration is currently disabled.');
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
        $userModel = new UserModel();
        $existingUser = $userModel->findByCredentials(['email' => $this->request->getPost('email')]);

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email already registered. Please use a different email.');
        }

        // Use Shield's proper registration flow
        $users = auth()->getProvider();

        // Prepare user data
        $userData = [
            'first_name' => $this->request->getPost('firstName'),
            'last_name'  => $this->request->getPost('lastName'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => $this->request->getPost('password'),
            'newsletter' => $this->request->getPost('newsletter') ? 1 : 0,
            'active'     => 0, // Will be activated after email verification
        ];

        // Save the user using Shield's method
        $user = $users->createNewUser($userData);

        try {
            $users->save($user);
        } catch (\CodeIgniter\Shield\Exceptions\ValidationException $e) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        // Trigger registration event
        \CodeIgniter\Events\Events::trigger('register', $user);

        /** @var \CodeIgniter\Shield\Authentication\Authenticators\Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Prevent "User Info in Session" LogicException by clearing any existing state
        if ($authenticator->loggedIn() || $authenticator->isPending()) {
            $authenticator->logout();
        }

        $authenticator->startLogin($user);

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show');
        }

        // Set the user active if no action is configured
        $user->activate();

        $authenticator->completeLogin($user);

        // Success!
        return redirect()->to(config('Auth')->registerRedirect())
            ->with('message', 'Registration successful!');
    }
}
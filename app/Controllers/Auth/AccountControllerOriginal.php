<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AccountController extends BaseController
{
    public function activateAccount($token = null)
    {
        $auth = auth('session');
        $userModel = new UserModel();

        if (empty($token)) {
            return redirect()->to('/auth/login')->with('error', 'Invalid activation token');
        }

        // Find user by activation token
        $user = $userModel->where('activate_hash', hash('sha256', $token))
            ->where('active', 0)
            ->first();

        if (!$user) {
            // Check if already activated
            $user = $userModel->where('activate_hash', hash('sha256', $token))
                ->where('active', 1)
                ->first();

            if ($user) {
                return view('auth/activate_account', [
                    'status' => 'already_activated',
                    'email' => $user->email
                ]);
            }

            return view('auth/activate_account', [
                'status' => 'invalid_token',
                'email' => $this->request->getGet('email')
            ]);
        }

        // Activate user
        $user->activate();
        $userModel->save($user);

        return view('auth/activate_account', [
            'status' => 'success',
            'email' => $user->email
        ]);
    }

    public function resendActivation()
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
            $user->generateActivateHash();
            $userModel->save($user);

            // Send activation email
            $this->sendActivationEmail($user);

            return redirect()->to('/auth/verify-email')->with('success', 'Activation email sent!')->with('email', $email);
        }

        return redirect()->back();
    }

    private function sendActivationEmail(User $user)
    {
        $email = service('email');

        $email->setTo($user->email);
        $email->setSubject('Activate Your ChegeOS Account');
        $email->setMessage(view('emails/activation', [
            'user' => $user,
            'token' => $user->activate_hash
        ]));

        return $email->send();
    }
}
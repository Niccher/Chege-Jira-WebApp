<?php

use App\Entities\User;

if (!function_exists('sendActivationEmail')) {
    /**
     * Send activation email to user
     *
     * @param User $user
     * @param string $token
     * @return bool
     */
    function sendActivationEmail(User $user, string $token): bool
    {
        $email = \Config\Services::email();

        $email->setFrom('noreply@chegeos.com', 'Chege JIRA');
        $email->setTo($user->email);
        $email->setSubject('Activate Your Chege JIRA Account');

        // Get the email content
        $emailContent = view('emails/activation', [
            'user' => $user,
            'token' => $token
        ]);

        $email->setMessage($emailContent);

        // Set email configuration
        $config = [
            'mailType' => 'html',
            'charset'  => 'utf-8',
            'wordWrap' => true,
        ];

        $email->initialize($config);

        return $email->send();
    }
}

if (!function_exists('sendWelcomeEmail')) {
    /**
     * Send welcome email after successful activation
     *
     * @param User $user
     * @return bool
     */
    function sendWelcomeEmail(User $user): bool
    {
        $email = \Config\Services::email();

        $email->setFrom('welcome@chegeos.com', 'Chege JIRA Team');
        $email->setTo($user->email);
        $email->setSubject('Welcome to Chege JIRA! 🎉');

        $emailContent = view('emails/welcome', [
            'user' => $user
        ]);

        $email->setMessage($emailContent);

        $config = [
            'mailType' => 'html',
            'charset'  => 'utf-8',
            'wordWrap' => true,
        ];

        $email->initialize($config);

        return $email->send();
    }
}
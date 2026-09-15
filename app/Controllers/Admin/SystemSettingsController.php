<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SystemSettingsController extends BaseController
{
    public function index()
    {
        $currentTab = $this->request->getGet('tab') ?? 'general';

        return view('admin/settings/index', [
            'currentTab' => $currentTab,
        ]);
    }

    public function update()
    {
        $tab = $this->request->getPost('tab') ?? 'general';

        if ($tab === 'general') {
            $siteName = trim((string)$this->request->getPost('site_name'));
            $siteDesc = trim((string)$this->request->getPost('site_desc'));
            $supportEmail = trim((string)$this->request->getPost('support_email'));
            $timezone = trim((string)$this->request->getPost('timezone'));

            if (!empty($siteName)) {
                setting('App.siteName', $siteName);
            }
            if ($siteDesc !== '') {
                setting('App.siteDesc', $siteDesc);
            }
            if (!empty($supportEmail)) {
                setting('App.supportEmail', $supportEmail);
            }
            if (!empty($timezone)) {
                setting('App.defaultTimezone', $timezone);
            }

            return redirect()->to(site_url('admin/settings?tab=general'))->with('message', 'General settings saved successfully.');
        }

        if ($tab === 'security') {
            $allowRegistration = $this->request->getPost('allow_registration') ? 1 : 0;
            $requireEmailVerification = $this->request->getPost('require_verification') ? 1 : 0;
            $maxAttempts = (int)($this->request->getPost('max_login_attempts') ?? 5);
            $lockoutMinutes = (int)($this->request->getPost('lockout_minutes') ?? 15);
            $sessionTimeout = (int)($this->request->getPost('session_timeout') ?? 7200);

            setting('Auth.allowRegistration', $allowRegistration);
            setting('Auth.requireEmailVerification', $requireEmailVerification);
            setting('Auth.maxLoginAttempts', max(1, $maxAttempts));
            setting('Auth.lockoutMinutes', max(1, $lockoutMinutes));
            setting('Auth.sessionTimeout', max(300, $sessionTimeout));

            return redirect()->to(site_url('admin/settings?tab=security'))->with('message', 'Security & Session preferences updated.');
        }

        if ($tab === 'email') {
            $fromEmail = trim((string)$this->request->getPost('from_email'));
            $fromName = trim((string)$this->request->getPost('from_name'));
            $smtpHost = trim((string)$this->request->getPost('smtp_host'));
            $smtpPort = (int)($this->request->getPost('smtp_port') ?? 587);
            $smtpCrypto = trim((string)$this->request->getPost('smtp_crypto') ?? 'tls');

            if (!empty($fromEmail)) {
                setting('Email.fromEmail', $fromEmail);
            }
            if (!empty($fromName)) {
                setting('Email.fromName', $fromName);
            }
            if (!empty($smtpHost)) {
                setting('Email.SMTPHost', $smtpHost);
            }
            setting('Email.SMTPPort', $smtpPort);
            setting('Email.SMTPCrypto', $smtpCrypto);

            return redirect()->to(site_url('admin/settings?tab=email'))->with('message', 'Email configuration updated successfully.');
        }

        if ($tab === 'project') {
            $defaultPriority = trim((string)$this->request->getPost('default_priority') ?? 'medium');
            $requireReview = $this->request->getPost('require_review') ? 1 : 0;
            $maxAttachmentMb = (int)($this->request->getPost('max_attachment_mb') ?? 10);

            setting('Project.defaultPriority', $defaultPriority);
            setting('Project.requireReview', $requireReview);
            setting('Project.maxAttachmentMb', max(1, $maxAttachmentMb));

            return redirect()->to(site_url('admin/settings?tab=project'))->with('message', 'Project & Workflow defaults saved.');
        }

        if ($tab === 'maintenance') {
            $maintenanceMode = $this->request->getPost('maintenance_mode') ? 1 : 0;
            $maintenanceNotice = trim((string)$this->request->getPost('maintenance_notice'));

            setting('App.maintenanceMode', $maintenanceMode);
            setting('App.maintenanceNotice', $maintenanceNotice);

            return redirect()->to(site_url('admin/settings?tab=maintenance'))->with('message', 'Maintenance mode state updated.');
        }

        return redirect()->to(site_url('admin/settings'))->with('error', 'Unknown settings tab submitted.');
    }
}

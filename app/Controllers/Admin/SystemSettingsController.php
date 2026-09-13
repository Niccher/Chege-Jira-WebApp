<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SystemSettingsController extends BaseController
{
    public function index()
    {
        return view('admin/settings/index');
    }

    public function update()
    {
        $siteName = $this->request->getPost('site_name');
        
        if (!empty($siteName)) {
            // Use the settings library to store the app name in the database
            setting('App.siteName', $siteName);
            return redirect()->back()->with('message', 'Application settings updated successfully.');
        }

        return redirect()->back()->with('error', 'Application name cannot be empty.');
    }
}

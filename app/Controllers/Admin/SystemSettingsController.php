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
        // Update logic will go here
        return redirect()->back()->with('message', 'Settings updated.');
    }
}

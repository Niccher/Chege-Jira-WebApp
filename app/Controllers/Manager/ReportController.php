<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;

class ReportController extends BaseController
{
    public function index()
    {
        return view('manager/reports/index');
    }

    public function generate()
    {
        // Implementation will be handled in Phase 6
        return redirect()->back()->with('message', 'Report generated.');
    }
}

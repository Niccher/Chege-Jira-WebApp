<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use App\Models\ProjectModel;

class TeamDashboardController extends BaseController
{
    public function index()
    {
        return view('manager/team/index', [
            'stats' => [] // Will populate after models are ready
        ]);
    }
}

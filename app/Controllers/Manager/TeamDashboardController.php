<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use App\Models\ProjectModel;

class TeamDashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // 1. Overall Team Stats
        $taskModel = new TaskModel();
        $totalTasks = $taskModel->countAllResults();
        $approvedTasks = $taskModel->whereIn('status', ['approved', 'done'])->countAllResults();
        $pendingTasks = $taskModel->whereIn('status', ['in_progress', 'review'])->countAllResults();
        
        // 2. Performance Leaderboard (Rank workers by approved/completed tasks)
        $leaderboardQuery = $db->query("
            SELECT 
                u.id as user_id,
                COALESCE(
                    NULLIF(TRIM(CONCAT(COALESCE(u.first_name, ''), ' ', COALESCE(u.last_name, ''))), ''),
                    u.username,
                    i.secret,
                    'Team Member'
                ) as username,
                COUNT(t.id) as completed_tasks
            FROM users u
            LEFT JOIN auth_identities i ON u.id = i.user_id AND i.type = 'email_password'
            LEFT JOIN tasks t ON u.id = t.assigned_to AND t.status IN ('approved', 'done')
            GROUP BY u.id, u.first_name, u.last_name, u.username, i.secret
            ORDER BY completed_tasks DESC
            LIMIT 10
        ");
        
        $leaderboard = $leaderboardQuery->getResultArray();

        return view('manager/team/index', [
            'totalTasks' => $totalTasks,
            'approvedTasks' => $approvedTasks,
            'pendingTasks' => $pendingTasks,
            'leaderboard' => $leaderboard
        ]);
    }
}

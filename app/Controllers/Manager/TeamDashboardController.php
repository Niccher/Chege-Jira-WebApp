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
        $approvedTasks = $taskModel->where('status', 'approved')->countAllResults();
        $pendingTasks = $taskModel->where('status', 'in_progress')->orWhere('status', 'pending_approval')->countAllResults();
        
        // 2. Performance Leaderboard (Rank workers by approved tasks)
        // We join with auth_identities to get the username/email
        $leaderboardQuery = $db->query("
            SELECT 
                u.id as user_id,
                i.secret as username,
                COUNT(t.id) as completed_tasks
            FROM users u
            JOIN auth_identities i ON u.id = i.user_id AND i.type = 'email_password'
            LEFT JOIN tasks t ON u.id = t.assignee_id AND t.status = 'approved'
            GROUP BY u.id
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

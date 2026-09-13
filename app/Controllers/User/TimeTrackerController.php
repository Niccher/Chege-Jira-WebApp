<?php

namespace App\Controllers\User;

use App\Models\ProjectModel;
use App\Models\TimeLogModel;

class TimeTrackerController extends BaseUserController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $projectModel = new ProjectModel();
        $timeModel = new TimeLogModel();

        $data['user'] = $this->currentUser;
        $data['projects'] = $projectModel->where('user_id', $this->userId)->findAll();
        
        // Stats
        $data['todayTime'] = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $this->userId)
            ->where('DATE(start_time)', date('Y-m-d'))
            ->get()->getRow()->duration ?? 0;
        $data['todayTime'] = round($data['todayTime'] / 3600, 1);

        $data['weekTime'] = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $this->userId)
            ->where('start_time >=', date('Y-m-d', strtotime('monday this week')))
            ->get()->getRow()->duration ?? 0;
        $data['weekTime'] = round($data['weekTime'] / 3600, 1);

        $data['monthTime'] = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $this->userId)
            ->where('start_time >=', date('Y-m-01'))
            ->get()->getRow()->duration ?? 0;
        $data['monthTime'] = round($data['monthTime'] / 3600, 1);

        $data['avgDaily'] = 0;
        $daysLogged = $db->table('time_logs')
            ->select('COUNT(DISTINCT DATE(start_time)) as days')
            ->where('user_id', $this->userId)
            ->get()->getRow()->days ?? 1;
        $totalSeconds = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $this->userId)
            ->get()->getRow()->duration ?? 0;
        if ($daysLogged > 0) {
            $data['avgDaily'] = round(($totalSeconds / $daysLogged) / 3600, 1);
        }

        // Paginated Time Entries
        $data['time_logs'] = $timeModel->select('time_logs.*, projects.name as project_name, projects.color as project_color')
            ->join('projects', 'projects.id = time_logs.project_id', 'left')
            ->where('time_logs.user_id', $this->userId)
            ->orderBy('time_logs.start_time', 'DESC')
            ->paginate(5, 'time_logs');
        $data['pager'] = $timeModel->pager;

        // Project Time Breakdown
        $breakdownQuery = $db->table('time_logs')
            ->select('projects.name, projects.color, SUM(time_logs.duration) as total_duration')
            ->join('projects', 'projects.id = time_logs.project_id', 'left')
            ->where('time_logs.user_id', $this->userId)
            ->groupBy('time_logs.project_id')
            ->orderBy('total_duration', 'DESC');
        
        $totalBreakdown = $breakdownQuery->countAllResults(false);
        $pageBreakdown = $this->request->getVar('page_breakdown') ?? 1;
        $data['project_breakdown'] = $breakdownQuery->get(5, ($pageBreakdown - 1) * 5)->getResultArray();
        $data['breakdown_total_pages'] = ceil($totalBreakdown / 5);
        $data['breakdown_current_page'] = $pageBreakdown;
        $data['total_all_duration'] = array_sum(array_column($data['project_breakdown'], 'total_duration')) ?: 1;

        return view('user/time', $data);
    }

    public function logManual()
    {
        $projectId = $this->request->getPost('project_id');
        $taskName = $this->request->getPost('task_name');
        $date = $this->request->getPost('date');
        $durationHours = $this->request->getPost('duration');
        $notes = $this->request->getPost('notes');

        $timeModel = new TimeLogModel();
        $startTime = $date . ' ' . date('H:i:s');
        $durationSeconds = floatval($durationHours) * 3600;

        $timeModel->insert([
            'user_id' => $this->userId,
            'project_id' => $projectId ?: null,
            'task_name' => $taskName,
            'start_time' => $startTime,
            'end_time' => date('Y-m-d H:i:s', strtotime($startTime) + $durationSeconds),
            'duration' => $durationSeconds,
            'notes' => $notes
        ]);

        return redirect()->to(site_url('time'))->with('message', 'Time entry saved successfully.');
    }
}

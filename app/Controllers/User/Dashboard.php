<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * Automatically runs before any controller method
     */
//    public function initController(
//        \CodeIgniter\HTTP\RequestInterface $request,
//        \CodeIgniter\HTTP\ResponseInterface $response,
//        \Psr\Log\LoggerInterface $logger
//    ) {
//        parent::initController($request, $response, $logger);
//
//        // Load admin helper globally
//    }

    public function index()
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        $user = auth()->user();

        $data = [
            'user'           => $user,
            'stats'          => $projectModel->getStats($userId),
            'weeklyFocus'    => $projectModel->getWeeklyFocus($userId),
            'recentActivity' => $projectModel->getRecentActivity($userId),
            'projects'       => $projectModel->where('user_id', $userId)
                                            ->where('is_archived', 0)
                                            ->orderBy('updated_at', 'DESC')
                                            ->limit(5)
                                            ->findAll(),
        ];

        return view('user/home', $data);
    }

    public function projects()
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        $user = auth()->user();

        $data = [
            'user'               => $user,
            'all_projects'       => $projectModel->where('user_id', $userId)->paginate(10, 'all'),
            'active_projects'    => $projectModel->where('user_id', $userId)->where('status', 'in_progress')->paginate(10, 'active'),
            'pending_projects'   => $projectModel->where('user_id', $userId)->whereIn('status', ['planning', 'on_hold'])->paginate(10, 'pending'),
            'completed_projects' => $projectModel->where('user_id', $userId)->where('status', 'completed')->paginate(10, 'completed'),
            'archived_projects'  => $projectModel->where('user_id', $userId)->where('is_archived', 1)->paginate(10, 'archived'),
            'pager'              => $projectModel->pager,
            'stats'              => $projectModel->getStats($userId),
            'tagStats'           => $projectModel->getTagStats($userId),
        ];

        return view('user/projects/index', $data);
    }

    public function project_create()
    {
        $user = auth()->user();
        return view('user/projects/create', ['user' => $user]);
    }

    public function project_store()
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();

        $data = $this->request->getPost();
        $data['user_id'] = $userId;
        $data['is_archived'] = 0;

        // tech_stack and categories are expected as comma-separated or similar from frontend, 
        // but model expects JSON or specific format if we use JSON in DB.
        // The create.php sends them as hidden inputs populated by JS.
        $data['tech_stack'] = json_encode(array_filter(explode(',', $this->request->getPost('tech_stack') ?? '')));
        $data['categories'] = json_encode(array_filter(explode(',', $this->request->getPost('categories') ?? '')));

        if (!$projectModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $projectModel->errors());
        }

        $projectId = $projectModel->getInsertID();

        // Handle Milestones
        $milestones = $this->request->getPost('milestones');
        if (is_array($milestones)) {
            $db = \Config\Database::connect();
            foreach ($milestones as $ms) {
                if (!empty($ms['name'])) {
                    $db->table('project_milestones')->insert([
                        'project_id'  => $projectId,
                        'name'        => $ms['name'],
                        'description' => $ms['description'] ?? null,
                        'due_date'    => !empty($ms['due_date']) ? $ms['due_date'] : null,
                        'status'      => $ms['status'] ?? 'pending',
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }

        return redirect()->to('/projects')->with('message', 'Project created successfully!');
    }

    public function project_view($id = null)
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        $user = auth()->user();
        $db = \Config\Database::connect();
        
        $project = $projectModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $timeStats = $db->table('time_logs')
            ->select('COALESCE(SUM(duration), 0) as total_seconds, 
                      COUNT(DISTINCT DATE(start_time)) as days_logged,
                      COALESCE(SUM(CASE WHEN start_time >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN duration ELSE 0 END), 0) as week_seconds,
                      COALESCE(SUM(CASE WHEN start_time >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN duration ELSE 0 END), 0) as month_seconds')
            ->where('user_id', $userId)
            ->where('project_id', $id)
            ->get()->getRowArray();

        $projectNotes = $db->table('notes')
            ->where('user_id', $userId)
            ->where('project_id', $id)
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get()->getResultArray();

        $data = [
            'user'          => $user,
            'project'       => $project,
            'milestones'    => $projectModel->getMilestones($id),
            'tech_stack'    => json_decode($project['tech_stack'], true) ?? [],
            'categories'    => json_decode($project['categories'], true) ?? [],
            'time_stats'    => $timeStats,
            'project_notes' => $projectNotes,
        ];

        return view('user/projects/view', $data);
    }

    public function project_edit($id = null)
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        $user = auth()->user();
        
        $project = $projectModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = [
            'user'       => $user,
            'project'    => $project,
            'milestones' => $projectModel->getMilestones($id),
            'tech_stack' => json_decode($project['tech_stack'], true) ?? [],
            'categories' => json_decode($project['categories'], true) ?? [],
        ];

        return view('user/projects/edit', $data);
    }

    public function project_update($id = null)
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        
        $project = $projectModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = $this->request->getPost();
        
        $data['tech_stack'] = json_encode(array_filter(explode(',', $this->request->getPost('tech_stack') ?? '')));
        $data['categories'] = json_encode(array_filter(explode(',', $this->request->getPost('categories') ?? '')));

        if (!$projectModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $projectModel->errors());
        }

        // Handle Milestones (Sync)
        $db = \Config\Database::connect();
        $db->table('project_milestones')->where('project_id', $id)->delete();
        
        $milestones = $this->request->getPost('milestones');
        if (is_array($milestones)) {
            foreach ($milestones as $ms) {
                if (!empty($ms['name'])) {
                    $db->table('project_milestones')->insert([
                        'project_id'  => $id,
                        'name'        => $ms['name'],
                        'description' => $ms['description'] ?? null,
                        'due_date'    => !empty($ms['due_date']) ? $ms['due_date'] : null,
                        'status'      => $ms['status'] ?? 'pending',
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }

        return redirect()->to('/projects/view/' . $id)->with('message', 'Project updated successfully!');
    }

    public function project_delete($id = null)
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        
        $project = $projectModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        if ($projectModel->delete($id)) {
            return redirect()->to('/projects')->with('message', 'Project deleted successfully.');
        }

        return redirect()->back()->with('error', 'Could not delete project.');
    }


    public function project_calendar()
    {
        $userId = auth()->id();
        $user = auth()->user();
        $db = \Config\Database::connect();
        $projectModel = new \App\Models\ProjectModel();
        
        $data['user'] = $user;
        $data['projects'] = $projectModel->where('user_id', $userId)->findAll();
        
        // --- 1. Stats Calculation ---
        $now = date('Y-m-d H:i:s');
        $monthStart = date('Y-m-01 00:00:00');
        $monthEnd = date('Y-m-t 23:59:59');

        // Manual Events Count
        $data['total_events'] = $db->table('calendar_events')
            ->where('user_id', $userId)
            ->where('start_time >=', $monthStart)
            ->where('start_time <=', $monthEnd)
            ->countAllResults();

        // Plus Projects Due this month
        $data['total_events'] += $db->table('projects')
            ->where('user_id', $userId)
            ->where('due_date >=', $monthStart)
            ->where('due_date <=', $monthEnd)
            ->countAllResults();

        // Plus Milestones Due this month
        $data['total_events'] += $db->table('project_milestones')
            ->join('projects', 'projects.id = project_milestones.project_id')
            ->where('projects.user_id', $userId)
            ->where('project_milestones.due_date >=', $monthStart)
            ->where('project_milestones.due_date <=', $monthEnd)
            ->countAllResults();

        // Overdue count (Projects & Milestones past due_date and not completed)
        $data['overdue_count'] = $db->table('projects')
            ->where('user_id', $userId)
            ->where('due_date <', date('Y-m-d'))
            ->where('status !=', 'completed')
            ->countAllResults();

        // Completed Stats
        $data['completed_count'] = $db->table('projects')->where('user_id', $userId)->where('status', 'completed')->countAllResults();
        $data['completed_count'] += $db->table('project_milestones')->join('projects', 'projects.id = project_milestones.project_id')->where('projects.user_id', $userId)->where('project_milestones.status', 'completed')->countAllResults();
        $data['completed_count'] += $db->table('notes')->where('user_id', $userId)->where('is_completed', 1)->countAllResults();

        // Pending Stats
        $data['pending_count'] = $db->table('projects')->where('user_id', $userId)->whereIn('status', ['planning', 'in_progress', 'on_hold'])->countAllResults();
        $data['pending_count'] += $db->table('project_milestones')->join('projects', 'projects.id = project_milestones.project_id')->where('projects.user_id', $userId)->where('project_milestones.status !=', 'completed')->countAllResults();
        $data['pending_count'] += $db->table('notes')->where('user_id', $userId)->where('is_completed', 0)->where('is_deleted', 0)->countAllResults();

        // --- 2. Upcoming Events List (Paginated) ---
        $upcoming = [];
        
        // Projects
        $upcomingProjects = $db->table('projects')
            ->where('user_id', $userId)
            ->where('due_date >=', date('Y-m-d'))
            ->orderBy('due_date', 'ASC')
            ->get()->getResultArray();
        foreach ($upcomingProjects as $p) {
            $upcoming[] = [
                'date' => $p['due_date'],
                'title' => $p['name'],
                'desc' => 'Project Deadline',
                'project' => $p['name'],
                'color' => $p['color'],
                'type' => 'project',
                'icon' => 'fa-project-diagram'
            ];
        }

        // Manual
        $upcomingManual = $db->table('calendar_events')
            ->where('user_id', $userId)
            ->where('start_time >=', $now)
            ->orderBy('start_time', 'ASC')
            ->get()->getResultArray();
        foreach ($upcomingManual as $e) {
            $upcoming[] = [
                'date' => date('Y-m-d', strtotime($e['start_time'])),
                'title' => $e['title'],
                'desc' => $e['description'],
                'project' => 'Personal',
                'color' => $e['color'],
                'type' => 'event',
                'icon' => 'fa-calendar-day'
            ];
        }

        usort($upcoming, function($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });

        // Simple custom pagination logic for combined array
        $page = $this->request->getVar('page_upcoming') ?? 1;
        $perPage = 5;
        $totalItems = count($upcoming);
        $data['upcoming_events'] = array_slice($upcoming, ($page - 1) * $perPage, $perPage);
        $data['upcoming_pager'] = service('pager');
        $data['upcoming_total_pages'] = ceil($totalItems / $perPage);
        $data['upcoming_current_page'] = $page;

        // --- 3. Project Distribution ---
        $data['distribution'] = $db->table('calendar_events')
            ->select('projects.name, projects.color, COUNT(calendar_events.id) as count')
            ->join('projects', 'projects.id = calendar_events.project_id', 'left')
            ->where('calendar_events.user_id', $userId)
            ->groupBy('calendar_events.project_id')
            ->get()->getResultArray();
        
        return view('user/calendar', $data);
    }

    public function project_time_tracker()
    {
        $userId = auth()->id();
        $user = auth()->user();
        $db = \Config\Database::connect();
        $projectModel = new \App\Models\ProjectModel();
        $timeModel = new \App\Models\TimeLogModel();

        $data['user'] = $user;
        $data['projects'] = $projectModel->where('user_id', $userId)->findAll();
        
        // Stats
        $data['todayTime'] = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $userId)
            ->where('DATE(start_time)', date('Y-m-d'))
            ->get()->getRow()->duration ?? 0;
        $data['todayTime'] = round($data['todayTime'] / 3600, 1);

        $data['weekTime'] = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $userId)
            ->where('start_time >=', date('Y-m-d', strtotime('monday this week')))
            ->get()->getRow()->duration ?? 0;
        $data['weekTime'] = round($data['weekTime'] / 3600, 1);

        $data['monthTime'] = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $userId)
            ->where('start_time >=', date('Y-m-01'))
            ->get()->getRow()->duration ?? 0;
        $data['monthTime'] = round($data['monthTime'] / 3600, 1);

        $data['avgDaily'] = 0;
        $daysLogged = $db->table('time_logs')
            ->select('COUNT(DISTINCT DATE(start_time)) as days')
            ->where('user_id', $userId)
            ->get()->getRow()->days ?? 1;
        $totalSeconds = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $userId)
            ->get()->getRow()->duration ?? 0;
        if ($daysLogged > 0) {
            $data['avgDaily'] = round(($totalSeconds / $daysLogged) / 3600, 1);
        }

        // Paginated Time Entries
        $data['time_logs'] = $timeModel->select('time_logs.*, projects.name as project_name, projects.color as project_color')
            ->join('projects', 'projects.id = time_logs.project_id', 'left')
            ->where('time_logs.user_id', $userId)
            ->orderBy('time_logs.start_time', 'DESC')
            ->paginate(5, 'time_logs');
        $data['pager'] = $timeModel->pager;

        // Project Time Breakdown (Aggregated & Paginated)
        $breakdownQuery = $db->table('time_logs')
            ->select('projects.name, projects.color, SUM(time_logs.duration) as total_duration')
            ->join('projects', 'projects.id = time_logs.project_id', 'left')
            ->where('time_logs.user_id', $userId)
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

    public function timer_start()
    {
        $userId = auth()->id();
        $projectId = $this->request->getPost('project_id');
        $taskName = $this->request->getPost('task_name');
        
        $timeModel = new \App\Models\TimeLogModel();
        $id = $timeModel->insert([
            'user_id' => $userId,
            'project_id' => $projectId ?: null,
            'task_name' => $taskName,
            'start_time' => date('Y-m-d H:i:s'),
            'notes' => ''
        ], true);

        return $this->response->setJSON(['status' => 'success', 'id' => $id]);
    }

    public function timer_stop($id)
    {
        $timeModel = new \App\Models\TimeLogModel();
        $log = $timeModel->find($id);
        
        if ($log) {
            $endTime = date('Y-m-d H:i:s');
            $startTime = $log['start_time'];
            $duration = strtotime($endTime) - strtotime($startTime);
            
            $timeModel->update($id, [
                'end_time' => $endTime,
                'duration' => $duration
            ]);
            
            return $this->response->setJSON(['status' => 'success', 'duration' => $duration]);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Log not found'], 404);
    }

    public function timer_manual()
    {
        $userId = auth()->id();
        $projectId = $this->request->getPost('project_id');
        $taskName = $this->request->getPost('task_name');
        $date = $this->request->getPost('date');
        $durationHours = $this->request->getPost('duration');
        $notes = $this->request->getPost('notes');

        $timeModel = new \App\Models\TimeLogModel();
        $startTime = $date . ' ' . date('H:i:s');
        $durationSeconds = floatval($durationHours) * 3600;

        $timeModel->insert([
            'user_id' => $userId,
            'project_id' => $projectId ?: null,
            'task_name' => $taskName,
            'start_time' => $startTime,
            'end_time' => date('Y-m-d H:i:s', strtotime($startTime) + $durationSeconds),
            'duration' => $durationSeconds,
            'notes' => $notes
        ]);

        return redirect()->to(site_url('time'))->with('message', 'Time entry saved successfully.');
    }

    public function project_notes()
    {
        $noteModel = new \App\Models\NoteModel();
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        $user = auth()->user();

        $notes = $noteModel->select('notes.*, projects.name as project_name')
            ->join('projects', 'projects.id = notes.project_id', 'left')
            ->where('notes.user_id', $userId)
            ->where('notes.is_deleted', 0)
            ->orderBy('notes.is_starred', 'DESC')
            ->orderBy('notes.created_at', 'DESC')
            ->paginate(5, 'notes');

        $data = [
            'user'     => $user,
            'notes'    => $notes,
            'pager'    => $noteModel->pager,
            'projects' => $projectModel->where('user_id', $userId)->findAll(),
            'stats'    => [
                'total'     => $noteModel->where('user_id', $userId)->where('is_deleted', 0)->countAllResults(),
                'starred'   => $noteModel->where('user_id', $userId)->where('is_deleted', 0)->where('is_starred', 1)->countAllResults(),
                'completed' => $noteModel->where('user_id', $userId)->where('is_deleted', 0)->where('is_completed', 1)->countAllResults(),
                'deleted'   => $noteModel->where('user_id', $userId)->where('is_deleted', 1)->countAllResults(),
            ]
        ];

        return view('user/notes', $data);
    }

    public function note_store()
    {
        $noteModel = new \App\Models\NoteModel();
        $userId = auth()->id();

        $data = $this->request->getPost();
        $data['user_id'] = $userId;
        $data['tags'] = json_encode(array_filter(array_map('trim', explode(',', $this->request->getPost('tags') ?? ''))));

        if ($noteModel->insert($data)) {
            return redirect()->to('/notes')->with('message', 'Note created successfully.');
        }

        return redirect()->back()->withInput()->with('errors', $noteModel->errors());
    }

    public function note_update($id = null)
    {
        $noteModel = new \App\Models\NoteModel();
        $userId = auth()->id();

        $note = $noteModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$note) {
            return redirect()->to('/notes')->with('error', 'Note not found.');
        }

        $data = $this->request->getPost();
        if (isset($data['tags'])) {
            $data['tags'] = json_encode(array_filter(array_map('trim', explode(',', $data['tags']))));
        }

        if ($noteModel->update($id, $data)) {
            return redirect()->to('/notes')->with('message', 'Note updated successfully.');
        }

        return redirect()->back()->withInput()->with('errors', $noteModel->errors());
    }

    public function note_delete($id = null)
    {
        $noteModel = new \App\Models\NoteModel();
        $userId = auth()->id();

        $note = $noteModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$note) {
            return redirect()->to('/notes')->with('error', 'Note not found.');
        }

        if ($noteModel->update($id, ['is_deleted' => 1])) {
            return redirect()->to('/notes')->with('message', 'Note deleted.');
        }

        return redirect()->back()->with('error', 'Could not delete note.');
    }

    public function note_star($id = null)
    {
        $noteModel = new \App\Models\NoteModel();
        $userId = auth()->id();

        $note = $noteModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$note) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Note not found']);
        }

        $newStatus = $note['is_starred'] ? 0 : 1;
        $noteModel->update($id, ['is_starred' => $newStatus]);

        return $this->response->setJSON(['status' => 'success', 'is_starred' => $newStatus]);
    }

    public function note_complete($id = null)
    {
        $noteModel = new \App\Models\NoteModel();
        $userId = auth()->id();

        $note = $noteModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$note) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Note not found']);
        }

        $newStatus = $note['is_completed'] ? 0 : 1;
        $noteModel->update($id, ['is_completed' => $newStatus]);

        return $this->response->setJSON(['status' => 'success', 'is_completed' => $newStatus]);
    }

    public function get_calendar_events()
    {
        $userId = auth()->id();
        $db = \Config\Database::connect();
        $events = [];

        // 1. Manual Events
        $eventModel = new \App\Models\EventModel();
        $manualEvents = $eventModel->where('user_id', $userId)->findAll();
        foreach ($manualEvents as $event) {
            $events[] = [
                'id'    => 'event_' . $event['id'],
                'title' => $event['title'],
                'start' => $event['start_time'],
                'end'   => $event['end_time'],
                'color' => $event['color'],
                'allDay' => (bool)$event['is_all_day'],
                'extendedProps' => [
                    'type' => 'manual',
                    'description' => $event['description'],
                    'dbId' => $event['id'],
                    'icon' => 'fa-calendar-day'
                ]
            ];
        }

        // 2. Project Due Dates
        $projects = $db->table('projects')
                       ->where('user_id', $userId)
                       ->where('due_date IS NOT NULL')
                       ->get()->getResultArray();
        foreach ($projects as $project) {
            $events[] = [
                'id'    => 'project_' . $project['id'],
                'title' => 'DUE: ' . $project['name'],
                'start' => $project['due_date'],
                'color' => $project['color'] ?? '#6366f1',
                'allDay' => true,
                'extendedProps' => [
                    'type' => 'project',
                    'description' => 'Project target completion date',
                    'dbId' => $project['id'],
                    'icon' => 'fa-project-diagram'
                ]
            ];
        }

        // 3. Milestone Events (Started, Completed)
        $milestones = $db->table('project_milestones')
                         ->select('project_milestones.*, projects.name as project_name, projects.color as project_color')
                         ->join('projects', 'projects.id = project_milestones.project_id')
                         ->where('projects.user_id', $userId)
                         ->get()->getResultArray();
        
        foreach ($milestones as $ms) {
            // Milestone Started
            if ($ms['status'] === 'in_progress') {
                $events[] = [
                    'id'    => 'ms_start_' . $ms['id'],
                    'title' => 'START: ' . $ms['name'],
                    'start' => $ms['updated_at'], // Using updated_at as start surrogate if no specific start_date
                    'color' => '#3b82f6',
                    'allDay' => true,
                    'extendedProps' => [
                        'type' => 'milestone_started',
                        'description' => 'Working on "' . $ms['name'] . '" for ' . $ms['project_name'],
                        'dbId' => $ms['id'],
                        'icon' => 'fa-play-circle'
                    ]
                ];
            }

            // Milestone Completed
            if ($ms['status'] === 'completed') {
                $events[] = [
                    'id'    => 'ms_done_' . $ms['id'],
                    'title' => 'GOAL: ' . $ms['name'],
                    'start' => $ms['completed_at'] ?? $ms['updated_at'],
                    'color' => '#10b981',
                    'allDay' => true,
                    'extendedProps' => [
                        'type' => 'milestone_completed',
                        'description' => 'Achieved "' . $ms['name'] . '" for ' . $ms['project_name'],
                        'dbId' => $ms['id'],
                        'icon' => 'fa-flag-checkered'
                    ]
                ];
            }

            // Also show Due Date if it exists and not completed
            if (!empty($ms['due_date']) && $ms['status'] !== 'completed') {
                $events[] = [
                    'id'    => 'ms_due_' . $ms['id'],
                    'title' => 'DUE: ' . $ms['name'],
                    'start' => $ms['due_date'],
                    'color' => '#f59e0b',
                    'allDay' => true,
                    'extendedProps' => [
                        'type' => 'milestone',
                        'description' => 'Deadline for "' . $ms['name'] . '"',
                        'dbId' => $ms['id'],
                        'icon' => 'fa-clock'
                    ]
                ];
            }
        }

        // 4. Note Events (General/Personal or Project-based)
        $noteModel = new \App\Models\NoteModel();
        $notes = $noteModel->where('user_id', $userId)->findAll();
        foreach ($notes as $note) {
            $isProject = !empty($note['project_id']);
            $type = $isProject ? 'note_project' : 'note_general';
            $icon = $isProject ? 'fa-sticky-note' : 'fa-lightbulb';
            $color = $isProject ? '#6366f1' : '#f59e0b';
            
            // Note Created
            $events[] = [
                'id'    => 'note_new_' . $note['id'],
                'title' => ($isProject ? 'PROJECT: ' : 'IDEA: ') . $note['title'],
                'start' => $note['created_at'],
                'color' => $color,
                'allDay' => true,
                'extendedProps' => [
                    'type' => $type,
                    'description' => 'Note: ' . $note['title'],
                    'dbId' => $note['id'],
                    'icon' => $icon
                ]
            ];

            // Note Completed
            if ($note['is_completed'] == 1) {
                $events[] = [
                    'id'    => 'note_done_' . $note['id'],
                    'title' => 'DONE: ' . $note['title'],
                    'start' => $note['updated_at'],
                    'color' => '#10b981',
                    'allDay' => true,
                    'extendedProps' => [
                        'type' => 'note_completed',
                        'description' => 'Completed note: ' . $note['title'],
                        'dbId' => $note['id'],
                        'icon' => 'fa-check-circle'
                    ]
                ];
            }
        }

        // 5. Time Logs
        $timeModel = new \App\Models\TimeLogModel();
        $logs = $timeModel->where('user_id', $userId)->findAll();
        foreach ($logs as $log) {
            $events[] = [
                'id'    => 'time_' . $log['id'],
                'title' => 'TIME: ' . $log['task_name'],
                'start' => $log['start_time'],
                'end'   => $log['end_time'],
                'color' => '#8b5cf6',
                'extendedProps' => [
                    'type' => 'time_log',
                    'description' => 'Time tracked: ' . $log['task_name'] . ($log['notes'] ? ' - ' . $log['notes'] : ''),
                    'dbId' => $log['id'],
                    'icon' => 'fa-clock'
                ]
            ];
        }

        return $this->response->setJSON($events);
    }

    public function event_store()
    {
        $eventModel = new \App\Models\EventModel();
        $data = $this->request->getPost();
        $data['user_id'] = auth()->id();

        if (empty($data['project_id'])) {
            $data['project_id'] = null;
        }

        if ($eventModel->insert($data)) {
            return redirect()->to('/calendar')->with('message', 'Event added successfully.');
        }

        return redirect()->back()->withInput()->with('errors', $eventModel->errors());
    }

    public function event_update($id = null)
    {
        $eventModel = new \App\Models\EventModel();
        $userId = auth()->id();
        
        $event = $eventModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$event) {
            return redirect()->to('/calendar')->with('error', 'Event not found.');
        }

        $data = $this->request->getPost();
        if (empty($data['project_id'])) {
            $data['project_id'] = null;
        }

        if ($eventModel->update($id, $data)) {
            return redirect()->to('/calendar')->with('message', 'Event updated successfully.');
        }

        return redirect()->back()->withInput()->with('errors', $eventModel->errors());
    }

    public function event_delete($id = null)
    {
        $eventModel = new \App\Models\EventModel();
        $userId = auth()->id();

        $event = $eventModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$event) {
            return redirect()->to('/calendar')->with('error', 'Event not found.');
        }

        $eventModel->delete($id);
        return redirect()->to('/calendar')->with('message', 'Event deleted.');
    }

    public function project_analytics()
    {
        $userId = auth()->id();
        $user = auth()->user();
        $db = \Config\Database::connect();
        $projectModel = new \App\Models\ProjectModel();

        // Total projects count
        $totalProjects = $projectModel->where('user_id', $userId)->countAllResults();
        $completedProjects = $projectModel->where('user_id', $userId)->where('status', 'completed')->countAllResults();

        // Completion rate
        $completionRate = $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100) : 0;

        // Hours logged
        $totalSeconds = $db->table('time_logs')
            ->selectSum('duration')
            ->where('user_id', $userId)
            ->get()->getRow()->duration ?? 0;
        $totalHours = round($totalSeconds / 3600, 1);

        // Avg daily
        $daysLogged = $db->table('time_logs')
            ->select('COUNT(DISTINCT DATE(start_time)) as days')
            ->where('user_id', $userId)
            ->get()->getRow()->days ?? 1;
        $avgDaily = $daysLogged > 0 ? round($totalHours / $daysLogged, 1) : 0;

        // Monthly trends (last 6 months)
        $monthlyTrends = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-{$i} months"));
            $monthStart = $month . '-01';
            $monthEnd = date('Y-m-t', strtotime($monthStart));
            
            $started = $projectModel->where('user_id', $userId)
                ->where('created_at >=', $monthStart)
                ->where('created_at <=', $monthEnd . ' 23:59:59')
                ->countAllResults();
            
            $done = $projectModel->where('user_id', $userId)
                ->where('updated_at >=', $monthStart)
                ->where('updated_at <=', $monthEnd . ' 23:59:59')
                ->where('status', 'completed')
                ->countAllResults();

            $monthlyTrends[] = [
                'month' => date('M', strtotime($monthStart)),
                'started' => $started,
                'completed' => $done,
            ];
        }

        // Project health distribution
        $good = $projectModel->where('user_id', $userId)->where('status', 'in_progress')->where('progress >=', 50)->countAllResults();
        $warning = $projectModel->where('user_id', $userId)->where('status', 'in_progress')->where('progress <', 50)->where('progress >', 0)->countAllResults();
        $danger = $projectModel->where('user_id', $userId)->whereIn('status', ['planning', 'on_hold'])->countAllResults();
        $archived = $projectModel->where('user_id', $userId)->where('is_archived', 1)->countAllResults();
        $healthTotal = max($good + $warning + $danger + $archived, 1);

        // Time distribution by project
        $timeDistribution = $db->table('time_logs')
            ->select('projects.name, projects.color, COALESCE(SUM(time_logs.duration), 0) as total_duration')
            ->join('projects', 'projects.id = time_logs.project_id', 'left')
            ->where('time_logs.user_id', $userId)
            ->groupBy('time_logs.project_id')
            ->orderBy('total_duration', 'DESC')
            ->limit(5)
            ->get()->getResultArray();

        $allTimeTotal = max(array_sum(array_column($timeDistribution, 'total_duration')), 1);

        // Activity heatmap data - last 30 days
        $heatmapData = [];
        for ($i = 29; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime("-{$i} days"));
            $activityCount = 0;
            
            $activityCount += $db->table('time_logs')
                ->where('user_id', $userId)
                ->where('DATE(start_time)', $day)
                ->countAllResults();
            
            $activityCount += $db->table('notes')
                ->where('user_id', $userId)
                ->where('DATE(created_at)', $day)
                ->countAllResults();

            $activityCount += $db->table('projects')
                ->where('user_id', $userId)
                ->where('DATE(updated_at)', $day)
                ->countAllResults();

            $heatmapData[] = [
                'date' => $day,
                'count' => min($activityCount, 4),
            ];
        }

        // Insights
        $insights = [];
        if ($completionRate >= 50) {
            $insights[] = [
                'type' => 'positive',
                'icon' => 'fa-arrow-up',
                'color' => 'text-success',
                'title' => 'Productivity Increase',
                'message' => "Your completion rate is {$completionRate}%. Keep up the momentum!",
            ];
        } else {
            $insights[] = [
                'type' => 'warning',
                'icon' => 'fa-clock',
                'color' => 'text-warning',
                'title' => 'Time Distribution',
                'message' => 'Consider breaking down projects into smaller, achievable milestones.',
            ];
        }

        $overdueCount = $db->table('projects')
            ->where('user_id', $userId)
            ->where('due_date <', date('Y-m-d'))
            ->where('status !=', 'completed')
            ->countAllResults();
        
        if ($overdueCount > 0) {
            $insights[] = [
                'type' => 'danger',
                'icon' => 'fa-exclamation-triangle',
                'color' => 'text-danger',
                'title' => 'Overdue Projects',
                'message' => "You have {$overdueCount} overdue project(s) that need attention.",
            ];
        }

        $insights[] = [
            'type' => 'info',
            'icon' => 'fa-calendar',
            'color' => 'text-info',
            'title' => 'Consistency',
            'message' => $daysLogged > 0 ? "You've logged time on {$daysLogged} different days. " . ($avgDaily > 0 ? "Average {$avgDaily}h/day." : '') : 'Start tracking time to see consistency insights.',
        ];

        // Completed this month
        $monthStart = date('Y-m-01');
        $monthEnd = date('Y-m-t 23:59:59');
        $completedThisMonth = $projectModel->where('user_id', $userId)
            ->where('status', 'completed')
            ->where('updated_at >=', $monthStart)
            ->where('updated_at <=', $monthEnd)
            ->findAll();

        // Stalled projects (no update in 14+ days)
        $stalledProjects = $projectModel->where('user_id', $userId)
            ->where('status', 'in_progress')
            ->where('updated_at <', date('Y-m-d', strtotime('-14 days')))
            ->where('is_archived', 0)
            ->findAll();

        $stalledTasks = [];
        foreach ($stalledProjects as $sp) {
            $stalledTasks[] = esc($sp['name']) . ' has been inactive for ' . round((time() - strtotime($sp['updated_at'])) / 86400) . ' days';
        }

        // Recent notes completed
        $recentDone = [];
        $doneNotes = $db->table('notes')
            ->where('user_id', $userId)
            ->where('is_completed', 1)
            ->where('is_deleted', 0)
            ->orderBy('updated_at', 'DESC')
            ->limit(5)
            ->get()->getResultArray();
        foreach ($doneNotes as $dn) {
            $recentDone[] = esc($dn['title']);
        }

        $data = [
            'user'              => $user,
            'totalProjects'     => $totalProjects,
            'completionRate'    => $completionRate,
            'totalHours'        => $totalHours,
            'avgDaily'          => $avgDaily,
            'monthlyTrends'     => $monthlyTrends,
            'good'              => $good,
            'warningCount'      => $warning,
            'dangerCount'       => $danger,
            'archivedCount'     => $archived,
            'healthTotal'       => $healthTotal,
            'goodPct'           => round(($good / $healthTotal) * 100),
            'warningPct'        => round(($warning / $healthTotal) * 100),
            'dangerPct'         => round(($danger / $healthTotal) * 100),
            'archivedPct'       => round(($archived / $healthTotal) * 100),
            'timeDistribution'  => $timeDistribution,
            'allTimeTotal'      => $allTimeTotal,
            'heatmapData'       => $heatmapData,
            'insights'          => $insights,
            'completedThisMonth' => $completedThisMonth,
            'stalledTasks'      => $stalledTasks,
            'recentDone'        => $recentDone,
            'thisMonthStarted'  => $projectModel->where('user_id', $userId)
                ->where('created_at >=', $monthStart)
                ->where('created_at <=', $monthEnd)
                ->countAllResults(),
            'projectsCount'     => $totalProjects,
        ];

        return view('user/analytics', $data);
    }

    public function project_settings()
    {
        $user = auth()->user();
        $user->preferences = $user->preferences ?? [];
        return view('user/settings', ['user' => $user]);
    }

    public function settings_update()
    {
        $user = auth()->user();
        $model = new \App\Models\UserModel();

        $data = [];

        if ($this->request->getPost('first_name') !== null) {
            $data['first_name'] = $this->request->getPost('first_name');
        }
        if ($this->request->getPost('last_name') !== null) {
            $data['last_name'] = $this->request->getPost('last_name');
        }
        if ($this->request->getPost('bio') !== null) {
            $data['bio'] = $this->request->getPost('bio');
        }
        if ($this->request->getPost('timezone') !== null) {
            $data['timezone'] = $this->request->getPost('timezone');
        }
        if ($this->request->getPost('date_format') !== null) {
            $data['date_format'] = $this->request->getPost('date_format');
        }

        // Handle avatar upload
        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $newName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads/avatars', $newName);
            $data['avatar'] = 'uploads/avatars/' . $newName;
        }

        // Gather preferences
        $preferences = is_array($user->preferences) ? $user->preferences : [];
        $prefFields = ['theme', 'accent_color', 'density', 'animations', 'sidebar_collapsed',
                       'notifications_email_project_updates', 'notifications_email_weekly_reports',
                       'notifications_email_stalled', 'notifications_inapp_due_dates',
                       'notifications_inapp_achievements', 'notifications_inapp_tips',
                       'notification_digest', 'reminder_time',
                       'default_priority', 'default_status', 'auto_archive_completed',
                       'show_stalled_alerts', 'kanban_default_columns', 'kanban_card_density',
                       'idle_timeout', 'rounding_interval', 'auto_break', 'timer_sound',
                       'weekly_goal_hours', 'daily_goal_hours', 'auto_weekly_report', 'show_billable'];

        foreach ($prefFields as $field) {
            $val = $this->request->getPost($field);
            if ($val !== null) {
                $preferences[$field] = $val;
            }
        }
        $data['preferences'] = json_encode($preferences);

        if ($model->update($user->id, $data)) {
            return redirect()->to('/settings')->with('message', 'Settings saved successfully!');
        }

        return redirect()->back()->withInput()->with('errors', $model->errors());
    }

    /**
     * Display Kanban board for a project
     */
    public function project_kanban($id = null)
    {
        $projectModel = new \App\Models\ProjectModel();
        $taskModel = new \App\Models\TaskModel();
        $userId = auth()->id();
        $user = auth()->user();

        if ($id === null) {
            $latestProject = $projectModel->where('user_id', $userId)
                                          ->orderBy('updated_at', 'DESC')
                                          ->first();
            if ($latestProject) {
                return redirect()->to('projects/kanban/' . $latestProject['id']);
            } else {
                return redirect()->to('projects')->with('error', 'Please create a project first to use the Kanban board.');
            }
        }

        $project = $projectModel->where('user_id', $userId)->find($id);

        if (!$project) {
            return redirect()->to('projects')->with('error', 'Project not found.');
        }

        $cats = $projectModel->getCategoriesByProjectId($id);
        $tech = $projectModel->getTechStackByProjectId($id);

        $data = [
            'user'       => $user,
            'project'    => $project,
            'projects'   => $projectModel->where('user_id', $userId)->orderBy('updated_at', 'DESC')->findAll(),
            'categories' => $cats,
            'tech_stack' => $tech,
            'boardData'  => $taskModel->getBoardData($id, $userId)
        ];

        return view('user/projects/kanban', $data);
    }

    /**
     * Move a task between columns
     */
    public function task_move()
    {
        $taskModel = new \App\Models\TaskModel();
        $userId = auth()->id();

        $taskId = $this->request->getPost('task_id');
        $newStatus = $this->request->getPost('status');
        $newOrder = $this->request->getPost('order');

        $task = $taskModel->where('user_id', $userId)->find($taskId);

        if (!$task) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Task not found']);
        }

        $taskModel->update($taskId, [
            'status'      => $newStatus,
            'order_index' => $newOrder
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    /**
     * Store a new task
     */
    public function task_store()
    {
        $taskModel = new \App\Models\TaskModel();
        $userId = auth()->id();

        $data = [
            'user_id'     => $userId,
            'project_id'  => $this->request->getPost('project_id'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status') ?? 'todo',
            'priority'    => $this->request->getPost('priority') ?? 'medium',
            'order_index' => 0,
        ];

        $taskModel->insert($data);

        return redirect()->back()->with('success', 'Task added successfully.');
    }

    /**
     * Update a task (title, description, priority, due_date)
     */
    public function task_update($id = null)
    {
        $taskModel = new \App\Models\TaskModel();
        $userId = auth()->id();

        $task = $taskModel->where('user_id', $userId)->find($id);
        if (!$task) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Task not found']);
        }

        $allowedFields = ['title', 'description', 'priority', 'due_date', 'status'];
        $data = [];
        foreach ($allowedFields as $field) {
            $value = $this->request->getPost($field);
            if ($value !== null) {
                $data[$field] = $value;
            }
        }

        if (empty($data)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No data provided']);
        }

        $taskModel->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }
}
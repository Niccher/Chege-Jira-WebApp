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

        $data = [
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

        $data = [
            'projects' => $projectModel->where('user_id', $userId)->findAll(),
            'stats'    => $projectModel->getStats($userId),
            'tagStats' => $projectModel->getTagStats($userId),
        ];

        return view('user/projects/index', $data);
    }

    public function project_create()
    {
        return view('user/projects/create');
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
        
        $project = $projectModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = [
            'project'    => $project,
            'milestones' => $projectModel->getMilestones($id),
            'tech_stack' => json_decode($project['tech_stack'], true) ?? [],
            'categories' => json_decode($project['categories'], true) ?? [],
        ];

        return view('user/projects/view', $data);
    }

    public function project_edit($id = null)
    {
        $projectModel = new \App\Models\ProjectModel();
        $userId = auth()->id();
        
        $project = $projectModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = [
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

    public function project_kanban()
    {
        return view('user/kanban');
    }

    public function project_calendar()
    {
        return view('user/calendar');
    }

    public function project_time_tracker()
    {
        return view('user/time');
    }

    public function project_notes()
    {
        return view('user/notes');
    }

    public function project_analytics()
    {
        return view('user/analytics');
    }

    public function project_settings()
    {
        return view('user/settings');
    }
}
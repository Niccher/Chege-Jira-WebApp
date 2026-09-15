<?php

namespace App\Controllers\User;

use App\Models\ProjectModel;

class ProjectController extends BaseUserController
{
    public function index()
    {
        $projectModel = new ProjectModel();

        $data = [
            'user'               => $this->currentUser,
            'all_projects'       => $projectModel->where('user_id', $this->userId)->paginate(10, 'all'),
            'active_projects'    => $projectModel->where('user_id', $this->userId)->where('status', 'in_progress')->paginate(10, 'active'),
            'pending_projects'   => $projectModel->where('user_id', $this->userId)->whereIn('status', ['planning', 'on_hold'])->paginate(10, 'pending'),
            'completed_projects' => $projectModel->where('user_id', $this->userId)->where('status', 'completed')->paginate(10, 'completed'),
            'archived_projects'  => $projectModel->where('user_id', $this->userId)->where('is_archived', 1)->paginate(10, 'archived'),
            'pager'              => $projectModel->pager,
            'stats'              => $projectModel->getStats($this->userId),
            'tagStats'           => $projectModel->getTagStats($this->userId),
        ];

        return view('user/projects/index', $data);
    }

    public function create()
    {
        return view('user/projects/create', ['user' => $this->currentUser]);
    }

    public function store()
    {
        $projectModel = new ProjectModel();

        $data = $this->request->getPost();
        $data['user_id'] = $this->userId;
        $data['is_archived'] = 0;

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

        $createdProject = $projectModel->find($projectId);
        $redirectSlug = $createdProject['slug'] ?? $projectId;

        return redirect()->to(site_url('projects/view/' . $redirectSlug))->with('message', 'Project created successfully!');
    }

    public function view($identifier)
    {
        $projectModel = new ProjectModel();
        $db = \Config\Database::connect();
        $isAdmin = auth()->user() && auth()->user()->inGroup('admin', 'manager');
        
        $project = $projectModel->findByIdentifier($identifier, $this->userId, $isAdmin);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found or unauthorized.');
        }

        $projectId = (int)$project['id'];

        $timeStats = $db->table('time_logs')
            ->select('COALESCE(SUM(duration), 0) as total_seconds, 
                      COUNT(DISTINCT DATE(start_time)) as days_logged,
                      COALESCE(SUM(CASE WHEN start_time >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN duration ELSE 0 END), 0) as week_seconds,
                      COALESCE(SUM(CASE WHEN start_time >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN duration ELSE 0 END), 0) as month_seconds')
            ->where('project_id', $projectId)
            ->get()->getRowArray();

        $projectNotes = $db->table('notes')
            ->where('project_id', $projectId)
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get()->getResultArray();

        $data = [
            'user'          => $this->currentUser,
            'project'       => $project,
            'milestones'    => $projectModel->getMilestones($projectId),
            'tech_stack'    => json_decode($project['tech_stack'], true) ?? [],
            'categories'    => json_decode($project['categories'], true) ?? [],
            'time_stats'    => $timeStats,
            'project_notes' => $projectNotes,
        ];

        return view('user/projects/view', $data);
    }

    public function edit($identifier)
    {
        $projectModel = new ProjectModel();
        $isAdmin = auth()->user() && auth()->user()->inGroup('admin', 'manager');
        
        $project = $projectModel->findByIdentifier($identifier, $this->userId, $isAdmin);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found or unauthorized.');
        }

        $projectId = (int)$project['id'];

        $data = [
            'user'       => $this->currentUser,
            'project'    => $project,
            'milestones' => $projectModel->getMilestones($projectId),
            'tech_stack' => json_decode($project['tech_stack'], true) ?? [],
            'categories' => json_decode($project['categories'], true) ?? [],
        ];

        return view('user/projects/edit', $data);
    }

    public function update($identifier)
    {
        $projectModel = new ProjectModel();
        $isAdmin = auth()->user() && auth()->user()->inGroup('admin', 'manager');
        
        $project = $projectModel->findByIdentifier($identifier, $this->userId, $isAdmin);
        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found or unauthorized.');
        }

        $id = (int)$project['id'];
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

        $refreshed = $projectModel->find($id);
        $redirectSlug = $refreshed['slug'] ?? $id;

        return redirect()->to(site_url('projects/view/' . $redirectSlug))->with('message', 'Project updated successfully!');
    }

    public function delete($identifier)
    {
        $projectModel = new ProjectModel();
        $isAdmin = auth()->user() && auth()->user()->inGroup('admin', 'manager');
        
        $project = $projectModel->findByIdentifier($identifier, $this->userId, $isAdmin);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found or unauthorized.');
        }

        if ($projectModel->delete($project['id'])) {
            return redirect()->to('/projects')->with('message', 'Project deleted successfully.');
        }

        return redirect()->back()->with('error', 'Could not delete project.');
    }

    public function archive($identifier)
    {
        $projectModel = new ProjectModel();
        $isAdmin = auth()->user() && auth()->user()->inGroup('admin', 'manager');
        
        $project = $projectModel->findByIdentifier($identifier, $this->userId, $isAdmin);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found or unauthorized.');
        }

        $id = (int)$project['id'];
        $newArchiveStatus = empty($project['is_archived']) ? 1 : 0;
        $projectModel->update($id, ['is_archived' => $newArchiveStatus]);

        $statusMsg = $newArchiveStatus ? 'Project archived successfully.' : 'Project unarchived successfully.';
        return redirect()->to('/projects')->with('message', $statusMsg);
    }
}

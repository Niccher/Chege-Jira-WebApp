<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'name', 'description', 'tech_stack', 'status', 
        'priority', 'start_date', 'due_date', 'progress', 
        'repository_url', 'categories', 'icon', 'color', 
        'budget', 'is_archived'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[255]',
        'description' => 'required',
        'status'      => 'required|in_list[planning,in_progress,testing,completed,on_hold,abandoned]',
        'priority'    => 'required|in_list[low,medium,high,critical]',
    ];

    /**
     * Get milestones for a project
     */
    public function getMilestones(int $projectId)
    {
        $db = \Config\Database::connect();
        return $db->table('project_milestones')
                  ->where('project_id', $projectId)
                  ->get()
                  ->getResultArray();
    }

    /**
     * Get statistics for projects
     */
    public function getStats(int $userId)
    {
        return [
            'total'    => $this->where('user_id', $userId)->countAllResults(),
            'active'   => $this->where('user_id', $userId)->where('status', 'in_progress')->countAllResults(),
            'pending'   => $this->where('user_id', $userId)->whereIn('status', ['planning', 'on_hold'])->countAllResults(),
            'completed' => $this->where('user_id', $userId)->where('status', 'completed')->countAllResults(),
            'archived'  => $this->where('user_id', $userId)->where('is_archived', 1)->countAllResults(),
        ];
    }

    /**
     * Get tag/category statistics
     */
    public function getTagStats(int $userId)
    {
        $projects = $this->where('user_id', $userId)->findAll();
        $tagStats = [];

        foreach ($projects as $project) {
            $categories = json_decode($project['categories'], true);
            if (is_array($categories)) {
                foreach ($categories as $cat) {
                    if (!isset($tagStats[$cat])) {
                        $tagStats[$cat] = 0;
                    }
                    $tagStats[$cat]++;
                }
            }
        }

        return $tagStats;
    }

    /**
     * Get weekly focus projects (Top 3 by priority and progress)
     */
    public function getWeeklyFocus(int $userId)
    {
        return $this->where('user_id', $userId)
                    ->where('status', 'in_progress')
                    ->orderBy('priority', 'DESC')
                    ->orderBy('progress', 'ASC')
                    ->limit(3)
                    ->findAll();
    }

    /**
     * Get recent activity (projects, milestones, and notes)
     */
    public function getRecentActivity(int $userId)
    {
        $db = \Config\Database::connect();
        $activity = [];

        // 1. Project Activities (Created, Completed, Archived)
        $projects = $this->where('user_id', $userId)
                         ->orderBy('updated_at', 'DESC')
                         ->limit(10)
                         ->findAll();
        
        foreach ($projects as $p) {
            // Project Created
            $activity[] = [
                'type' => 'project_created',
                'title' => 'Project Created',
                'description' => 'Started new project: ' . $p['name'],
                'time' => $p['created_at'],
                'icon' => 'fa-plus-circle',
                'bg' => 'rgba(16, 185, 129, 0.2)',
                'color' => '#10b981'
            ];

            // Project Completed
            if ($p['status'] === 'completed') {
                $activity[] = [
                    'type' => 'project_completed',
                    'title' => 'Project Completed',
                    'description' => 'Finished work on ' . $p['name'],
                    'time' => $p['updated_at'],
                    'icon' => 'fa-check-double',
                    'bg' => 'rgba(99, 102, 241, 0.2)',
                    'color' => '#6366f1'
                ];
            }

            // Project Archived
            if ($p['is_archived'] == 1) {
                $activity[] = [
                    'type' => 'project_archived',
                    'title' => 'Project Archived',
                    'description' => esc($p['name']) . ' was moved to archives',
                    'time' => $p['updated_at'],
                    'icon' => 'fa-archive',
                    'bg' => 'rgba(148, 163, 184, 0.2)',
                    'color' => '#94a3b8'
                ];
            }
        }

        // 2. Milestone Activities (Started, Completed)
        $milestones = $db->table('project_milestones')
                         ->select('project_milestones.*, projects.name as project_name')
                         ->join('projects', 'projects.id = project_milestones.project_id')
                         ->where('projects.user_id', $userId)
                         ->orderBy('project_milestones.updated_at', 'DESC')
                         ->limit(10)
                         ->get()
                         ->getResultArray();

        foreach ($milestones as $m) {
            if ($m['status'] === 'completed') {
                $activity[] = [
                    'type' => 'milestone_completed',
                    'title' => 'Milestone Achieved',
                    'description' => 'Completed "' . $m['name'] . '" for ' . $m['project_name'],
                    'time' => $m['updated_at'],
                    'icon' => 'fa-flag-checkered',
                    'bg' => 'rgba(16, 185, 129, 0.2)',
                    'color' => '#10b981'
                ];
            } elseif ($m['status'] === 'in_progress') {
                $activity[] = [
                    'type' => 'milestone_started',
                    'title' => 'Milestone Started',
                    'description' => 'Working on "' . $m['name'] . '" in ' . $m['project_name'],
                    'time' => $m['updated_at'],
                    'icon' => 'fa-play-circle',
                    'bg' => 'rgba(59, 130, 246, 0.2)',
                    'color' => '#3b82f6'
                ];
            }
        }

        // 3. Note Activities (Created, Completed)
        $notes = $db->table('notes')
                    ->where('user_id', $userId)
                    ->orderBy('updated_at', 'DESC')
                    ->limit(10)
                    ->get()
                    ->getResultArray();

        foreach ($notes as $n) {
            // New Note
            if ($n['created_at'] === $n['updated_at']) {
                $activity[] = [
                    'type' => 'new_note',
                    'title' => 'Idea Captured',
                    'description' => 'Added new note: ' . $n['title'],
                    'time' => $n['created_at'],
                    'icon' => 'fa-sticky-note',
                    'bg' => 'rgba(245, 158, 11, 0.2)',
                    'color' => '#f59e0b'
                ];
            }

            // Note Completed
            if ($n['is_completed'] == 1) {
                $activity[] = [
                    'type' => 'note_completed',
                    'title' => 'Note Completed',
                    'description' => 'Marked "' . $n['title'] . '" as done',
                    'time' => $n['updated_at'],
                    'icon' => 'fa-check-circle',
                    'bg' => 'rgba(16, 185, 129, 0.2)',
                    'color' => '#10b981'
                ];
            }
        }

        // Sort by time DESC
        usort($activity, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        // Unique filter (to avoid showing "Project Created" and "Project Updated" for the same thing at the same time if they are same)
        // Actually, we'll just limit it.
        return array_slice($activity, 0, 10);
    }

    /**
     * Get categories for a specific project
     */
    public function getCategoriesByProjectId(int $projectId)
    {
        $project = $this->find($projectId);
        return $project ? json_decode($project['categories'], true) : [];
    }

    /**
     * Get tech stack for a specific project
     */
    public function getTechStackByProjectId(int $projectId)
    {
        $project = $this->find($projectId);
        return $project ? json_decode($project['tech_stack'], true) : [];
    }
}

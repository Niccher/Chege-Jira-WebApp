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
            'pending'  => $this->where('user_id', $userId)->whereIn('status', ['planning', 'on_hold'])->countAllResults(),
            'archived' => $this->where('user_id', $userId)->where('is_archived', 1)->countAllResults(),
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
     * Get recent activity (milestone completions and project updates)
     */
    public function getRecentActivity(int $userId)
    {
        $db = \Config\Database::connect();
        
        // This is a simplified version. In a real app, we might have an 'activity_log' table.
        // For now, we'll fetch recently updated projects and milestones.
        
        $projects = $this->where('user_id', $userId)
                         ->orderBy('updated_at', 'DESC')
                         ->limit(5)
                         ->findAll();
                         
        $milestones = $db->table('project_milestones')
                         ->select('project_milestones.*, projects.name as project_name')
                         ->join('projects', 'projects.id = project_milestones.project_id')
                         ->where('projects.user_id', $userId)
                         ->orderBy('project_milestones.updated_at', 'DESC')
                         ->limit(5)
                         ->get()
                         ->getResultArray();
                         
        $activity = [];
        
        foreach ($projects as $p) {
            $activity[] = [
                'type' => 'project_update',
                'title' => 'Updated ' . $p['name'],
                'description' => 'Current progress: ' . $p['progress'] . '%',
                'time' => $p['updated_at'],
                'icon' => 'fa-code',
                'color' => 'var(--primary-color)'
            ];
        }
        
        foreach ($milestones as $m) {
            $activity[] = [
                'type' => 'milestone_' . $m['status'],
                'title' => ($m['status'] === 'completed' ? 'Completed' : 'Updated') . ' milestone',
                'description' => '"' . $m['name'] . '" in ' . $m['project_name'],
                'time' => $m['updated_at'],
                'icon' => $m['status'] === 'completed' ? 'fa-check' : 'fa-spinner fa-spin',
                'color' => $m['status'] === 'completed' ? 'var(--success-color)' : 'var(--warning-color)'
            ];
        }
        
        // Sort by time DESC
        usort($activity, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        return array_slice($activity, 0, 5);
    }
}

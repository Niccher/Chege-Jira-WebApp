<?php

namespace App\Models;

use CodeIgniter\Model;

class TimeLogModel extends Model
{
    protected $table            = 'time_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'project_id', 'task_name', 'start_time', 
        'end_time', 'duration', 'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get recent logs for a user
     */
    public function getRecentLogs(int $userId, int $limit = 5)
    {
        return $this->select('time_logs.*, projects.name as project_name, projects.color as project_color')
                    ->join('projects', 'projects.id = time_logs.project_id', 'left')
                    ->where('time_logs.user_id', $userId)
                    ->orderBy('time_logs.start_time', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}

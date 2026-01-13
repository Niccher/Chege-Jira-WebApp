<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'order_index',
        'due_date'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get tasks grouped by status for a specific project
     */
    public function getBoardData(int $projectId, int $userId)
    {
        $tasks = $this->where('project_id', $projectId)
                      ->where('user_id', $userId)
                      ->orderBy('order_index', 'ASC')
                      ->findAll();

        $board = [
            'todo'        => [],
            'in_progress' => [],
            'review'      => [],
            'done'        => []
        ];

        foreach ($tasks as $task) {
            $board[$task['status']][] = $task;
        }

        return $board;
    }
}

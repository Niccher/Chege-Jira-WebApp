<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\NoteModel;
use App\Models\TimeLogModel;

class CalendarApiController extends BaseController
{
    public function index()
    {
        $userId = auth()->id();
        $db = \Config\Database::connect();
        $events = [];

        // 1. Manual Events
        $eventModel = new EventModel();
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

        // 3. Milestone Events
        $milestones = $db->table('project_milestones')
                         ->select('project_milestones.*, projects.name as project_name, projects.color as project_color')
                         ->join('projects', 'projects.id = project_milestones.project_id')
                         ->where('projects.user_id', $userId)
                         ->get()->getResultArray();
        
        foreach ($milestones as $ms) {
            if ($ms['status'] === 'in_progress') {
                $events[] = [
                    'id'    => 'ms_start_' . $ms['id'],
                    'title' => 'START: ' . $ms['name'],
                    'start' => $ms['updated_at'],
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

        // 4. Note Events
        $noteModel = new NoteModel();
        $notes = $noteModel->where('user_id', $userId)->findAll();
        foreach ($notes as $note) {
            $isProject = !empty($note['project_id']);
            $type = $isProject ? 'note_project' : 'note_general';
            $icon = $isProject ? 'fa-sticky-note' : 'fa-lightbulb';
            $color = $isProject ? '#6366f1' : '#f59e0b';
            
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
        $timeModel = new TimeLogModel();
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
}

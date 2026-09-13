<?php

namespace App\Controllers\User;

use App\Models\ProjectModel;
use App\Models\TaskModel;

class KanbanController extends BaseUserController
{
    public function index($id = null)
    {
        $projectModel = new ProjectModel();
        $taskModel = new TaskModel();

        if ($id === null) {
            $latestProject = $projectModel->where('user_id', $this->userId)
                                          ->orderBy('updated_at', 'DESC')
                                          ->first();
            if ($latestProject) {
                return redirect()->to('projects/kanban/' . $latestProject['id']);
            } else {
                return redirect()->to('projects')->with('error', 'Please create a project first to use the Kanban board.');
            }
        }

        $project = $projectModel->where('user_id', $this->userId)->find($id);

        if (!$project) {
            return redirect()->to('projects')->with('error', 'Project not found.');
        }

        $cats = $projectModel->getCategoriesByProjectId($id);
        $tech = $projectModel->getTechStackByProjectId($id);

        $data = [
            'user'       => $this->currentUser,
            'project'    => $project,
            'projects'   => $projectModel->where('user_id', $this->userId)->orderBy('updated_at', 'DESC')->findAll(),
            'categories' => $cats,
            'tech_stack' => $tech,
            'boardData'  => $taskModel->getBoardData($id, $this->userId)
        ];

        return view('user/projects/kanban', $data);
    }
}

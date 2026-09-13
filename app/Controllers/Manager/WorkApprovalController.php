<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Models\TaskModel;

class WorkApprovalController extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();
        $tasks = $taskModel->getPendingReviews(auth()->id());

        return view('manager/approvals/index', ['tasks' => $tasks]);
    }

    public function approve($id)
    {
        $taskModel = new TaskModel();
        
        $data = [
            'status'      => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => date('Y-m-d H:i:s')
        ];

        if ($taskModel->update($id, $data)) {
            // Audit Log and Notification logic will go here in Phase 4/5
            return redirect()->back()->with('message', 'Task approved successfully.');
        }

        return redirect()->back()->with('error', 'Failed to approve task.');
    }

    public function reject($id)
    {
        $taskModel = new TaskModel();
        
        $data = [
            'status'          => 'rejected',
            'rejected_by'     => auth()->id(),
            'rejected_reason' => $this->request->getPost('rejected_reason')
        ];

        if ($taskModel->update($id, $data)) {
            // Audit Log and Notification logic will go here in Phase 4/5
            return redirect()->back()->with('message', 'Task rejected.');
        }

        return redirect()->back()->with('error', 'Failed to reject task.');
    }
}

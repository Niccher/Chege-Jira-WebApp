<div class="kanban-card" data-task-id="<?= $task['id'] ?>" draggable="true">
    <div class="kanban-card-header">
        <div class="d-flex justify-content-between align-items-start">
            <div class="task-title text-truncate" title="<?= esc($task['title']) ?>">
                <?= esc($task['title']) ?>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item small" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                    <li><a class="dropdown-item small text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="kanban-card-body">
        <p class="small text-truncate-2"><?= esc($task['description']) ?></p>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="task-meta">
                <span class="badge <?= $task['priority'] === 'critical' ? 'bg-danger' : ($task['priority'] === 'high' ? 'bg-warning' : 'bg-primary') ?>">
                    <?= ucfirst($task['priority']) ?>
                </span>
            </div>
            <div class="task-date small text-muted">
                <i class="fas fa-calendar-alt me-1"></i> <?= $task['due_date'] ? date('M d', strtotime($task['due_date'])) : 'No date' ?>
            </div>
        </div>
    </div>
    
    <div class="kanban-card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div class="task-assignee">
                <div class="user-avatar" title="Assignee">JD</div>
            </div>
            <div class="task-comments">
                <i class="fas fa-comment"></i> 0
            </div>
        </div>
    </div>
</div>

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

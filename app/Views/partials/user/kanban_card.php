<div class="kanban-card mb-3 p-3 bg-slate-900 rounded-lg border border-slate-700 cursor-move" data-task-id="<?= $task['id'] ?>">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <span class="badge <?= $task['priority'] === 'critical' ? 'bg-danger' : ($task['priority'] === 'high' ? 'bg-warning' : 'bg-primary') ?> extra-small">
            <?= ucfirst($task['priority']) ?>
        </span>
        <div class="dropdown">
            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                <li><a class="dropdown-item small" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                <li><a class="dropdown-item small text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
            </ul>
        </div>
    </div>
    <h6 class="text-white small fw-bold mb-2"><?= esc($task['title']) ?></h6>
    <p class="text-slate-400 extra-small mb-3 text-truncate-2"><?= esc($task['description']) ?></p>
    
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="avatar-group d-flex">
            <div class="avatar-xs text-bg-primary rounded-circle border border-slate-800 d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 10px;">JD</div>
        </div>
        <div class="text-slate-500 extra-small">
            <i class="far fa-calendar-alt me-1"></i> <?= $task['due_date'] ? date('M d', strtotime($task['due_date'])) : 'No date' ?>
        </div>
    </div>
</div>

<style>
    .bg-slate-900 { background-color: #0f172a; }
    .border-slate-700 { border-color: #334155; }
    .text-slate-400 { color: #94a3b8; }
    .text-slate-500 { color: #64748b; }
    .extra-small { font-size: 0.7rem; }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

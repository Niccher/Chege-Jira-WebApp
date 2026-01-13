<?= $this->include('layouts/user/header', ['title' => 'ChegeOS Dashboard • Kanban Board']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('projects') ?>" class="text-decoration-none text-muted">Projects</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('projects/view/' . $project['id']) ?>" class="text-decoration-none text-muted"><?= esc($project['name']) ?></a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Kanban</li>
                    </ol>
                </nav>
            </div>

            <div class="d-flex align-items-center">
                <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="fas fa-plus me-1"></i> Add Task
                </button>
                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        JD
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kanban Board Container -->
        <div class="kanban-container pb-4">
            <div class="row kanban-row flex-nowrap overflow-auto py-2">
                
                <!-- To Do Column -->
                <div class="col-kanban">
                    <div class="kanban-column" data-status="todo">
                        <div class="column-header d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">TO DO <span class="badge bg-secondary ms-2" id="count-todo"><?= count($boardData['todo']) ?></span></h6>
                            <button class="btn btn-sm btn-link text-muted p-0"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="kanban-cards sortable-list" id="todo-list">
                            <?php foreach ($boardData['todo'] as $task): ?>
                                <?= view('partials/user/kanban_card', ['task' => $task]) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- In Progress Column -->
                <div class="col-kanban">
                    <div class="kanban-column" data-status="in_progress">
                        <div class="column-header d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">IN PROGRESS <span class="badge bg-info ms-2" id="count-in_progress"><?= count($boardData['in_progress']) ?></span></h6>
                            <button class="btn btn-sm btn-link text-muted p-0"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="kanban-cards sortable-list" id="in_progress-list">
                            <?php foreach ($boardData['in_progress'] as $task): ?>
                                <?= view('partials/user/kanban_card', ['task' => $task]) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Review Column -->
                <div class="col-kanban">
                    <div class="kanban-column" data-status="review">
                        <div class="column-header d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">REVIEW <span class="badge bg-warning ms-2" id="count-review"><?= count($boardData['review']) ?></span></h6>
                            <button class="btn btn-sm btn-link text-muted p-0"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="kanban-cards sortable-list" id="review-list">
                            <?php foreach ($boardData['review'] as $task): ?>
                                <?= view('partials/user/kanban_card', ['task' => $task]) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Done Column -->
                <div class="col-kanban">
                    <div class="kanban-column" data-status="done">
                        <div class="column-header d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-success">DONE <span class="badge bg-success ms-2" id="count-done"><?= count($boardData['done']) ?></span></h6>
                        </div>
                        <div class="kanban-cards sortable-list" id="done-list">
                            <?php foreach ($boardData['done'] as $task): ?>
                                <?= view('partials/user/kanban_card', ['task' => $task]) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

        </div> <!-- Close Row -->
    </div> <!-- Close Kanban Container -->

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= site_url('projects/task/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Task Title</label>
                            <input type="text" name="title" class="form-control" placeholder="What needs to be done?" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Additional details..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-select">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Initial Status</label>
                                <select name="status" class="form-select">
                                    <option value="todo">To Do</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="review">Review</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        $(document).ready(function() {
            // Sidebar toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('sidebar-collapsed');
                $('#mainContent').toggleClass('full-width');
            });

            // Initialize Sortable for each column
            const columns = ['todo', 'in_progress', 'review', 'done'];
            columns.forEach(status => {
                const el = document.getElementById(status + '-list');
                new Sortable(el, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'kanban-ghost',
                    onEnd: function(evt) {
                        const taskId = evt.item.dataset.taskId;
                        const newStatus = evt.to.parentElement.dataset.status;
                        const order = Array.from(evt.to.children).indexOf(evt.item);

                        // AJAX update
                        $.post('<?= site_url('projects/task/move') ?>', {
                            <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                            task_id: taskId,
                            status: newStatus,
                            order: order
                        }, function(res) {
                            if (res.status === 'success') {
                                // Update counts
                                updateColumnCounts();
                            }
                        });
                    }
                });
            });

            function updateColumnCounts() {
                columns.forEach(status => {
                    $(`#count-${status}`).text($(`#${status}-list .kanban-card`).length);
                });
            }
        });
    </script>

    <style>
        .kanban-container {
            height: calc(100vh - 120px);
            overflow-x: auto;
            white-space: nowrap;
        }
        .kanban-row {
            height: 100%;
            margin: 0;
            padding: 10px;
        }
        .col-kanban {
            width: 320px;
            min-width: 320px;
            max-width: 320px;
            height: 100%;
            display: inline-block;
            vertical-align: top;
            margin-right: 1.5rem;
        }
        .kanban-column {
            background-color: #1e293b;
            border-radius: 12px;
            padding: 1.25rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #334155;
        }
        .kanban-cards {
            flex-grow: 1;
            overflow-y: auto;
            min-height: 200px;
        }
        .kanban-cards::-webkit-scrollbar {
            width: 5px;
        }
        .kanban-cards::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 10px;
        }
        .kanban-ghost {
            opacity: 0.4;
            background: #6366f1 !important;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            color: #475569;
        }
        .modal-content {
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #f8fafc;
        }
        .modal-header { border-bottom: 1px solid #334155; }
        .modal-footer { border-top: 1px solid #334155; }
        .form-control, .form-select {
            background-color: #0f172a;
            border: 1px solid #334155;
            color: #f8fafc;
        }
        .form-control:focus, .form-select:focus {
            background-color: #0f172a;
            border-color: #6366f1;
            color: #f8fafc;
            box-shadow: none;
        }
    </style>

<?= $this->include('layouts/user/footer') ?>

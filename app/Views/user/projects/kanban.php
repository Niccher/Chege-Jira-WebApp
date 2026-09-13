<?= $this->extend('layouts/hyper/main') ?>
<?= $this->section('content') ?>


    
        
        <div class="row space-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Dashboard</strong></h3>
            </div>
            <div class="col-auto float-end text-end mt-n1">
                
            </div>
        </div>
        <!-- Kanban Board Container -->
        <div class="kanban-container pb-4">
            <div class="row kanban-row flex-nowrap overflow-auto py-2">
                
                <!-- To Do Column -->
                <div class="col-kanban">
                    <div class="kanban-column" data-status="todo">
                        <div class="column-header    space-3">
                            <h6 class="space-0">TO DO <span class="badge badge-default ms-2" id="count-todo"><?= count($boardData['todo']) ?></span></h6>
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
                        <div class="column-header    space-3">
                            <h6 class="space-0">IN PROGRESS <span class="badge badge-info ms-2" id="count-in_progress"><?= count($boardData['in_progress']) ?></span></h6>
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
                        <div class="column-header    space-3">
                            <h6 class="space-0">REVIEW <span class="badge badge-warning ms-2" id="count-review"><?= count($boardData['review']) ?></span></h6>
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
                        <div class="column-header    space-3">
                            <h6 class="space-0 text-success">DONE <span class="badge badge-success ms-2" id="count-done"><?= count($boardData['done']) ?></span></h6>
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
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="space-3">
                            <label class="form-label">Task Title</label>
                            <input type="text" name="title" class="form-control" placeholder="What needs to be done?" required>
                        </div>
                        <div class="space-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Additional details..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 space-3">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-control">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>
                            <div class="col-md-6 space-3">
                                <label class="form-label">Initial Status</label>
                                <select name="status" class="form-control">
                                    <option value="todo">To Do</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="review">Review</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

            // Project selector redirect
            $('#projectSelector').change(function() {
                const projectId = $(this).val();
                window.location.href = '<?= site_url('projects/kanban') ?>/' + projectId;
            });

            // Edit task
            $(document).on('click', '.edit-task-btn', function(e) {
                e.preventDefault();
                const card = $(this).closest('.kanban-card');
                $('#editTaskId').val(card.data('task-id'));
                $('#editTaskTitle').val(card.find('.task-title').text().trim());
                $('#editTaskDescription').val(card.data('description') || '');
                $('#editTaskPriority').val(card.data('priority') || 'medium');
                $('#editTaskDueDate').val(card.data('due-date') || '');
                $('#editTaskModal').modal('show');
            });

            $('#saveTaskEditBtn').click(function() {
                const id = $('#editTaskId').val();
                $.post('<?= site_url('projects/task/update/') ?>' + id, {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                    title: $('#editTaskTitle').val(),
                    description: $('#editTaskDescription').val(),
                    priority: $('#editTaskPriority').val(),
                    due_date: $('#editTaskDueDate').val()
                }, function(res) {
                    if (res.status === 'success') {
                        location.reload();
                    }
                });
            });
        });
    </script>


<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editTaskId">
                <div class="space-3">
                    <label class="form-label">Title</label>
                    <input type="text" id="editTaskTitle" class="form-control" required>
                </div>
                <div class="space-3">
                    <label class="form-label">Description</label>
                    <textarea id="editTaskDescription" class="form-control" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 space-3">
                        <label class="form-label">Priority</label>
                        <select id="editTaskPriority" class="form-control">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="critical">Critical</option>
                        </select>
                    </div>
                    <div class="col-md-6 space-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" id="editTaskDueDate" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveTaskEditBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

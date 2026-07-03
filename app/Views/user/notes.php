<?= $this->include('layouts/user/header', ['title' => 'Notes • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Notes</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="input-group input-group-sm me-3" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search notes..." id="notesSearch">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <button class="btn btn-primary btn-sm me-2" id="newNoteBtn">
                    <i class="fas fa-plus me-1"></i> New Note
                </button>

                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item active" href="#"><i class="fas fa-sticky-note me-2"></i> All Notes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-star me-2"></i> Starred</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-project-diagram me-2"></i> By Project</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Trash</a></li>
                    </ul>
                </div>

                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        JD
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notes Stats -->
        <div class="row mb-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Total Notes</div>
                    <div class="stat-value" id="totalNotes"><?= $stats['total'] ?></div>
                    <div class="stat-change text-secondary mt-3 font-mono border-top pt-2">
                        <i class="fas fa-sticky-note"></i> All notes
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Starred</div>
                    <div class="stat-value text-warning" id="starredNotes"><?= $stats['starred'] ?></div>
                    <div class="stat-change text-warning mt-3 font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-star"></i> Important
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Completed</div>
                    <div class="stat-value text-success" id="completedNotes"><?= $stats['completed'] ?></div>
                    <div class="stat-change text-success mt-3 font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-check-circle"></i> Resolved
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Deleted</div>
                    <div class="stat-value text-danger" id="deletedNotes">0</div>
                    <div class="stat-change text-danger mt-3 font-mono border-top border-danger border-opacity-25 pt-2">
                        <i class="fas fa-trash"></i> Trash
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 1: Notes List & Editor -->
        <div class="row" id="row_1">
            <!-- Notes List -->
            <div class="col-lg-4">
                <div class="stat-card" style="height: calc(100vh - 300px); overflow-y: auto;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i>All Notes</h5>
                        <button class="btn btn-sm btn-outline-secondary" id="sortNotesBtn">
                            <i class="fas fa-sort me-1"></i> Recent
                        </button>
                    </div>

                    <div id="notesList">
                        <?php if (!empty($notes)): ?>
                            <?php foreach ($notes as $note): ?>
                            <?php $noteTags = json_decode($note['tags'], true) ?? []; ?>
                            <div class="note-item <?= $note['is_completed'] ? 'completed-note' : '' ?>" 
                                 data-note-id="<?= $note['id'] ?>" 
                                 data-project-id="<?= $note['project_id'] ?>"
                                 data-title="<?= esc($note['title']) ?>"
                                 data-content="<?= esc($note['content']) ?>"
                                 data-tags="<?= esc(implode(', ', $noteTags)) ?>"
                                 data-starred="<?= $note['is_starred'] ?>"
                                 data-completed="<?= $note['is_completed'] ?>"
                                 data-created-at="<?= date('M d, Y', strtotime($note['created_at'])) ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="text-truncate" style="max-width: 70%;">
                                        <h6 class="mb-1"><?= esc($note['title']) ?></h6>
                                        <div class="small text-muted">
                                            <i class="fas fa-project-diagram me-1"></i> <?= esc($note['project_name'] ?? 'General') ?>
                                        </div>
                                    </div>
                                    <div class="note-meta text-end">
                                        <i class="fa<?= $note['is_starred'] ? 's' : 'r' ?> fa-star text-warning"></i>
                                        <div class="small text-muted"><?= date('M d', strtotime($note['created_at'])) ?></div>
                                    </div>
                                </div>
                                <p class="note-preview small text-muted mb-2">
                                    <?= esc(substr(strip_tags($note['content']), 0, 80)) ?><?= strlen($note['content']) > 80 ? '...' : '' ?>
                                </p>
                                <div class="note-tags">
                                    <?php 
                                    $tagColors = ['bg-primary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-secondary'];
                                    foreach ($noteTags as $index => $tag): 
                                        $color = $tagColors[$index % count($tagColors)];
                                    ?>
                                    <span class="badge <?= $color ?> badge-sm"><i class="fas fa-tag me-1"></i><?= esc($tag) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-sticky-note fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No notes found. Create your first note!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <?= $pager->links('notes', 'bootstrap_full') ?>
                    </div>
                </div>
            </div>

            <!-- Note Editor or New Note Form -->
            <div class="col-lg-8">
                <div class="stat-card" style="height: calc(100vh - 300px); display: flex; flex-direction: column;">
                    <form action="<?= site_url('notes/store') ?>" method="POST" id="newNoteForm" class="h-100 d-flex flex-column">
                        <?= csrf_field() ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>New Note</h5>
                            <button type="submit" class="btn btn-sm btn-primary" id="saveNoteBtn" disabled>
                                <i class="fas fa-save me-1"></i> Save Note
                            </button>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="title" class="form-control form-control-lg" id="noteTitle" placeholder="Note Title" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select name="project_id" class="form-select" id="noteProject">
                                    <option value="">General (No Project)</option>
                                    <?php if (!empty($projects)): ?>
                                        <?php foreach ($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>"><?= esc($project['name']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="tags" class="form-control" id="noteTags" placeholder="Tags (comma separated)">
                            </div>
                        </div>

                        <div class="flex-grow-1 mb-3">
                            <textarea name="content" class="form-control h-100" id="noteContent" placeholder="Start writing your note here..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="markdownMode">
                                <label class="form-check-label small" for="markdownMode">Markdown Mode</label>
                            </div>
                            <div class="small text-muted">
                                <i class="fas fa-info-circle me-1"></i> Press Save to store this note.
                            </div>
                        </div>
                    </form>
                </div>
        </div> <!-- Close Main Row -->

        <!-- Note View Modal -->
        <div class="modal fade" id="noteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form id="noteEditForm" method="POST">
                        <?= csrf_field() ?>
                        <div class="modal-header border-bottom border-secondary">
                            <input type="text" name="title" id="modalNoteTitle" class="form-control form-control-lg bg-transparent border-0 text-white font-weight-bold" required>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="small text-muted mb-1">Project</label>
                                    <select name="project_id" id="modalNoteProject" class="form-select form-select-sm">
                                        <option value="">General</option>
                                        <?php if (!empty($projects)): ?>
                                            <?php foreach ($projects as $project): ?>
                                            <option value="<?= $project['id'] ?>"><?= esc($project['name']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted mb-1">Tags (comma separated)</label>
                                    <input type="text" name="tags" id="modalNoteTags" class="form-control form-select-sm" placeholder="e.g. design, logic">
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted mb-1">Created At</label>
                                    <div id="modalNoteDate" class="form-control-plaintext small text-white ms-2"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted mb-1">Content (Markdown supported)</label>
                                <textarea name="content" id="modalNoteContent" class="form-control" rows="10" placeholder="Write your note here..."></textarea>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-warning w-100" id="modalToggleStar">
                                    <i class="far fa-star me-1"></i> Starred
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success w-100" id="modalToggleComplete">
                                    <i class="fas fa-check me-1"></i> Completed
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger w-100" id="modalDeleteBtn">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer border-top border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Notes Styles */
        .note-item {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: none;
        }

        .note-item:hover {
            border-color: var(--bs-body-color);
            box-shadow: 4px 4px 0 var(--border-color);
            transform: translate(-2px, -2px);
        }

        .note-item.active {
            border-color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.05);
        }

        .note-item h6 {
            font-family: 'Space Grotesk', monospace;
            font-weight: 700;
            text-transform: uppercase;
        }

        .completed-note {
            opacity: 0.7;
            border-left: 4px solid var(--bs-success);
        }

        .completed-note h6 {
            text-decoration: line-through;
        }

        .note-meta {
            text-align: right;
            font-size: 0.8rem;
            font-family: 'Space Grotesk', monospace;
        }

        .note-preview {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 0.85rem;
        }

        .note-tags {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .badge-sm {
            font-size: 0.65rem;
            padding: 0.2rem 0.5rem;
            border-radius: 0;
            font-family: 'Space Grotesk', monospace;
            text-transform: uppercase;
        }

        .editor-toolbar {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0;
            padding: 0.5rem;
        }

        .quick-note {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0;
            padding: 1rem;
            height: 120px;
            display: flex;
            flex-direction: column;
        }

        .quick-note-content {
            flex-grow: 1;
            overflow: hidden;
            font-size: 0.9rem;
        }

        .quick-note-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
        }

        #noteContent {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--border-color);
            color: var(--bs-body-color);
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            resize: none;
            border-radius: 0;
        }
        
        #noteContent:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        /* Scrollbar Styling */
        #notesList::-webkit-scrollbar {
            width: 6px;
        }

        #notesList::-webkit-scrollbar-track {
            background: var(--bs-body-bg);
            border-radius: 0;
        }

        #notesList::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 0;
        }
        
        #notesList::-webkit-scrollbar-thumb:hover {
            background: var(--bs-secondary-color);
        }
    </style>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Notes JavaScript -->
    <script>
        $(document).ready(function() {
            // Sidebar toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('sidebar-collapsed');
                $('#mainContent').toggleClass('full-width');
                localStorage.setItem('sidebarCollapsed', $('#sidebar').hasClass('sidebar-collapsed'));
            });

            // Note item click -> Open Modal (Using Event Delegation)
            $(document).on('click', '.note-item', function() {
                const noteId = $(this).data('note-id');
                const title = $(this).data('title');
                const content = $(this).data('content');
                const projectId = $(this).data('project-id');
                const tags = $(this).data('tags');
                const isStarred = $(this).data('starred');
                const isCompleted = $(this).data('completed');
                const createdAt = $(this).data('created-at');

                // Fill Modal
                $('#modalNoteTitle').val(title);
                $('#modalNoteContent').val(content);
                $('#modalNoteProject').val(projectId);
                $('#modalNoteTags').val(tags);
                $('#modalNoteDate').text(createdAt);
                $('#noteEditForm').attr('action', '<?= site_url('notes/update/') ?>' + noteId);
                $('#modalDeleteBtn').attr('data-id', noteId);
                $('#modalToggleStar').attr('data-id', noteId);
                $('#modalToggleComplete').attr('data-id', noteId);

                // Update Button States
                updateModalButtonStates(isStarred, isCompleted);
                
                // Show Modal using Bootstrap 5 Native API
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('noteModal'));
                modal.show();
            });

            function updateModalButtonStates(isStarred, isCompleted) {
                if (isStarred) {
                    $('#modalToggleStar').removeClass('btn-outline-warning').addClass('btn-warning text-dark');
                    $('#modalToggleStar i').removeClass('far').addClass('fas');
                } else {
                    $('#modalToggleStar').removeClass('btn-warning text-dark').addClass('btn-outline-warning');
                    $('#modalToggleStar i').removeClass('fas').addClass('far');
                }

                if (isCompleted) {
                    $('#modalToggleComplete').removeClass('btn-outline-success').addClass('btn-success');
                } else {
                    $('#modalToggleComplete').removeClass('btn-success').addClass('btn-outline-success');
                }
            }

            // Star Toggle (AJAX)
            $('#modalToggleStar').click(function() {
                const id = $(this).data('id');
                $.post('<?= site_url('notes/star/') ?>' + id, {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                }, function(res) {
                    if (res.status === 'success') {
                        updateModalButtonStates(res.is_starred, null);
                        // Optional: update the list item star icon too without reload
                    }
                });
            });

            // Complete Toggle (AJAX)
            $('#modalToggleComplete').click(function() {
                const id = $(this).data('id');
                $.post('<?= site_url('notes/complete/') ?>' + id, {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                }, function(res) {
                    if (res.status === 'success') {
                        location.reload(); // Reload to update list styling and stats
                    }
                });
            });

            // Delete (Form Submission)
            $('#modalDeleteBtn').click(function() {
                if (confirm('Move this note to trash?')) {
                    const id = $(this).data('id');
                    const form = $('<form>', {
                        'method': 'POST',
                        'action': '<?= site_url('notes/delete/') ?>' + id
                    }).append($('<input>', {
                        'type': 'hidden',
                        'name': '<?= csrf_token() ?>',
                        'value': '<?= csrf_hash() ?>'
                    }));
                    $('body').append(form);
                    form.submit();
                }
            });

            // Note List Search
            $('#notesSearch').on('keyup', function() {
                const term = $(this).val().toLowerCase();
                $('.note-item').each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.includes(term));
                });
            });

            // New Note Button (uses the desktop editor if preferred, or we could use another modal)
            $('#newNoteBtn').click(function() {
                // Focus the title input in the right editor
                $('#noteTitle').focus();
                $('html, body').animate({
                    scrollTop: $("#noteTitle").offset().top - 100
                }, 500);
            });

            // Toggle Save Note Button
            $('#noteProject').on('change', function() {
                const val = $(this).val();
                if (val !== "") {
                    $('#saveNoteBtn').prop('disabled', false);
                    showToast('Project selected. You can now save your note.', 'info');
                } else {
                    $('#saveNoteBtn').prop('disabled', true);
                }
            });

            // Toast notification function
            function showToast(message, type = 'info') {
                const toastId = 'toast-' + Date.now();
                const toastHtml = `
                    <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>`;
                $('.toast-container').append(toastHtml);
                new bootstrap.Toast(document.getElementById(toastId)).show();
            }
        });
    </script>

<?= $this->include('layouts/user/footer') ?>
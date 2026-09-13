<?= $this->extend('layouts/ace/main') ?>
<?= $this->section('content') ?>


    
        
        <div class="row space-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Notes</strong></h3>
            </div>
            <div class="col-auto pull-right text-end mt-n1">
                
            </div>
        </div>
        <!-- Notes Stats -->
        <div class="row space-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Total Notes</div>
                    <div class="stat-value" id="totalNotes"><?= $stats['total'] ?></div>
                    <div class="stat-change text-secondary  font-mono border-top pt-2">
                        <i class="fas fa-sticky-note"></i> All notes
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Starred</div>
                    <div class="stat-value text-warning" id="starredNotes"><?= $stats['starred'] ?></div>
                    <div class="stat-change text-warning  font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-star"></i> Important
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Completed</div>
                    <div class="stat-value text-success" id="completedNotes"><?= $stats['completed'] ?></div>
                    <div class="stat-change text-success  font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-check-circle"></i> Resolved
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Deleted</div>
                    <div class="stat-value text-danger" id="deletedNotes"><?= $stats['deleted'] ?></div>
                    <div class="stat-change text-danger  font-mono border-top border-danger border-opacity-25 pt-2">
                        <i class="fas fa-trash"></i> Trash
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 1: Notes List & Editor -->
        <div class="row" id="row_1">
            <!-- Notes List -->
            <div class="col-lg-4">
                <div class="widget-box card-body" style="height: calc(100vh - 300px); overflow-y: auto;">
                    <div class="   space-3">
                        <h5 class="space-0"><i class="fas fa-list-ul pr-2"></i>All Notes</h5>
                        <button class="btn btn-sm btn btn-white btn-default" id="sortNotesBtn">
                            <i class="fas fa-sort pr-1"></i> Recent
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
                                <div class="  align-items-start">
                                    <div class="text-truncate" style="max-width: 70%;">
                                        <h6 class="space-1"><?= esc($note['title']) ?></h6>
                                        <div class="small text-muted">
                                            <i class="fas fa-project-diagram pr-1"></i> <?= esc($note['project_name'] ?? 'General') ?>
                                        </div>
                                    </div>
                                    <div class="note-meta text-end">
                                        <i class="fa<?= $note['is_starred'] ? 's' : 'r' ?> fa-star text-warning"></i>
                                        <div class="small text-muted"><?= date('M d', strtotime($note['created_at'])) ?></div>
                                    </div>
                                </div>
                                <p class="note-preview small text-muted space-2">
                                    <?= esc(substr(strip_tags($note['content']), 0, 80)) ?><?= strlen($note['content']) > 80 ? '...' : '' ?>
                                </p>
                                <div class="note-tags">
                                    <?php 
                                    $tagColors = ['bg-primary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-secondary'];
                                    foreach ($noteTags as $index => $tag): 
                                        $color = $tagColors[$index % count($tagColors)];
                                    ?>
                                    <span class="badge <?= $color ?> badge-sm"><i class="fas fa-tag pr-1"></i><?= esc($tag) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-sticky-note fa-3x text-muted space-3"></i>
                                <p class="text-muted">No notes found. Create your first note!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?= $pager->links('notes', 'bootstrap_full') ?>
                    </div>
                </div>
            </div>

            <!-- Note Editor or New Note Form -->
            <div class="col-lg-8">
                <div class="widget-box card-body" style="height: calc(100vh - 300px); display: flex; flex-direction: column;">
                    <form action="<?= site_url('notes/store') ?>" method="POST" id="newNoteForm" class="h-100  ">
                        <?= csrf_field() ?>
                        <div class="   space-3">
                            <h5 class="space-0"><i class="fas fa-edit pr-2"></i>New Note</h5>
                            <button type="submit" class="btn btn-sm btn-primary" id="saveNoteBtn">
                                <i class="fas fa-save pr-1"></i> Save Note
                            </button>
                        </div>

                        <div class="space-3">
                            <input type="text" name="title" class="form-control form-control-lg" id="noteTitle" placeholder="Note Title" required>
                        </div>

                        <div class="row space-3">
                            <div class="col-md-6">
                                <select name="project_id" class="form-control" id="noteProject">
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

                        <div class="flex-grow-1 space-3">
                            <textarea name="content" class="form-control h-100" id="noteContent" placeholder="Start writing your note here..."></textarea>
                        </div>

                        <div class="   mt-auto">
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="markdownMode">
                                <label class="form-check-label small" for="markdownMode">Markdown Mode</label>
                            </div>
                            <div class="small text-muted">
                                <i class="fas fa-info-circle pr-1"></i> Press Save to store this note.
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
                            <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row space-3">
                                <div class="col-md-4">
                                    <label class="small text-muted space-1">Project</label>
                                    <select name="project_id" id="modalNoteProject" class="form-control form-control-sm">
                                        <option value="">General</option>
                                        <?php if (!empty($projects)): ?>
                                            <?php foreach ($projects as $project): ?>
                                            <option value="<?= $project['id'] ?>"><?= esc($project['name']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted space-1">Tags (comma separated)</label>
                                    <input type="text" name="tags" id="modalNoteTags" class="form-control form-control-sm" placeholder="e.g. design, logic">
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted space-1">Created At</label>
                                    <div id="modalNoteDate" class="form-control-plaintext small text-white ms-2"></div>
                                </div>
                            </div>
                            <div class="space-3">
                                <label class="small text-muted space-1">Content (Markdown supported)</label>
                                <textarea name="content" id="modalNoteContent" class="form-control" rows="10" placeholder="Write your note here..."></textarea>
                            </div>
                            
                            <div class=" ">
                                <button type="button" class="btn btn-sm btn-outline-warning w-100" id="modalToggleStar">
                                    <i class="far fa-star pr-1"></i> Starred
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success w-100" id="modalToggleComplete">
                                    <i class="fas fa-check pr-1"></i> Completed
                                </button>
                                <button type="button" class="btn btn-sm btn btn-white btn-danger w-100" id="modalDeleteBtn">
                                    <i class="fas fa-trash pr-1"></i> Delete
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer border-top border-secondary">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Notes JavaScript -->
    <script>
        $(document).ready(function() {
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

            // Toast notification function
            function showToast(message, type = 'info') {
                const toastId = 'toast-' + Date.now();
                const toastHtml = `
                    <div id="${toastId}" class="toast  text-bg-${type} border-0" role="alert">
                        <div class="">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white pr-2 m-auto" data-dismiss="toast"></button>
                        </div>
                    </div>`;
                $('.toast-container').append(toastHtml);
                new bootstrap.Toast(document.getElementById(toastId)).show();
            }
        });
    </script>

<?= $this->endSection() ?>

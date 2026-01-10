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
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.2); color: #6366f1;">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <div class="stat-value" id="totalNotes">24</div>
                    <div class="stat-label">Total Notes</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.2); color: #10b981;">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-value" id="starredNotes">8</div>
                    <div class="stat-label">Starred</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.2); color: #f59e0b;">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-value" id="projectNotes">15</div>
                    <div class="stat-label">Project Notes</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.2); color: #ef4444;">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="stat-value" id="codeSnippets">32</div>
                    <div class="stat-label">Code Snippets</div>
                </div>
            </div>
        </div>

        <!-- Notes Layout -->
        <div class="row">
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
                        <!-- Note Item -->
                        <div class="note-item active" data-note-id="1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Dashboard Design Decisions</h6>
                                    <div class="small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> ChegeOS Dashboard
                                    </div>
                                </div>
                                <div class="note-meta">
                                    <i class="fas fa-star text-warning"></i>
                                    <div class="small text-muted">Today</div>
                                </div>
                            </div>
                            <p class="note-preview small text-muted mb-2">
                                Decided to use dark theme as default with Bootstrap 5. Sidebar will be collapsible...
                            </p>
                            <div class="note-tags">
                                <span class="badge bg-primary badge-sm">design</span>
                                <span class="badge bg-info badge-sm">ui</span>
                            </div>
                        </div>

                        <!-- Note Item -->
                        <div class="note-item" data-note-id="2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">API Integration Architecture</h6>
                                    <div class="small text-muted">
                                        <i class="fas fa-server me-1"></i> API Integration
                                    </div>
                                </div>
                                <div class="note-meta">
                                    <div class="small text-muted">2 days ago</div>
                                </div>
                            </div>
                            <p class="note-preview small text-muted mb-2">
                                Plan to integrate with GitHub, GitLab, and Jira APIs. Need rate limiting...
                            </p>
                            <div class="note-tags">
                                <span class="badge bg-success badge-sm">backend</span>
                                <span class="badge bg-dark badge-sm">api</span>
                            </div>
                        </div>

                        <!-- Note Item -->
                        <div class="note-item" data-note-id="3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Database Schema</h6>
                                    <div class="small text-muted">
                                        <i class="fas fa-database me-1"></i> E-commerce Backend
                                    </div>
                                </div>
                                <div class="note-meta">
                                    <i class="fas fa-star text-warning"></i>
                                    <div class="small text-muted">3 days ago</div>
                                </div>
                            </div>
                            <p class="note-preview small text-muted mb-2">
                                Users table: id, email, password_hash, created_at. Projects table...
                            </p>
                            <div class="note-tags">
                                <span class="badge bg-dark badge-sm">database</span>
                                <span class="badge bg-warning badge-sm">schema</span>
                            </div>
                        </div>

                        <!-- Note Item -->
                        <div class="note-item" data-note-id="4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">React Native Setup</h6>
                                    <div class="small text-muted">
                                        <i class="fas fa-mobile-alt me-1"></i> Mobile App
                                    </div>
                                </div>
                                <div class="note-meta">
                                    <div class="small text-muted">1 week ago</div>
                                </div>
                            </div>
                            <p class="note-preview small text-muted mb-2">
                                npx react-native init ChegeOSMobile. Using React Navigation for routing...
                            </p>
                            <div class="note-tags">
                                <span class="badge bg-info badge-sm">mobile</span>
                                <span class="badge bg-danger badge-sm">react</span>
                            </div>
                        </div>

                        <!-- Note Item -->
                        <div class="note-item" data-note-id="5">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Project Meeting Notes</h6>
                                    <div class="small text-muted">
                                        <i class="fas fa-users me-1"></i> Team Meeting
                                    </div>
                                </div>
                                <div class="note-meta">
                                    <div class="small text-muted">2 weeks ago</div>
                                </div>
                            </div>
                            <p class="note-preview small text-muted mb-2">
                                Discussed project priorities and timeline. ChegeOS MVP deadline...
                            </p>
                            <div class="note-tags">
                                <span class="badge bg-secondary badge-sm">meeting</span>
                            </div>
                        </div>

                        <!-- Note Item -->
                        <div class="note-item" data-note-id="6">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Code Snippet: JWT Auth</h6>
                                    <div class="small text-muted">
                                        <i class="fas fa-code me-1"></i> Code Snippet
                                    </div>
                                </div>
                                <div class="note-meta">
                                    <i class="fas fa-star text-warning"></i>
                                    <div class="small text-muted">Mar 10</div>
                                </div>
                            </div>
                            <p class="note-preview small text-muted mb-2">
                                // JWT middleware implementation for Express.js...
                            </p>
                            <div class="note-tags">
                                <span class="badge bg-success badge-sm">nodejs</span>
                                <span class="badge bg-danger badge-sm">auth</span>
                                <span class="badge bg-primary badge-sm">code</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Note Editor -->
            <div class="col-lg-8">
                <div class="stat-card" style="height: calc(100vh - 300px); display: flex; flex-direction: column;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Note Editor</h5>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary" id="saveNoteBtn">
                                <i class="fas fa-save me-1"></i> Save
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" id="starNoteBtn">
                                <i class="far fa-star"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" id="deleteNoteBtn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" id="noteTitle" placeholder="Note Title" value="Dashboard Design Decisions">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <select class="form-select" id="noteProject">
                                <option value="chegeos">ChegeOS Dashboard</option>
                                <option value="api">API Integration</option>
                                <option value="mobile">Mobile App</option>
                                <option value="portfolio">Portfolio Website</option>
                                <option value="ecommerce">E-commerce Backend</option>
                                <option value="general">General</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="noteTags" placeholder="Tags (comma separated)" value="design, ui, decisions">
                        </div>
                    </div>

                    <!-- Editor Toolbar -->
                    <div class="editor-toolbar mb-3">
                        <div class="btn-group btn-group-sm me-2">
                            <button class="btn btn-outline-secondary" title="Bold"><i class="fas fa-bold"></i></button>
                            <button class="btn btn-outline-secondary" title="Italic"><i class="fas fa-italic"></i></button>
                            <button class="btn btn-outline-secondary" title="Code"><i class="fas fa-code"></i></button>
                        </div>
                        <div class="btn-group btn-group-sm me-2">
                            <button class="btn btn-outline-secondary" title="Heading 1"><i class="fas fa-heading"></i>1</button>
                            <button class="btn btn-outline-secondary" title="Heading 2"><i class="fas fa-heading"></i>2</button>
                        </div>
                        <div class="btn-group btn-group-sm me-2">
                            <button class="btn btn-outline-secondary" title="List"><i class="fas fa-list-ul"></i></button>
                            <button class="btn btn-outline-secondary" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                        </div>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-secondary" title="Link"><i class="fas fa-link"></i></button>
                            <button class="btn btn-outline-secondary" title="Image"><i class="fas fa-image"></i></button>
                        </div>
                        <div class="form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="markdownMode">
                            <label class="form-check-label small" for="markdownMode">Markdown</label>
                        </div>
                    </div>

                    <!-- Note Editor -->
                    <div class="flex-grow-1 mb-3">
                    <textarea class="form-control h-100" id="noteContent" placeholder="Start writing your note here..."># Dashboard Design Decisions

## Color Scheme
- Primary: Indigo (#6366f1)
- Background: Dark slate (#0f172a)
- Cards: Slate (#1e293b)

## Layout Decisions
1. Fixed sidebar (250px) with toggle
2. Main content area with padding
3. Responsive grid system

## Components
- Stat cards with hover effects
- Project cards with health indicators
- Progress bars for task completion

## Future Considerations
- Light/dark theme toggle
- Customizable dashboard widgets
- Export functionality for reports

## Code Example
```css
.stat-card {
    background-color: #1e293b;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #334155;
}
```</textarea>
                    </div>

                    <!-- Preview/Edit Toggle -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="previewToggle">
                            <label class="form-check-label small" for="previewToggle">Preview Mode</label>
                        </div>
                        <div class="small text-muted">
                            <i class="fas fa-history me-1"></i> Last saved: 2 hours ago
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Notes Section -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Notes</h5>
                        <button class="btn btn-sm btn-outline-secondary" id="clearQuickNotes">
                            <i class="fas fa-trash me-1"></i> Clear All
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="quick-note">
                                <div class="quick-note-content">
                                    Remember to add export functionality to time tracking
                                </div>
                                <div class="quick-note-footer">
                                    <div class="small text-muted">Just now</div>
                                    <button class="btn btn-sm btn-link p-0">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="quick-note">
                                <div class="quick-note-content">
                                    Check mobile responsiveness on calendar view
                                </div>
                                <div class="quick-note-footer">
                                    <div class="small text-muted">Yesterday</div>
                                    <button class="btn btn-sm btn-link p-0">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="quick-note">
                                <div class="quick-note-content">
                                    Research best practices for kanban drag & drop
                                </div>
                                <div class="quick-note-footer">
                                    <div class="small text-muted">2 days ago</div>
                                    <button class="btn btn-sm btn-link p-0">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="quick-note">
                                <div class="quick-note-content">
                                    <input type="text" class="form-control form-control-sm" placeholder="Add quick note...">
                                </div>
                                <div class="quick-note-footer">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Notes Styles */
        .note-item {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .note-item:hover {
            border-color: #475569;
            transform: translateY(-2px);
        }

        .note-item.active {
            border-color: #6366f1;
            background-color: rgba(99, 102, 241, 0.1);
        }

        .note-meta {
            text-align: right;
            font-size: 0.8rem;
        }

        .note-preview {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
        }

        .editor-toolbar {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 6px;
            padding: 0.5rem;
        }

        .quick-note {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
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
            background-color: #0f172a;
            border: 1px solid #334155;
            color: #e2e8f0;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            resize: none;
        }

        /* Scrollbar Styling */
        #notesList::-webkit-scrollbar {
            width: 6px;
        }

        #notesList::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 3px;
        }

        #notesList::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 3px;
        }
    </style>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Notes JavaScript -->
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Sidebar toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('sidebar-collapsed');
                $('#mainContent').toggleClass('full-width');

                const icon = $(this).find('i');
                if (icon.hasClass('fa-bars')) {
                    icon.removeClass('fa-bars').addClass('fa-times');
                } else {
                    icon.removeClass('fa-times').addClass('fa-bars');
                }

                localStorage.setItem('sidebarCollapsed', $('#sidebar').hasClass('sidebar-collapsed'));
            });

            // Check saved sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                $('#sidebar').addClass('sidebar-collapsed');
                $('#mainContent').addClass('full-width');
                $('#sidebarToggle i').removeClass('fa-bars').addClass('fa-times');
            }

            // New note button
            $('#newNoteBtn').click(function() {
                resetNoteEditor();
                showToast('New note created', 'info');
            });

            // Save note
            $('#saveNoteBtn').click(function() {
                const title = $('#noteTitle').val();
                if (!title) {
                    showToast('Please enter a note title', 'warning');
                    return;
                }

                showToast(`Note "${title}" saved successfully`, 'success');

                // Update note list if needed
                updateNoteInList(title);
            });

            // Star note
            $('#starNoteBtn').click(function() {
                const isStarred = $(this).find('i').hasClass('fas');
                if (isStarred) {
                    $(this).html('<i class="far fa-star"></i>');
                    showToast('Note unstarred', 'info');
                } else {
                    $(this).html('<i class="fas fa-star"></i>');
                    showToast('Note starred', 'success');
                }
            });

            // Delete note
            $('#deleteNoteBtn').click(function() {
                const title = $('#noteTitle').val();
                if (confirm(`Delete note "${title}"?`)) {
                    showToast(`Note "${title}" deleted`, 'danger');
                    resetNoteEditor();
                }
            });

            // Note item click
            $(document).on('click', '.note-item', function() {
                $('.note-item').removeClass('active');
                $(this).addClass('active');

                const noteId = $(this).data('note-id');
                loadNote(noteId);
            });

            // Search notes
            $('#notesSearch').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();

                $('.note-item').each(function() {
                    const noteText = $(this).text().toLowerCase();
                    if (noteText.includes(searchTerm) || searchTerm === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Preview toggle
            $('#previewToggle').change(function() {
                if ($(this).is(':checked')) {
                    // Convert markdown to HTML (simplified)
                    const content = $('#noteContent').val();
                    // In a real app, you would use a markdown parser here
                    showToast('Preview mode enabled', 'info');
                } else {
                    showToast('Edit mode enabled', 'info');
                }
            });

            // Clear quick notes
            $('#clearQuickNotes').click(function() {
                if (confirm('Clear all quick notes?')) {
                    $('.quick-note-content:not(:has(input))').parent().parent().fadeOut(300, function() {
                        $(this).remove();
                    });
                    showToast('Quick notes cleared', 'danger');
                }
            });

            // Add quick note
            $(document).on('keypress', '.quick-note input', function(e) {
                if (e.which === 13) { // Enter key
                    const noteText = $(this).val();
                    if (noteText) {
                        // In a real app, this would save the note
                        $(this).val('');
                        showToast('Quick note added', 'success');
                    }
                }
            });

            // Helper functions
            function resetNoteEditor() {
                $('#noteTitle').val('');
                $('#noteContent').val('');
                $('#noteProject').val('general');
                $('#noteTags').val('');
                $('#starNoteBtn').html('<i class="far fa-star"></i>');
            }

            function loadNote(noteId) {
                // In a real app, this would load note from database
                const noteData = {
                    1: {
                        title: 'Dashboard Design Decisions',
                        content: '# Dashboard Design Decisions\n\n## Color Scheme\n- Primary: Indigo (#6366f1)\n- Background: Dark slate (#0f172a)\n- Cards: Slate (#1e293b)',
                        project: 'chegeos',
                        tags: 'design, ui, decisions',
                        starred: true
                    },
                    2: {
                        title: 'API Integration Architecture',
                        content: '# API Integration Architecture\n\nPlan to integrate with GitHub, GitLab, and Jira APIs.',
                        project: 'api',
                        tags: 'backend, api',
                        starred: false
                    }
                };

                if (noteData[noteId]) {
                    const note = noteData[noteId];
                    $('#noteTitle').val(note.title);
                    $('#noteContent').val(note.content);
                    $('#noteProject').val(note.project);
                    $('#noteTags').val(note.tags);
                    $('#starNoteBtn').html(note.starred ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>');
                }
            }

            function updateNoteInList(title) {
                // Update the active note item in the list
                const activeNote = $('.note-item.active');
                activeNote.find('h6').text(title);
                activeNote.find('.note-preview').text($('#noteContent').val().substring(0, 100) + '...');
            }

            // Toast notification function
            function showToast(message, type = 'info') {
                const toastId = 'toast-' + Date.now();
                const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;

                $('.toast-container').append(toastHtml);
                const toast = new bootstrap.Toast(document.getElementById(toastId));
                toast.show();

                $(`#${toastId}`).on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            // Load first note by default
            $('.note-item:first').click();
        });
    </script>

<?= $this->include('layouts/user/footer') ?>
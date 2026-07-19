<?= $this->include('layouts/user/header', ['title' => 'New Project • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>
<?php $initials = strtoupper(substr($user->first_name ?? $user->username, 0, 1) . substr($user->last_name ?? '', 0, 1)); ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">New Project</h1>
            </div>

            <div class="d-flex align-items-center">
                <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>

                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        <?= $initials ?>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= site_url('settings') ?>"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Project Creation Form -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="stat-card">
                    <div class="mb-4">
                        <h5 class="mb-2"><i class="fas fa-plus-circle me-2 text-primary"></i>Create New Coding Project</h5>
                        <p class="text-muted small">Track your development projects with detailed information</p>
                    </div>

                    <form id="projectCreateForm" method="post" action="<?= site_url('projects/store') ?>">
                        <?= csrf_field() ?>

                        <!-- Basic Information -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-3">
                                <h6><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                                <div class="section-line"></div>
                            </div>

                            <!-- Project Name -->
                            <div class="mb-4">
                                <label for="projectName" class="form-label">
                                    Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    <input type="text" class="form-control" id="projectName" name="name"
                                           placeholder="Enter project name" required
                                           data-bs-toggle="tooltip" data-bs-title="Use a descriptive name that clearly identifies your project">
                                </div>
                                <div class="form-text">e.g., "E-commerce API with Node.js" or "Portfolio Website Redesign"</div>
                            </div>

                            <!-- Short Description -->
                            <div class="mb-4">
                                <label for="projectDescription" class="form-label">
                                    Description / Goal <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="projectDescription" name="description" rows="3"
                                          placeholder="What are you building? What problem does it solve?"
                                          required></textarea>
                                <div class="form-text d-flex justify-content-between">
                                    <span>Briefly describe the project's purpose</span>
                                    <span id="descCounter">0/500</span>
                                </div>
                            </div>

                            <!-- Technology Stack -->
                            <div class="mb-4">
                                <label for="projectTech" class="form-label">Technology Stack</label>
                                <div class="tech-select-container">
                                    <div class="selected-tech d-flex flex-wrap gap-2 mb-2" id="selectedTech">
                                        <!-- Selected tech tags will appear here -->
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="techInput"
                                               placeholder="Type to add technologies (PHP, React, MySQL, etc.)">
                                        <button class="btn btn-outline-secondary" type="button" id="addTech">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="tech_stack" id="techStack">
                                    <div class="form-text">Common technologies will be suggested as you type</div>
                                </div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-3">
                                <h6><i class="fas fa-cog me-2"></i>Project Details</h6>
                                <div class="section-line"></div>
                            </div>

                            <div class="row">
                                <!-- Status & Priority -->
                                <div class="col-md-6 mb-4">
                                    <label for="projectStatus" class="form-label">
                                        Status <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="projectStatus" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="planning">📋 Planning</option>
                                        <option value="in_progress" selected>🚀 In Progress</option>
                                        <option value="testing">🧪 Testing</option>
                                        <option value="completed">✅ Completed</option>
                                        <option value="on_hold">⏸️ On Hold</option>
                                        <option value="abandoned">❌ Abandoned</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="projectPriority" class="form-label">
                                        Priority <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="projectPriority" name="priority" required>
                                        <option value="">Select Priority</option>
                                        <option value="low">🟢 Low</option>
                                        <option value="medium" selected>🟡 Medium</option>
                                        <option value="high">🟠 High</option>
                                        <option value="critical">🔴 Critical</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="projectStartDate" class="form-label">Start Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                        <input type="date" class="form-control" id="projectStartDate" name="start_date"
                                               value="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="projectDueDate" class="form-label">Target Completion</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        <input type="date" class="form-control" id="projectDueDate" name="due_date">
                                    </div>
                                    <div class="form-text">Leave empty if no specific deadline</div>
                                </div>
                            </div>

                            <!-- Progress -->
                            <div class="mb-4">
                                <label for="projectProgress" class="form-label">
                                    Current Progress <span id="progressValue" class="badge bg-primary">0%</span>
                                </label>
                                <input type="range" class="form-range" id="projectProgress" name="progress"
                                       min="0" max="100" value="0" step="5">
                                <div class="d-flex justify-content-between small text-muted">
                                    <span>Not Started</span>
                                    <span>Complete</span>
                                </div>
                            </div>

                            <!-- Repository -->
                            <div class="mb-4">
                                <label for="projectRepo" class="form-label">Repository URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-github"></i></span>
                                    <input type="url" class="form-control" id="projectRepo" name="repository_url"
                                           placeholder="https://github.com/username/project">
                                </div>
                                <div class="form-text">Supports GitHub, GitLab, Bitbucket, etc.</div>
                            </div>

                            <!-- Categories/Tags -->
                            <div class="mb-4">
                                <label for="projectCategories" class="form-label">Project Categories</label>
                                <div class="categories-container">
                                    <div class="category-pills d-flex flex-wrap gap-2 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="web_app" id="catWeb">
                                            <label class="form-check-label badge bg-primary" for="catWeb">
                                                Web Application
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="api" id="catAPI">
                                            <label class="form-check-label badge bg-success" for="catAPI">
                                                API/Backend
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="mobile" id="catMobile">
                                            <label class="form-check-label badge bg-info" for="catMobile">
                                                Mobile App
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="learning" id="catLearning">
                                            <label class="form-check-label badge bg-warning" for="catLearning">
                                                Learning Project
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="portfolio" id="catPortfolio">
                                            <label class="form-check-label badge bg-purple" for="catPortfolio">
                                                Portfolio Piece
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="freelance" id="catFreelance">
                                            <label class="form-check-label badge bg-danger" for="catFreelance">
                                                Freelance Work
                                            </label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="categories" id="projectCategories">
                                </div>
                            </div>
                        </div>

                        <!-- Milestones -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-3">
                                <h6><i class="fas fa-flag-checkered me-2"></i>Project Milestones</h6>
                                <div class="section-line"></div>
                            </div>

                            <div id="milestonesContainer">
                                <div class="milestone-entry card mb-3">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" placeholder="Milestone name"
                                                       name="milestones[0][name]">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" class="form-control" placeholder="Due date"
                                                       name="milestones[0][due_date]">
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-select" name="milestones[0][status]">
                                                    <option value="pending">Pending</option>
                                                    <option value="in_progress">In Progress</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" rows="2" placeholder="Description (optional)"
                                                          name="milestones[0][description]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-secondary btn-sm" id="addMilestone">
                                <i class="fas fa-plus me-1"></i> Add Another Milestone
                            </button>
                            <div class="form-text">Break down your project into manageable milestones</div>
                        </div>

                        <!-- Notes & Observations -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-3">
                                <h6><i class="fas fa-sticky-note me-2"></i>Notes & Observations</h6>
                                <div class="section-line"></div>
                            </div>

                            <div class="mb-4">
                                <label for="projectNotes" class="form-label">Initial Notes</label>
                                <textarea class="form-control" id="projectNotes" name="notes" rows="4"
                                          placeholder="Add any initial thoughts, blockers, or learning goals..."></textarea>
                                <div class="form-text">Use this space to track challenges, lessons learned, or project-specific notes</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Known Blockers</label>
                                <div class="blockers-container">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control blocker-input" placeholder="Add a blocker">
                                        <button class="btn btn-outline-danger" type="button" id="addBlocker">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div id="blockersList"></div>
                                    <input type="hidden" name="blockers" id="projectBlockers">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <div>
                                <button type="button" class="btn btn-outline-primary me-2" id="saveDraftBtn">
                                    <i class="fas fa-save me-1"></i> Save Draft
                                </button>
                                <button type="submit" class="btn btn-primary" id="createProjectBtn">
                                    <i class="fas fa-rocket me-1"></i> Create Project
                                </button>
                            </div>
                        </div>

                        <!-- Quick Tips -->
                        <div class="stat-card mt-4">
                            <h6 class="mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Quick Tips</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small><strong>Set realistic milestones</strong> - Break large projects into smaller, achievable goals</small>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small><strong>Track blockers early</strong> - Identify potential challenges before they delay your project</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small><strong>Link your repository</strong> - Connect to GitHub/GitLab for automatic activity tracking</small>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small><strong>Update progress regularly</strong> - Keep your project status current for accurate insights</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <style>
        /* Progress Steps */
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }

        .progress-step.active .step-number {
            background-color: #6366f1;
            color: white;
            border-color: #6366f1;
        }

        .step-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid #475569;
            background-color: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .step-label {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .progress-step.active .step-label {
            color: #e2e8f0;
            font-weight: 500;
        }

        .progress-connector {
            flex: 1;
            height: 2px;
            background-color: #475569;
            margin: 0 1rem;
            margin-top: 18px;
        }

        /* Form Sections */
        .form-section {
            padding: 1.5rem;
            background-color: rgba(30, 41, 59, 0.5);
            border-radius: 8px;
            border-left: 4px solid #6366f1;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-line {
            flex-grow: 1;
            height: 1px;
            background-color: #334155;
        }

        /* Tech Tags */
        .tech-tag {
            display: inline-flex;
            align-items: center;
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 0.25rem 0.75rem;
            font-size: 0.85rem;
            margin: 0.25rem;
        }

        .tech-tag .remove {
            margin-left: 0.5rem;
            cursor: pointer;
            color: #94a3b8;
        }

        .tech-tag .remove:hover {
            color: #ef4444;
        }

        /* Milestone Cards */
        .milestone-entry {
            background-color: #0f172a;
            border: 1px solid #334155;
        }

        .milestone-entry .card-body {
            padding: 1rem;
        }

        /* Blockers */
        .blocker-item {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 6px;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .blocker-item .remove {
            color: #ef4444;
            cursor: pointer;
        }

        /* Category Pills */
        .category-pills .form-check {
            margin: 0;
        }

        .category-pills .form-check-input {
            display: none;
        }

        .category-pills .form-check-label {
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.2s;
            padding: 0.5rem 1rem;
        }

        .category-pills .form-check-input:checked + .form-check-label {
            opacity: 1;
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .bg-purple {
            background-color: #8b5cf6 !important;
        }
    </style>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            // Tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Description character counter
            $('#projectDescription').on('input', function() {
                const length = $(this).val().length;
                $('#descCounter').text(length + '/500');
                if (length > 450) {
                    $('#descCounter').addClass('text-warning');
                } else {
                    $('#descCounter').removeClass('text-warning');
                }
            });

            // Technology stack management
            const techStack = [];
            const commonTech = ['PHP', 'JavaScript', 'React', 'Node.js', 'Python', 'MySQL', 'PostgreSQL',
                'MongoDB', 'Docker', 'Git', 'Tailwind CSS', 'Bootstrap', 'CodeIgniter',
                'Laravel', 'Vue.js', 'TypeScript', 'Redis', 'AWS', 'GraphQL'];

            $('#addTech').click(addTechnology);
            $('#techInput').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    addTechnology();
                }
            });

            function addTechnology() {
                const tech = $('#techInput').val().trim();
                if (tech && !techStack.includes(tech.toLowerCase())) {
                    techStack.push(tech.toLowerCase());
                    updateTechDisplay();
                    $('#techInput').val('');
                }
            }

            function updateTechDisplay() {
                $('#selectedTech').empty();
                techStack.forEach(tech => {
                    const tag = $(`
                        <div class="tech-tag">
                            ${tech}
                            <span class="remove" data-tech="${tech}">×</span>
                        </div>
                    `);
                    $('#selectedTech').append(tag);
                });
                $('#techStack').val(techStack.join(','));
            }

            $(document).on('click', '.tech-tag .remove', function() {
                const techToRemove = $(this).data('tech');
                const index = techStack.indexOf(techToRemove);
                if (index > -1) {
                    techStack.splice(index, 1);
                    updateTechDisplay();
                }
            });

            // Progress slider update
            $('#projectProgress').on('input', function() {
                const value = $(this).val();
                $('#progressValue').text(value + '%').removeClass().addClass('badge');
                if (value < 30) $('#progressValue').addClass('bg-danger');
                else if (value < 70) $('#progressValue').addClass('bg-warning');
                else $('#progressValue').addClass('bg-success');
            });

            // Categories handling
            $('.category-pills input[type="checkbox"]').change(function() {
                const categories = [];
                $('.category-pills input[type="checkbox"]:checked').each(function() {
                    categories.push($(this).val());
                });
                $('#projectCategories').val(categories.join(','));
            });

            // Milestones
            let milestoneCount = 1;
            $('#addMilestone').click(function() {
                const template = `
                    <div class="milestone-entry card mb-3">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" placeholder="Milestone name"
                                           name="milestones[${milestoneCount}][name]">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" placeholder="Due date"
                                           name="milestones[${milestoneCount}][due_date]">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" name="milestones[${milestoneCount}][status]">
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="2" placeholder="Description (optional)"
                                              name="milestones[${milestoneCount}][description]"></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-milestone">
                                        <i class="fas fa-trash me-1"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#milestonesContainer').append(template);
                milestoneCount++;
            });

            $(document).on('click', '.remove-milestone', function() {
                $(this).closest('.milestone-entry').remove();
            });

            // Blockers
            const blockers = [];
            $('#addBlocker').click(function() {
                const blocker = $('.blocker-input').val().trim();
                if (blocker) {
                    blockers.push(blocker);
                    updateBlockersDisplay();
                    $('.blocker-input').val('');
                }
            });

            function updateBlockersDisplay() {
                $('#blockersList').empty();
                blockers.forEach((blocker, index) => {
                    const item = $(`
                        <div class="blocker-item">
                            <span>${blocker}</span>
                            <span class="remove" data-index="${index}">
                                <i class="fas fa-times"></i>
                            </span>
                        </div>
                    `);
                    $('#blockersList').append(item);
                });
                $('#projectBlockers').val(blockers.join('|'));
            }

            $(document).on('click', '.blocker-item .remove', function() {
                const index = $(this).data('index');
                blockers.splice(index, 1);
                updateBlockersDisplay();
            });

            // Form validation and submission
            $('#projectCreateForm').on('submit', function(e) {
                // Validate required fields
                const projectName = $('#projectName').val().trim();
                const description = $('#projectDescription').val().trim();

                if (!projectName) {
                    e.preventDefault();
                    showToast('Please enter a project name', 'danger');
                    $('#projectName').focus();
                    return;
                }

                if (!description) {
                    e.preventDefault();
                    showToast('Please enter a project description', 'danger');
                    $('#projectDescription').focus();
                    return;
                }

                // Show loading state
                $('#createProjectBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Creating...');
            });

            // Save draft
            $('#saveDraftBtn').click(function() {
                const projectName = $('#projectName').val().trim();
                if (!projectName) {
                    showToast('Please enter at least a project name to save as draft', 'warning');
                    return;
                }
                showToast('Project saved as draft', 'info');
                // In real app, this would make an AJAX call
            });

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
        });
    </script>

<?= $this->include('layouts/user/footer') ?>
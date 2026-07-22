<?= $this->include('layouts/user/header', ['title' => 'Edit Project • Chege JIRA']) ?>
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
                <h1 class="h4 mb-0">Edit Project</h1>
            </div>

            <div class="d-flex align-items-center">
                <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-eye me-1"></i> View
                </a>
                <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i> All Projects
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

        <!-- Project Header -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3" style="width: 48px; height: 48px; background-color: <?= esc($project['color'] ?? '#6366f1') ?>; font-size: 20px;">
                                <i class="fas <?= esc($project['icon'] ?? 'fa-project-diagram') ?>"></i>
                            </div>
                            <div>
                                <h5 class="mb-1"><?= esc($project['name']) ?></h5>
                                <p class="text-muted small mb-0">Last updated: <?= date('M d, H:i', strtotime($project['updated_at'])) ?></p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('projects/time/' . $project['id']) ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-clock me-1"></i> Track Time
                            </a>
                            <a href="<?= site_url('projects/kanban/' . $project['id']) ?>" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-columns me-1"></i> Kanban
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Edit Form -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="stat-card">
                    <div class="mb-4">
                        <h5 class="mb-2"><i class="fas fa-edit me-2 text-warning"></i>Update Project Details</h5>
                        <p class="text-muted small">Current progress: <strong class="text-success">75% complete</strong></p>
                    </div>

                    <form id="projectEditForm" method="post" action="<?= site_url('projects/update/' . $project['id']) ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $project['id'] ?>">

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
                                           value="<?= esc($project['name']) ?>" required>
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="mb-4">
                                <label for="projectDescription" class="form-label">
                                    Description / Goal <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="projectDescription" name="description" rows="3"
                                          required><?= esc($project['description']) ?></textarea>
                                <div class="form-text d-flex justify-content-between">
                                    <span>Briefly describe the project's purpose</span>
                                    <span id="descCounter">142/500</span>
                                </div>
                            </div>

                            <!-- Technology Stack -->
                            <div class="mb-4">
                                <label for="projectTech" class="form-label">Technology Stack</label>
                                <div class="tech-select-container">
                                    <div class="selected-tech d-flex flex-wrap gap-2 mb-2" id="selectedTech">
                                        <?php if (!empty($tech_stack)): ?>
                                            <?php foreach ($tech_stack as $tech): ?>
                                            <div class="tech-tag">
                                                <?= esc($tech) ?>
                                                <span class="remove" data-tech="<?= esc($tech) ?>">×</span>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="techInput"
                                               placeholder="Add another technology...">
                                        <button class="btn btn-outline-secondary" type="button" id="addTech">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="tech_stack" id="techStack" value="<?= esc(implode(',', $tech_stack)) ?>">
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
                                        <option value="planning" <?= $project['status'] === 'planning' ? 'selected' : '' ?>>📋 Planning</option>
                                        <option value="in_progress" <?= $project['status'] === 'in_progress' ? 'selected' : '' ?>>🚀 In Progress</option>
                                        <option value="testing" <?= $project['status'] === 'testing' ? 'selected' : '' ?>>🧪 Testing</option>
                                        <option value="completed" <?= $project['status'] === 'completed' ? 'selected' : '' ?>>✅ Completed</option>
                                        <option value="on_hold" <?= $project['status'] === 'on_hold' ? 'selected' : '' ?>>⏸️ On Hold</option>
                                        <option value="abandoned" <?= $project['status'] === 'abandoned' ? 'selected' : '' ?>>❌ Abandoned</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="projectPriority" class="form-label">
                                        Priority <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="projectPriority" name="priority" required>
                                        <option value="low" <?= $project['priority'] === 'low' ? 'selected' : '' ?>>🟢 Low</option>
                                        <option value="medium" <?= $project['priority'] === 'medium' ? 'selected' : '' ?>>🟡 Medium</option>
                                        <option value="high" <?= $project['priority'] === 'high' ? 'selected' : '' ?>>🟠 High</option>
                                        <option value="critical" <?= $project['priority'] === 'critical' ? 'selected' : '' ?>>🔴 Critical</option>
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
                                               value="<?= $project['start_date'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="projectDueDate" class="form-label">Target Completion</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        <input type="date" class="form-control" id="projectDueDate" name="due_date"
                                               value="<?= $project['due_date'] ?>">
                                    </div>
                                    <div class="form-text">
                                        <span id="daysRemaining"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress -->
                            <div class="mb-4">
                                <label for="projectProgress" class="form-label">
                                    Current Progress <span id="progressValue" class="badge bg-success"><?= $project['progress'] ?>%</span>
                                </label>
                                <input type="range" class="form-range" id="projectProgress" name="progress"
                                       min="0" max="100" value="<?= $project['progress'] ?>" step="5">
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
                                           value="<?= esc($project['repository_url']) ?>">
                                </div>
                                <?php if (!empty($project['repository_url'])): ?>
                                <div class="form-text">
                                    <a href="<?= esc($project['repository_url']) ?>" target="_blank" class="small">
                                        <i class="fas fa-external-link-alt me-1"></i> View Repository
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Categories/Tags -->
                            <div class="mb-4">
                                <label for="projectCategories" class="form-label">Project Categories</label>
                                <div class="categories-container">
                                    <div class="category-pills d-flex flex-wrap gap-2 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="web_app" id="catWeb" <?= in_array('web_app', $categories) ? 'checked' : '' ?>>
                                            <label class="form-check-label badge bg-primary" for="catWeb">Web Application</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="api" id="catAPI" <?= in_array('api', $categories) ? 'checked' : '' ?>>
                                            <label class="form-check-label badge bg-success" for="catAPI">API/Backend</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="mobile" id="catMobile" <?= in_array('mobile', $categories) ? 'checked' : '' ?>>
                                            <label class="form-check-label badge bg-info" for="catMobile">Mobile App</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="learning" id="catLearning" <?= in_array('learning', $categories) ? 'checked' : '' ?>>
                                            <label class="form-check-label badge bg-warning" for="catLearning">Learning Project</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="portfolio" id="catPortfolio" <?= in_array('portfolio', $categories) ? 'checked' : '' ?>>
                                            <label class="form-check-label badge bg-purple" for="catPortfolio">Portfolio Piece</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="freelance" id="catFreelance" <?= in_array('freelance', $categories) ? 'checked' : '' ?>>
                                            <label class="form-check-label badge bg-danger" for="catFreelance">Freelance Work</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="categories" id="projectCategories" value="<?= esc(implode(',', $categories)) ?>">
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
                                <?php if (!empty($milestones)): ?>
                                    <?php foreach ($milestones as $index => $ms): ?>
                                    <div class="milestone-entry card mb-3">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" value="<?= esc($ms['name']) ?>"
                                                           name="milestones[<?= $index ?>][name]">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="date" class="form-control" value="<?= $ms['due_date'] ?>"
                                                           name="milestones[<?= $index ?>][due_date]">
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-select" name="milestones[<?= $index ?>][status]">
                                                        <option value="pending" <?= $ms['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="in_progress" <?= $ms['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                                        <option value="completed" <?= $ms['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <textarea class="form-control" rows="2" name="milestones[<?= $index ?>][description]"><?= esc($ms['description']) ?></textarea>
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-milestone">
                                                        <i class="fas fa-trash me-1"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <button type="button" class="btn btn-outline-secondary btn-sm" id="addMilestone">
                                <i class="fas fa-plus me-1"></i> Add Another Milestone
                            </button>
                        </div>

                        <!-- Notes & Observations -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-3">
                                <h6><i class="fas fa-sticky-note me-2"></i>Notes & Observations</h6>
                                <div class="section-line"></div>
                            </div>

                            <div class="mb-4">
                                <label for="projectNotes" class="form-label">Project Notes</label>
                                <textarea class="form-control" id="projectNotes" name="notes" rows="4">- Need to improve mobile responsiveness
- Consider adding dark/light theme toggle
- API rate limiting needs implementation
- Great progress on authentication system!</textarea>
                                <div class="form-text">Track challenges, lessons learned, or project-specific notes</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Current Blockers</label>
                                <div class="blockers-container">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control blocker-input" placeholder="Add a new blocker">
                                        <button class="btn btn-outline-danger" type="button" id="addBlocker">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div id="blockersList">
                                        <div class="blocker-item">
                                            <span>Waiting for design feedback on dashboard components</span>
                                            <span class="remove" data-index="0">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                        <div class="blocker-item">
                                            <span>GitHub API rate limit issues</span>
                                            <span class="remove" data-index="1">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="blockers" id="projectBlockers" value="Waiting for design feedback on dashboard components|GitHub API rate limit issues">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <div>
                                <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                                <button type="button" class="btn btn-outline-danger ms-2" id="deleteProjectBtn">
                                    <i class="fas fa-trash me-1"></i> Delete Project
                                </button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-primary me-2" id="saveDraftBtn">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                                <button type="submit" class="btn btn-warning" id="updateProjectBtn">
                                    <i class="fas fa-check me-1"></i> Update Project
                                </button>
                            </div>
                        </div>

                        <!-- Change History -->
                        <div class="stat-card mt-4">
                            <h6 class="mb-3"><i class="fas fa-history me-2 text-info"></i>Recent Changes</h6>
                            <div class="timeline small">
                                <div class="d-flex mb-2">
                                    <div class="text-muted" style="min-width: 120px;">2 hours ago</div>
                                    <div>Updated progress from 65% to 75%</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="text-muted" style="min-width: 120px;">1 day ago</div>
                                    <div>Added "Project Setup" milestone</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="text-muted" style="min-width: 120px;">3 days ago</div>
                                    <div>Changed priority from Medium to High</div>
                                </div>
                                <div class="d-flex">
                                    <div class="text-muted" style="min-width: 120px;">Jan 15, 2024</div>
                                    <div>Project created</div>
                                </div>
                            </div>
                        </div>


                    </form>

                    <form id="deleteProjectForm" action="<?= site_url('projects/delete/' . $project['id']) ?>" method="post" style="display:none;">
                        <?= csrf_field() ?>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>"<?= esc($project['name']) ?>"</strong>?</p>
                    <div class="alert alert-warning small">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        This will permanently delete all project data, including:
                        <ul class="mb-0 mt-1">
                            <li>All time tracking entries</li>
                            <li>Task history and milestones</li>
                            <li>Project notes and attachments</li>
                        </ul>
                    </div>
                    <p class="text-danger mb-0"><strong>This action cannot be undone!</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-1"></i> Delete Project
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <script>
        $(document).ready(function() {
            // Days remaining calculation
            function updateDaysRemaining() {
                const dueDate = new Date($('#projectDueDate').val());
                const today = new Date();
                const diffTime = dueDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                let message = '';
                if (diffDays > 0) {
                    message = `<span class="text-success">${diffDays} days remaining</span>`;
                } else if (diffDays === 0) {
                    message = `<span class="text-warning">Due today!</span>`;
                } else {
                    message = `<span class="text-danger">Overdue by ${Math.abs(diffDays)} days</span>`;
                }
                $('#daysRemaining').html(message);
            }

            $('#projectDueDate').change(updateDaysRemaining);
            updateDaysRemaining();

            // Character counter
            $('#projectDescription').on('input', function() {
                const length = $(this).val().length;
                $('#descCounter').text(length + '/500');
            });

            // Technology stack
            const techStack = <?= json_encode($tech_stack) ?>;

            $('#addTech').click(function() {
                const tech = $('#techInput').val().trim().toLowerCase();
                if (tech && !techStack.includes(tech)) {
                    techStack.push(tech);
                    updateTechDisplay();
                    $('#techInput').val('');
                }
            });

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

            // Progress slider
            $('#projectProgress').on('input', function() {
                const value = $(this).val();
                $('#progressValue').text(value + '%').removeClass().addClass('badge');
                if (value < 30) $('#progressValue').addClass('bg-danger');
                else if (value < 70) $('#progressValue').addClass('bg-warning');
                else $('#progressValue').addClass('bg-success');
            });

            // Categories
            $('.category-pills input[type="checkbox"]').change(function() {
                const categories = [];
                $('.category-pills input[type="checkbox"]:checked').each(function() {
                    categories.push($(this).val());
                });
                $('#projectCategories').val(categories.join(','));
            });

            // Milestones
            let milestoneCount = <?= count($milestones) ?>;
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
            const blockers = ['Waiting for design feedback on dashboard components', 'GitHub API rate limit issues'];

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

            // Delete project
            $('#confirmDeleteBtn').click(function() {
                $('#deleteProjectForm').submit();
            });

            // Form submission
            $('#projectEditForm').on('submit', function(e) {
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
                $('#updateProjectBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Updating...');
            });

            // Save changes
            $('#saveDraftBtn').click(function() {
                showToast('Changes saved successfully', 'info');
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
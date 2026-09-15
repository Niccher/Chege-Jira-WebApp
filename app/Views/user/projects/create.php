<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>New Project • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary rounded-pill">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to Projects
                </a>
            </div>
            <h4 class="page-title"><i class="uil-plus-circle me-2 text-primary"></i> Create Project</h4>
        </div>
    </div>
</div>

<!-- Project Creation Form -->
<div class="row">
    <div class="col-xl-9 col-lg-10 mx-auto">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-bottom py-3">
                <h5 class="header-title mb-0">
                    <i class="uil-folder-plus me-1 text-primary"></i> Project Information
                </h5>
            </div>
            <div class="card-body p-4">
                <form id="projectCreateForm" method="post" action="<?= site_url('projects/store') ?>">
                    <?= csrf_field() ?>

                    <!-- Basic Information Section -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted font-12 fw-bold mb-3">
                            <i class="uil-info-circle me-1"></i> Basic Details
                        </h6>

                        <!-- Project Name -->
                        <div class="mb-3">
                            <label for="projectName" class="form-label fw-semibold">
                                Project Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg" id="projectName" name="name"
                                   placeholder="e.g., E-commerce API or Portfolio Redesign" required>
                            <div class="form-text">Choose a descriptive name that clearly identifies your project.</div>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="projectDescription" class="form-label fw-semibold mb-0">
                                    Description / Goal <span class="text-danger">*</span>
                                </label>
                                <small class="text-muted" id="descCounter">0/500</small>
                            </div>
                            <textarea class="form-control" id="projectDescription" name="description" rows="3"
                                      placeholder="What are you building? What problem does it solve?" required></textarea>
                        </div>

                        <!-- Technology Stack -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Technology Stack</label>
                            <div class="d-flex flex-wrap gap-1 mb-2" id="selectedTech">
                                <!-- Selected tech tags will appear here -->
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="techInput"
                                       placeholder="Type technology (e.g. PHP, React, MySQL) and press Enter...">
                                <button class="btn btn-outline-secondary" type="button" id="addTech">
                                    <i class="mdi mdi-plus"></i> Add
                                </button>
                            </div>
                            <input type="hidden" name="tech_stack" id="techStack">
                        </div>
                    </div>

                    <!-- Project Parameters Section -->
                    <div class="mb-4 border-top pt-3">
                        <h6 class="text-uppercase text-muted font-12 fw-bold mb-3">
                            <i class="uil-sliders-v-alt me-1"></i> Status & Scheduling
                        </h6>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="projectStatus" class="form-label fw-semibold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="projectStatus" name="status" required>
                                    <option value="planning">📋 Planning</option>
                                    <option value="in_progress" selected>🚀 In Progress</option>
                                    <option value="testing">🧪 Testing</option>
                                    <option value="completed">✅ Completed</option>
                                    <option value="on_hold">⏸️ On Hold</option>
                                    <option value="abandoned">❌ Abandoned</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="projectPriority" class="form-label fw-semibold">
                                    Priority <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="projectPriority" name="priority" required>
                                    <option value="low">🟢 Low</option>
                                    <option value="medium" selected>🟡 Medium</option>
                                    <option value="high">🟠 High</option>
                                    <option value="critical">🔴 Critical</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="projectStartDate" class="form-label fw-semibold">Start Date</label>
                                <input type="date" class="form-control" id="projectStartDate" name="start_date"
                                       value="<?= date('Y-m-d') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="projectDueDate" class="form-label fw-semibold">Target Completion</label>
                                <input type="date" class="form-control" id="projectDueDate" name="due_date">
                                <div class="form-text">Leave blank if no strict deadline.</div>
                            </div>
                        </div>

                        <!-- Progress -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="projectProgress" class="form-label fw-semibold mb-0">
                                    Initial Progress
                                </label>
                                <span id="progressValue" class="badge bg-primary-lighten text-primary font-12">0%</span>
                            </div>
                            <input type="range" class="form-range" id="projectProgress" name="progress"
                                   min="0" max="100" value="0" step="5">
                        </div>

                        <!-- Repository -->
                        <div class="mb-3">
                            <label for="projectRepo" class="form-label fw-semibold">Repository URL</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                                <input type="url" class="form-control" id="projectRepo" name="repository_url"
                                       placeholder="https://github.com/username/project">
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Categories</label>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="web_app" id="catWeb">
                                    <label class="form-check-label" for="catWeb">Web Application</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="api" id="catAPI">
                                    <label class="form-check-label" for="catAPI">API / Backend</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mobile" id="catMobile">
                                    <label class="form-check-label" for="catMobile">Mobile App</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="learning" id="catLearning">
                                    <label class="form-check-label" for="catLearning">Learning</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="portfolio" id="catPortfolio">
                                    <label class="form-check-label" for="catPortfolio">Portfolio</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="freelance" id="catFreelance">
                                    <label class="form-check-label" for="catFreelance">Freelance</label>
                                </div>
                            </div>
                            <input type="hidden" name="categories" id="projectCategories">
                        </div>
                    </div>

                    <!-- Milestones Section -->
                    <div class="mb-4 border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-uppercase text-muted font-12 fw-bold mb-0">
                                <i class="uil-check-square me-1"></i> Milestones
                            </h6>
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" id="addMilestone">
                                <i class="mdi mdi-plus me-1"></i> Add Milestone
                            </button>
                        </div>

                        <div id="milestonesContainer">
                            <div class="milestone-entry p-3 rounded border bg-light-subtle mb-2">
                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control form-control-sm" placeholder="Milestone name"
                                               name="milestones[0][name]">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control form-control-sm" placeholder="Due date"
                                               name="milestones[0][due_date]">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select form-select-sm" name="milestones[0][status]">
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control form-control-sm" rows="2" placeholder="Description (optional)"
                                                  name="milestones[0][description]"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="mb-4 border-top pt-3">
                        <h6 class="text-uppercase text-muted font-12 fw-bold mb-3">
                            <i class="uil-notes me-1"></i> Notes & Observations
                        </h6>

                        <div class="mb-3">
                            <label for="projectNotes" class="form-label fw-semibold">Initial Notes</label>
                            <textarea class="form-control font-monospace" id="projectNotes" name="notes" rows="3"
                                      placeholder="Add initial thoughts, requirements, or architecture notes..."></textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="<?= site_url('projects') ?>" class="btn btn-light">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" id="createProjectBtn">
                            <i class="mdi mdi-rocket-launch me-1"></i> Create Project
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Description counter
        $('#projectDescription').on('input', function() {
            const length = $(this).val().length;
            $('#descCounter').text(length + '/500');
        });

        // Tech stack management
        const techStack = [];
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
                    <span class="badge bg-primary-lighten text-primary font-12 d-inline-flex align-items-center gap-1">
                        ${tech}
                        <span class="cursor-pointer remove-tech" data-tech="${tech}" style="cursor: pointer;">&times;</span>
                    </span>
                `);
                $('#selectedTech').append(tag);
            });
            $('#techStack').val(techStack.join(','));
        }

        $(document).on('click', '.remove-tech', function() {
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
            $('#progressValue').text(value + '%');
        });

        // Categories
        $('.form-check-input').change(function() {
            const categories = [];
            $('input[type="checkbox"]:checked').each(function() {
                categories.push($(this).val());
            });
            $('#projectCategories').val(categories.join(','));
        });

        // Milestones
        let milestoneCount = 1;
        $('#addMilestone').click(function() {
            const template = `
                <div class="milestone-entry p-3 rounded border bg-light-subtle mb-2">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-sm" placeholder="Milestone name"
                                   name="milestones[${milestoneCount}][name]">
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" placeholder="Due date"
                                   name="milestones[${milestoneCount}][due_date]">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" name="milestones[${milestoneCount}][status]">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control form-control-sm" rows="2" placeholder="Description (optional)"
                                      name="milestones[${milestoneCount}][description]"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-milestone">
                                <i class="mdi mdi-trash-can-outline me-1"></i> Remove
                            </button>
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

        // Form submission
        $('#projectCreateForm').on('submit', function(e) {
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

            $('#createProjectBtn').prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin me-1"></i> Creating...');
        });

        // Toast notification
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

<?= $this->endSection() ?>

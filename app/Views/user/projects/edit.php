<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>Edit: <?= esc($project['name']) ?> • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$initials = strtoupper(substr($user->first_name ?? $user->username ?? 'U', 0, 1) . substr($user->last_name ?? '', 0, 1));
$categories = is_array($categories ?? null) ? $categories : (!empty($project['categories']) ? explode(',', $project['categories']) : []);
$tech_stack = is_array($tech_stack ?? null) ? $tech_stack : (!empty($project['tech_stack']) ? explode(',', $project['tech_stack']) : []);
$milestones = is_array($milestones ?? null) ? $milestones : [];
?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <div class="btn-group">
                    <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="btn btn-outline-primary btn-sm">
                        <i class="mdi mdi-eye me-1"></i> View Project
                    </a>
                    <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="mdi mdi-arrow-left me-1"></i> All Projects
                    </a>
                </div>
            </div>
            <h4 class="page-title">
                <i class="uil-edit-alt me-2 text-primary"></i> Edit Project: <?= esc($project['name']) ?>
            </h4>
        </div>
    </div>
</div>

<!-- Project Overview Bar -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-0">
            <div class="card-body py-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex align-items-center">
                        <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center text-white me-3" 
                             style="background-color: <?= esc($project['color'] ?? '#3e60d5') ?>; font-size: 22px; width: 48px; height: 48px;">
                            <i class="fas <?= esc($project['icon'] ?? 'fa-project-diagram') ?>"></i>
                        </div>
                        <div>
                            <h4 class="mb-1"><?= esc($project['name']) ?></h4>
                            <p class="text-muted font-13 mb-0">
                                Last updated: <?= !empty($project['updated_at']) ? date('M d, Y H:i', strtotime($project['updated_at'])) : 'Recently' ?>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= site_url('projects/time/' . $project['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="mdi mdi-clock-outline me-1"></i> Track Time
                        </a>
                        <a href="<?= site_url('projects/kanban/' . $project['id']) ?>" class="btn btn-sm btn-outline-info">
                            <i class="mdi mdi-view-column me-1"></i> Kanban
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Project Edit Form -->
<div class="row">
    <div class="col-xl-9 col-lg-10 mx-auto">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="header-title mb-0">
                    <i class="uil-sliders-v-alt me-1 text-primary"></i> Project Details & Configuration
                </h5>
                <span class="badge bg-success-lighten text-success font-13">
                    Progress: <?= (int)($project['progress'] ?? 0) ?>%
                </span>
            </div>
            <div class="card-body p-4">
                <form id="projectEditForm" method="post" action="<?= site_url('projects/update/' . $project['id']) ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $project['id'] ?>">

                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted font-12 fw-bold mb-3">
                            <i class="uil-info-circle me-1"></i> Basic Information
                        </h6>

                        <!-- Project Name -->
                        <div class="mb-3">
                            <label for="projectName" class="form-label fw-semibold">
                                Project Name <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                <input type="text" class="form-control" id="projectName" name="name"
                                       value="<?= esc($project['name']) ?>" required>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="projectDescription" class="form-label fw-semibold mb-0">
                                    Description / Goal <span class="text-danger">*</span>
                                </label>
                                <small class="text-muted" id="descCounter"><?= strlen($project['description'] ?? '') ?>/500</small>
                            </div>
                            <textarea class="form-control" id="projectDescription" name="description" rows="3"
                                      required><?= esc($project['description']) ?></textarea>
                            <div class="form-text">Briefly describe the project's purpose and target outcomes.</div>
                        </div>

                        <!-- Technology Stack -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Technology Stack</label>
                            <div class="d-flex flex-wrap gap-1 mb-2" id="selectedTech">
                                <?php if (!empty($tech_stack)): ?>
                                    <?php foreach ($tech_stack as $tech): if (empty(trim($tech))) continue; ?>
                                    <div class="badge bg-primary-lighten text-primary p-2 d-flex align-items-center gap-1 font-13 rounded">
                                        <?= esc(trim($tech)) ?>
                                        <span class="remove ms-1 text-danger cursor-pointer" data-tech="<?= esc(trim($tech)) ?>" style="cursor: pointer;">&times;</span>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="techInput"
                                       placeholder="Add another technology (e.g., Vue.js, Docker)...">
                                <button class="btn btn-outline-secondary" type="button" id="addTech">
                                    <i class="mdi mdi-plus"></i> Add
                                </button>
                            </div>
                            <input type="hidden" name="tech_stack" id="techStack" value="<?= esc(implode(',', array_filter($tech_stack))) ?>">
                        </div>
                    </div>

                    <!-- Project Parameters -->
                    <div class="mb-4 border-top pt-3">
                        <h6 class="text-uppercase text-muted font-12 fw-bold mb-3">
                            <i class="uil-cog me-1"></i> Status & Scheduling
                        </h6>

                        <div class="row g-3 mb-3">
                            <!-- Status & Priority -->
                            <div class="col-md-6">
                                <label for="projectStatus" class="form-label fw-semibold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="projectStatus" name="status" required>
                                    <option value="planning" <?= ($project['status'] ?? '') === 'planning' ? 'selected' : '' ?>>📋 Planning</option>
                                    <option value="in_progress" <?= ($project['status'] ?? '') === 'in_progress' ? 'selected' : '' ?>>🚀 In Progress</option>
                                    <option value="testing" <?= ($project['status'] ?? '') === 'testing' ? 'selected' : '' ?>>🧪 Testing</option>
                                    <option value="completed" <?= ($project['status'] ?? '') === 'completed' ? 'selected' : '' ?>>✅ Completed</option>
                                    <option value="on_hold" <?= ($project['status'] ?? '') === 'on_hold' ? 'selected' : '' ?>>⏸️ On Hold</option>
                                    <option value="abandoned" <?= ($project['status'] ?? '') === 'abandoned' ? 'selected' : '' ?>>❌ Abandoned</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="projectPriority" class="form-label fw-semibold">
                                    Priority <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="projectPriority" name="priority" required>
                                    <option value="low" <?= ($project['priority'] ?? '') === 'low' ? 'selected' : '' ?>>🟢 Low</option>
                                    <option value="medium" <?= ($project['priority'] ?? '') === 'medium' ? 'selected' : '' ?>>🟡 Medium</option>
                                    <option value="high" <?= ($project['priority'] ?? '') === 'high' ? 'selected' : '' ?>>🟠 High</option>
                                    <option value="critical" <?= ($project['priority'] ?? '') === 'critical' ? 'selected' : '' ?>>🔴 Critical</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="projectStartDate" class="form-label fw-semibold">Start Date</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <input type="date" class="form-control" id="projectStartDate" name="start_date"
                                           value="<?= esc($project['start_date'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="projectDueDate" class="form-label fw-semibold">Target Completion</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="mdi mdi-calendar-check"></i></span>
                                    <input type="date" class="form-control" id="projectDueDate" name="due_date"
                                           value="<?= esc($project['due_date'] ?? '') ?>">
                                </div>
                                <div class="form-text">
                                    <span id="daysRemaining"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Slider -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="projectProgress" class="form-label fw-semibold mb-0">
                                    Current Progress
                                </label>
                                <span id="progressValue" class="badge bg-primary-lighten text-primary font-12"><?= (int)($project['progress'] ?? 0) ?>%</span>
                            </div>
                            <input type="range" class="form-range" id="projectProgress" name="progress"
                                   min="0" max="100" value="<?= (int)($project['progress'] ?? 0) ?>" step="5">
                            <div class="d-flex justify-content-between font-12 text-muted">
                                <span>0% Not Started</span>
                                <span>50% In Progress</span>
                                <span>100% Complete</span>
                            </div>
                        </div>

                        <!-- Repository -->
                        <div class="mb-3">
                            <label for="projectRepo" class="form-label fw-semibold">Repository URL</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                                <input type="url" class="form-control" id="projectRepo" name="repository_url"
                                       value="<?= esc($project['repository_url'] ?? '') ?>" placeholder="https://github.com/username/project">
                            </div>
                            <?php if (!empty($project['repository_url'])): ?>
                            <div class="form-text">
                                <a href="<?= esc($project['repository_url']) ?>" target="_blank" class="text-primary">
                                    <i class="mdi mdi-open-in-new me-1"></i> Open Repository in New Tab
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Categories/Tags -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Project Categories</label>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="web_app" id="catWeb" <?= in_array('web_app', $categories) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="catWeb">Web Application</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="api" id="catAPI" <?= in_array('api', $categories) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="catAPI">API / Backend</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mobile" id="catMobile" <?= in_array('mobile', $categories) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="catMobile">Mobile App</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="learning" id="catLearning" <?= in_array('learning', $categories) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="catLearning">Learning Project</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="portfolio" id="catPortfolio" <?= in_array('portfolio', $categories) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="catPortfolio">Portfolio Piece</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="freelance" id="catFreelance" <?= in_array('freelance', $categories) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="catFreelance">Freelance Work</label>
                                </div>
                            </div>
                            <input type="hidden" name="categories" id="projectCategories" value="<?= esc(implode(',', $categories)) ?>">
                        </div>
                    </div>

                    <!-- Milestones -->
                    <div class="mb-4 border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-uppercase text-muted font-12 fw-bold mb-0">
                                <i class="uil-check-square me-1"></i> Project Milestones
                            </h6>
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" id="addMilestone">
                                <i class="mdi mdi-plus me-1"></i> Add Milestone
                            </button>
                        </div>

                        <div id="milestonesContainer">
                            <?php if (!empty($milestones)): ?>
                                <?php foreach ($milestones as $index => $ms): ?>
                                <div class="milestone-entry card border mb-3 shadow-none">
                                    <div class="card-body p-3">
                                        <div class="row g-2">
                                            <div class="col-md-5">
                                                <label class="form-label font-12 mb-1">Milestone Name</label>
                                                <input type="text" class="form-control form-control-sm" value="<?= esc($ms['name'] ?? '') ?>"
                                                       name="milestones[<?= $index ?>][name]" placeholder="Milestone name">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label font-12 mb-1">Due Date</label>
                                                <input type="date" class="form-control form-control-sm" value="<?= esc($ms['due_date'] ?? '') ?>"
                                                       name="milestones[<?= $index ?>][due_date]">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label font-12 mb-1">Status</label>
                                                <select class="form-select form-select-sm" name="milestones[<?= $index ?>][status]">
                                                    <option value="pending" <?= ($ms['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="in_progress" <?= ($ms['status'] ?? '') === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                                    <option value="completed" <?= ($ms['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label font-12 mb-1">Description (Optional)</label>
                                                <textarea class="form-control form-control-sm" rows="2" name="milestones[<?= $index ?>][description]" placeholder="Key deliverables or notes..."><?= esc($ms['description'] ?? '') ?></textarea>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-milestone">
                                                    <i class="mdi mdi-trash-can-outline me-1"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Notes & Blockers -->
                    <div class="mb-4 border-top pt-3">
                        <h6 class="text-uppercase text-muted font-12 fw-bold mb-3">
                            <i class="uil-notes me-1"></i> Notes & Observations
                        </h6>

                        <div class="mb-3">
                            <label for="projectNotes" class="form-label fw-semibold">Project Notes</label>
                            <textarea class="form-control font-monospace" id="projectNotes" name="notes" rows="4"
                                      placeholder="Track challenges, lessons learned, or architecture notes..."><?= esc($project['notes'] ?? '') ?></textarea>
                            <div class="form-text">Document technical decisions, next priorities, or blockers.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Blockers</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control blocker-input" placeholder="Add a new blocker...">
                                <button class="btn btn-outline-danger" type="button" id="addBlocker">
                                    <i class="mdi mdi-plus"></i> Add Blocker
                                </button>
                            </div>
                            <div id="blockersList" class="d-flex flex-column gap-2">
                                <?php 
                                $blockers = !empty($project['blockers']) ? explode('|', $project['blockers']) : [];
                                foreach ($blockers as $bIdx => $bVal): if(empty(trim($bVal))) continue;
                                ?>
                                <div class="blocker-item p-2 rounded border bg-danger-lighten text-danger d-flex justify-content-between align-items-center">
                                    <span><i class="mdi mdi-alert-circle-outline me-1"></i> <?= esc(trim($bVal)) ?></span>
                                    <span class="remove cursor-pointer text-danger font-16" data-index="<?= $bIdx ?>" style="cursor: pointer;">&times;</span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" name="blockers" id="projectBlockers" value="<?= esc($project['blockers'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 border-top gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="btn btn-light">
                                Cancel
                            </a>
                            <button type="button" class="btn btn-outline-danger" id="deleteProjectBtn">
                                <i class="mdi mdi-trash-can me-1"></i> Delete Project
                            </button>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4" id="updateProjectBtn">
                                <i class="mdi mdi-check me-1"></i> Save Changes
                            </button>
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
                <h5 class="modal-title text-white"><i class="mdi mdi-alert-triangle me-1"></i> Confirm Project Deletion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="font-16">Are you sure you want to permanently delete <strong>"<?= esc($project['name']) ?>"</strong>?</p>
                <div class="alert alert-warning mb-3">
                    <i class="mdi mdi-alert-circle me-1"></i>
                    This will permanently delete all associated project records:
                    <ul class="mb-0 mt-1">
                        <li>All time tracking sessions and logs</li>
                        <li>Milestones and tasks</li>
                        <li>Project notes and observations</li>
                    </ul>
                </div>
                <p class="text-danger font-13 mb-0"><strong>Warning: This action cannot be reversed!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="mdi mdi-trash-can me-1"></i> Delete Project
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>

<script>
$(document).ready(function() {
    // Days remaining calculation
    function updateDaysRemaining() {
        const val = $('#projectDueDate').val();
        if (!val) {
            $('#daysRemaining').html('');
            return;
        }
        const dueDate = new Date(val);
        const today = new Date();
        today.setHours(0,0,0,0);
        dueDate.setHours(0,0,0,0);
        const diffTime = dueDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        let message = '';
        if (diffDays > 0) {
            message = `<span class="text-success">${diffDays} days remaining</span>`;
        } else if (diffDays === 0) {
            message = `<span class="text-warning fw-bold">Due today!</span>`;
        } else {
            message = `<span class="text-danger fw-bold">Overdue by ${Math.abs(diffDays)} days</span>`;
        }
        $('#daysRemaining').html(message);
    }

    $('#projectDueDate').on('change', updateDaysRemaining);
    updateDaysRemaining();

    // Character counter
    $('#projectDescription').on('input', function() {
        const length = $(this).val().length;
        $('#descCounter').text(length + '/500');
    });

    // Technology stack
    let techStack = <?= json_encode(array_values(array_filter(array_map('trim', $tech_stack)))) ?>;

    $('#addTech').on('click', function() {
        const tech = $('#techInput').val().trim();
        if (tech && !techStack.includes(tech)) {
            techStack.push(tech);
            updateTechDisplay();
            $('#techInput').val('');
        }
    });

    $('#techInput').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#addTech').click();
        }
    });

    function updateTechDisplay() {
        $('#selectedTech').empty();
        techStack.forEach(tech => {
            const tag = $(`
                <div class="badge bg-primary-lighten text-primary p-2 d-flex align-items-center gap-1 font-13 rounded">
                    ${tech}
                    <span class="remove ms-1 text-danger cursor-pointer" data-tech="${tech}" style="cursor: pointer;">&times;</span>
                </div>
            `);
            $('#selectedTech').append(tag);
        });
        $('#techStack').val(techStack.join(','));
    }

    $(document).on('click', '#selectedTech .remove', function() {
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
    $('.form-check-input[type="checkbox"]').on('change', function() {
        const categories = [];
        $('.form-check-input[type="checkbox"]:checked').each(function() {
            categories.push($(this).val());
        });
        $('#projectCategories').val(categories.join(','));
    });

    // Milestones
    let milestoneCount = <?= count($milestones) ?>;
    $('#addMilestone').on('click', function() {
        const template = `
            <div class="milestone-entry card border mb-3 shadow-none">
                <div class="card-body p-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <label class="form-label font-12 mb-1">Milestone Name</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Milestone name"
                                   name="milestones[${milestoneCount}][name]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-12 mb-1">Due Date</label>
                            <input type="date" class="form-control form-control-sm" placeholder="Due date"
                                   name="milestones[${milestoneCount}][due_date]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-12 mb-1">Status</label>
                            <select class="form-select form-select-sm" name="milestones[${milestoneCount}][status]">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label font-12 mb-1">Description (Optional)</label>
                            <textarea class="form-control form-control-sm" rows="2" placeholder="Key deliverables or notes..."
                                      name="milestones[${milestoneCount}][description]"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-milestone">
                                <i class="mdi mdi-trash-can-outline me-1"></i> Remove
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
    let blockers = <?= json_encode(array_values(array_filter(array_map('trim', !empty($project['blockers']) ? explode('|', $project['blockers']) : [])))) ?>;

    $('#addBlocker').on('click', function() {
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
                <div class="blocker-item p-2 rounded border bg-danger-lighten text-danger d-flex justify-content-between align-items-center">
                    <span><i class="mdi mdi-alert-circle-outline me-1"></i> ${blocker}</span>
                    <span class="remove cursor-pointer text-danger font-16" data-index="${index}" style="cursor: pointer;">&times;</span>
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

    // Delete project modal
    $('#deleteProjectBtn').on('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    });

    $('#confirmDeleteBtn').on('click', function() {
        $('#deleteProjectForm').submit();
    });

    // Form submission validation
    $('#projectEditForm').on('submit', function(e) {
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

        $('#updateProjectBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
    });

    function showToast(message, type = 'info') {
        const toastId = 'toast-' + Date.now();
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        $('.toast-container').append(toastHtml);
        const toastEl = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        $(toastEl).on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
});
</script>

<?= $this->endSection() ?>

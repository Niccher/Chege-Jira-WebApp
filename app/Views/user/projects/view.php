<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?><?= esc($project['name'] ?? 'Project Details') ?> • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$initials = strtoupper(substr($user->first_name ?? $user->username, 0, 1));
if (!empty($user->last_name)) {
    $initials .= strtoupper(substr($user->last_name, 0, 1));
}

function timeAgo($datetime) {
    if (empty($datetime)) return 'N/A';
    $diff = time() - strtotime($datetime);
    if ($diff < 60) return 'Just now';
    if ($diff < 3600) return round($diff / 60) . 'm ago';
    if ($diff < 86400) return round($diff / 3600) . 'h ago';
    if ($diff < 2592000) return round($diff / 86400) . 'd ago';
    return round($diff / 2592000) . 'mo ago';
}

$weekHours = round(($time_stats['week_seconds'] ?? 0) / 3600, 1);
$monthHours = round(($time_stats['month_seconds'] ?? 0) / 3600, 1);
$totalHours = round(($time_stats['total_seconds'] ?? 0) / 3600, 1);
$daysLogged = max($time_stats['days_logged'] ?? 1, 1);
$avgDaily = round($totalHours / $daysLogged, 1);

$statusClass = match($project['status'] ?? 'in_progress') {
    'completed' => 'bg-success-lighten text-success',
    'in_progress' => 'bg-primary-lighten text-primary',
    'planning', 'on_hold' => 'bg-warning-lighten text-warning',
    'abandoned' => 'bg-danger-lighten text-danger',
    default => 'bg-secondary-lighten text-secondary',
};

$priorityClass = match($project['priority'] ?? 'medium') {
    'critical' => 'bg-danger-lighten text-danger',
    'high' => 'bg-warning-lighten text-warning',
    'medium' => 'bg-info-lighten text-info',
    default => 'bg-secondary-lighten text-secondary',
};
?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary rounded-pill me-1">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to Projects
                </a>
                <a href="<?= site_url('projects/sprints/' . $project['id']) ?>" class="btn btn-outline-primary rounded-pill me-1">
                    <i class="mdi mdi-layer-group me-1"></i> Sprints & Backlog
                </a>
                <a href="<?= site_url('projects/wiki/' . $project['id']) ?>" class="btn btn-outline-success rounded-pill me-1">
                    <i class="mdi mdi-book-open-outline me-1"></i> Wiki & Docs
                </a>
                <a href="<?= site_url('projects/kanban/' . $project['id']) ?>" class="btn btn-outline-info rounded-pill me-1">
                    <i class="mdi mdi-view-column me-1"></i> Kanban
                </a>
                <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-primary rounded-pill">
                    <i class="mdi mdi-pencil me-1"></i> Edit Project
                </a>
            </div>
            <h4 class="page-title"><i class="uil-briefcase me-2 text-primary"></i> Project Details</h4>
        </div>
    </div>
</div>

<!-- Project Hero Card -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-md-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <div class="avatar-md rounded d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="background-color: <?= esc($project['color'] ?? '#727cf5') ?>20; color: <?= esc($project['color'] ?? '#727cf5') ?>;">
                            <i class="fas <?= esc($project['icon'] ?? 'fa-project-diagram') ?> font-24"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                <h4 class="mb-0 fw-bold text-body"><?= esc($project['name']) ?></h4>
                                <span class="badge <?= $statusClass ?> font-12">
                                    <?= ucfirst(str_replace('_', ' ', $project['status'] ?? 'in_progress')) ?>
                                </span>
                                <span class="badge <?= $priorityClass ?> font-12">
                                    <?= ucfirst($project['priority'] ?? 'medium') ?> Priority
                                </span>
                            </div>
                            <p class="text-muted font-14 mb-2"><?= esc($project['description']) ?></p>
                            <div class="d-flex gap-1 flex-wrap">
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <span class="badge bg-secondary-lighten text-secondary font-11">
                                            <i class="uil-tag-alt me-1"></i><?= ucfirst(str_replace('_', ' ', $cat)) ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-md-end flex-shrink-0 ms-md-4">
                        <div class="h3 mb-0 text-primary fw-bold"><?= (int)($project['progress'] ?? 0) ?>%</div>
                        <span class="text-muted font-12">Overall Progress</span>
                        <div class="progress mt-2" style="width: 140px; height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= (int)($project['progress'] ?? 0) ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card widget-flat h-100 mb-0 shadow-sm border-0">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm bg-primary-lighten text-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="uil-calendar-plus font-22"></i>
                    </div>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Start Date">Started</h5>
                <h4 class="mt-3 mb-1 fw-bold"><?= !empty($project['created_at']) ? date('M d, Y', strtotime($project['created_at'])) : 'N/A' ?></h4>
                <p class="mb-0 text-muted font-13">
                    <span class="text-primary me-1"><i class="mdi mdi-clock-outline"></i> Created</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card widget-flat h-100 mb-0 shadow-sm border-0">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm bg-success-lighten text-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="uil-calendar-check font-22"></i>
                    </div>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Target Deadline">Target Date</h5>
                <h4 class="mt-3 mb-1 fw-bold"><?= !empty($project['due_date']) ? date('M d, Y', strtotime($project['due_date'])) : 'No deadline' ?></h4>
                <p class="mb-0 text-muted font-13">
                    <span class="text-success me-1"><i class="mdi mdi-flag-outline"></i> Milestone target</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card widget-flat h-100 mb-0 shadow-sm border-0">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm bg-warning-lighten text-warning rounded-circle d-flex align-items-center justify-content-center">
                        <i class="uil-clock font-22"></i>
                    </div>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Time Logged">Time Logged</h5>
                <h4 class="mt-3 mb-1 fw-bold text-warning"><?= $totalHours ?> hrs</h4>
                <p class="mb-0 text-muted font-13">
                    <span class="text-warning me-1"><i class="mdi mdi-timer-sand"></i> <?= $weekHours ?>h this week</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card widget-flat h-100 mb-0 shadow-sm border-0">
            <div class="card-body">
                <div class="float-end">
                    <div class="avatar-sm bg-info-lighten text-info rounded-circle d-flex align-items-center justify-content-center">
                        <i class="uil-history font-22"></i>
                    </div>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Last Updated">Last Updated</h5>
                <h4 class="mt-3 mb-1 fw-bold text-info"><?= timeAgo($project['updated_at'] ?? '') ?></h4>
                <p class="mb-0 text-muted font-13">
                    <span class="text-info me-1"><i class="mdi mdi-sync"></i> Recent activity</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row">
    <!-- Left Column (Wider) -->
    <div class="col-xl-8 col-lg-7">
        
        <!-- Project Overview & Tech Stack Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom py-3">
                <h5 class="header-title mb-0">
                    <i class="uil-info-circle me-1 text-primary"></i> Project Overview
                </h5>
                <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-sm btn-outline-warning rounded-pill">
                    <i class="mdi mdi-pencil me-1"></i> Edit Details
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive mb-3">
                    <table class="table table-sm table-borderless mb-0 font-14">
                        <tbody>
                            <tr>
                                <td class="text-muted fw-semibold" style="width: 140px;">Status:</td>
                                <td><span class="badge <?= $statusClass ?>"><?= ucfirst(str_replace('_', ' ', $project['status'] ?? 'in_progress')) ?></span></td>
                                <td class="text-muted fw-semibold" style="width: 140px;">Priority:</td>
                                <td><span class="badge <?= $priorityClass ?>"><?= ucfirst($project['priority'] ?? 'medium') ?></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Repository:</td>
                                <td colspan="3">
                                    <?php if (!empty($project['repository_url'])): ?>
                                        <a href="<?= esc($project['repository_url']) ?>" target="_blank" class="text-primary fw-semibold text-decoration-none">
                                            <i class="mdi mdi-github me-1"></i> <?= esc($project['repository_url']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted font-13">No repository URL linked</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Tech Stack:</td>
                                <td colspan="3">
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php if (!empty($tech_stack)): ?>
                                            <?php foreach ($tech_stack as $tech): ?>
                                                <span class="badge bg-dark-lighten text-dark font-12"><?= esc($tech) ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted font-13">None specified</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Accordion for Breakdown, Milestones, Notes -->
                <div class="accordion custom-accordion" id="projectDetailsAccordion">
                    
                    <!-- Milestones Section -->
                    <div class="accordion-item border rounded mb-2">
                        <h2 class="accordion-header" id="headingMilestones">
                            <button class="accordion-button fw-bold text-body" type="button" data-bs-toggle="collapse" data-bs-target="#milestonesCollapse" aria-expanded="true" aria-controls="milestonesCollapse">
                                <i class="uil-check-square me-2 text-primary"></i> Milestones (<?= count(array_filter($milestones ?? [], fn($ms) => ($ms['status'] ?? '') === 'completed')) ?> / <?= count($milestones ?? []) ?>)
                            </button>
                        </h2>
                        <div id="milestonesCollapse" class="accordion-collapse collapse show" aria-labelledby="headingMilestones" data-bs-parent="#projectDetailsAccordion">
                            <div class="accordion-body">
                                <?php if (!empty($milestones)): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0 font-13">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 40px;">Status</th>
                                                <th>Milestone</th>
                                                <th class="text-end">Due</th>
                                                <th class="text-end" style="width: 100px;">Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($milestones as $ms): ?>
                                            <?php
                                                $msStatus = $ms['status'] ?? 'pending';
                                                $msProgress = (int)($ms['progress'] ?? 0);
                                                $msBadge = match($msStatus) {
                                                    'completed' => 'bg-success-lighten text-success',
                                                    'in_progress' => 'bg-primary-lighten text-primary',
                                                    default => 'bg-secondary-lighten text-secondary',
                                                };
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="badge <?= $msBadge ?>">
                                                        <i class="mdi mdi-<?= $msStatus === 'completed' ? 'check' : ($msStatus === 'in_progress' ? 'progress-clock' : 'clock-outline') ?>"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-body d-block"><?= esc($ms['name']) ?></span>
                                                    <?php if (!empty($ms['description'])): ?>
                                                        <small class="text-muted"><?= esc($ms['description']) ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end text-muted">
                                                    <?= !empty($ms['due_date']) ? date('M d, Y', strtotime($ms['due_date'])) : 'N/A' ?>
                                                </td>
                                                <td class="text-end">
                                                    <span class="fw-semibold text-body"><?= $msProgress ?>%</span>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                    <div class="text-center text-muted py-3">No milestones defined yet.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="accordion-item border rounded mb-2">
                        <h2 class="accordion-header" id="headingNotes">
                            <button class="accordion-button collapsed fw-bold text-body" type="button" data-bs-toggle="collapse" data-bs-target="#notesCollapse" aria-expanded="false" aria-controls="notesCollapse">
                                <i class="uil-notes me-2 text-warning"></i> Notes & Scratchpad
                            </button>
                        </h2>
                        <div id="notesCollapse" class="accordion-collapse collapse" aria-labelledby="headingNotes" data-bs-parent="#projectDetailsAccordion">
                            <div class="accordion-body">
                                <button class="btn btn-sm btn-outline-primary rounded-pill mb-3 w-100" id="addNoteBtn">
                                    <i class="mdi mdi-plus me-1"></i> Add Project Note
                                </button>
                                <div class="notes-list-compact">
                                    <?php if (!empty($project_notes)): ?>
                                        <?php foreach ($project_notes as $note): ?>
                                        <div class="p-3 mb-2 rounded border bg-light-subtle">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold text-body font-13"><?= esc($note['title'] ?? 'Note') ?></span>
                                                <small class="text-muted font-11"><?= !empty($note['created_at']) ? timeAgo($note['created_at']) : '' ?></small>
                                            </div>
                                            <p class="small text-muted mb-1"><?= esc($note['content'] ?? $note['description'] ?? '') ?></p>
                                            <?php if (!empty($note['is_blocker'])): ?>
                                                <span class="badge bg-danger-lighten text-danger font-11">Blocker</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center text-muted py-3">No notes attached to this project.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Long Description Section -->
                    <div class="accordion-item border rounded">
                        <h2 class="accordion-header" id="headingDesc">
                            <button class="accordion-button collapsed fw-bold text-body" type="button" data-bs-toggle="collapse" data-bs-target="#descriptionCollapse" aria-expanded="false" aria-controls="descriptionCollapse">
                                <i class="uil-align-left me-2 text-info"></i> Full Description
                            </button>
                        </h2>
                        <div id="descriptionCollapse" class="accordion-collapse collapse" aria-labelledby="headingDesc" data-bs-parent="#projectDetailsAccordion">
                            <div class="accordion-body">
                                <p class="text-body font-14 mb-0" style="white-space: pre-line;">
                                    <?= esc($project['description'] ?? 'No detailed description provided.') ?>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Right Column (Compact) -->
    <div class="col-xl-4 col-lg-5">
        
        <!-- Quick Actions Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-bottom py-3">
                <h5 class="header-title mb-0">
                    <i class="uil-bolt me-1 text-primary"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="<?= site_url('time?project_id=' . $project['id']) ?>" class="btn btn-outline-primary btn-sm w-100 py-2">
                            <i class="mdi mdi-clock-start me-1"></i> Track Time
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= site_url('projects/kanban/' . $project['id']) ?>" class="btn btn-outline-info btn-sm w-100 py-2">
                            <i class="mdi mdi-view-column me-1"></i> Kanban
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= site_url('analytics') ?>" class="btn btn-outline-success btn-sm w-100 py-2">
                            <i class="mdi mdi-chart-line me-1"></i> Analytics
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= site_url('projects/archive/' . $project['id']) ?>" class="btn btn-outline-danger btn-sm w-100 py-2" onclick="return confirm('Archive this project?');">
                            <i class="mdi mdi-archive-arrow-down me-1"></i> Archive
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Summary Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-bottom py-3">
                <h5 class="header-title mb-0">
                    <i class="uil-stopwatch me-1 text-primary"></i> Time Summary
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-muted font-13">This Week</span>
                    <span class="fw-bold text-success font-14"><?= $weekHours ?> hrs</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-muted font-13">This Month</span>
                    <span class="fw-bold text-primary font-14"><?= $monthHours ?> hrs</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-muted font-13">All-Time Total</span>
                    <span class="fw-bold text-warning font-14"><?= $totalHours ?> hrs</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                    <span class="text-muted font-13">Daily Average</span>
                    <span class="fw-bold text-info font-14"><?= $avgDaily ?> hrs</span>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom py-3">
                <h5 class="modal-title font-16" id="addNoteModalLabel">
                    <i class="uil-notes me-1 text-primary"></i> Add Project Note
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="addNoteForm" action="<?= site_url('notes/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Title (optional)</label>
                        <input type="text" name="title" class="form-control form-control-sm" placeholder="Note headline...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control form-control-sm font-monospace" rows="4" placeholder="Write your observation or task details..." required></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_blocker" id="markBlocker">
                        <label class="form-check-label small text-danger fw-semibold" for="markBlocker">
                            Mark as critical blocker
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top py-2">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="saveNoteBtn">Save Note</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        const noteModal = new bootstrap.Modal(document.getElementById('addNoteModal'));

        // Add note modal
        $('#addNoteBtn').click(function() {
            noteModal.show();
        });

        // Save note via AJAX
        $('#saveNoteBtn').click(function() {
            const form = $('#addNoteForm');
            const formData = form.serialize();
            const noteContent = form.find('textarea[name="content"]').val().trim();

            if (!noteContent) {
                showToast('Please enter note content', 'warning');
                return;
            }

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    const isBlocker = $('#markBlocker').prop('checked');
                    const title = form.find('input[name="title"]').val().trim() || 'Note';

                    const noteHtml = `
                        <div class="p-3 mb-2 rounded border bg-light-subtle">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-body font-13">${title}</span>
                                <small class="text-muted font-11">Just now</small>
                            </div>
                            <p class="small text-muted mb-1">${noteContent}</p>
                            ${isBlocker ? '<span class="badge bg-danger-lighten text-danger font-11">Blocker</span>' : ''}
                        </div>
                    `;

                    $('.notes-list-compact').prepend(noteHtml);
                    noteModal.hide();
                    form[0].reset();
                    showToast('Note added successfully', 'success');
                },
                error: function() {
                    showToast('Failed to save note', 'danger');
                }
            });
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

<?= $this->endSection() ?>

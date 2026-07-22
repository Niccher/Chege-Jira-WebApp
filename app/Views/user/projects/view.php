<?= $this->include('layouts/user/header', ['title' => 'Chege JIRA Dashboard • Project Details']) ?>
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
?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Project Details</h1>
            </div>

            <div class="d-flex align-items-center">
                <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-warning btn-sm me-2">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        <?= $initials ?>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= site_url('profile') ?>"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('settings') ?>"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Project Header (Compact) -->
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="compact-avatar me-3" style="background-color: <?= esc($project['color'] ?? '#6366f1') ?>;">
                                <i class="fas <?= esc($project['icon'] ?? 'fa-project-diagram') ?>"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center mb-1">
                                    <h5 class="mb-0 me-2"><?= esc($project['name']) ?></h5>
                                    <span class="project-health health-good small"></span>
                                </div>
                                <p class="text-muted small mb-0"><?= esc($project['description']) ?></p>
                                <div class="d-flex align-items-center gap-1 mt-1">
                                    <span class="badge bg-<?= $project['status'] === 'in_progress' ? 'success' : 'secondary' ?>"><?= ucfirst(str_replace('_', ' ', $project['status'])) ?></span>
                                    <span class="badge bg-primary"><?= ucfirst($project['priority']) ?> Priority</span>
                                    <?php foreach ($categories as $cat): ?>
                                        <span class="badge bg-info"><?= ucfirst($cat) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="h4 mb-0 text-success"><?= $project['progress'] ?>%</div>
                            <div class="small text-muted">Progress</div>
                            <div class="progress mt-1" style="width: 100px; height: 4px;">
                                <div class="progress-bar bg-success" style="width: <?= $project['progress'] ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats (Compact Grid) -->
        <div class="row mb-3">
            <div class="col-md-3 col-6 mb-2">
                <div class="stat-card compact h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-sm me-2" style="background-color: rgba(99, 102, 241, 0.2); color: #6366f1;">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div>
                            <div class="stat-value-sm"><?= date('M d', strtotime($project['created_at'])) ?></div>
                            <div class="stat-label-sm">Started</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-2">
                <div class="stat-card compact h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-sm me-2" style="background-color: rgba(16, 185, 129, 0.2); color: #10b981;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="stat-value-sm"><?= !empty($project['due_date']) ? date('M d', strtotime($project['due_date'])) : 'No deadline' ?></div>
                            <div class="stat-label-sm">Target</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-2">
                <div class="stat-card compact h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-sm me-2" style="background-color: rgba(245, 158, 11, 0.2); color: #f59e0b;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="stat-value-sm"><?= $totalHours ?>h</div>
                            <div class="stat-label-sm">Time Logged</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-2">
                <div class="stat-card compact h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-sm me-2" style="background-color: rgba(239, 68, 68, 0.2); color: #ef4444;">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <div class="stat-value-sm"><?= timeAgo($project['updated_at']) ?></div>
                            <div class="stat-label-sm">Updated</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="row">
            <!-- Left Column (Wider) -->
            <div class="col-lg-8">
                <!-- Project Details (Expandable Sections) -->
                <div class="stat-card compact mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Project Details</h6>
                        <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    </div>

                    <!-- Basic Info Table -->
                    <div class="table-responsive mb-3">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                            <tr>
                                <td class="text-muted" style="width: 120px;">Status</td>
                                <td><span class="badge bg-success"><?= ucfirst(str_replace('_', ' ', $project['status'])) ?></span></td>
                                <td class="text-muted">Priority</td>
                                <td><span class="badge bg-primary"><?= ucfirst($project['priority']) ?></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Repository</td>
                                <td colspan="3">
                                    <?php if (!empty($project['repository_url'])): ?>
                                        <a href="<?= esc($project['repository_url']) ?>" target="_blank" class="small">
                                            <i class="fab fa-github me-1"></i> <?= esc(parse_url($project['repository_url'], PHP_URL_HOST) . parse_url($project['repository_url'], PHP_URL_PATH)) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">No repository linked</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Technology</td>
                                <td colspan="3">
                                    <div class="tech-tags d-flex flex-wrap gap-1">
                                        <?php if (!empty($tech_stack)): ?>
                                            <?php foreach ($tech_stack as $tech): ?>
                                                <span class="badge bg-dark"><?= esc($tech) ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted small">None specified</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Categories</td>
                                <td colspan="3">
                                    <?php foreach ($categories as $cat): ?>
                                        <span class="badge bg-primary me-1"><?= ucfirst(str_replace('_', ' ', $cat)) ?></span>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Accordion for Additional Sections -->
                    <div class="accordion accordion-flush" id="projectDetailsAccordion">
                        <!-- Progress Breakdown -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#progressCollapse">
                                    <i class="fas fa-tasks me-2"></i> Progress Breakdown
                                </button>
                            </h2>
                            <div id="progressCollapse" class="accordion-collapse collapse show" data-bs-parent="#projectDetailsAccordion">
                                <div class="accordion-body">
                                    <?php if (!empty($milestones)): ?>
                                    <div class="row g-2">
                                        <?php foreach ($milestones as $ms): ?>
                                        <div class="col-6">
                                            <div class="progress-item-compact">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span><?= esc($ms['name']) ?></span>
                                                    <span class="text-<?= $ms['progress'] >= 80 ? 'success' : ($ms['progress'] >= 40 ? 'warning' : 'danger') ?>"><?= $ms['progress'] ?>%</span>
                                                </div>
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-<?= $ms['progress'] >= 80 ? 'success' : ($ms['progress'] >= 40 ? 'warning' : 'danger') ?>" style="width: <?= $ms['progress'] ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php else: ?>
                                        <div class="text-center text-muted small py-3">No milestones defined</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Milestones -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#milestonesCollapse">
                                    <i class="fas fa-flag-checkered me-2"></i> Milestones 
                                    <span class="badge bg-success ms-2 small">
                                        <?= count(array_filter($milestones, fn($ms) => $ms['status'] === 'completed')) ?>/<?= count($milestones) ?>
                                    </span>
                                </button>
                            </h2>
                            <div id="milestonesCollapse" class="accordion-collapse collapse show" data-bs-parent="#projectDetailsAccordion">
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0">
                                            <thead>
                                            <tr>
                                                <th class="small text-muted" style="width: 30px;">Status</th>
                                                <th class="small text-muted">Milestone</th>
                                                <th class="small text-muted text-end" style="width: 80px;">Due</th>
                                                <th class="small text-muted text-end" style="width: 60px;">%</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($milestones)): ?>
                                                <?php foreach ($milestones as $ms): ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-<?= $ms['status'] === 'completed' ? 'success' : ($ms['status'] === 'in_progress' ? 'warning' : 'secondary') ?>">
                                                            <i class="fas <?= $ms['status'] === 'completed' ? 'fa-check' : ($ms['status'] === 'in_progress' ? 'fa-spinner fa-spin' : 'fa-clock') ?>"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="small"><strong><?= esc($ms['name']) ?></strong></div>
                                                        <div class="small text-muted"><?= esc($ms['description']) ?></div>
                                                    </td>
                                                    <td class="text-end small <?= $ms['status'] === 'completed' ? 'text-success' : 'text-warning' ?>">
                                                        <?= $ms['due_date'] ? date('M d', strtotime($ms['due_date'])) : 'N/A' ?>
                                                    </td>
                                                    <td class="text-end small"><?= $ms['progress'] ?>%</td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted small py-3">No milestones defined</td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#notesCollapse">
                                    <i class="fas fa-sticky-note me-2"></i> Notes & Observations
                                </button>
                            </h2>
                            <div id="notesCollapse" class="accordion-collapse collapse show" data-bs-parent="#projectDetailsAccordion">
                                <div class="accordion-body">
                                    <button class="btn btn-sm btn-outline-primary mb-2 w-100" id="addNoteBtn">
                                        <i class="fas fa-plus me-1"></i> Add Note
                                    </button>
                                    <div class="notes-list-compact">
                                        <?php if (!empty($project_notes)): ?>
                                            <?php foreach ($project_notes as $note): ?>
                                            <div class="note-item-compact <?= !empty($note['is_blocker']) ? 'blocker' : '' ?>">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="small"><strong><?= esc($note['title'] ?? 'Note') ?></strong></div>
                                                    <div class="text-muted small"><?= !empty($note['created_at']) ? timeAgo($note['created_at']) : '' ?></div>
                                                </div>
                                                <p class="small text-muted mb-1"><?= esc($note['content'] ?? $note['description'] ?? '') ?></p>
                                                <?php if (!empty($note['is_blocker'])): ?><span class="badge bg-danger small">Blocker</span><?php endif; ?>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-center text-muted small py-3">No notes yet</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#descriptionCollapse">
                                    <i class="fas fa-align-left me-2"></i> Description
                                </button>
                            </h2>
                            <div id="descriptionCollapse" class="accordion-collapse collapse show" data-bs-parent="#projectDetailsAccordion">
                                <div class="accordion-body">
                                    <p class="small text-muted mb-0">
                                        <?= nl2br(esc($project['description'])) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (Compact) -->
            <div class="col-lg-4">
                <!-- Quick Actions & Info -->
                <div class="stat-card compact">
                    <h6 class="mb-2"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <a href="<?= site_url('time?project_id=' . $project['id']) ?>" class="btn btn-sm btn-primary w-100">
                                <i class="fas fa-clock me-1"></i> Time
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?= site_url('projects/kanban/' . $project['id']) ?>" class="btn btn-sm btn-info w-100">
                                <i class="fas fa-columns me-1"></i> Tasks
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?= site_url('projects/analytics/' . $project['id']) ?>" class="btn btn-sm btn-outline-success w-100">
                                <i class="fas fa-chart-line me-1"></i> Analytics
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?= site_url('projects/archive/' . $project['id']) ?>" class="btn btn-sm btn-outline-danger w-100">
                                <i class="fas fa-archive me-1"></i> Archive
                            </a>
                        </div>
                    </div>

                    <!-- Accordion for Additional Info -->
                    <div class="accordion accordion-flush" id="quickInfoAccordion">
                        <!-- Time Summary -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#timeCollapse">
                                    <i class="fas fa-chart-pie me-2"></i> Time Summary
                                </button>
                            </h2>
                            <div id="timeCollapse" class="accordion-collapse collapse show" data-bs-parent="#quickInfoAccordion">
                                <div class="accordion-body">
                                    <div class="time-summary-compact">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small">This Week</span>
                                            <span class="small text-success"><?= $weekHours ?>h</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small">This Month</span>
                                            <span class="small text-primary"><?= $monthHours ?>h</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small">Total</span>
                                            <span class="small text-warning"><?= $totalHours ?>h</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="small">Avg Daily</span>
                                            <span class="small text-info"><?= $avgDaily ?>h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#activityCollapse">
                                    <i class="fas fa-history me-2"></i> Recent Activity
                                </button>
                            </h2>
                            <div id="activityCollapse" class="accordion-collapse collapse show" data-bs-parent="#quickInfoAccordion">
                                <div class="accordion-body">
                                    <div class="activity-timeline-compact">
                                        <div class="activity-item-compact">
                                            <div class="activity-dot bg-success"></div>
                                            <div class="activity-content">
                                                <div class="small">Project updated</div>
                                                <div class="small text-muted"><?= timeAgo($project['updated_at']) ?></div>
                                            </div>
                                        </div>
                                        <div class="activity-item-compact">
                                            <div class="activity-dot bg-primary"></div>
                                            <div class="activity-content">
                                                <div class="small">Project created</div>
                                                <div class="small text-muted"><?= timeAgo($project['created_at']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Close Main Row -->

    <!-- Add Note Modal (Compact) -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title mb-0"><i class="fas fa-sticky-note me-2"></i>Add Note</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addNoteForm" action="<?= site_url('notes/store') ?>" method="POST">
                        <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                        <div class="mb-2">
                            <input type="text" name="title" class="form-control form-control-sm" placeholder="Title (optional)">
                        </div>
                        <div class="mb-2">
                            <textarea name="content" class="form-control form-control-sm" rows="3" placeholder="Note content..."></textarea>
                        </div>
                        <div class="mb-2">
                            <div class="form-check form-check-sm">
                                <input class="form-check-input" type="checkbox" name="is_blocker" id="markBlocker">
                                <label class="form-check-label" for="markBlocker">
                                    Mark as blocker
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-primary" id="saveNoteBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <style>
        /* Compact Card Styles */
        .stat-card.compact {
            padding: 0.75rem 1rem;
        }

        .stat-card.compact h6 {
            font-size: 0.9rem;
            font-weight: 600;
            color: #e2e8f0;
        }

        /* Compact Avatar */
        .compact-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        /* Small Stat Icons */
        .stat-icon-sm {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .stat-value-sm {
            font-size: 0.9rem;
            font-weight: 600;
            color: #e2e8f0;
        }

        .stat-label-sm {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Tech Tags */
        .tech-tags .badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            background-color: #1e293b;
            border: 1px solid #334155;
        }

        /* Progress Items */
        .progress-item-compact {
            margin-bottom: 0.5rem;
        }

        /* Notes List Compact */
        .notes-list-compact {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .note-item-compact {
            padding: 0.5rem;
            background-color: rgba(30, 41, 59, 0.5);
            border-radius: 4px;
            border-left: 3px solid #334155;
        }

        .note-item-compact.blocker {
            border-left-color: #ef4444;
            background-color: rgba(239, 68, 68, 0.05);
        }

        .note-item-compact.blocker .badge {
            font-size: 0.65rem;
            padding: 0.1rem 0.4rem;
        }

        /* Activity Timeline Compact */
        .activity-timeline-compact {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .activity-item-compact {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-top: 0.35rem;
            flex-shrink: 0;
        }

        .activity-content .small {
            line-height: 1.3;
        }

        /* Time Summary */
        .time-summary-compact .small {
            font-size: 0.8rem;
        }

        /* Table Improvements */
        .table-borderless td, .table-borderless th {
            padding: 0.35rem 0.25rem;
        }

        .table-borderless tbody tr:not(:last-child) {
            border-bottom: 1px solid #334155;
        }

        /* Small Badges */
        .badge.small {
            font-size: 0.7rem;
            padding: 0.1rem 0.4rem;
        }

        /* Small Progress Bars */
        .progress {
            background-color: #334155;
        }

        /* Purple Badge */
        .bg-purple {
            background-color: #8b5cf6 !important;
        }

        /* Project Health Dot */
        .project-health.small {
            width: 8px;
            height: 8px;
        }

        .project-health.small.health-good {
            background-color: #10b981;
        }

        /* Button Spacing */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        /* Modal Compact */
        .modal-sm .modal-content {
            background-color: #1e293b;
            border: 1px solid #475569;
        }

        .modal-sm .modal-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #334155;
        }

        .modal-sm .modal-body {
            padding: 1rem;
        }

        .modal-sm .modal-footer {
            padding: 0.75rem 1rem;
            border-top: 1px solid #334155;
        }

        .form-check-sm .form-check-input {
            width: 0.85rem;
            height: 0.85rem;
            margin-top: 0.15rem;
        }

        .form-check-sm .form-check-label {
            font-size: 0.85rem;
        }

        /* Accordion Styles */
        .accordion-flush .accordion-item {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #334155;
        }

        .accordion-flush .accordion-item:last-child {
            border-bottom: none;
        }

        .accordion-button {
            background-color: transparent;
            color: #94a3b8;
            font-size: 0.85rem;
            padding: 0.5rem 0;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background-color: transparent;
            color: #e2e8f0;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .accordion-button::after {
            background-size: 0.75rem;
            width: 0.75rem;
            height: 0.75rem;
        }

        .accordion-body {
            padding: 0.75rem 0;
            font-size: 0.85rem;
        }
    </style>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            // Add note modal
            $('#addNoteBtn').click(function() {
                $('#addNoteModal').modal('show');
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
                            <div class="note-item-compact ${isBlocker ? 'blocker' : ''}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="small"><strong>${title}</strong></div>
                                    <div class="text-muted small">Just now</div>
                                </div>
                                <p class="small text-muted mb-1">${noteContent}</p>
                                ${isBlocker ? '<span class="badge bg-danger small">Blocker</span>' : ''}
                            </div>
                        `;

                        $('.notes-list-compact').prepend(noteHtml);
                        $('#addNoteModal').modal('hide');
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

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

<?= $this->include('layouts/user/footer') ?>
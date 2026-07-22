<?= $this->include('layouts/user/header', ['title' => 'Analytics • Chege JIRA']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Analytics</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-calendar me-1"></i> Last 30 Days
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-day me-2"></i> Today</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-week me-2"></i> This Week</a></li>
                        <li><a class="dropdown-item active" href="#"><i class="fas fa-calendar-alt me-2"></i> Last 30 Days</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar me-2"></i> This Quarter</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar me-2"></i> This Year</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary btn-sm me-2" id="exportAnalyticsBtn">
                    <i class="fas fa-download me-1"></i> Export
                </button>

                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        <?= esc(strtoupper(substr($user->name ?? $user->username ?? 'U', 0, 2))) ?>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item" style="cursor:pointer;"><i class="fas fa-user me-2"></i> Profile</span></li>
                        <li><span class="dropdown-item" style="cursor:pointer;"><i class="fas fa-cog me-2"></i> Settings</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="dropdown-item" style="cursor:pointer;"><i class="fas fa-sign-out-alt me-2"></i> Logout</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="row mb-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Total Projects</div>
                    <div class="stat-value"><?= esc($totalProjects) ?></div>
                    <div class="stat-change text-secondary mt-3 font-mono border-top pt-2">
                        <i class="fas fa-arrow-up"></i> <?= esc($thisMonthStarted) ?> this month
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Completion Rate</div>
                    <div class="stat-value text-success"><?= esc(round($completionRate)) ?>%</div>
                    <div class="stat-change text-success mt-3 font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-arrow-up"></i> Overall rate
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Hours Logged</div>
                    <div class="stat-value text-warning"><?= esc(number_format($totalHours, 1)) ?></div>
                    <div class="stat-change text-warning mt-3 font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-clock"></i> Total hours
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Avg Daily Hours</div>
                    <div class="stat-value text-success"><?= esc(number_format($avgDaily, 1)) ?></div>
                    <div class="stat-change text-success mt-3 font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-arrow-up"></i> Daily average
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="row mb-4">
            <!-- Project Completion Chart -->
            <div class="col-lg-8">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Project Completion Trends</h5>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-secondary active">Monthly</button>
                            <button class="btn btn-outline-secondary">Quarterly</button>
                            <button class="btn btn-outline-secondary">Yearly</button>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-legend">
                                <span class="legend-item"><span class="legend-color" style="background-color: #6366f1;"></span> Started</span>
                                <span class="legend-item"><span class="legend-color" style="background-color: #10b981;"></span> Completed</span>
                            </div>
                        </div>

                        <div class="bar-chart">
                            <?php
                            $maxVal = 1;
                            foreach ($monthlyTrends as $row) {
                                $maxVal = max($maxVal, $row['started'], $row['completed']);
                            }
                            ?>
                            <?php foreach ($monthlyTrends as $row): ?>
                            <div class="chart-row">
                                <div class="chart-label"><?= esc($row['month']) ?></div>
                                <div class="chart-bars">
                                    <div class="bar started" style="width: <?= ($row['started'] / $maxVal) * 100 ?>%; background-color: #6366f1;"></div>
                                    <div class="bar completed" style="width: <?= ($row['completed'] / $maxVal) * 100 ?>%; background-color: #10b981;"></div>
                                </div>
                                <div class="chart-value"><?= esc($row['completed']) ?>/<?= esc($row['started']) ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Health Distribution -->
            <div class="col-lg-4">
                <div class="stat-card h-100">
                    <h5 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Project Health Distribution</h5>
                    <div class="pie-chart-container">
                        <?php
                        $segments = [
                            ['pct' => $goodPct, 'color' => '#10b981'],
                            ['pct' => $warningPct, 'color' => '#f59e0b'],
                            ['pct' => $dangerPct, 'color' => '#ef4444'],
                            ['pct' => $archivedPct, 'color' => '#94a3b8'],
                        ];
                        $start = 0;
                        $parts = [];
                        foreach ($segments as $seg) {
                            if ($seg['pct'] > 0) {
                                $end = $start + $seg['pct'];
                                $parts[] = $seg['color'] . ' ' . $start . '% ' . $end . '%';
                                $start = $end;
                            }
                        }
                        $pieGradient = implode(', ', $parts);
                        $totalHealthCount = $good + $warningCount + $dangerCount + $archivedCount;
                        ?>
                        <div class="pie-chart" style="background: conic-gradient(<?= $pieGradient ?>);">
                            <div class="pie-center">
                                <div class="pie-value"><?= esc($totalHealthCount) ?></div>
                                <div class="pie-label">Projects</div>
                            </div>
                        </div>

                        <div class="pie-legend">
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #10b981;"></span>
                                <span class="legend-text">Good (<?= esc(round($goodPct)) ?>%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #f59e0b;"></span>
                                <span class="legend-text">Warning (<?= esc(round($warningPct)) ?>%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #ef4444;"></span>
                                <span class="legend-text">Danger (<?= esc(round($dangerPct)) ?>%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #94a3b8;"></span>
                                <span class="legend-text">Archived (<?= esc(round($archivedPct)) ?>%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="row mb-4">
            <!-- Time Distribution -->
            <div class="col-lg-6">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Time Distribution by Project</h5>
                        <button class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>

                    <div class="time-distribution">
                        <?php $isFirst = true; ?>
                        <?php foreach ($timeDistribution as $item): ?>
                        <?php $pct = $allTimeTotal > 0 ? round(($item['total_duration'] / $allTimeTotal) * 100) : 0; ?>
                        <div class="distribution-item<?= $isFirst ? '' : ' mt-3' ?>">
                            <?php $isFirst = false; ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="project-icon me-2" style="background-color: <?= esc($item['color']) ?>;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <span><?= esc($item['name']) ?></span>
                                </div>
                                <span class="text-muted"><?= esc(number_format($item['total_duration'], 1)) ?> hrs (<?= $pct ?>%)</span>
                            </div>
                            <div class="progress mt-1" style="height: 10px;">
                                <div class="progress-bar" style="width: <?= $pct ?>%; background-color: <?= esc($item['color']) ?>;"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Productivity Heatmap -->
            <div class="col-lg-6">
                <div class="stat-card h-100">
                    <h5 class="mb-3"><i class="fas fa-calendar-alt me-2"></i>Monthly Activity Heatmap</h5>
                    <div class="heatmap-container">
                        <div class="heatmap-header">
                            <div class="heatmap-months">
                                <span>Last 30 Days</span>
                            </div>
                        </div>

                        <div class="heatmap-grid" style="grid-template-columns: repeat(30, 1fr);">
                            <?php foreach ($heatmapData as $cell): ?>
                            <?php
                            $colors = ['#334155', '#1e3a8a', '#1d4ed8', '#3b82f6', '#60a5fa'];
                            $color = $colors[$cell['count']] ?? '#334155';
                            ?>
                            <div class="heatmap-square" style="background-color: <?= $color ?>;"
                                 title="<?= esc($cell['date']) ?>: <?= esc($cell['count']) ?> activities"></div>
                            <?php endforeach; ?>
                        </div>

                        <div class="heatmap-footer mt-3">
                            <div class="d-flex justify-content-between small text-muted">
                                <span>Less</span>
                                <div>
                                    <span class="heatmap-legend" style="background-color: #334155;"></span>
                                    <span class="heatmap-legend" style="background-color: #1e3a8a;"></span>
                                    <span class="heatmap-legend" style="background-color: #1d4ed8;"></span>
                                    <span class="heatmap-legend" style="background-color: #3b82f6;"></span>
                                    <span class="heatmap-legend" style="background-color: #60a5fa;"></span>
                                </div>
                                <span>More</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Insights & Recommendations -->
        <div class="row">
            <div class="col-lg-12">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Insights & Recommendations</h5>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync me-1"></i> Refresh
                        </button>
                    </div>

                    <?php if (!empty($insights)): ?>
                    <div class="row g-3">
                        <?php foreach ($insights as $insight): ?>
                        <div class="col-md-4">
                            <div class="stat-card h-100 p-3 border-dark border-start border-4 border-<?= esc($insight['color']) ?>">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="<?= esc($insight['icon']) ?> text-<?= esc($insight['color']) ?> fs-5 me-2"></i>
                                    <h6 class="mb-0 text-white font-mono"><?= esc($insight['title']) ?></h6>
                                </div>
                                <p class="small text-secondary mb-0"><?= esc($insight['message']) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="stat-card p-3 border-dark">
                                <h6 class="font-mono text-white border-bottom pb-2 mb-3"><i class="fas fa-check-square text-success me-2"></i>Completed This Month</h6>
                                <ul class="small text-secondary mb-0 list-unstyled font-mono">
                                    <?php if (!empty($completedThisMonth)): ?>
                                    <?php foreach ($completedThisMonth as $item): ?>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <li class="mb-2 text-muted">No projects completed this month</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card p-3 border-dark">
                                <h6 class="font-mono text-white border-bottom pb-2 mb-3"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Need Attention</h6>
                                <ul class="small text-secondary mb-0 list-unstyled font-mono">
                                    <?php if (!empty($stalledTasks)): ?>
                                    <?php foreach ($stalledTasks as $item): ?>
                                    <li class="mb-2"><i class="fas fa-circle text-danger ms-1 me-2" style="font-size: 8px;"></i><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <li class="mb-2 text-muted">No stalled projects</li>
                                    <?php endif; ?>
                                </ul>
                                <?php if (!empty($recentDone)): ?>
                                <h6 class="font-mono text-white border-bottom pb-2 mb-3 mt-3"><i class="fas fa-history text-info me-2"></i>Recently Completed</h6>
                                <ul class="small text-secondary mb-0 list-unstyled font-mono">
                                    <?php foreach ($recentDone as $item): ?>
                                    <li class="mb-2"><i class="fas fa-check-circle text-info me-2"></i><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Analytics Styles */
        .stat-change {
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        /* Chart Styles */
        .chart-container {
            padding: 1rem 0;
        }

        .chart-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .chart-legend {
            display: flex;
            gap: 1rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            margin-right: 0.5rem;
        }

        .bar-chart {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .chart-row {
            display: grid;
            grid-template-columns: 60px 1fr 60px;
            align-items: center;
            gap: 1rem;
        }

        .chart-label {
            font-weight: 600;
            color: #e2e8f0;
        }

        .chart-bars {
            display: flex;
            height: 24px;
            background-color: #334155;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .chart-bars .bar {
            height: 100%;
            transition: width 0.3s ease;
        }

        .chart-bars .bar:hover {
            filter: brightness(1.2);
        }

        .chart-value {
            text-align: right;
            font-size: 0.9rem;
            color: #94a3b8;
        }

        /* Pie Chart */
        .pie-chart-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .pie-chart {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            position: relative;
            margin-right: 2rem;
        }

        .pie-center {
            position: absolute;
            width: 100px;
            height: 100px;
            background-color: #0f172a;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .pie-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #e2e8f0;
        }

        .pie-label {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .pie-legend {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .pie-legend .legend-item {
            display: flex;
            align-items: center;
        }

        /* Project Icons */
        .project-icon {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }

        /* Heatmap */
        .heatmap-container {
            padding: 1rem 0;
        }

        .heatmap-header {
            margin-bottom: 1rem;
        }

        .heatmap-months {
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .heatmap-grid {
            display: grid;
            grid-template-columns: repeat(30, 1fr);
            gap: 3px;
            justify-content: center;
        }

        .heatmap-square {
            width: 14px;
            height: 14px;
            border-radius: 2px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .heatmap-square:hover {
            transform: scale(1.2);
        }

        .heatmap-legend {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            display: inline-block;
            margin: 0 2px;
        }

        /* Insights */
        .insight-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 1rem;
            height: 100%;
            display: flex;
            align-items: flex-start;
        }

        .insight-card.insight-positive {
            border-left: 4px solid #10b981;
        }

        .insight-card.insight-warning {
            border-left: 4px solid #f59e0b;
        }

        .insight-card.insight-info {
            border-left: 4px solid #6366f1;
        }

        .insight-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: rgba(16, 185, 129, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .insight-warning .insight-icon {
            background-color: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .insight-info .insight-icon {
            background-color: rgba(99, 102, 241, 0.2);
            color: #6366f1;
        }

        .insight-content h6 {
            margin-bottom: 0.5rem;
            color: #e2e8f0;
        }

        .insight-content p, .insight-content ul {
            margin-bottom: 0;
        }

        .insight-content ul {
            padding-left: 1.2rem;
        }

        .insight-content li {
            margin-bottom: 0.25rem;
        }
    </style>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Analytics JavaScript -->
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Export analytics
            $('#exportAnalyticsBtn').click(function() {
                showToast('Exporting analytics data...', 'info');
                // In a real app, this would generate a CSV/PDF report
                setTimeout(() => {
                    showToast('Analytics data exported successfully!', 'success');
                }, 1500);
            });

            // Chart time period buttons
            $('.btn-group .btn').click(function() {
                $(this).parent().find('.btn').removeClass('active');
                $(this).addClass('active');

                const period = $(this).text();
                showToast(`Showing analytics for: ${period}`, 'info');
            });

            // Heatmap square hover
            $('.heatmap-square').hover(
                function() {
                    const title = $(this).attr('title');
                    $(this).attr('data-bs-toggle', 'tooltip');
                    $(this).attr('data-bs-title', title);
                    $(this).tooltip('show');
                },
                function() {
                    $(this).tooltip('hide');
                }
            );

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

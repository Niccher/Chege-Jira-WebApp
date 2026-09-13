<?= $this->extend('layouts/ace/main') ?>
<?= $this->section('content') ?>


    
        
        <div class="row space-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Analytics</strong></h3>
            </div>
            <div class="col-auto pull-right text-end mt-n1">
                
            </div>
        </div>
        <!-- Key Metrics -->
        <div class="row space-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Total Projects</div>
                    <div class="stat-value"><?= esc($totalProjects) ?></div>
                    <div class="stat-change text-secondary  font-mono border-top pt-2">
                        <i class="fas fa-arrow-up"></i> <?= esc($thisMonthStarted) ?> this month
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Completion Rate</div>
                    <div class="stat-value text-success"><?= esc(round($completionRate)) ?>%</div>
                    <div class="stat-change text-success  font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-arrow-up"></i> Overall rate
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Hours Logged</div>
                    <div class="stat-value text-warning"><?= esc(number_format($totalHours, 1)) ?></div>
                    <div class="stat-change text-warning  font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-clock"></i> Total hours
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Avg Daily Hours</div>
                    <div class="stat-value text-success"><?= esc(number_format($avgDaily, 1)) ?></div>
                    <div class="stat-change text-success  font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-arrow-up"></i> Daily average
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="row space-4">
            <!-- Project Completion Chart -->
            <div class="col-lg-8">
                <div class="widget-box card-body h-100">
                    <div class="   space-3">
                        <h5 class="space-0"><i class="fas fa-chart-line pr-2"></i>Project Completion Trends</h5>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn btn-white btn-default active">Monthly</button>
                            <button class="btn btn btn-white btn-default">Quarterly</button>
                            <button class="btn btn btn-white btn-default">Yearly</button>
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
                <div class="widget-box card-body h-100">
                    <h5 class="space-3"><i class="fas fa-chart-pie pr-2"></i>Project Health Distribution</h5>
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
        <div class="row space-4">
            <!-- Time Distribution -->
            <div class="col-lg-6">
                <div class="widget-box card-body h-100">
                    <div class="   space-3">
                        <h5 class="space-0"><i class="fas fa-clock pr-2"></i>Time Distribution by Project</h5>
                        <button class="btn btn-sm btn btn-white btn-default">Details</button>
                    </div>

                    <div class="time-distribution">
                        <?php $isFirst = true; ?>
                        <?php foreach ($timeDistribution as $item): ?>
                        <?php $pct = $allTimeTotal > 0 ? round(($item['total_duration'] / $allTimeTotal) * 100) : 0; ?>
                        <div class="distribution-item<?= $isFirst ? '' : ' ' ?>">
                            <?php $isFirst = false; ?>
                            <div class="  ">
                                <div class=" ">
                                    <div class="project-icon pr-2" style="background-color: <?= esc($item['color']) ?>;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <span><?= esc($item['name']) ?></span>
                                </div>
                                <span class="text-muted"><?= esc(number_format($item['total_duration'], 1)) ?> hrs (<?= $pct ?>%)</span>
                            </div>
                            <div class="progress " style="height: 10px;">
                                <div class="progress-bar" style="width: <?= $pct ?>%; background-color: <?= esc($item['color']) ?>;"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Productivity Heatmap -->
            <div class="col-lg-6">
                <div class="widget-box card-body h-100">
                    <h5 class="space-3"><i class="fas fa-calendar-alt pr-2"></i>Monthly Activity Heatmap</h5>
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

                        <div class="heatmap-footer ">
                            <div class="  small text-muted">
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
                <div class="widget-box card-body">
                    <div class="   space-3">
                        <h5 class="space-0"><i class="fas fa-lightbulb pr-2"></i>Insights & Recommendations</h5>
                        <button class="btn btn-sm btn btn-white btn-default">
                            <i class="fas fa-sync pr-1"></i> Refresh
                        </button>
                    </div>

                    <?php if (!empty($insights)): ?>
                    <div class="row g-3">
                        <?php foreach ($insights as $insight): ?>
                        <div class="col-md-4">
                            <div class="widget-box card-body h-100 p-3 border-dark border-start border-4 border-<?= esc($insight['color']) ?>">
                                <div class="  space-2">
                                    <i class="<?= esc($insight['icon']) ?> text-<?= esc($insight['color']) ?> fs-5 pr-2"></i>
                                    <h6 class="space-0 text-white font-mono"><?= esc($insight['title']) ?></h6>
                                </div>
                                <p class="small text-secondary space-0"><?= esc($insight['message']) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="row g-3 ">
                        <div class="col-md-6">
                            <div class="widget-box card-body p-3 border-dark">
                                <h6 class="font-mono text-white border-bottom pb-2 space-3"><i class="fas fa-check-square text-success pr-2"></i>Completed This Month</h6>
                                <ul class="small text-secondary space-0 list-unstyled font-mono">
                                    <?php if (!empty($completedThisMonth)): ?>
                                    <?php foreach ($completedThisMonth as $item): ?>
                                    <li class="space-2"><i class="fas fa-check text-success pr-2"></i><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <li class="space-2 text-muted">No projects completed this month</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="widget-box card-body p-3 border-dark">
                                <h6 class="font-mono text-white border-bottom pb-2 space-3"><i class="fas fa-exclamation-triangle text-warning pr-2"></i>Need Attention</h6>
                                <ul class="small text-secondary space-0 list-unstyled font-mono">
                                    <?php if (!empty($stalledTasks)): ?>
                                    <?php foreach ($stalledTasks as $item): ?>
                                    <li class="space-2"><i class="fas fa-circle text-danger ms-1 pr-2" style="font-size: 8px;"></i><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <li class="space-2 text-muted">No stalled projects</li>
                                    <?php endif; ?>
                                </ul>
                                <?php if (!empty($recentDone)): ?>
                                <h6 class="font-mono text-white border-bottom pb-2 space-3 "><i class="fas fa-history text-info pr-2"></i>Recently Completed</h6>
                                <ul class="small text-secondary space-0 list-unstyled font-mono">
                                    <?php foreach ($recentDone as $item): ?>
                                    <li class="space-2"><i class="fas fa-check-circle text-info pr-2"></i><?= esc($item) ?></li>
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
            <div id="${toastId}" class="toast  text-bg-${type} border-0" role="alert">
                <div class="">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white pr-2 m-auto" data-dismiss="toast"></button>
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

<?= $this->endSection() ?>

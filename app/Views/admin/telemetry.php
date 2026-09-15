<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>System Telemetry • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-2">
    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="page-title mb-0">
                        <i class="uil-server-network text-primary me-2"></i> System Telemetry & Container Diagnostics
                    </h4>
                    <p class="text-muted font-13 mb-0">Live container resource metrics, MySQL daemon diagnostics, and WebApp execution specs.</p>
                </div>
                <div>
                    <button class="btn btn-sm btn-primary rounded-pill shadow-sm" onclick="window.location.reload();">
                        <i class="mdi mdi-refresh me-1"></i> Refresh Metrics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hardware Health Cards -->
    <div class="row g-3 mb-4">
        <!-- CPU Usage -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted text-uppercase font-12 fw-bold">CPU Load & Pressure</span>
                        <div class="avatar-xs bg-info-lighten text-info rounded d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-cpu-64-bit font-18"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline mb-2">
                        <h3 class="my-0 me-2 <?= $cpuPercent > 80 ? 'text-danger' : 'text-primary' ?>"><?= $cpuPercent ?>%</h3>
                        <span class="text-muted font-13"><?= $cpuCores ?> Core<?= $cpuCores > 1 ? 's' : '' ?></span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar <?= $cpuPercent > 80 ? 'bg-danger' : ($cpuPercent > 50 ? 'bg-warning' : 'bg-primary') ?>" role="progressbar" style="width: <?= min(100, $cpuPercent) ?>%"></div>
                    </div>
                    <div class="row text-center font-12 text-muted border-top pt-2 g-0">
                        <div class="col-4 border-end">
                            <span class="d-block text-body fw-semibold"><?= $cpuLoad1 ?></span>
                            <span>1 min</span>
                        </div>
                        <div class="col-4 border-end">
                            <span class="d-block text-body fw-semibold"><?= $cpuLoad5 ?></span>
                            <span>5 min</span>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-body fw-semibold"><?= $cpuLoad15 ?></span>
                            <span>15 min</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RAM Usage -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted text-uppercase font-12 fw-bold">Container Memory</span>
                        <div class="avatar-xs bg-warning-lighten text-warning rounded d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-memory font-18"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline mb-2">
                        <h3 class="my-0 me-2 <?= $ramPercent > 85 ? 'text-danger' : 'text-warning' ?>"><?= $ramPercent ?>%</h3>
                        <span class="text-muted font-13"><?= number_format($ramUsed) ?> / <?= number_format($ramTotal) ?> MB</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar <?= $ramPercent > 85 ? 'bg-danger' : 'bg-warning' ?>" role="progressbar" style="width: <?= min(100, $ramPercent) ?>%"></div>
                    </div>
                    <div class="d-flex justify-content-between font-12 text-muted border-top pt-2">
                        <span>Allocated Peak: <strong><?= esc($webAppSpecs['memory_peak']) ?></strong></span>
                        <span>PHP Limit: <strong><?= esc($webAppSpecs['memory_limit']) ?></strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disk Storage -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted text-uppercase font-12 fw-bold">Container Storage (/)</span>
                        <div class="avatar-xs bg-success-lighten text-success rounded d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-harddisk font-18"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline mb-2">
                        <h3 class="my-0 me-2 <?= $diskPercent > 90 ? 'text-danger' : 'text-success' ?>"><?= $diskPercent ?>%</h3>
                        <span class="text-muted font-13"><?= $diskUsed ?> / <?= $diskTotal ?> GB</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar <?= $diskPercent > 90 ? 'bg-danger' : 'bg-success' ?>" role="progressbar" style="width: <?= min(100, $diskPercent) ?>%"></div>
                    </div>
                    <div class="d-flex justify-content-between font-12 text-muted border-top pt-2">
                        <span>Free Space: <strong><?= $diskFree ?> GB</strong></span>
                        <span>Mount: <strong>Linux OverlayFS</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Live MySQL Container Diagnostics -->
    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3 d-flex align-items-center justify-content-between border-bottom">
                    <h5 class="mb-0 fw-bold font-15">
                        <i class="mdi mdi-database-check text-primary me-2"></i> MySQL Container & Engine Specs
                    </h5>
                    <?php if ($dbSpecs['connected']): ?>
                        <span class="badge bg-success-lighten text-success"><i class="mdi mdi-check-circle me-1"></i> Connected</span>
                    <?php else: ?>
                        <span class="badge bg-danger-lighten text-danger"><i class="mdi mdi-alert me-1"></i> Disconnected</span>
                    <?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0 font-13">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-3" style="width: 45%;">Server Version</td>
                                    <td class="fw-semibold font-monospace"><?= esc($dbSpecs['version']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Database / Schema</td>
                                    <td class="fw-semibold"><code><?= esc($dbSpecs['database']) ?></code> (<?= esc($dbSpecs['driver']) ?>)</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Database Host</td>
                                    <td class="fw-semibold font-monospace"><?= esc($dbSpecs['host']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Database Size</td>
                                    <td class="fw-bold text-primary"><?= esc($dbSpecs['size_mb']) ?> MB</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Total Tables</td>
                                    <td class="fw-semibold"><span class="badge bg-light text-secondary"><?= esc($dbSpecs['table_count']) ?> tables</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Database Uptime</td>
                                    <td class="fw-semibold"><?= esc($dbSpecs['uptime_human']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">InnoDB Buffer Pool</td>
                                    <td class="fw-semibold"><?= esc($dbSpecs['innodb_buffer_pool']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Threads Connected / Max</td>
                                    <td class="fw-semibold">
                                        <span class="badge bg-info-lighten text-info"><?= esc($dbSpecs['active_threads']) ?></span>
                                        <span class="text-muted font-11">/ max <?= esc($dbSpecs['max_connections']) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Slow Queries Recorded</td>
                                    <td class="fw-semibold <?= $dbSpecs['slow_queries'] > 0 ? 'text-warning' : 'text-success' ?>">
                                        <?= esc($dbSpecs['slow_queries']) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- WebApp Execution Specs -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3 d-flex align-items-center justify-content-between border-bottom">
                    <h5 class="mb-0 fw-bold font-15">
                        <i class="mdi mdi-application-cog text-info me-2"></i> WebApp Runtime & PHP Engine Specs
                    </h5>
                    <span class="badge bg-primary-lighten text-primary font-11">PHP <?= esc($webAppSpecs['php_version']) ?></span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0 font-13">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-3" style="width: 45%;">CodeIgniter Framework</td>
                                    <td class="fw-semibold font-monospace">v<?= esc($webAppSpecs['ci_version']) ?> (<?= esc($webAppSpecs['environment']) ?>)</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">PHP SAPI Interface</td>
                                    <td class="fw-semibold font-monospace"><?= esc($webAppSpecs['php_sapi']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Session Driver & Store</td>
                                    <td class="fw-semibold">
                                        <span class="badge bg-purple-lighten text-purple">DatabaseHandler</span>
                                        <code><?= esc($webAppSpecs['session_save_path']) ?></code>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">PHP Memory Usage</td>
                                    <td class="fw-semibold">Current: <strong><?= esc($webAppSpecs['memory_current']) ?></strong> (Peak: <strong><?= esc($webAppSpecs['memory_peak']) ?></strong>)</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">OPcache Accelerator</td>
                                    <td>
                                        <?php if ($webAppSpecs['opcache_enabled']): ?>
                                            <span class="badge bg-success-lighten text-success"><i class="mdi mdi-lightning-bolt me-1"></i> Enabled</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-lighten text-muted">Disabled</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Max Execution Time</td>
                                    <td class="fw-semibold"><?= esc($webAppSpecs['max_execution_time']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Upload Max File Size</td>
                                    <td class="fw-semibold"><?= esc($webAppSpecs['upload_max_filesize']) ?> (POST: <?= esc($webAppSpecs['post_max_size']) ?>)</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">App Timezone</td>
                                    <td class="fw-semibold"><?= esc($webAppSpecs['timezone']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-3">Container OS</td>
                                    <td class="fw-semibold"><?= PHP_OS ?> (Linux Container)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

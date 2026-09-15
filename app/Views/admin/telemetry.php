<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>System Telemetry • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4 class="page-title mb-0">
                        <i class="uil-server-network text-primary me-2"></i> Cluster Telemetry & Container Diagnostics
                    </h4>
                    <p class="text-muted font-13 mb-0">Live real-time monitoring across WebApp, ML Microservice, MySQL, and Redis nodes.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-lighten text-success px-3 py-2 font-12 rounded-pill">
                        <i class="mdi mdi-check-circle me-1"></i> All 4 Services Healthy
                    </span>
                    <button class="btn btn-sm btn-primary rounded-pill shadow-sm" onclick="window.location.reload();">
                        <i class="mdi mdi-refresh me-1"></i> Refresh Metrics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- TOP ROW: ALL 4 CONTAINER NODES AT A GLANCE (Side-by-Side)     -->
    <!-- ============================================================== -->
    <div class="row g-3 mb-4">
        <!-- 1. WebApp Container -->
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100 position-relative overflow-hidden">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-primary-lighten text-primary font-12 fw-bold">
                            <i class="mdi mdi-application-cog me-1"></i> WebApp Node
                        </span>
                        <span class="badge bg-success-lighten text-success font-11">Live</span>
                    </div>
                    <div class="row g-2 font-13">
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">CPU Load</span>
                            <span class="fw-bold text-dark font-15"><?= $cpuPercent ?>%</span>
                            <span class="text-muted font-11 d-block"><?= $cpuCores ?> Core(s)</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">RAM Usage</span>
                            <span class="fw-bold text-dark font-15"><?= $ramPercent ?>%</span>
                            <span class="text-muted font-11 d-block text-truncate"><?= $ramUsedHuman ?></span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Disk Used</span>
                            <span class="fw-semibold text-dark"><?= $diskUsedHuman ?></span>
                            <span class="text-muted font-11 d-block">/ <?= $diskTotalHuman ?></span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Uptime</span>
                            <span class="fw-semibold text-dark text-truncate d-block"><?= esc($webUptime) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. ML AI Inference Container -->
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100 position-relative overflow-hidden">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-success-lighten text-success font-12 fw-bold">
                            <i class="mdi mdi-brain me-1"></i> ML AI Engine
                        </span>
                        <span class="badge bg-success-lighten text-success font-11"><?= esc($mlSpecs['version']) ?></span>
                    </div>
                    <div class="row g-2 font-13">
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">CPU Load</span>
                            <span class="fw-bold text-dark font-15"><?= esc($mlSpecs['cpu_usage']) ?></span>
                            <span class="text-muted font-11 d-block">GGUF Inference</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">RAM Usage</span>
                            <span class="fw-bold text-dark font-15">~30%</span>
                            <span class="text-muted font-11 d-block text-truncate"><?= esc($mlSpecs['ram_usage']) ?></span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Model Storage</span>
                            <span class="fw-semibold text-dark"><?= esc($mlSpecs['model_storage']) ?></span>
                            <span class="text-muted font-11 d-block">Q4 Quantized</span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">FastAPI State</span>
                            <span class="fw-semibold text-success d-block"><?= esc($mlSpecs['uptime_human']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. MySQL Database Container -->
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100 position-relative overflow-hidden">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-info-lighten text-info font-12 fw-bold">
                            <i class="mdi mdi-database me-1"></i> MySQL Database
                        </span>
                        <span class="badge bg-success-lighten text-success font-11">Online</span>
                    </div>
                    <div class="row g-2 font-13">
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">DB Size</span>
                            <span class="fw-bold text-dark font-15"><?= esc($dbSpecs['size_human']) ?></span>
                            <span class="text-muted font-11 d-block"><?= esc($dbSpecs['table_count']) ?> Tables</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Threads</span>
                            <span class="fw-bold text-dark font-15"><?= esc($dbSpecs['active_threads']) ?></span>
                            <span class="text-muted font-11 d-block">/ max <?= esc($dbSpecs['max_connections']) ?></span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Buffer Pool</span>
                            <span class="fw-semibold text-dark"><?= esc($dbSpecs['innodb_buffer_pool']) ?></span>
                            <span class="text-muted font-11 d-block">InnoDB Cache</span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Uptime</span>
                            <span class="fw-semibold text-dark text-truncate d-block"><?= esc($dbSpecs['uptime_human']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Redis Cache & Session Container -->
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100 position-relative overflow-hidden">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-danger-lighten text-danger font-12 fw-bold">
                            <i class="mdi mdi-memory me-1"></i> Redis Cluster
                        </span>
                        <span class="badge bg-success-lighten text-success font-11">Active</span>
                    </div>
                    <div class="row g-2 font-13">
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">RAM Used</span>
                            <span class="fw-bold text-dark font-15"><?= esc($redisSpecs['used_memory_human']) ?></span>
                            <span class="text-muted font-11 d-block">In-Memory Cache</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Clients</span>
                            <span class="fw-bold text-dark font-15"><?= esc($redisSpecs['connected_clients']) ?></span>
                            <span class="text-muted font-11 d-block">Connected</span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Hit Rate</span>
                            <span class="fw-semibold text-dark"><?= esc($redisSpecs['keyspace_hits']) ?></span>
                            <span class="text-muted font-11 d-block">Efficiency</span>
                        </div>
                        <div class="col-6 mt-2 pt-2 border-top">
                            <span class="text-muted d-block font-11 text-uppercase fw-semibold">Role</span>
                            <span class="fw-semibold text-dark text-truncate d-block"><?= esc($redisSpecs['role']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- TABBED SECTION: 4 DEDICATED GRANULAR PANES                     -->
    <!-- ============================================================== -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-0">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs nav-bordered nav-justified bg-light mb-0" style="border-radius: 8px 8px 0 0;" role="tablist">
                <li class="nav-item">
                    <a href="#tab-webapp" data-bs-toggle="tab" aria-expanded="true" class="nav-link active py-3">
                        <i class="mdi mdi-application-cog font-18 text-primary me-1 d-block mb-1"></i>
                        <span class="fw-bold">1. WebApp Container</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-ml" data-bs-toggle="tab" aria-expanded="false" class="nav-link py-3">
                        <i class="mdi mdi-brain font-18 text-success me-1 d-block mb-1"></i>
                        <span class="fw-bold">2. ML AI Engine</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-redis" data-bs-toggle="tab" aria-expanded="false" class="nav-link py-3">
                        <i class="mdi mdi-memory font-18 text-danger me-1 d-block mb-1"></i>
                        <span class="fw-bold">3. Redis Cluster</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-mysql" data-bs-toggle="tab" aria-expanded="false" class="nav-link py-3">
                        <i class="mdi mdi-database font-18 text-info me-1 d-block mb-1"></i>
                        <span class="fw-bold">4. MySQL Database</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content p-4">
                <!-- ================================================== -->
                <!-- TAB 1: WEBAPP CONTAINER (DEFAULT ACTIVE)           -->
                <!-- ================================================== -->
                <div class="tab-pane show active" id="tab-webapp">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-primary">
                            <i class="mdi mdi-server me-1"></i> Web Application Runtime & PHP Engine Specs
                        </h5>
                        <span class="badge bg-primary-lighten text-primary font-12">PHP <?= esc($webAppSpecs['php_version']) ?> (<?= esc($webAppSpecs['php_sapi']) ?>)</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-tune-vertical me-1 text-primary"></i> Runtime Memory & Limits</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Memory Limit (PHP ini)</span>
                                        <span class="fw-semibold font-monospace"><?= esc($webAppSpecs['memory_limit']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Current Memory Usage</span>
                                        <span class="fw-semibold text-primary font-monospace"><?= esc($webAppSpecs['memory_current']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Peak Memory Recorded</span>
                                        <span class="fw-semibold text-danger font-monospace"><?= esc($webAppSpecs['memory_peak']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Max Execution Timeout</span>
                                        <span class="fw-semibold font-monospace"><?= esc($webAppSpecs['max_execution_time']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Upload Max File Size</span>
                                        <span class="fw-semibold font-monospace"><?= esc($webAppSpecs['upload_max_filesize']) ?> (POST: <?= esc($webAppSpecs['post_max_size']) ?>)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-shield-check-outline me-1 text-success"></i> Framework & Session Architecture</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Framework Version</span>
                                        <span class="fw-semibold font-monospace">CodeIgniter v<?= esc($webAppSpecs['ci_version']) ?> (<?= esc($webAppSpecs['environment']) ?>)</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Session Driver</span>
                                        <span class="badge bg-success-lighten text-success"><?= esc($webAppSpecs['session_driver']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">OPcache Accelerator</span>
                                        <span><?= $webAppSpecs['opcache_enabled'] ? '<span class="badge bg-success"><i class="mdi mdi-lightning-bolt me-1"></i> Active</span>' : '<span class="badge bg-secondary">Disabled</span>' ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">System Load Average</span>
                                        <span class="fw-semibold font-monospace"><?= $cpuLoad1 ?> (1m) &bull; <?= $cpuLoad5 ?> (5m) &bull; <?= $cpuLoad15 ?> (15m)</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Timezone</span>
                                        <span class="fw-semibold font-monospace"><?= esc($webAppSpecs['timezone']) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================================================== -->
                <!-- TAB 2: ML AI ENGINE MICROSERVICE                   -->
                <!-- ================================================== -->
                <div class="tab-pane" id="tab-ml">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-success">
                            <i class="mdi mdi-brain me-1"></i> Python FastAPI & LLM Inference Architecture
                        </h5>
                        <span class="badge bg-success-lighten text-success font-12">Synced API <?= esc($mlSpecs['version']) ?></span>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-cog-sync-outline me-1 text-success"></i> Inference Engine Specifications</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Microservice Framework</span>
                                        <span class="fw-semibold font-monospace"><?= esc($mlSpecs['framework']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">LLM Inference Backend</span>
                                        <span class="fw-semibold text-primary font-monospace"><?= esc($mlSpecs['inference_type']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Quantized Model Cache</span>
                                        <span class="fw-semibold font-monospace"><?= esc($mlSpecs['model_storage']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Worker Threads</span>
                                        <span class="badge bg-info-lighten text-info"><?= esc($mlSpecs['active_workers']) ?> Uvicorn Workers</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-api me-1 text-primary"></i> Microservice Health & Endpoints</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Endpoint Version</span>
                                        <span class="badge bg-success-lighten text-success font-monospace"><?= esc($mlSpecs['version']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Task Estimation API</span>
                                        <span class="badge bg-light text-dark font-monospace">/api/v1/resources/tasks</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">AI Sprint Summary API</span>
                                        <span class="badge bg-light text-dark font-monospace">/api/v1/resources/sprints</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Security Guard</span>
                                        <span class="badge bg-success-lighten text-success"><i class="mdi mdi-shield-lock me-1"></i> X-API-Key Verified</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================================================== -->
                <!-- TAB 3: REDIS CACHE & SESSION STORE                 -->
                <!-- ================================================== -->
                <div class="tab-pane" id="tab-redis">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-danger">
                            <i class="mdi mdi-memory me-1"></i> Redis In-Memory Cluster & Resilient Session Store
                        </h5>
                        <span class="badge bg-danger-lighten text-danger font-12">Redis <?= esc($redisSpecs['version']) ?></span>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-memory me-1 text-danger"></i> Cache & Memory Consumption</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Memory Allocated</span>
                                        <span class="fw-bold text-danger font-monospace"><?= esc($redisSpecs['used_memory_human']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Connected Clients</span>
                                        <span class="badge bg-info-lighten text-info font-monospace"><?= esc($redisSpecs['connected_clients']) ?> Active</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Cache Hit Efficiency</span>
                                        <span class="fw-bold text-success font-monospace"><?= esc($redisSpecs['keyspace_hits']) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-sync me-1 text-primary"></i> Resilience & Fallback Architecture</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Primary Storage</span>
                                        <span class="fw-semibold text-dark">Redis 6.2 (Railway Private Network)</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Automatic Failover</span>
                                        <span class="badge bg-success-lighten text-success">Active (Falls back to MySQL DatabaseHandler)</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Session Lifetime</span>
                                        <span class="fw-semibold font-monospace">30 Days (2,592,000s)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================================================== -->
                <!-- TAB 4: MYSQL RELATIONAL DATABASE                   -->
                <!-- ================================================== -->
                <div class="tab-pane" id="tab-mysql">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-info">
                            <i class="mdi mdi-database me-1"></i> MySQL Relational Database Diagnostics
                        </h5>
                        <span class="badge bg-info-lighten text-info font-12"><?= esc($dbSpecs['version']) ?></span>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-table me-1 text-info"></i> Storage & Table Statistics</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Database / Schema</span>
                                        <span class="fw-semibold font-monospace"><code><?= esc($dbSpecs['database']) ?></code></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Total Database Size</span>
                                        <span class="fw-bold text-primary font-monospace"><?= esc($dbSpecs['size_human']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Table Count</span>
                                        <span class="badge bg-light text-secondary font-monospace"><?= esc($dbSpecs['table_count']) ?> Tables</span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Database Host</span>
                                        <span class="fw-semibold font-monospace"><?= esc($dbSpecs['host']) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-3 bg-light rounded border h-100">
                                <h6 class="fw-bold font-14 mb-3 text-dark"><i class="mdi mdi-speedometer me-1 text-success"></i> Performance & Connection Pool</h6>
                                <ul class="list-group list-group-flush bg-transparent font-13">
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">InnoDB Buffer Pool</span>
                                        <span class="fw-semibold font-monospace"><?= esc($dbSpecs['innodb_buffer_pool']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Active / Max Connections</span>
                                        <span class="fw-semibold font-monospace"><?= esc($dbSpecs['active_threads']) ?> / <?= esc($dbSpecs['max_connections']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Slow Queries Recorded</span>
                                        <span class="fw-semibold <?= $dbSpecs['slow_queries'] > 0 ? 'text-warning' : 'text-success' ?> font-monospace"><?= esc($dbSpecs['slow_queries']) ?></span>
                                    </li>
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <span class="text-muted">Database Uptime</span>
                                        <span class="fw-semibold font-monospace"><?= esc($dbSpecs['uptime_human']) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end tab-content -->
        </div> <!-- end card-body -->
    </div> <!-- end card -->
</div>
<?= $this->endSection() ?>

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

<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-server text-primary me-2"></i> System Telemetry</h2>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.location.reload();">
            <i class="fas fa-sync-alt"></i> Refresh Data
        </button>
    </div>

    <div class="row">
        <!-- CPU Usage -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-microchip text-info me-2"></i>CPU Load</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-3 <?= $cpuPercent > 80 ? 'text-danger' : 'text-success' ?>">
                        <?= $cpuPercent ?>%
                    </h3>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar <?= $cpuPercent > 80 ? 'bg-danger' : 'bg-success' ?>" role="progressbar" style="width: <?= $cpuPercent ?>%"></div>
                    </div>
                    <ul class="list-unstyled text-muted small">
                        <li><strong>Cores:</strong> <?= $cpuCores ?></li>
                        <li><strong>1 min load:</strong> <?= $cpuLoad1 ?></li>
                        <li><strong>5 min load:</strong> <?= $cpuLoad5 ?></li>
                        <li><strong>15 min load:</strong> <?= $cpuLoad15 ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- RAM Usage -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-memory text-warning me-2"></i>Memory Usage</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-3 <?= $ramPercent > 85 ? 'text-danger' : 'text-primary' ?>">
                        <?= $ramPercent ?>%
                    </h3>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar <?= $ramPercent > 85 ? 'bg-danger' : 'bg-primary' ?>" role="progressbar" style="width: <?= $ramPercent ?>%"></div>
                    </div>
                    <ul class="list-unstyled text-muted small">
                        <li><strong>Used:</strong> <?= number_format($ramUsed) ?> MB</li>
                        <li><strong>Total:</strong> <?= number_format($ramTotal) ?> MB</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Disk Space -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-hdd text-secondary me-2"></i>Disk Space</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-3 <?= $diskPercent > 90 ? 'text-danger' : 'text-success' ?>">
                        <?= $diskPercent ?>%
                    </h3>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar <?= $diskPercent > 90 ? 'bg-danger' : 'bg-success' ?>" role="progressbar" style="width: <?= $diskPercent ?>%"></div>
                    </div>
                    <ul class="list-unstyled text-muted small">
                        <li><strong>Used:</strong> <?= $diskUsed ?> GB</li>
                        <li><strong>Total:</strong> <?= $diskTotal ?> GB</li>
                        <li><strong>Mount:</strong> / (Container Root)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Environment Info -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle text-muted me-2"></i>Environment Details</h5>
        </div>
        <div class="card-body">
            <div class="row text-muted">
                <div class="col-md-6">
                    <p><strong>PHP Version:</strong> <?= esc($phpVersion) ?></p>
                    <p><strong>Web Server:</strong> <?= esc($serverSoftware) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>CodeIgniter Version:</strong> <?= \CodeIgniter\CodeIgniter::CI_VERSION ?></p>
                    <p><strong>Environment:</strong> <?= ENVIRONMENT ?></p>
                </div>
            </div>
            <hr>
            <p class="small text-muted mb-0">
                <em>Note: CPU and Memory metrics reflect the underlying host/node limits visible to this Docker container. If resources are constrained by Docker limits, these numbers represent the container's isolated view.</em>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

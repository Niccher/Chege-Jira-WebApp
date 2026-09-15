<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>AI Engine Settings • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-2">
    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="page-title mb-0">
                        <i class="uil-brain text-primary me-2"></i> AI Engine Configuration
                    </h4>
                    <p class="text-muted font-13 mb-0">Manage default LLM models, CPU thread allocations, context window buffers, and compute hardware.</p>
                </div>
                <div>
                    <a href="<?= site_url('admin/ai/telemetry') ?>" class="btn btn-sm btn-outline-primary rounded-pill shadow-sm">
                        <i class="mdi mdi-chart-line me-1"></i> View Diagnostics
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-check-circle-outline me-2 font-16"></i> <?= session()->getFlashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2 font-16"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title my-0">Runtime Settings</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= site_url('admin/ai/settings/update') ?>">
                        <?= csrf_field() ?>

                        <!-- Default Model Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Default GGUF Model</label>
                            <select name="default_model" class="form-select">
                                <?php foreach ($models as $mKey => $m): ?>
                                    <option value="<?= esc($mKey) ?>" <?= ($config['default_model'] ?? '') === $mKey ? 'selected' : '' ?>>
                                        <?= esc($mKey) ?> (<?= esc($m['file'] ?? '') ?> - <?= esc($m['size_gb'] ?? '') ?> GB)
                                        <?= empty($m['exists_on_disk']) ? '[Not Downloaded]' : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text">Used automatically for all background AI operations unless overridden per request.</div>
                        </div>

                        <!-- Compute Mode (CPU vs GPU) -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Compute Hardware</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="compute_mode" id="computeCpu" value="cpu" <?= ($config['n_gpu_layers'] ?? 0) == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="computeCpu">
                                        <strong>CPU Execution (Default)</strong>
                                        <span class="d-block text-muted font-12">Accelerated with OpenBLAS multi-threading</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="compute_mode" id="computeGpu" value="gpu" <?= ($config['n_gpu_layers'] ?? 0) != 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="computeGpu">
                                        <strong>NVIDIA GPU Offload (CUDA)</strong>
                                        <span class="d-block text-muted font-12">Full layer offloading (n_gpu_layers = -1)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- CPU Thread Count -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">CPU Thread Allocation</label>
                            <input type="number" name="n_threads" class="form-control" min="1" max="64" value="<?= esc($config['n_threads'] ?? 4) ?>">
                            <div class="form-text">Recommended: 2 to 8 threads depending on host CPU cores.</div>
                        </div>

                        <!-- Context Window -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Context Window Size (Tokens)</label>
                            <input type="number" name="n_ctx" class="form-control" min="512" max="32768" step="512" value="<?= esc($config['n_ctx'] ?? 4096) ?>">
                            <div class="form-text">Default: 4096. Larger context allows larger wiki documentation generation but uses more RAM.</div>
                        </div>

                        <div class="text-end border-top pt-3">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="mdi mdi-content-save me-1"></i> Save AI Engine Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

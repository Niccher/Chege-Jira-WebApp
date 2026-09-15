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
                    <p class="text-muted font-13 mb-0">Configure FastAPI microservice connection URL, API credentials, compute acceleration (CPU/GPU), and LLM parameters.</p>
                </div>
                <div>
                    <a href="<?= site_url('admin/ai/telemetry') ?>" class="btn btn-sm btn-outline-primary rounded-pill shadow-sm">
                        <i class="mdi mdi-chart-line me-1"></i> View Live Diagnostics
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
        <div class="col-lg-9">
            <form method="post" action="<?= site_url('admin/ai/settings/update') ?>">
                <?= csrf_field() ?>

                <!-- 1. Microservice Connection Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title my-0">
                                <i class="uil-plug me-1 text-primary"></i> Microservice Connection & Endpoint
                            </h5>
                            <span class="text-muted font-12">Specify where the Python FastAPI container is hosted</span>
                        </div>
                        <div>
                            <?php if ($isOnline): ?>
                                <span class="badge bg-success-lighten text-success"><i class="mdi mdi-check-circle me-1"></i>Connected</span>
                            <?php else: ?>
                                <span class="badge bg-danger-lighten text-danger"><i class="mdi mdi-alert-circle me-1"></i>Unreachable</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Microservice Endpoint (URL & Port)</label>
                                <input type="text" name="service_url" class="form-control" value="<?= esc($serviceUrl) ?>" placeholder="e.g. http://ml-chege-jira:8000 or http://ml-chege-jira.railway.internal:8000" required>
                                <div class="form-text">
                                    Local Docker: <code>http://ml-chege-jira:8000</code> • Railway Private: <code>http://ml-chege-jira.railway.internal:8000</code>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">API Secret Key (X-API-Key)</label>
                                <input type="password" name="api_key" class="form-control" value="<?= esc($apiKey) ?>" placeholder="Secret key matching ML .env" required>
                                <div class="form-text">Shared secret token used to authenticate all requests.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. LLM Runtime Parameters Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="card-title my-0">
                            <i class="uil-processor me-1 text-primary"></i> LLM Runtime Parameters & Hardware Mode
                        </h5>
                        <span class="text-muted font-12">Controls inference execution on the ML microservice</span>
                    </div>
                    <div class="card-body">
                        <!-- Default Model Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Default GGUF Model</label>
                            <select name="default_model" class="form-select">
                                <?php if (!empty($models)): ?>
                                    <?php foreach ($models as $mKey => $m): ?>
                                        <option value="<?= esc($mKey) ?>" <?= ($config['default_model'] ?? '') === $mKey ? 'selected' : '' ?>>
                                            <?= esc($mKey) ?> (<?= esc($m['file'] ?? '') ?> - <?= esc($m['size_gb'] ?? '') ?> GB)
                                            <?= empty($m['exists_on_disk']) ? '[File Missing - Run Download Script]' : '[Ready]' ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="mistral-7b" <?= ($config['default_model'] ?? '') === 'mistral-7b' ? 'selected' : '' ?>>mistral-7b (Mistral-7B-Instruct-v0.2)</option>
                                    <option value="llama3-8b" <?= ($config['default_model'] ?? '') === 'llama3-8b' ? 'selected' : '' ?>>llama3-8b (Meta-Llama-3-8B-Instruct)</option>
                                    <option value="phi3-mini" <?= ($config['default_model'] ?? '') === 'phi3-mini' ? 'selected' : '' ?>>phi3-mini (Phi-3-mini-4k-instruct)</option>
                                    <option value="deepseek-7b" <?= ($config['default_model'] ?? '') === 'deepseek-7b' ? 'selected' : '' ?>>deepseek-7b (deepseek-coder-7b-instruct)</option>
                                <?php endif; ?>
                            </select>
                            <div class="form-text">Used automatically for all background AI tasks unless specifically overridden.</div>
                        </div>

                        <!-- Compute Mode (CPU vs GPU) -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Compute Acceleration</label>
                            <div class="d-flex gap-4 p-2 bg-light rounded">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="compute_mode" id="computeCpu" value="cpu" <?= ($config['n_gpu_layers'] ?? 0) == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="computeCpu">
                                        <strong>CPU Multi-threading (Default)</strong>
                                        <span class="d-block text-muted font-12">Accelerated with OpenBLAS CPU matrix routines</span>
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

                        <div class="row g-3">
                            <!-- CPU Thread Count -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">CPU Thread Allocation</label>
                                <input type="number" name="n_threads" class="form-control" min="1" max="64" value="<?= esc($config['n_threads'] ?? 4) ?>">
                                <div class="form-text">Recommended: 2 to 8 threads depending on CPU vCores.</div>
                            </div>

                            <!-- Context Window -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Context Window Size (Tokens)</label>
                                <input type="number" name="n_ctx" class="form-control" min="512" max="32768" step="512" value="<?= esc($config['n_ctx'] ?? 4096) ?>">
                                <div class="form-text">Default: 4096. Allows longer wiki documents & summaries.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center">
                        <button type="submit" formaction="<?= site_url('admin/ai/test-connection') ?>" class="btn btn-outline-secondary">
                            <i class="mdi mdi-connection me-1"></i> Test Connection
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="mdi mdi-content-save me-1"></i> Save & Apply Configuration
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

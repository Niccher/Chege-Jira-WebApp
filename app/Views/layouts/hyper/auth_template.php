<?= $this->include('landing/header', [
    'pageTitle' => trim($this->renderSection('title')) ?: (setting('App.siteName') . ' — Authentication')
]) ?>

<style>
    .auth-page-container {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1rem;
        background: #f4f6fa;
    }
    .auth-main-card {
        width: 100%;
        max-width: 960px;
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .auth-form-column {
        padding: 2.5rem;
    }
    @media (min-width: 768px) {
        .auth-form-column {
            padding: 3rem 3.25rem;
        }
    }
    .auth-showcase-column {
        background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);
        padding: 3rem 2.5rem;
        color: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    .auth-showcase-column::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -30%;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .auth-feature-pill {
        display: flex;
        align-items: center;
        padding: 0.65rem 0.85rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 0.75rem;
    }
    .auth-feature-pill i {
        font-size: 18px;
        margin-right: 0.65rem;
    }
</style>

<div class="auth-page-container">
    <div class="auth-main-card">
        <div class="row g-0">
            <!-- Left Form Column -->
            <div class="col-lg-6 col-md-12 auth-form-column d-flex flex-column justify-content-center">
                <?= $this->renderSection('content') ?>
            </div>

            <!-- Right Brand Showcase Column (Desktop Only) -->
            <div class="col-lg-6 d-none d-lg-flex auth-showcase-column">
                <div>
                    <span class="badge bg-white bg-opacity-15 text-white px-3 py-1 rounded-pill font-12 mb-3">
                        <i class="mdi mdi-rocket-launch me-1 text-info"></i> Agile Project Management
                    </span>
                    <h3 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">
                        Supercharge Your Team's Engineering Velocity
                    </h3>
                    <p class="text-white-50 font-14 mb-4">
                        Coordinate sprints, organize tasks with drag-and-drop Kanban, track worklogs, and deliver software reliably.
                    </p>

                    <div class="mt-4">
                        <div class="auth-feature-pill">
                            <i class="mdi mdi-view-column text-info"></i>
                            <div>
                                <strong class="d-block text-white font-13">Interactive Kanban &amp; Sprints</strong>
                                <span class="text-white-50 font-12">Seamless drag-and-drop task workflows</span>
                            </div>
                        </div>

                        <div class="auth-feature-pill">
                            <i class="mdi mdi-timer-outline text-success"></i>
                            <div>
                                <strong class="d-block text-white font-13">Built-in Time Tracking &amp; Metrics</strong>
                                <span class="text-white-50 font-12">Stopwatch logs and automated sprint reports</span>
                            </div>
                        </div>

                        <div class="auth-feature-pill mb-0">
                            <i class="mdi mdi-shield-check-outline text-warning"></i>
                            <div>
                                <strong class="d-block text-white font-13">Enterprise Access &amp; Data Privacy</strong>
                                <span class="text-white-50 font-12">Role-based controls and complete data ownership</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-top border-white border-opacity-10 d-flex justify-content-between align-items-center font-12 text-white-50">
                    <span><?= date('Y') ?> © <?= esc(setting('App.siteName')) ?></span>
                    <span class="badge bg-white bg-opacity-10 text-white font-11">v1.2.0 • MIT</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

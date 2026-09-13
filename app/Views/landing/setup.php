<?= $this->include('landing/header') ?>

<!-- START PAGE HEADER -->
<section class="py-5 bg-light border-bottom">
    <div class="container text-center py-4">
        <span class="badge bg-primary-lighten text-primary rounded-pill px-3 py-1 font-12 fw-semibold">Quick Start</span>
        <h1 class="fw-bold mt-2 mb-2 display-6">Self-Hosting & Deployment Guide</h1>
        <p class="text-muted font-16 lead w-75 mx-auto mb-0">Deploy <?= esc(setting('App.siteName')) ?> to your local machine, private cloud, or Railway instance in under 2 minutes.</p>
    </div>
</section>
<!-- END PAGE HEADER -->

<section class="py-5">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- DOCKER DEPLOYMENT (RECOMMENDED) -->
                <div class="card feature-card mb-4 border">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                        <h4 class="card-title text-white mb-0 font-18">
                            <i class="mdi mdi-docker me-2"></i> Option 1: Docker & Docker Compose (Recommended)
                        </h4>
                        <span class="badge bg-light text-primary font-12">Fastest</span>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted font-15 mb-3">
                            The cleanest way to run <?= esc(setting('App.siteName')) ?> in an isolated environment with MySQL pre-configured.
                        </p>

                        <div class="mb-3">
                            <label class="fw-bold text-dark font-14 mb-1">1. Clone the repository:</label>
                            <pre class="bg-dark text-white p-3 rounded font-13 mb-0"><code>git clone https://github.com/Niccher/Chege-Jira-WebApp.git
cd Chege-Jira-WebApp</code></pre>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-dark font-14 mb-1">2. Configure your environment:</label>
                            <pre class="bg-dark text-white p-3 rounded font-13 mb-0"><code>cp env .env</code></pre>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold text-dark font-14 mb-1">3. Launch the container:</label>
                            <pre class="bg-dark text-white p-3 rounded font-13 mb-0"><code>docker-compose up -d --build</code></pre>
                        </div>

                        <div class="alert alert-info border-0 d-flex align-items-center mb-0" role="alert">
                            <i class="mdi mdi-information-outline font-22 me-2"></i>
                            <div>
                                Database migrations and seeders execute automatically on container startup. Access the web app at <a href="http://localhost:8080" class="fw-bold text-info" target="_blank">http://localhost:8080</a>.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DEFAULT CREDENTIALS CARD -->
                <div class="card feature-card border mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-dark mb-3">
                            <i class="mdi mdi-key-variant text-warning me-2"></i> Default Seeded Accounts
                        </h4>
                        <p class="text-muted font-14 mb-3">When seeded via <code>php spark db:seed DemoSeeder</code>, you can log in immediately using these default accounts:</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border">
                                    <span class="badge bg-danger-lighten text-danger mb-2">Administrator</span>
                                    <p class="mb-1 font-13"><strong>Email:</strong> <code>admin@chegejira.local</code></p>
                                    <p class="mb-0 font-13"><strong>Password:</strong> <code>secret</code></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border">
                                    <span class="badge bg-primary-lighten text-primary mb-2">Standard Developer</span>
                                    <p class="mb-1 font-13"><strong>Email:</strong> <code>dev@chegejira.local</code></p>
                                    <p class="mb-0 font-13"><strong>Password:</strong> <code>secret</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SYSTEM REQUIREMENTS -->
                <div class="card feature-card border">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-dark mb-3">
                            <i class="mdi mdi-check-network-outline text-success me-2"></i> System Requirements (Manual LAMP / VPS)
                        </h4>
                        <div class="row font-14 text-muted">
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="mdi mdi-check text-success me-1"></i> PHP 8.1 or PHP 8.2+</li>
                                    <li class="mb-2"><i class="mdi mdi-check text-success me-1"></i> PHP Extensions: <code>intl</code>, <code>mbstring</code>, <code>mysqli</code>, <code>curl</code></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="mdi mdi-check text-success me-1"></i> MySQL 8.0+ or MariaDB 10.5+</li>
                                    <li class="mb-2"><i class="mdi mdi-check text-success me-1"></i> Web Server: Nginx or Apache with <code>mod_rewrite</code></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->include('landing/footer') ?>

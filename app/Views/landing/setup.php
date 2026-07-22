<?= $this->include('landing/header') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="section-label">Setup Guide</div>
        <h1 class="section-title">Deploy in minutes</h1>
        <p class="section-subtitle" style="max-width: 700px;">Choose your path — Docker (recommended) or manual installation. Both methods get you a fully functional instance with all features enabled.</p>
    </div>
</section>

<!-- Docker Setup -->
<section>
    <div class="container">
        <h2 class="section-title" style="font-size: 1.75rem;"><i class="fab fa-docker me-2" style="color: var(--primary);"></i>Docker Setup (Recommended)</h2>
        <p class="section-subtitle" style="margin-bottom: 2rem;">Zero-configuration deployment. The entire stack — application, database, and database manager — launches with a single command.</p>

        <div class="setup-section p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-list-check me-2 text-primary"></i>Prerequisites</h5>
            <div class="row g-2 mb-4">
                <div class="col-md-4">
                    <div class="requirement-item"><i class="fab fa-docker"></i> Docker <span class="text-muted" style="font-size: 0.8rem;">&amp; Docker Compose</span></div>
                </div>
                <div class="col-md-4">
                    <div class="requirement-item"><i class="fab fa-git-alt"></i> Git</div>
                </div>
                <div class="col-md-4">
                    <div class="requirement-item"><i class="fas fa-globe"></i> Ports <code>9001</code> &amp; <code>9000</code> free</div>
                </div>
            </div>

            <h5 class="fw-bold mb-3"><i class="fas fa-terminal me-2 text-primary"></i>Step 1 — Clone & Configure</h5>
            <pre>git clone https://github.com/yourusername/chege-jira-webapp.git
cd "Chege Jira WebApp"
cp .env.example .env</pre>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-play me-2 text-primary"></i>Step 2 — Build & Launch</h5>
            <pre>docker compose up --build -d</pre>
            <p class="text-muted" style="font-size: 0.85rem;">The first build pulls PHP, MySQL, and phpMyAdmin images. Migrations run automatically on container boot.</p>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Step 3 — Access</h5>
            <p style="font-size: 0.9rem;">Once the containers are running, access your services at:</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="requirement-item" style="background: rgba(5, 150, 105, 0.05); border-color: rgba(5, 150, 105, 0.2);">
                        <i class="fas fa-globe" style="color: var(--success);"></i>
                        <div><strong>Application</strong><br><a href="http://localhost:9001" style="color: var(--success); text-decoration: none;">http://localhost:9001</a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="requirement-item" style="background: rgba(59, 130, 246, 0.05); border-color: rgba(59, 130, 246, 0.2);">
                        <i class="fas fa-database" style="color: var(--info);"></i>
                        <div><strong>phpMyAdmin</strong><br><a href="http://localhost:9000" style="color: var(--info); text-decoration: none;">http://localhost:9000</a></div>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-cube me-2 text-primary"></i>Services Overview</h5>
            <div class="table-responsive">
                <table class="table table-sm table-borderless text-muted" style="font-size: 0.85rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <th style="font-family: 'JetBrains Mono', monospace;">Service</th>
                            <th style="font-family: 'JetBrains Mono', monospace;">Image</th>
                            <th style="font-family: 'JetBrains Mono', monospace;">Port</th>
                            <th style="font-family: 'JetBrains Mono', monospace;">Persistence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><span class="badge bg-dark me-2">app</span> Application</td><td>PHP 8.3 + Apache</td><td><code>:9001</code></td><td>Bind mount — <code>writable/</code></td></tr>
                        <tr><td><span class="badge bg-dark me-2">mysql</span> Database</td><td>MySQL 8.4</td><td><code>:9306</code></td><td>Named volume — survives rebuilds</td></tr>
                        <tr><td><span class="badge bg-dark me-2">phpmyadmin</span> DB Manager</td><td>phpMyAdmin</td><td><code>:9000</code></td><td>Stateless</td></tr>
                    </tbody>
                </table>
            </div>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-book me-2 text-primary"></i>Useful Commands</h5>
            <pre>docker compose logs -f chege-jira     # Live application logs
docker compose restart chege-jira       # Restart app only
docker compose down                     # Stop all containers
docker compose down -v                  # Stop + delete volumes (⚠️ deletes DB)</pre>
        </div>
    </div>
</section>

<!-- Local Setup -->
<section style="background: var(--bg-card);">
    <div class="container">
        <h2 class="section-title" style="font-size: 1.75rem;"><i class="fas fa-laptop-code me-2" style="color: var(--primary);"></i>Manual Installation (No Docker)</h2>
        <p class="section-subtitle" style="margin-bottom: 2rem;">For environments where Docker is not available, or if you prefer a traditional LAMP/LEMP stack setup.</p>

        <div class="setup-section p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-list-check me-2 text-primary"></i>Prerequisites</h5>
            <div class="row g-2 mb-4">
                <div class="col-md-4"><div class="requirement-item"><i class="fab fa-php"></i> PHP 8.3+</div></div>
                <div class="col-md-4"><div class="requirement-item"><i class="fas fa-database"></i> MySQL 8+</div></div>
                <div class="col-md-4"><div class="requirement-item"><i class="fas fa-box"></i> Composer</div></div>
            </div>

            <h5 class="fw-bold mb-3"><i class="fas fa-terminal me-2 text-primary"></i>Installation Steps</h5>
            <pre>git clone https://github.com/yourusername/chege-jira-webapp.git
cd "Chege Jira WebApp"
composer install
cp .env.example .env</pre>

            <p class="mt-3" style="font-size: 0.9rem;">Edit <code>.env</code> and configure your database credentials:</p>
            <pre># .env
database.default.hostname = 127.0.0.1
database.default.database = db_chege_jira
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi</pre>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-arrow-right me-2 text-primary"></i>Run Migrations</h5>
            <pre>php spark migrate --all</pre>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-play me-2 text-primary"></i>Serve the Application</h5>
            <pre>php spark serve</pre>
            <p class="text-muted" style="font-size: 0.85rem;">The app will be available at <code>http://localhost:8080</code>. For production, point your web server (Apache/Nginx) to the <code>public/</code> directory.</p>
        </div>
    </div>
</section>

<!-- Quick Reference - Database -->
<section>
    <div class="container">
        <div class="text-center">
            <div class="section-label">Reference</div>
            <h2 class="section-title" style="font-size: 1.75rem;">Default Credentials & Configuration</h2>
            <p class="section-subtitle" style="max-width: 600px;">Default database credentials used by the Docker setup. Change these in production.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="setup-section p-4">
                    <table class="table table-sm table-borderless text-muted" style="font-size: 0.9rem;">
                        <tbody>
                            <tr><td style="font-family: 'JetBrains Mono', monospace; width: 120px;">Host</td><td><code>mysql</code></td></tr>
                            <tr><td style="font-family: 'JetBrains Mono', monospace;">Database</td><td><code>db_chege_jira</code></td></tr>
                            <tr><td style="font-family: 'JetBrains Mono', monospace;">Username</td><td><code>root</code></td></tr>
                            <tr><td style="font-family: 'JetBrains Mono', monospace;">Password</td><td><code>root_password</code></td></tr>
                            <tr><td style="font-family: 'JetBrains Mono', monospace;">Port</td><td><code>9306</code> (host) / <code>3306</code> (container)</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('landing/footer') ?>

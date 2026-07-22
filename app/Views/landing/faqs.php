<?= $this->include('landing/header') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="section-label">FAQs</div>
        <h1 class="section-title">Frequently Asked Questions</h1>
        <p class="section-subtitle" style="max-width: 600px;">Everything you need to know about deploying, using, and contributing to Chege JIRA.</p>
    </div>
</section>

<!-- FAQs -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Category: General -->
                <h5 class="fw-bold mb-3" style="font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; color: var(--primary);"><i class="fas fa-info-circle me-2"></i>General</h5>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>What is Chege JIRA?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Chege JIRA is a self-hosted, open-source project management platform built on CodeIgniter 4 and MySQL.
                        It includes project tracking, Kanban boards, time logging, notes, calendar events, analytics,
                        and full user settings — all running on your own infrastructure with Docker.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Do I need an internet connection to use it?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Only for the initial setup — cloning the repository, pulling Docker images, and loading CDN assets
                        (Bootstrap, Font Awesome, Google Fonts). Once deployed, the app runs entirely on your local network
                        or private server with no external dependencies.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>What license is this project under?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Chege JIRA is distributed under the <strong>MIT License</strong>. You are free to use, modify,
                        and distribute it for personal, educational, or commercial use. See the <code>LICENSE</code> file
                        for the full text.
                    </div>
                </div>

                <!-- Category: Deployment & Setup -->
                <h5 class="fw-bold mt-5 mb-3" style="font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; color: var(--primary);"><i class="fas fa-server me-2"></i>Deployment & Setup</h5>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I deploy with Docker?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Clone the repo, copy <code>.env.example</code> to <code>.env</code>, then run
                        <code>docker compose up --build -d</code>. The application, MySQL database, and phpMyAdmin
                        will start. Access the app at <a href="http://localhost:9001">http://localhost:9001</a>.
                        See the <a href="/setup">full setup guide</a> for details.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I persist my data across container restarts?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        The <code>docker-compose.yml</code> uses a named Docker volume for MySQL data storage and
                        bind-mounts for uploaded files. Your database records, uploaded avatars, session data, and
                        configuration survive container rebuilds, restarts, and <code>docker compose down</code>.
                        Only <code>docker compose down -v</code> will delete the database volume.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I run it without Docker?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes. You need PHP 8.3+, Composer, and MySQL 8+. Run <code>composer install</code>,
                        configure your <code>.env</code> file with local database credentials, execute
                        <code>php spark migrate --all</code>, and serve with <code>php spark serve</code>.
                        For production, point Apache or Nginx to the <code>public/</code> directory.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Which ports does the Docker setup use?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <code>:9001</code> for the application, <code>:9000</code> for phpMyAdmin, and
                        <code>:9306</code> for the MySQL database (host-facing). All ports can be customized
                        in <code>docker-compose.yml</code> if there are conflicts.
                    </div>
                </div>

                <!-- Category: Usage -->
                <h5 class="fw-bold mt-5 mb-3" style="font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; color: var(--primary);"><i class="fas fa-question-circle me-2"></i>Usage</h5>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I reset my password?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Visit the <a href="<?= site_url('auth/login') ?>">login page</a> and click "Forgot Password."
                        Enter your registered email address, and a password reset link will be sent to your inbox.
                        The reset token expires after one hour.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Is there multi-user or team support?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Currently the app supports individual accounts with full authentication (register, login,
                        email verification, password reset, account locking). Each user's projects, time logs, notes,
                        and settings are fully isolated. Multi-user project collaboration with shared workspaces
                        is planned for a future release.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I change the theme or accent color?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Once logged in, go to <strong>Settings → Appearance</strong>. You can toggle between
                        Dark and Light themes, pick an accent color (default is Red), adjust UI density, and
                        enable/disable animations. All preferences are saved to your account and persist across sessions.
                        You can also press <code>T</code> to toggle the theme from any page.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I export my data?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes. Go to <strong>Settings → Data Management</strong> to export your projects, time logs,
                        and notes as CSV or JSON files. You can also import previously exported data back into the
                        application. This gives you full control and portability of your information.
                    </div>
                </div>

                <!-- Category: Technical -->
                <h5 class="fw-bold mt-5 mb-3" style="font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; color: var(--primary);"><i class="fas fa-code me-2"></i>Technical</h5>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>What tech stack does Chege JIRA use?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <strong>Backend:</strong> PHP 8.3, CodeIgniter 4, CodeIgniter Shield (authentication).<br>
                        <strong>Database:</strong> MySQL 8.4 with automated migrations.<br>
                        <strong>Frontend:</strong> Bootstrap 5.3, jQuery, Font Awesome 6, Google Fonts (Space Grotesk + JetBrains Mono), SortableJS (Kanban drag-and-drop), FullCalendar (calendar view).<br>
                        <strong>Infrastructure:</strong> Docker &amp; Docker Compose, PHP-Apache container, phpMyAdmin for database management.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I contribute or report a bug?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Contributions are welcome! Fork the repository, create a feature branch, and open a pull request.
                        For bug reports or feature requests, please open an issue on the GitHub repository.
                        Ensure your changes work inside the Docker environment before submitting.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Where are uploaded files stored?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        User-uploaded files (profile avatars) are stored in <code>public/uploads/avatars/</code>.
                        This directory is excluded from version control via <code>.gitignore</code>.
                        In the Docker setup, it's bind-mounted to the host filesystem for persistence.
                        Logs, cache, and session files are stored in the <code>writable/</code> directory.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Still have questions? -->
<section style="background: var(--bg-card);">
    <div class="container text-center">
        <div class="section-label">Support</div>
        <h2 class="section-title" style="font-size: 1.75rem;">Still have questions?</h2>
        <p class="section-subtitle" style="max-width: 500px;">Check the documentation or open an issue on GitHub. We're happy to help.</p>
        <div class="hero-actions">
            <a href="<?= site_url('auth/register') ?>" class="btn-landing-primary"><i class="fas fa-rocket"></i> Get Started</a>
            <a href="/setup" class="btn-landing-secondary"><i class="fas fa-book"></i> Setup Guide</a>
        </div>
    </div>
</section>

<?= $this->include('landing/footer') ?>

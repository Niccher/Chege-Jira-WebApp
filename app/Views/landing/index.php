<?= $this->include('landing/header') ?>

<!-- Hero -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge"><i class="fas fa-cubes me-1"></i> v1.0 — Open Source</div>
        <h1>Own Your<br><span>Project Workflow</span></h1>
        <p>
            Chege JIRA is a self-hosted project management platform that puts you in control.
            Track projects, log time, organize tasks on a Kanban board, take notes, and analyze your
            productivity — all without leaving your infrastructure.
        </p>
        <div class="hero-actions">
            <a href="<?= site_url('auth/register') ?>" class="btn-landing-primary">
                <i class="fas fa-rocket"></i> Get Started Free
            </a>
            <a href="/features" class="btn-landing-secondary">
                <i class="fas fa-chevron-down"></i> Explore Features
            </a>
        </div>
    </div>
</section>

<!-- Features Overview -->
<section id="features">
    <div class="container">
        <div class="text-center">
            <div class="section-label">Features</div>
            <h2 class="section-title">Everything you need to ship</h2>
            <p class="section-subtitle">A complete project management toolkit designed for developers, teams, and power users who want full control over their data.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-project-diagram"></i></div>
                <h3>Project Management</h3>
                <p>Create, track, and manage projects with statuses, priorities, tech stacks, milestones, progress bars, and budget tracking.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-th"></i></div>
                <h3>Kanban Board</h3>
                <p>Drag-and-drop task management with customizable columns. Switch between projects, edit tasks inline, and move cards across stages.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <h3>Time Tracking</h3>
                <p>Start/stop timers or log hours manually. View daily, weekly, and monthly breakdowns with per-project distribution charts.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Calendar View</h3>
                <p>Visualize due dates, milestones, time logs, and events on an interactive FullCalendar. Create custom events with color labels.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-sticky-note"></i></div>
                <h3>Notes & Documentation</h3>
                <p>Write per-project notes with markdown-style content, tags, starring, and completion tracking. Soft-delete for safety.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Analytics & Insights</h3>
                <p>Real-time analytics dashboard with monthly trends, project health distribution, time breakdowns, activity heatmaps, and smart productivity insights.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-palette"></i></div>
                <h3>Full Customization</h3>
                <p>Dark/light theme toggle, accent color picker, sidebar collapse, density controls, and notification preferences — all persisted to your account.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-database"></i></div>
                <h3>Data Export & Import</h3>
                <p>Export your projects, time logs, and notes to CSV or JSON. Re-import data through the settings panel. You own your data.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/features" class="btn-landing-secondary">View All Features <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

<!-- How It Works -->
<section style="background: var(--bg-card);">
    <div class="container">
        <div class="text-center">
            <div class="section-label">How It Works</div>
            <h2 class="section-title">Get started in minutes</h2>
            <p class="section-subtitle">From zero to productive — no cloud registration, no vendor lock-in.</p>
        </div>
        <div class="steps">
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-download"></i></div>
                <h3>Deploy with Docker</h3>
                <p>Clone the repo, run <code style="background: rgba(255,255,255,0.05); padding: 0.15rem 0.4rem; font-family: 'JetBrains Mono', monospace;">docker compose up -d</code>, and the app boots with MySQL + phpMyAdmin.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-user-plus"></i></div>
                <h3>Create Your Account</h3>
                <p>Sign up with your name, email, and password. No third-party auth, no data leaving your server.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-folder-open"></i></div>
                <h3>Create Projects</h3>
                <p>Set up your first project with a name, description, tech stack, milestones, and priority level.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-tasks"></i></div>
                <h3>Build Your Workflow</h3>
                <p>Add tasks to your Kanban board, log time, write notes, and watch your productivity take shape.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/setup" class="btn-landing-primary"><i class="fas fa-book"></i> View Setup Guide</a>
        </div>
    </div>
</section>

<?= $this->include('landing/footer') ?>

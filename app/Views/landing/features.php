<?= $this->include('landing/header') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="section-label">Features</div>
        <h1 class="section-title">Everything Chege JIRA offers</h1>
        <p class="section-subtitle" style="max-width: 700px;">Every feature is designed to help you stay organized, track your time, and ship faster — all from a self-hosted platform you control.</p>
    </div>
</section>

<!-- Detailed Features -->
<section>
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-project-diagram"></i></div>
                <h3>Project Management</h3>
                <p>Full project lifecycle tracking with statuses (planning, in progress, testing, completed, on hold, abandoned). Set priorities from low to critical, attach tech stacks and categories, define milestones with progress, and track budgets. All projects are paginated and filterable.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-th"></i></div>
                <h3>Kanban Board</h3>
                <p>Four-column drag-and-drop board (To Do, In Progress, Review, Done) powered by SortableJS. Switch between projects with a dropdown, create tasks inline, edit title/description/priority/due date via modal, and move cards with real-time position persistence.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <h3>Time Tracking</h3>
                <p>Start/stop timers with AJAX or log hours manually. View today/week/month stats with average daily hours. Per-project breakdown shows where your time goes. Timer runs server-side — no data loss on page refresh.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Calendar View</h3>
                <p>FullCalendar.js integration displays project due dates, milestones, time logs, notes, and manual events in one unified view. Monthly stats, upcoming events list, and project distribution all update in real time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-sticky-note"></i></div>
                <h3>Notes & Documentation</h3>
                <p>Write per-project notes with titles, content, and tags (stored as JSON). Star important notes, mark as completed, or soft-delete. Stats show total, starred, completed, and deleted counts. Paginated for long lists.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Analytics & Insights</h3>
                <p>Dashboard with monthly trends (6-month started vs completed), project health distribution (good/warning/danger/archived), top 5 projects by time logged, 30-day activity heatmap, and smart insights (overdue warnings, stalled projects, recent completions).</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-palette"></i></div>
                <h3>Appearance & Preferences</h3>
                <p>Toggle between dark and light themes with a single click or press <code>T</code>. Choose your accent color (default: Red). Sidebar collapse with <code>S</code> key. All preferences — including notification settings, kanban defaults, timer prefs, and weekly goals — persist to your account via the preferences JSON column.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-user-cog"></i></div>
                <h3>User Settings</h3>
                <p>Full settings panel: profile details (first name, last name, bio), avatar upload, timezone (full PHP list), date format, appearance, email notifications, in-app alerts, project defaults, kanban layout, timer behavior, and weekly/daily goal hours.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-database"></i></div>
                <h3>Data Export & Import</h3>
                <p>Export your projects, time logs, and notes to CSV or JSON. Import data back through the settings interface. You maintain full ownership of your data with no vendor lock-in.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Authentication & Security</h3>
                <p>CodeIgniter Shield integration with register, login, forgot/reset password, email verification, and account locking. CSRF protection on all forms. Password validation with composition and personal-information checks.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-keyboard"></i></div>
                <h3>Keyboard Shortcuts</h3>
                <p>Power-user shortcuts: press <code>T</code> to toggle dark/light theme, <code>S</code> to toggle sidebar collapse. More shortcuts planned. All while respecting input fields so you can type normally.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-sync-alt"></i></div>
                <h3>Activity Timeline</h3>
                <p>The dashboard's recent activity feed shows project creation, completion, archival, milestone updates, note additions, and more — all color-coded by type with relative timestamps.</p>
            </div>
        </div>
    </div>
</section>

<?= $this->include('landing/footer') ?>

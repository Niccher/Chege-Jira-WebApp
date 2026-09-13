<?= $this->include('landing/header') ?>

<!-- Hero -->
<div class="jumbotron jumbotron-ace">
    <div class="container">
        <span class="label label-success arrowed-in arrowed-in-right" style="margin-bottom: 20px; font-size: 14px; padding: 5px 10px;">v1.0 — Open Source</span>
        <h1>Own Your Project Workflow</h1>
        <p>
            Chege OS is a self-hosted project management platform that puts you in control.
            Track projects, log time, organize tasks on a Kanban board, take notes, and analyze your
            productivity — all without leaving your infrastructure.
        </p>
        <p>
            <a href="<?= site_url('auth/register') ?>" class="btn btn-primary btn-lg btn-round">
                <i class="fa fa-rocket"></i> Get Started Free
            </a>
            <a href="/features" class="btn btn-default btn-lg btn-round" style="margin-left: 10px;">
                <i class="fa fa-chevron-down"></i> Explore Features
            </a>
        </p>
    </div>
</div>

<!-- Features Overview -->
<div class="container" style="background-color: #f5f7fa; padding-bottom: 50px;">
    <div class="section-header">
        <h2>Everything you need to ship</h2>
        <p>A complete project management toolkit designed for developers, teams, and power users who want full control over their data.</p>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-sitemap"></i></div>
                <h3>Project Management</h3>
                <p>Create, track, and manage projects with statuses, priorities, tech stacks, milestones, progress bars, and budget tracking.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-th"></i></div>
                <h3>Kanban Board</h3>
                <p>Drag-and-drop task management with customizable columns. Switch between projects, edit tasks inline, and move cards across stages.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <h3>Time Tracking</h3>
                <p>Start/stop timers or log hours manually. View daily, weekly, and monthly breakdowns with per-project distribution charts.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-calendar"></i></div>
                <h3>Calendar View</h3>
                <p>Visualize due dates, milestones, time logs, and events on an interactive FullCalendar. Create custom events with color labels.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-file-text"></i></div>
                <h3>Notes & Documentation</h3>
                <p>Write per-project notes with markdown-style content, tags, starring, and completion tracking. Soft-delete for safety.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-bar-chart"></i></div>
                <h3>Analytics & Insights</h3>
                <p>Generate visual reports of time spent across projects, active hours over time, and team productivity using Chart.js.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

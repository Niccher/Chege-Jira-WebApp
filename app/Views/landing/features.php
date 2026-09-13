<?= $this->include('landing/header') ?>

<div class="jumbotron jumbotron-ace" style="padding: 40px 0; background-color: #f4f6f9; border-bottom: 1px solid #e2e8f0; text-align: center;">
    <div class="container">
        <h1>Everything you need to ship software</h1>
        <p>A deep dive into everything <?= esc(setting('App.siteName')) ?> can do for your agile team.</p>
    </div>
</div>

<div class="container" style="padding: 40px 0;">
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-md-6">
            <h3><i class="ace-icon fa fa-sitemap blue"></i> Projects & Epics</h3>
            <p>
                Group your work into manageable pieces. Create projects to represent distinct applications or teams. 
                Use Epics to group related stories and bugs together, providing a high-level view of major feature initiatives.
                Set strict deadlines, assign project leads, and track budget utilization.
            </p>
        </div>
        <div class="col-md-6">
            <h3><i class="ace-icon fa fa-columns blue"></i> Interactive Kanban</h3>
            <p>
                Say goodbye to clunky lists. Our drag-and-drop Kanban board allows you to visually transition 
                work through your workflow. Instantly see blockers, assignees, and issue priorities without opening 
                a single ticket.
            </p>
        </div>
    </div>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col-md-6">
            <h3><i class="ace-icon fa fa-users blue"></i> Role-Based Permissions</h3>
            <p>
                Ensure data security with strict Role-Based Access Control (RBAC). 
                <strong>Administrators</strong> have full system access, <strong>Managers</strong> can assign work and view reports, 
                and <strong>Team Members</strong> are scoped strictly to executing tasks and logging time.
            </p>
        </div>
        <div class="col-md-6">
            <h3><i class="ace-icon fa fa-bar-chart blue"></i> Velocity & Reporting</h3>
            <p>
                Out-of-the-box reporting gives you insights into team velocity, time spent per epic, and sprint burndown. 
                Export reports to PDF for stakeholder meetings, or view real-time charts directly on your dashboard.
            </p>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-12">
            <hr>
            <h2>Ready to transform your workflow?</h2>
            <div class="space-12"></div>
            <a href="<?= site_url('auth/register') ?>" class="btn btn-primary btn-lg btn-round">
                <i class="ace-icon fa fa-rocket"></i> Get Started Free
            </a>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

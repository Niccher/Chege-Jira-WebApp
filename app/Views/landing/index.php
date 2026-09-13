<?= $this->include('landing/header') ?>

<!-- Hero -->
<div class="jumbotron jumbotron-ace">
    <div class="container">
        <span class="label label-success arrowed-in arrowed-in-right" style="margin-bottom: 20px; font-size: 14px; padding: 5px 10px;">v1.0 — Open Source Agile</span>
        <h1>Move fast, stay aligned, and build better.</h1>
        <p>
            <?= esc(setting('App.siteName')) ?> is the #1 software development tool used by agile teams.
            Plan, track, and release world-class software. Manage your backlog, run sprints, and log time 
            on an interactive Kanban board designed for speed and scale.
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
<div class="container" style="background-color: #f4f6f9; padding-bottom: 50px;">
    <div class="section-header">
        <h2>Built for every phase of your software lifecycle</h2>
        <p>Whether you're a startup or an enterprise, <?= esc(setting('App.siteName')) ?> provides the tools you need to ship high-quality products.</p>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-tasks"></i></div>
                <h3>Agile Project Management</h3>
                <p>Plan your work in Epics, Stories, and Tasks. Assign priorities, story points, and track progress using burn-down metrics.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-columns"></i></div>
                <h3>Kanban & Scrum Boards</h3>
                <p>Visualize your workflow. Move issues from 'To Do' to 'Done' seamlessly. Customize board columns to match your exact agile process.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-bug"></i></div>
                <h3>Issue & Bug Tracking</h3>
                <p>Capture, prioritize, and assign bugs as they happen. Link bugs directly to source code commits and pull requests for deep traceability.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <h3>Time Logging & Estimates</h3>
                <p>Track time spent on individual issues. Compare original estimates against logged time to improve team velocity predictions.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-shield"></i></div>
                <h3>Role-Based Access</h3>
                <p>Control exactly who sees what with granular permissions for Administrators, Project Managers, and Team Members.</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="feature-box">
                <div class="icon"><i class="fa fa-bar-chart"></i></div>
                <h3>Custom Reports</h3>
                <p>Generate visual reports on sprint velocity, workload distribution, and resolution times to keep your stakeholders informed.</p>
            </div>
        </div>
    </div>
</div>


<!-- Open Source Philosophy -->
<div class="container" style="padding-top: 50px; padding-bottom: 50px; border-top: 1px solid #e2e8f0;">
    <div class="section-header">
        <h2>Open Source by design. Private by default.</h2>
        <p>Why pay per-seat licensing fees when you can own your data and your infrastructure?</p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3 style="color: #2679b5;"><i class="fa fa-lock"></i> 100% Data Ownership</h3>
            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                When you use cloud SaaS trackers, your proprietary code, bug reports, and unreleased feature plans live on someone else's servers. 
                With <?= esc(setting('App.siteName')) ?>, you host it yourself. Your data never leaves your infrastructure, and no AI models will scrape your confidential issues.
            </p>
        </div>
        <div class="col-md-6">
            <h3 style="color: #2679b5;"><i class="fa fa-users"></i> Unlimited Seats ($0)</h3>
            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                Enterprise SaaS trackers charge you exorbitant fees for every single user you add to your team. 
                <?= esc(setting('App.siteName')) ?> scales with you for free. Add 10 users or 10,000 users. Your monthly cost remains exactly $0.
            </p>
        </div>
    </div>
    
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-6">
            <h3 style="color: #2679b5;"><i class="fa fa-code"></i> Extensible & Transparent</h3>
            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                Missing a feature? You don't have to wait years for a corporate product roadmap to catch up. 
                Because the codebase is open-source (PHP 8 + CodeIgniter 4), your developers can easily audit the code, write custom plugins, or modify the core to fit your exact workflow.
            </p>
        </div>
        <div class="col-md-6">
            <h3 style="color: #2679b5;"><i class="fa fa-external-link"></i> No Vendor Lock-In</h3>
            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                We don't trap your data. You have direct access to the MySQL/PostgreSQL database. 
                Export your issues to CSV, JSON, or SQL at any time. If you decide to migrate away, you can do so freely.
            </p>
        </div>
    </div>
    
    <div class="text-center" style="margin-top: 40px;">
        <a href="/compare" class="btn btn-default btn-lg btn-round">See how we compare to Enterprise Trackers <i class="fa fa-arrow-right"></i></a>
    </div>
</div>


<?= $this->include('landing/footer') ?>

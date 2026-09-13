<?= $this->include('landing/header') ?>

<div class="jumbotron jumbotron-ace" style="padding: 40px 0;">
    <div class="container">
        <h1>All Features</h1>
        <p>A deep dive into everything Chege OS can do for you.</p>
    </div>
</div>

<div class="container" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h2 class="header smaller lighter blue">Project Management</h2>
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled spaced">
                        <li><i class="ace-icon fa fa-check green"></i> Create and organize unlimited projects</li>
                        <li><i class="ace-icon fa fa-check green"></i> Track project statuses (Planning, Active, Completed, On Hold)</li>
                        <li><i class="ace-icon fa fa-check green"></i> Assign tech stacks (e.g., LAMP, MERN, Go, Python)</li>
                        <li><i class="ace-icon fa fa-check green"></i> Set and monitor project budgets and actual cost</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled spaced">
                        <li><i class="ace-icon fa fa-check green"></i> Track milestones and deadlines</li>
                        <li><i class="ace-icon fa fa-check green"></i> Progress bars derived from completed tasks</li>
                        <li><i class="ace-icon fa fa-check green"></i> Markdown-supported project descriptions</li>
                        <li><i class="ace-icon fa fa-check green"></i> Archive old or completed projects</li>
                    </ul>
                </div>
            </div>

            <div class="space-12"></div>

            <h2 class="header smaller lighter blue">Task & Kanban Management</h2>
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled spaced">
                        <li><i class="ace-icon fa fa-check green"></i> Interactive Drag-and-Drop Kanban Board</li>
                        <li><i class="ace-icon fa fa-check green"></i> Standard columns (To Do, In Progress, Review, Done)</li>
                        <li><i class="ace-icon fa fa-check green"></i> Edit task titles, descriptions, and priorities inline</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled spaced">
                        <li><i class="ace-icon fa fa-check green"></i> Visual priority indicators (Low, Medium, High, Urgent)</li>
                        <li><i class="ace-icon fa fa-check green"></i> Assign tasks to specific projects</li>
                        <li><i class="ace-icon fa fa-check green"></i> Track individual task completion</li>
                    </ul>
                </div>
            </div>

            <div class="space-12"></div>
            
            <h2 class="header smaller lighter blue">Time Tracking & Analytics</h2>
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled spaced">
                        <li><i class="ace-icon fa fa-check green"></i> Built-in timer (Start/Stop/Pause)</li>
                        <li><i class="ace-icon fa fa-check green"></i> Manual time entry for past work</li>
                        <li><i class="ace-icon fa fa-check green"></i> Link time logs directly to projects</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled spaced">
                        <li><i class="ace-icon fa fa-check green"></i> Visual analytics dashboard with charts</li>
                        <li><i class="ace-icon fa fa-check green"></i> Time distribution by project (Pie Chart)</li>
                        <li><i class="ace-icon fa fa-check green"></i> Activity trends over the last 30 days</li>
                    </ul>
                </div>
            </div>
            
            <div class="space-24"></div>
            
            <div class="center">
                <a href="<?= site_url('auth/register') ?>" class="btn btn-primary btn-round btn-lg">
                    <i class="ace-icon fa fa-rocket"></i> Get Started with Chege OS
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

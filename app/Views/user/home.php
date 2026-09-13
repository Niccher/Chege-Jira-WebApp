<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
    <li class="active">Dashboard</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page header -->
<div class="row">
    <div class="col-12">
        <h3 class="header smaller lighter blue">
            <i class="ace-icon fa fa-tachometer"></i>
            Dashboard
            <a href="<?= site_url('projects/create') ?>" class="btn btn-sm btn-primary float-end">
                <i class="ace-icon fa fa-plus"></i>
                New Project
            </a>
        </h3>
        <div class="hr hr-8 dotted"></div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card transparent">
            <div class="card-header card-header-flat">
                <h5 class="widget-title smaller">
                    <i class="ace-icon fa fa-folder-open blue"></i>
                    Total Projects
                </h5>
            </div>
            <div class="card-body">
                <div class="p-3 padding-4">
                    <span class="stat-value blue"><?= $stats['total'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="card transparent">
            <div class="card-header card-header-flat">
                <h5 class="widget-title smaller">
                    <i class="ace-icon fa fa-play-circle green"></i>
                    Active Projects
                </h5>
            </div>
            <div class="card-body">
                <div class="p-3 padding-4">
                    <span class="stat-value green"><?= $stats['active'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="card transparent">
            <div class="card-header card-header-flat">
                <h5 class="widget-title smaller">
                    <i class="ace-icon fa fa-clock-o orange"></i>
                    Pending
                </h5>
            </div>
            <div class="card-body">
                <div class="p-3 padding-4">
                    <span class="stat-value orange"><?= $stats['pending'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="card transparent">
            <div class="card-header card-header-flat">
                <h5 class="widget-title smaller">
                    <i class="ace-icon fa fa-archive grey"></i>
                    Archived
                </h5>
            </div>
            <div class="card-body">
                <div class="p-3 padding-4">
                    <span class="stat-value grey"><?= $stats['archived'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row stats -->

<div class="hr hr-dotted"></div>

<!-- Main content row -->
<div class="row">
    <!-- Left: Recent Projects -->
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-folder-open-o"></i>
                    Recent Projects
                </h5>
                <div class="widget-toolbar">
                    <a href="<?= site_url('projects') ?>" class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-list"></i> All Projects
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="p-3">
                    <?php if (!empty($projects)): ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $project): ?>
                            <tr>
                                <td>
                                    <a href="<?= site_url('projects/view/' . $project->id) ?>">
                                        <?= esc($project->name) ?>
                                    </a>
                                    <?php if ($project->description): ?>
                                        <br/><small class="lighter"><?= esc(substr($project->description, 0, 60)) ?>...</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $badgeClass = match($project->status ?? 'active') {
                                        'active'   => 'badge-success',
                                        'pending'  => 'badge-warning',
                                        'done'     => 'badge-primary',
                                        'archived' => 'badge-inverse',
                                        default    => 'badge-info',
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= ucfirst($project->status ?? 'active') ?></span>
                                </td>
                                <td><small><?= date('M d, Y', strtotime($project->updated_at)) ?></small></td>
                                <td>
                                    <a href="<?= site_url('projects/view/' . $project->id) ?>" class="btn btn-xs btn-primary">
                                        <i class="ace-icon fa fa-eye"></i>
                                    </a>
                                    <a href="<?= site_url('projects/kanban/' . $project->id) ?>" class="btn btn-xs btn-success">
                                        <i class="ace-icon fa fa-columns"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="ace-icon fa fa-info-circle"></i>
                            No projects yet. <a href="<?= site_url('projects/create') ?>">Create your first project</a>.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Recent Activity -->
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-history orange"></i>
                    Recent Activity
                </h5>
            </div>
            <div class="card-body">
                <div class="p-3 padding-0">
                    <?php if (!empty($recentActivity)): ?>
                    <ul class="list-unstyled spaced timeline-style2 padding-16">
                        <?php foreach ($recentActivity as $act): ?>
                        <li class="clearfix">
                            <div class="time-label">
                                <span class="label label-info"><?= date('M d', strtotime($act['time'])) ?></span>
                            </div>
                            <div class="timeline-details">
                                <i class="ace-icon fa <?= $act['icon'] ?> purple"></i>
                                <span class="action-name"><?= esc($act['title']) ?></span>
                                <p class="lighter"><?= esc($act['description']) ?></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?>
                        <div class="padding-16">
                            <div class="alert alert-info margin-0">
                                <i class="ace-icon fa fa-info-circle"></i>
                                No recent activity.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | Chege JIRA</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Bootstrap 3 & Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/fonts.googleapis.com.css') ?>" />

    <!-- Ace Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/ace.min.css') ?>" />

    <!-- Page-specific styles -->
    <?= $this->renderSection('head') ?>
</head>

<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="login-container">
                        <div class="center">
                            <h1>
                                <i class="ace-icon fa fa-cubes blue"></i>
                                <span class="blue bolder">Chege</span>
                                <span class="white" id="id-text2">JIRA</span>
                            </h1>
                            <h4 class="blue lighter" id="id-company-text">Project Management</h4>
                        </div>

                        <?= $this->renderSection('main_content') ?>

                    </div><!-- /.login-container -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.main-content -->
    </div><!-- /.main-container -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/ace/js/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/ace/js/bootstrap.min.js') ?>"></script>

    <!-- Page-specific scripts -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>

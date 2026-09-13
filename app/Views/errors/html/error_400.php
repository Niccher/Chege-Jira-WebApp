<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>400 Error | Chege Jira</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="<?= base_url('assets/ace/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/fonts.googleapis.com.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/ace.min.css') ?>" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= base_url('assets/css/modern-ace.css') ?>" />
</head>
<body class="no-skin">
    <div class="main-container ace-save-state" id="main-container">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="error-container">
                                <div class="well">
                                    <h1 class="grey lighter smaller">
                                        <span class="blue bigger-125">
                                            <i class="ace-icon fa fa-exclamation-triangle"></i>
                                            400
                                        </span>
                                        Bad Request
                                    </h1>

                                    <hr />
                                    <h3 class="lighter smaller">
                                        The request could not be understood by the server due to malformed syntax.
                                    </h3>
                                    
                                    <div class="space"></div>

                                    <div class="center">
                                        <a href="javascript:history.back()" class="btn btn-grey">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            Go Back
                                        </a>

                                        <a href="<?= base_url() ?>" class="btn btn-primary">
                                            <i class="ace-icon fa fa-tachometer"></i>
                                            Dashboard
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- PAGE CONTENT ENDS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

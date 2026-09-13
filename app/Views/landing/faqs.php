<?= $this->include('landing/header') ?>

<div class="jumbotron jumbotron-ace" style="padding: 40px 0;">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <p>Everything you need to know about Chege OS.</p>
    </div>
</div>

<div class="container" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <!-- #section:elements.accordion -->
            <div id="accordion" class="accordion-style1 panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#faq-1">
                                <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;Is Chege OS free?
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="faq-1">
                        <div class="panel-body">
                            Yes! Chege OS is 100% free and open-source. You can download the source code, inspect it, modify it, and run it on your own server without any licensing fees or subscriptions.
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq-2">
                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;What technologies are used?
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="faq-2">
                        <div class="panel-body">
                            Chege OS is built on a modern, lightweight, and robust stack:
                            <ul class="spaced">
                                <li><strong>Backend:</strong> CodeIgniter 4.6.4 (PHP 8.1+)</li>
                                <li><strong>Database:</strong> MySQL 8.0 or PostgreSQL</li>
                                <li><strong>Frontend:</strong> Ace Admin Theme (Bootstrap 3), jQuery, FontAwesome</li>
                                <li><strong>Auth:</strong> CodeIgniter Shield (Session-based, Magic Links, 2FA ready)</li>
                                <li><strong>Deployment:</strong> Docker & Docker Compose</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq-3">
                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;How do I install Chege OS?
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="faq-3">
                        <div class="panel-body">
                            The easiest way is using Docker. Clone the repository, configure your <code>.env</code> file, and run <code>docker-compose up -d</code>. 
                            Check our <a href="/setup">Setup Guide</a> for step-by-step instructions.
                        </div>
                    </div>
                </div>
            </div>
            <!-- /section:elements.accordion -->
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

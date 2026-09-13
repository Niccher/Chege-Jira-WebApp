<?= $this->include('landing/header') ?>

<div class="jumbotron jumbotron-ace" style="padding: 40px 0;">
    <div class="container">
        <h1>Setup Guide</h1>
        <p>Deploy <?= esc(setting('App.siteName')) ?> to your own server in minutes.</p>
    </div>
</div>

<div class="container" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title lighter">Docker Installation (Recommended)</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-16">
                        <p>The fastest and most reliable way to run <?= esc(setting('App.siteName')) ?> is using Docker and Docker Compose.</p>
                        
                        <ol class="spaced">
                            <li>
                                <strong>Clone the repository</strong>
                                <pre style="margin-top:10px;">git clone https://github.com/Niccher/Chege-Jira-WebApp.git
cd Chege-Jira-WebApp</pre>
                            </li>
                            <li>
                                <strong>Configure Environment</strong>
                                <br/>Copy the example environment file and update your variables (Database credentials, SMTP for emails).
                                <pre style="margin-top:10px;">cp env .env</pre>
                            </li>
                            <li>
                                <strong>Build and Run</strong>
                                <pre style="margin-top:10px;">docker-compose up -d --build</pre>
                            </li>
                            <li>
                                <strong>Database Migrations</strong>
                                <br/>The Docker container will automatically run <code>php spark migrate</code> on startup.
                            </li>
                        </ol>
                        
                        <hr />
                        
                        <h4 class="blue">Default Admin Account</h4>
                        <p>After a fresh installation, you can login with the default admin credentials (if seeded):</p>
                        <ul>
                            <li><strong>Email:</strong> admin@example.com</li>
                            <li><strong>Password:</strong> admin_password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

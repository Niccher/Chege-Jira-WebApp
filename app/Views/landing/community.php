<?= $this->include('landing/header') ?>

<div class="jumbotron jumbotron-ace" style="padding: 40px 0; background-color: #f4f6f9; border-bottom: 1px solid #e2e8f0; text-align: center;">
    <div class="container">
        <h1>Join the <?= esc(setting('App.siteName')) ?> Community</h1>
        <p>We believe in building software in the open. Here's how you can get involved.</p>
    </div>
</div>

<div class="container" style="padding: 50px 0; min-height: 50vh;">
    <div class="row">
        <div class="col-md-4">
            <div class="feature-box text-center">
                <div class="icon"><i class="fa fa-github" style="color: #333;"></i></div>
                <h3>Contribute Code</h3>
                <p>
                    <?= esc(setting('App.siteName')) ?> is open-source and hosted on GitHub. We welcome pull requests 
                    for bug fixes, new features, and UI improvements.
                </p>
                <a href="https://github.com/Niccher/Chege-Jira-WebApp" target="_blank" class="btn btn-default btn-round" style="margin-top: 15px;">
                    View Repository
                </a>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-box text-center">
                <div class="icon"><i class="fa fa-bug" style="color: #d15b47;"></i></div>
                <h3>Report Bugs</h3>
                <p>
                    Found a bug or have a feature request? Let us know! The best way to get our attention is to 
                    file an issue on our GitHub issue tracker.
                </p>
                <a href="https://github.com/Niccher/Chege-Jira-WebApp/issues" target="_blank" class="btn btn-default btn-round" style="margin-top: 15px;">
                    Open an Issue
                </a>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-box text-center">
                <div class="icon"><i class="fa fa-balance-scale" style="color: #438eb9;"></i></div>
                <h3>Open License</h3>
                <p>
                    <?= esc(setting('App.siteName')) ?> is distributed under the <strong>MIT License</strong>. 
                    You are completely free to use, modify, and distribute it for both personal and commercial use.
                </p>
                <a href="https://github.com/Niccher/Chege-Jira-WebApp/blob/master/LICENSE" target="_blank" class="btn btn-default btn-round" style="margin-top: 15px;">
                    Read License
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

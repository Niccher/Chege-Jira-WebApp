<?= $this->include('landing/header') ?>

<div class="jumbotron jumbotron-ace" style="padding: 40px 0; background-color: #f4f6f9; border-bottom: 1px solid #e2e8f0; text-align: center;">
    <div class="container">
        <h1><?= esc(setting('App.siteName')) ?> vs. Enterprise SaaS Trackers</h1>
        <p>Why modern engineering teams are ditching bloated cloud trackers for self-hosted agility.</p>
    </div>
</div>

<div class="container" style="padding: 50px 0; min-height: 50vh;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-striped table-bordered" style="font-size: 16px; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <thead style="background: #438eb9; color: #fff;">
                    <tr>
                        <th style="padding: 15px; width: 33%;">Feature</th>
                        <th style="padding: 15px; width: 33%; text-align: center;"><?= esc(setting('App.siteName')) ?></th>
                        <th style="padding: 15px; width: 33%; text-align: center;">Legacy SaaS Trackers</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 15px; font-weight: bold;">Pricing Model</td>
                        <td style="padding: 15px; text-align: center; color: #87b87f; font-weight: bold;">100% Free, Forever</td>
                        <td style="padding: 15px; text-align: center; color: #d15b47;">Expensive (Per User / Per Month)</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; font-weight: bold;">Data Privacy</td>
                        <td style="padding: 15px; text-align: center;">You own your data (Self-hosted)</td>
                        <td style="padding: 15px; text-align: center;">Data lives on their servers</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; font-weight: bold;">Performance</td>
                        <td style="padding: 15px; text-align: center;">Lightning Fast (Lightweight PHP/MySQL)</td>
                        <td style="padding: 15px; text-align: center;">Often slow and bloated</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; font-weight: bold;">Vendor Lock-in</td>
                        <td style="padding: 15px; text-align: center;">None. Full SQL Database Access.</td>
                        <td style="padding: 15px; text-align: center;">High. Difficult to export full data.</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; font-weight: bold;">Customizability</td>
                        <td style="padding: 15px; text-align: center;">Open Source Codebase. Modify anything.</td>
                        <td style="padding: 15px; text-align: center;">Limited to provided APIs/plugins.</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; font-weight: bold;">Core Features</td>
                        <td style="padding: 15px; text-align: center;">Kanban, Time Tracking, Notes, RBAC</td>
                        <td style="padding: 15px; text-align: center;">Kanban, Time Tracking, Notes, RBAC</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="text-center" style="margin-top: 40px;">
                <p style="font-size: 18px; color: #555;">Ready to take back control of your workflow?</p>
                <a href="<?= site_url('auth/register') ?>" class="btn btn-primary btn-lg btn-round">
                    <i class="ace-icon fa fa-rocket"></i> Get Started Free
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('landing/footer') ?>

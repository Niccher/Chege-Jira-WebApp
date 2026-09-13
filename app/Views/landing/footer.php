<footer class="public-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 style="color: #fff; margin-bottom: 20px;"><i class="fa fa-leaf"></i> <?= esc(setting('App.siteName')) ?></h4>
                <p>The self-hosted project management platform.</p>
                <div style="margin-top: 20px;">
                    <a href="https://github.com/Niccher" target="_blank" style="margin: 0 10px; font-size: 24px;"><i class="fa fa-github"></i></a>
                </div>
                <hr style="border-color: #444; margin: 20px 0;">
                <p class="mb-0">&copy; <?= date('Y') ?> <?= esc(setting('App.siteName')) ?>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery and Bootstrap JS -->
<script src="<?= base_url('assets/ace/js/jquery-2.1.4.min.js') ?>"></script>
<script src="<?= base_url('assets/ace/js/bootstrap.min.js') ?>"></script>
</body>
</html>

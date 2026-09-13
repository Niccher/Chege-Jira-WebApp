    <!-- FOOTER START -->
    <footer class="bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="text-white mb-3"><i class="mdi mdi-leaf"></i> <?= esc(setting('App.siteName')) ?></h4>
                    <p class="text-muted w-75">Self-hosted, open-source project management platform built for modern agile teams.</p>
                </div>
                <div class="col-lg-2 col-md-4 mt-4 mt-lg-0">
                    <h5 class="text-white mb-3">Product</h5>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><a href="<?= site_url('features') ?>" class="text-muted">Features</a></li>
                        <li><a href="<?= site_url('compare') ?>" class="text-muted">Compare</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mt-4 mt-lg-0">
                    <h5 class="text-white mb-3">Resources</h5>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><a href="<?= site_url('setup') ?>" class="text-muted">Setup Guide</a></li>
                        <li><a href="<?= site_url('faqs') ?>" class="text-muted">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mt-4 mt-lg-0">
                    <h5 class="text-white mb-3">Open Source</h5>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><a href="<?= site_url('community') ?>" class="text-muted">Community</a></li>
                        <li><a href="https://github.com" target="_blank" class="text-muted">GitHub</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted mb-0">&copy; <?= date('Y') ?> <?= esc(setting('App.siteName')) ?>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- bundle -->
    <script src="<?= base_url('assets/hyper/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('assets/hyper/js/app.min.js') ?>"></script>
</body>
</html>

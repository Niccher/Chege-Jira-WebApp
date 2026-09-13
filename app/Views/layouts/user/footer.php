        </div> <!-- /.container-fluid -->
    </main> <!-- /.content -->
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row text-muted">
                <div class="col-6 text-start">
                    <p class="mb-0">
                        <a href="https://chegejira.app" target="_blank" class="text-muted"><strong>Chege JIRA</strong></a> &copy; <?= date('Y') ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div> <!-- /.main -->
</div> <!-- /.wrapper -->

<script src="<?= base_url('assets/js/app.js') ?>"></script>

<!-- Theme Switcher Logic for Authenticated Layout -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const themeBtn = document.getElementById('themeToggle');
        const icon = themeBtn.querySelector('i');
        const stylesheet = document.getElementById('theme-stylesheet');
        
        // Sync icon on load
        const currentTheme = localStorage.getItem('theme') || 'dark';
        if (currentTheme === 'light') {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }

        themeBtn.addEventListener('click', function() {
            let activeTheme = localStorage.getItem('theme') || 'dark';
            let nextTheme = activeTheme === 'dark' ? 'light' : 'dark';
            
            // Swap stylesheet
            stylesheet.href = `<?= base_url('assets/css') ?>/${nextTheme}.css`;
            
            // Swap icon
            if (nextTheme === 'dark') {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
            
            localStorage.setItem('theme', nextTheme);
        });
    });
</script>

</body>
</html>
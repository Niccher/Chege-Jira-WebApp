</div> <!-- Close main-content -->

    <!-- Footer -->
    <footer class="text-center small text-muted border-top">
        <div class="container-fluid font-mono">
            Chege Jira WebApp • v1 • <span id="currentDate"></span>
        </div>
    </footer>
</div> <!-- Close wrapper -->

<!-- Custom Scripts -->

<script>
    $(document).ready(function() {
        // Set current date in footer
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        $('#currentDate').text(now.toLocaleDateString('en-US', options));

        // Sidebar toggle function
        function toggleSidebar() {
            $('#sidebar').toggleClass('sidebar-collapsed');
            $('#mainContent').toggleClass('full-width');

            const isCollapsed = $('#sidebar').hasClass('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);

            // Toggle icons on all toggle buttons
            $('.sidebar-toggle-icon').each(function() {
                if (isCollapsed) {
                    $(this).removeClass('fa-bars').addClass('fa-chevron-right');
                } else {
                    $(this).removeClass('fa-chevron-right').addClass('fa-bars');
                }
            });
        }

        // Sidebar toggle from top bar
        $('#sidebarToggle').click(function() {
            toggleSidebar();
            const icon = $(this).find('i');
            if ($('#sidebar').hasClass('sidebar-collapsed')) {
                icon.removeClass('fa-bars').addClass('fa-chevron-right');
            } else {
                icon.removeClass('fa-chevron-right').addClass('fa-bars');
            }
            $(document).trigger('sidebar:toggle');
        });

        // Check saved sidebar state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            $('#sidebar').addClass('sidebar-collapsed');
            $('#mainContent').addClass('full-width');
            $('#sidebarToggle i').removeClass('fa-bars').addClass('fa-chevron-right');
        }

        // Also notify FullCalendar on any page that has it
        $(document).on('sidebar:toggle', function() {
            if (typeof calendar !== 'undefined' && calendar.updateSize) {
                calendar.updateSize();
            }
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Dark/Light theme toggle
        function toggleTheme() {
            const html = $('html');
            const currentTheme = html.attr('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.attr('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            $('html').attr('data-bs-theme', savedTheme);
        }

        // Apply saved accent color from localStorage (set by settings page)
        const savedAccent = localStorage.getItem('accentColor');
        if (savedAccent) {
            document.documentElement.style.setProperty('--primary-color', savedAccent);
        }

        // Press 't' to toggle theme (only when not typing in input/textarea)
        $(document).keypress(function(e) {
            if ((e.key === 't' || e.key === 'T') && !$(e.target).is('input, textarea, select, [contenteditable]')) {
                toggleTheme();
            }
        });

        // Theme toggle button (if exists)
        $('#themeToggle').click(function() {
            toggleTheme();
        });

        // Press 's' to toggle sidebar (only when not typing in input/textarea)
        $(document).keypress(function(e) {
            if ((e.key === 's' || e.key === 'S') && !$(e.target).is('input, textarea, select, [contenteditable]')) {
                toggleSidebar();
            }
        });
    });
</script>
</body>
</html>
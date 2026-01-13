    <!-- Footer -->
    <footer class="mt-auto py-3 text-center small text-muted border-top border-secondary-subtle" style="background-color: #0f172a;">
        <div class="container-fluid">
            ChegeOS Dashboard • v0.1 • <span id="currentDate"></span>
        </div>
    </footer>
</div> <!-- Close main-content -->
</div> <!-- Close wrapper -->

<!-- Custom Scripts -->

<script>
    $(document).ready(function() {
        // Set current date in footer
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        $('#currentDate').text(now.toLocaleDateString('en-US', options));

        // Sidebar toggle functionality
        $('#sidebarToggle').click(function() {
            $('#sidebar').toggleClass('sidebar-collapsed');
            $('#mainContent').toggleClass('full-width');

            // Change icon
            const icon = $(this).find('i');
            if (icon.hasClass('fa-bars')) {
                icon.removeClass('fa-bars').addClass('fa-times');
            } else {
                icon.removeClass('fa-times').addClass('fa-bars');
            }
        });


        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();




        // Dark/Light theme toggle (example - not in UI yet)
        function toggleTheme() {
            const html = $('html');
            const currentTheme = html.attr('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.attr('data-bs-theme', newTheme);
            console.log(`Theme changed to ${newTheme}`);
        }

        // Example: Press 't' to toggle theme
        $(document).keypress(function(e) {
            if (e.key === 't' || e.key === 'T') {
                toggleTheme();
            }
        });
    });
</script>
</body>
</html>
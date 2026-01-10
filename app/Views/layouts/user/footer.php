<!-- Footer -->
<div class="mt-4 text-center small text-muted">
    ChegeOS Dashboard • v0.1 • <span id="currentDate"></span>
</div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

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

        // Generate heatmap
        function generateHeatmap() {
            const heatmap = $('#heatmap');
            heatmap.empty();

            // Generate 30 days of random activity
            for (let i = 0; i < 30; i++) {
                const activityLevel = Math.floor(Math.random() * 5); // 0-4
                const cell = $('<div class="heatmap-cell"></div>');

                if (activityLevel > 0) {
                    cell.addClass(`heatmap-${activityLevel}`);
                    // Add tooltip
                    cell.attr('title', `${activityLevel} activities on day ${i+1}`);
                    cell.tooltip({ trigger: 'hover' });
                }

                heatmap.append(cell);
            }
        }

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Generate the heatmap
        generateHeatmap();

        // Simulate updating stats (these would come from API later)
        setInterval(function() {
            // Randomly update stats for demo purposes
            const total = parseInt($('#totalProjects').text());
            const active = parseInt($('#activeProjects').text());
            const stalled = parseInt($('#stalledProjects').text());
            const time = parseFloat($('#timeThisWeek').text());

            // Small random fluctuations
            $('#activeProjects').text(active + (Math.random() > 0.7 ? 1 : 0));
            $('#timeThisWeek').text((time + (Math.random() * 0.5)).toFixed(1));
        }, 5000);

        // Project card click handler
        $(document).on('click', '.project-card', function() {
            const projectName = $(this).find('strong').text();
            console.log(`Project clicked: ${projectName}`);
            // This will be replaced with modal or page navigation later
            alert(`Opening project: ${projectName}`);
        });

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
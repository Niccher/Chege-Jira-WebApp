// Main application JavaScript for ChegeOS

$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Set current date in elements with class .current-date
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    $('.current-date').text(now.toLocaleDateString('en-US', options));

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

        // Store preference in localStorage
        const isCollapsed = $('#sidebar').hasClass('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    });

    // Check localStorage for sidebar state
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        $('#sidebar').addClass('sidebar-collapsed');
        $('#mainContent').addClass('full-width');
        $('#sidebarToggle i').removeClass('fa-bars').addClass('fa-times');
    }

    // Generate heatmap for elements with id="heatmap"
    function generateHeatmap() {
        const heatmap = $('#heatmap');
        if (heatmap.length) {
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
    }

    // Generate the heatmap
    generateHeatmap();

    // Project card click handler
    $(document).on('click', '.project-card', function() {
        const projectName = $(this).find('strong').text();
        const projectId = $(this).data('project-id');

        if (projectId) {
            // Navigate to project detail page
            window.location.href = `/projects/${projectId}`;
        } else {
            console.log(`Project clicked: ${projectName}`);
            // Show modal or toast notification
            showToast(`Opening project: ${projectName}`);
        }
    });

    // Dark/Light theme toggle
    function toggleTheme() {
        const html = $('html');
        const currentTheme = html.attr('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        html.attr('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        // Show notification
        showToast(`Theme changed to ${newTheme} mode`);
    }

    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        $('html').attr('data-bs-theme', savedTheme);
    }

    // Press 't' to toggle theme
    $(document).keypress(function(e) {
        if (e.key === 't' || e.key === 'T') {
            toggleTheme();
        }
    });

    // Theme toggle button (if exists)
    $('#themeToggle').click(function() {
        toggleTheme();
    });

    // Toast notification function
    function showToast(message, type = 'info') {
        // Create toast element
        const toastId = 'toast-' + Date.now();
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        // Add to container
        $('.toast-container').append(toastHtml);

        // Show toast
        const toast = new bootstrap.Toast(document.getElementById(toastId));
        toast.show();

        // Remove after hidden
        $(`#${toastId}`).on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }

    // Create toast container if it doesn't exist
    if ($('.toast-container').length === 0) {
        $('body').append('<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>');
    }

    // Auto-update dashboard stats every 30 seconds
    if ($('.auto-update-stats').length) {
        setInterval(function() {
            updateDashboardStats();
        }, 30000);
    }

    // Function to update dashboard stats via AJAX
    function updateDashboardStats() {
        $.ajax({
            url: '/api/dashboard/stats',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    // Update each stat element
                    $.each(response.data, function(key, value) {
                        $(`#${key}`).text(value);
                    });
                }
            },
            error: function() {
                console.log('Failed to update stats');
            }
        });
    }

    // Search functionality
    $('#projectSearch').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();

        $('.project-card').each(function() {
            const projectText = $(this).text().toLowerCase();
            if (projectText.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
<?= $this->extend('layouts/ace/main') ?>
<?= $this->section('content') ?>

<?php $initials = strtoupper(substr($user->first_name ?? $user->username, 0, 1) . substr($user->last_name ?? '', 0, 1)); ?>

    
        
        <div class="row space-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Calendar</strong></h3>
            </div>
            <div class="col-auto pull-right text-end mt-n1">
                
            </div>
        </div>
        <!-- Calendar Stats -->
        <div class="row space-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">This Month</div>
                    <div class="stat-value" id="totalEvents"><?= $total_events ?></div>
                    <div class="stat-change text-secondary  font-mono border-top pt-2">
                        <i class="fas fa-calendar-check"></i> Scheduled
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Completed</div>
                    <div class="stat-value text-success" id="completedEvents"><?= $completed_count ?></div>
                    <div class="stat-change text-success  font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-check-circle"></i> Done
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Pending</div>
                    <div class="stat-value text-warning" id="pendingEvents"><?= $pending_count ?></div>
                    <div class="stat-change text-warning  font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-clock"></i> In Progress
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Overdue</div>
                    <div class="stat-value text-danger" id="overdueEvents"><?= $overdue_count ?></div>
                    <div class="stat-change text-danger  font-mono border-top border-danger border-opacity-25 pt-2">
                        <i class="fas fa-exclamation-triangle"></i> Needs Action
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Container -->
        <div class="widget-box card-body">
            <!-- Calendar Header -->
            <div class="   space-4">
                <h5 class="space-0"><i class="fas fa-calendar-alt pr-2"></i><span id="calendarTitle">Calendar</span></h5>
                <div class="  ">
                    <!-- Activity Legend -->
                    <div class="calendar-legend d-none d-lg-flex   small">
                        <div class="  pr-2"><i class="fas fa-project-diagram text-info pr-1"></i>Project</div>
                        <div class="  pr-2"><i class="fas fa-play-circle text-primary pr-1"></i>Start</div>
                        <div class="  pr-2"><i class="fas fa-flag-checkered text-success pr-1"></i>Goal</div>
                        <div class="  pr-2"><i class="fas fa-sticky-note text-indigo pr-1"></i>Note (P)</div>
                        <div class="  pr-2"><i class="fas fa-lightbulb text-warning pr-1"></i>Idea (G)</div>
                        <div class="  pr-2"><i class="fas fa-clock text-purple pr-1" style="color: #8b5cf6;"></i>Time</div>
                        <div class=" "><i class="fas fa-check-circle text-success pr-1"></i>Done</div>
                    </div>
                </div>
            </div>
            <!-- FullCalendar Container -->
            <div id="calendar" class="calendar-container"></div>
        </div>

        <!-- Upcoming Events -->
        <div class="row ">
            <div class="col-lg-8">
                <div class="widget-box card-body">
                    <h5 class="space-3"><i class="fas fa-list-ul pr-2"></i>Upcoming Events</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Event</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($upcoming_events)): ?>
                                <?php foreach ($upcoming_events as $event): ?>
                                <tr>
                                    <td class="small"><?= date('M d', strtotime($event['date'])) ?></td>
                                    <td>
                                        <div class=" ">
                                            <div class="stat-icon m-0 pr-2" style="width: 28px; height: 28px; background-color: rgba(255, 255, 255, 0.05); color: #cbd5e1; font-size: 12px; border-radius: 4px;">
                                                <i class="fas <?= esc($event['icon'] ?? 'fa-circle') ?>"></i>
                                            </div>
                                            <div>
                                                <strong><?= esc($event['title']) ?></strong>
                                                <div class="small text-muted" style="font-size: 0.75rem;"><?= esc($event['desc']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge" style="background-color: <?= $event['color'] ?>"><?= esc($event['project']) ?></span></td>
                                    <td><span class="badge badge-default"><?= ucfirst($event['type']) ?></span></td>
                                    <td class="small">All Day</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info view-upcoming-btn" 
                                                data-title="<?= esc($event['title']) ?>" 
                                                data-desc="<?= esc($event['desc']) ?>"
                                                data-date="<?= date('Y-m-d', strtotime($event['date'])) ?>"
                                                data-type="<?= esc($event['type']) ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center">No upcoming events found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="   ">
                        <button class="btn btn-sm btn btn-white btn-default <?= $upcoming_current_page <= 1 ? 'disabled' : '' ?>" 
                                onclick="window.location.search = '?page_upcoming=<?= $upcoming_current_page - 1 ?>'">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <span class="small text-muted">Page <?= $upcoming_current_page ?> of <?= $upcoming_total_pages ?></span>
                        <button class="btn btn-sm btn btn-white btn-default <?= $upcoming_current_page >= $upcoming_total_pages ? 'disabled' : '' ?>"
                                onclick="window.location.search = '?page_upcoming=<?= $upcoming_current_page + 1 ?>'">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="widget-box card-body">
                    <h5 class="space-3"><i class="fas fa-chart-pie pr-2"></i>Project Distribution</h5>
                    <div class="project-distribution">
                        <?php if (!empty($distribution)): ?>
                            <?php 
                            $totalCount = array_sum(array_column($distribution, 'count'));
                            foreach ($distribution as $dist): 
                                $percent = ($totalCount > 0) ? ($dist['count'] / $totalCount) * 100 : 0;
                            ?>
                            <div class="distribution-item ">
                                <div class=" ">
                                    <span><?= esc($dist['name'] ?? 'General') ?></span>
                                    <span class="text-muted"><?= $dist['count'] ?> event<?= $dist['count'] == 1 ? '' : 's' ?></span>
                                </div>
                                <div class="progress " style="height: 6px;">
                                    <div class="progress-bar" style="width: <?= $percent ?>%; background-color: <?= $dist['color'] ?? '#6366f1' ?>;"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-muted">No specific project data.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- FullCalendar v6 -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-plus pr-2"></i>Add Event</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" id="eventId" name="id">
                        <div class="space-3">
                            <label for="eventTitle" class="form-label">Event Title *</label>
                            <input type="text" class="form-control" id="eventTitle" placeholder="Enter event title" required>
                        </div>
                        <div class="space-3">
                            <label for="eventDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="eventDescription" rows="2" placeholder="Describe the event..."></textarea>
                        </div>
                        <div class="row space-3">
                            <div class="col-md-6">
                                <label for="eventProject" class="form-label">Project</label>
                                <select class="form-control" id="eventProject" name="project_id">
                                    <option value="">General / No Project</option>
                                    <?php if (!empty($projects)): ?>
                                        <?php foreach ($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>" data-color="<?= $project['color'] ?>"><?= esc($project['name']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="eventDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="eventDate" name="start_date" required>
                            </div>
                        </div>
                        <div class="row space-3">
                            <div class="col-md-6">
                                <label for="eventStartTime" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="eventStartTime" value="14:00">
                            </div>
                            <div class="col-md-6">
                                <label for="eventEndTime" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="eventEndTime" name="end_time" value="16:00">
                            </div>
                        </div>
                        <div class="space-3">
                            <label for="eventStatus" class="form-label">Status</label>
                            <select class="form-control" id="eventStatus">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEventBtn">Save Event</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsTitle">Event Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="detailsDesc" class="space-3"></p>
                    <div class="  small text-muted space-2">
                        <span><i class="fas fa-clock pr-1"></i> <span id="detailsTime"></span></span>
                        <span id="detailsType" class="badge"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn btn-white btn-danger" id="deleteEventBtn">Delete</button>
                    <button type="button" class="btn btn-primary" id="editEventBtn">Edit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Page JavaScript -->
    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap5',
                events: '<?= site_url('calendar/events') ?>',
                editable: false,
                selectable: true,
                height: 700,
                
                datesSet: function(dateInfo) {
                    $('#calendarTitle').text(dateInfo.view.title);
                },

                eventContent: function(arg) {
                    let icon = arg.event.extendedProps.icon || 'fa-circle';
                    let arrayOfDomNodes = [
                        $('<div>', { class: 'fc-event-main-inner  ' })
                            .append($('<i>', { class: 'fas ' + icon + ' pr-1', style: 'font-size: 0.75rem;' }))
                            .append($('<span>', { class: 'fc-event-title text-truncate' }).text(arg.event.title))[0]
                    ];
                    return { domNodes: arrayOfDomNodes };
                },
                
                select: function(info) {
                    $('#eventForm')[0].reset();
                    $('#eventId').val('');
                    $('#eventDate').val(info.startStr.split('T')[0]);
                    $('#eventForm').attr('action', '<?= site_url('calendar/event/store') ?>');
                    $('#addEventModal .modal-title').html('<i class="fas fa-calendar-plus pr-2"></i>Add Event');
                    $('#addEventModal').modal('show');
                },

                eventClick: function(info) {
                    const props = info.event.extendedProps;
                    
                    if (props.type === 'manual') {
                        $('#detailsTitle').text(info.event.title);
                        $('#detailsDesc').text(props.description || 'No description provided.');
                        $('#detailsTime').text(info.event.start.toLocaleString());
                        $('#detailsType').text('Personal Event').removeClass('bg-info bg-success').addClass('bg-primary');
                        
                        $('#editEventBtn').show().off('click').on('click', function() {
                            $('#eventDetailsModal').modal('hide');
                            $('#eventId').val(props.dbId);
                            $('#eventTitle').val(info.event.title);
                            $('#eventDescription').val(props.description);
                            $('#eventDate').val(info.event.startStr.split('T')[0]);
                            $('#eventForm').attr('action', '<?= site_url('calendar/event/update/') ?>' + props.dbId);
                            $('#addEventModal .modal-title').html('<i class="fas fa-edit pr-2"></i>Edit Event');
                            $('#addEventModal').modal('show');
                        });

                        $('#deleteEventBtn').show().off('click').on('click', function() {
                            if (confirm('Delete this event?')) {
                                const form = $('<form>', {
                                    'method': 'POST',
                                    'action': '<?= site_url('calendar/event/delete/') ?>' + props.dbId
                                }).append($('<input>', {
                                    'type': 'hidden',
                                    'name': '<?= csrf_token() ?>',
                                    'value': '<?= csrf_hash() ?>'
                                }));
                                $('body').append(form);
                                form.submit();
                            }
                        });
                    } else {
                        $('#detailsTitle').text(info.event.title);
                        $('#detailsDesc').text(props.description);
                        $('#detailsTime').text(info.event.start.toLocaleDateString());
                        $('#detailsType').text(props.type.toUpperCase()).removeClass('bg-primary bg-info bg-success').addClass(
                            props.type === 'project' ? 'bg-info' : 
                            (props.type === 'milestone' ? 'bg-success' : 'bg-primary')
                        );
                        
                        if (props.type === 'note_completed') {
                            $('#detailsType').text('COMPLETED NOTE').removeClass('bg-primary').addClass('bg-success');
                        }
                        
                        $('#editEventBtn').hide();
                        $('#deleteEventBtn').hide();
                    }
                    
                    $('#eventDetailsModal').modal('show');
                }
            });
            calendar.render();

            // Link manual Add Event button
            $('#addEventBtn').click(function() {
                $('#eventForm')[0].reset();
                $('#eventId').val('');
                $('#eventForm').attr('action', '<?= site_url('calendar/event/store') ?>');
                $('#addEventModal').modal('show');
            });

            // Save via Submit button
            $('#saveEventBtn').click(function() {
                // We'll use traditional form submit for simplicity as planned
                $('#eventForm').submit();
            });

            // View event button in table
            $('.view-upcoming-btn').click(function() {
                const title = $(this).data('title');
                const desc = $(this).data('desc');
                const date = $(this).data('date');
                const type = $(this).data('type');

                $('#detailsTitle').text(title);
                $('#detailsDesc').text(desc || 'No description provided.');
                $('#detailsTime').text(date);
                
                $('#detailsType').text(type.toUpperCase());
                $('#detailsType').removeClass('bg-primary bg-info bg-success').addClass(
                    type === 'project' ? 'bg-info' : 
                    (type === 'milestone' ? 'bg-success' : 'bg-primary')
                );

                $('#editEventBtn').hide();
                $('#deleteEventBtn').hide();
                $('#eventDetailsModal').modal('show');
            });

            // Toast notification function
            function showToast(message, type = 'info') {
                const toastId = 'toast-' + Date.now();
                const toastHtml = `
                    <div id="${toastId}" class="toast  text-bg-${type} border-0" role="alert">
                        <div class="">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white pr-2 m-auto" data-dismiss="toast"></button>
                        </div>
                    </div>
                `;

                $('.toast-container').append(toastHtml);
                const toast = new bootstrap.Toast(document.getElementById(toastId));
                toast.show();

                $(`#${toastId}`).on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }
        });
    </script>

<?= $this->endSection() ?>

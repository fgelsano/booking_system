<!DOCTYPE html>
<html>
<head>
    <title>Sea Vessel Booking </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>          
  
<div class="container">
  <center><h2> Schedular Calendar </h2></center>
    <div id='calendar'></div>
</div>


   
  
</body>
</html>
<script>
    $(document).ready(function () {
       
    var SITEURL = "{{ url('/') }}";
      
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        
        }
    });
      
    var calendar = $('#calendar').fullCalendar({

                        editable: true,
                        events: SITEURL + "/fullcalender",
                        displayEventTime: false,
                        editable: true,
                        eventRender: function (event, element, view) {
                            if (event.allDay === 'true') {
                                    event.allDay = true;
                            } else {
                                    event.allDay = false;
                            }
                           
                        },
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end, allDay) {
                            var title = prompt('Enter Origin: ');
                            if (title) {    
                                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                
                                $.ajax({
                                    url: SITEURL + "/fullcalenderAjax",
                                     data: {
                                        title: title,
                                        start: start,
                                        end: end,
                                        type: 'add'
                                    },
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("Bookings Reserved Successfully");
                                        calendar.fullCalendar('renderEvent',
                                            {
                                                id: data.id,
                                                title: title,
                                                start: start,
                                                end: end,
                                                allDay: allDay
                                            },true);
                                           
      
                                        calendar.fullCalendar('unselect');
                                    }
                                });
                            }
                            


                        },
                        
                        eventDrop: function (event, delta) {
                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
      
                            $.ajax({
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                    title: event.title,
                                    start: start,
                                    end: end,
                                    id: event.id,
                                    type: 'update'
                                },
                                type: "POST",
                                success: function (response) {
                                    displayMessage("Booking Schedules Updated Successfully");
                                   
                                }
                            });
                        },
                        eventClick: function (event) {
                            toastr.options = {
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "progressBar": true,
                                "preventDuplicates": false,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                                

                            };

                            toastr.warning("Are you sure you want to delete?", "Delete Schdules", {
                              
                                "timeOut": "0",
                                "extendedTimeOut": "0",
                                "tapToDismiss": false,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": function () {
                                    $.ajax({
                                        type: "POST",
                                        url: SITEURL + '/fullcalenderAjax',
                                        data: {
                                            id: event.id,
                                            type: 'delete'
                                        },
                                        success: function (response) {
                                            calendar.fullCalendar('removeEvents', event.id);
                                            toastr.success("Schedules deleted successfully", "Success");
                                      
                                          
                                        },
                                        error: function (xhr, status, error) {
                                            console.log("Error callback called.", error);
                                            toastr.error(xhr.responseText || 'An error occurred while deleting the schedules!');
                                        }
                                    });
                                },
                                "onHidden": function () {
                                    // nothing to do here
                                    
                                }
                            });
                        }

     
                    });
                    
     
    });
     
    function displayMessage(message) {
        toastr.success(message, 'Event');
    } 

      
    </script>
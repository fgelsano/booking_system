@extends('layouts.admin.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-yQvzI1XMW+CGZmhCp16lE1vIaAcaW8Un73slLrNhXgYn5zhBzW8ewNKMLw1n/rDPO3oC+2W8I94S+uz9VYmvlQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-KQLzNjjb/SPQ/2+O/JfgJh/BziC1hSdMz9nUqLgs8z7QZw4cUJ7Gp+px6eRgVfj66DY1Y9RKsA//Pl+8aAZ19w==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                Schedules
                            </div>
                            <div class="col-md-6 text-right">
                               
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSchedulesModal">New Schedules</a>

                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="schedules-table" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Schedules ID</th>
                                    <th>Vessel Name</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Departure Date</th>
                                    <th>Departure Date Range</th>
                                    <th>Departure Time</th>
                                    <th>Action</th>
                               
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal view --}}
    <div class="modal fade" id="view-schedules-modal" tabindex="-1" aria-labelledby="view-schedules-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view-modal-label">Schedules Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>  

                <form id = "view-modal-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="view-schedule-id">Schedule ID</label>
                            <p id="view-schedule-id"></p>
                        </div>
                        <div class="form-group">
                          <label for="view-vessel-id">Vessel Name</label>
                          <p id="view-vessel-id"></p>
                      </div>
                        <div class="form-group">
                            <label for="view-origin">Origin</label>
                            <p id="view-origin"></p>
                        </div>
                        <div class="form-group">
                          <label for="view-destination">Destination</label>
                          <p id="view-destination"></p>
                        </div>

                        <div class="form-group">
                            <label for="view-departure-date">Departure Date</label>
                            <p id="view-departure-date"></p>
                        </div>

                        <div class="form-group">
                            <label for="view-departure-date-range">Departure Date Range</label>
                            <p id="view-departure-date-range"></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="view-departure-time">Departure Time</label>
                            <p id="view-departure-time"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal create --}}
    <div class="modal fade" id="addSchedulesModal" tabindex="-1" role="dialog" aria-labelledby="addSchedulesModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addAccommodationModalLabel">Add Schedules</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{ route('schedules.store') }}" id="schedulesForm" name="schedulesForm" class="form-horizontal" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                          <label for="vessel_id" class="control-label">Vessel Name:</label>
                          <select class="form-control" id="add-vessel-id" name="vessel_id">
                              <option value="">-- Select Vessel --</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="origin" class="control-label">Origin:</label>
                          <input type="text" class="form-control" id="add-origin" name="origin" required />
                      </div>
                      <div class="form-group">
                        <label for="destination" class="control-label">Destination:</label>
                        <input type="text" class="form-control" id="add-destination" name="destination" required />
                    </div>
                    <div class="form-group">
                        <label for="departure_date" class="control-label">Departure Date:</label>
                        <div class="input-daterange input-group" id="departure_date">
                          <input type="date" class="form-control" name="departure_date" id="add-departure-date" required>
                          <div class="input-group-prepend">
                            <span class="input-group-text">to</span>
                          </div>
                          <input type="date" class="form-control" name="departure_date_range" id="departure_date_range" required>
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label for="departure_time" class="control-label">Departure Time:</label>
                        <input type="time" class="form-control" id="add-departure-time" name="departure_time" required />
                    </div>
                      
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <input type="submit" value="Save" class="btn btn-primary">
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="edit-schedules-modal" tabindex="-1" role="dialog" aria-labelledby="edit-schedules-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-schedules-modal-title">Edit Schedules</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-schedules-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="schedules_id" id="schedules_id">
                        <div class="form-group">
                            <label for="vessel_id">Vessels</label>
                            <select class="form-control" name="vessel_id" id="edit-vessel-id">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="origin">Origin </label>
                            <input type="text" class="form-control" name="origin" id="edit-origin" required>
                        </div>
                         <div class="form-group">
                            <label for="destination">Destination </label>
                            <input type="text" class="form-control" name="destination" id="edit-destination" required>
                        </div>

                        <div class="form-group">
                            <label for="departure_date" class="control-label">Departure Date:</label>
                            <div class="input-daterange input-group" id="departure_date">
                                <input type="date" class="form-control" name="departure_date" id="edit-departure-date" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">to</span>
                                    </div>
                                <input type="date" class="form-control" name="departure_date_range" id="edit-departure-date-range" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="departure_time">Departure Time </label>
                            <input type="time" class="form-control" name="departure_time" id="edit-departure-time" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="edit-accommodation-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
    <script>    
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#schedules-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('schedules.index') }}', 
                method: 'get',
                columns: [
                {data: 'id', name: 'id'},
                {data: 'vessel_id', name: 'vessels.vessel_id'},
                {data: 'origin', name: 'origin'},
                {data: 'destination', name: 'destination'},
                {data: 'departure_date', name: 'departure_date'},
                {data: 'departure_date_range', name: 'departure_date_range'},
                {data: 'departure_time', name: 'departure_time'},
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    width: '20%',
                    render: function(data, type, row) {
                    return `
                        <div class="btn-group">
                        <button data-id="${data['id']}" data-action="view" class="btn btn-info btn-sm view" data-toggle="modal" data-target="#view-schedules-modal"><i class="fa fa-eye"></i> View</button>

                        <button data-id="${data['id']}" data-action="edit" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#edit-schedules-modal"><i class="fa fa-edit"></i> Edit</button>

                        <button data-id="${data['id']}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    `;
                    },
                    "className":"text-center",
                },
                ],
            });

        });
             

        //view
        $j(document).on('click', '.view', function() {
            var id = $j(this).data('id');          
            $.ajax({
                url: "{{ url('dashboard/settings/schedules') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) { 
                    var schedules = response.data;
                    var vesselID = $(this).data('view-schedule-id');
                    var origin = $(this).data('view-origin');
                    var destination = $(this).data('view-destination');
                    var departure_date = $(this).data('view-departure-date');
                    var departure_date_range = $(this).data('view-departure-date-range')
                    var departure_time = $(this).data('view-departure-time');

                    // populate the modal with the data
                    $j('#view-schedule-id').text(schedules.id);
                    $j('#view-vessel-id').text(schedules.vessel_name);
                    $j('#view-origin').text(schedules.origin);
                    $j('#view-destination').text(schedules.destination);  
                    $j('#view-departure-date').text(schedules.departure_date); 
                    $j('#view-departure-date-range').text(schedules.departure_date_range)
                    $j('#view-departure-time').text(schedules.departure_time); 
                    $('#view-port-modal').modal('show');
                                

                },
                error: function(xhr) {
                    onsole.log(xhr.responseText);
                }
            });    
        });
               
        // edit
        $j(document).on('click','.edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "/dashboard/settings/schedules/" + id + "/edit",
                type: "GET",
                
                success: function(data) { 
                    var schedules = data.data
          
                    
                    var options;
                    $.each(data, function(key, schedules) {
                        var vesselNames = Array.isArray(schedules.vessel_name) ? schedules.vessel_name.join(", ") : schedules.vessel_name;
                        options += "<option value='" + schedules.vessel_id + "'>" + vesselNames + "</option>"; 
                    }); 
                   
                    $j('#schedules_id').val(schedules.id);
                    $j('#edit-vessel-id').empty().append(options).val(schedules.vessel_id).trigger('change');
                    $('input[name="origin"]').val(schedules.origin);
                    $('input[name="destination"]').val(schedules.destination);
                    $('input[name="departure_date"]').val(schedules.departure_date);
                    $('input[name="departure_date_range"]').val(schedules.departure_date_range);
                    $('input[name="departure_time"]').val(schedules.departure_time);

                    // Open the Edit Modal
                    $('#edit-schedules-modal').modal('show');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText); 
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            $j('#edit-schedules-form').on('submit', function(e) {
                e.preventDefault();
                var schedules_id = $('input[name="schedules_id"]').val();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ url('dashboard/settings/schedules') }}/" + schedules_id,
                    type: 'PUT',
                    data: form_data,
                    success: function(data) {
                        const dttb = $j('#schedules-table').DataTable();
                        $('#edit-schedules-modal').modal('hide');
                        dttb.ajax.reload();

                        toastr.success('Schedules Updated successfully.');
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var error_msg = '';
                        $.each(errors, function(key, value) {
                            error_msg += value[0] + '<br>';
                        });
                        toastr.error(error_msg, 'Error');
                    }
                });

            }); 

            
            
        });
      
        //delete
        $j(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var clickedRow = $(this).closest('tr');
            var id = $j(this).data('id');

            toastr.options = {
                "positionClass": "toast-top-center",
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true,
            };

            toastr.warning('Are you sure you want to delete this Schedules?', 'Confirmation', {
                "onclick": function() {
                    $.ajax({
                        url: "{{ url('dashboard/settings/schedules') }}/" + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            console.log('Delete request succeeded:');
                            if (data.status && data.status === 'error') {
                                toastr.error(data.message || 'An error occurred while deleting the Port!');
                            } else {
                                toastr.success('Schedules deleted successfully!', 'Success');
                                clickedRow.remove();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error callback called.", error);
                            toastr.error(xhr.responseText || 'An error occurred while deleting the Port!');
                        }
                    });
                }
            });
        });


        //create
        $j(document).ready(function() {
            $.ajax({
                url: "{{ route('vessels.index') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                console.log(response);
                var options = "<option value=''>-- Select Vessel --</option>";
                var data = response.data;
                    if (data.length) {
                        $.each(data, function(key, vessel) {
                        options += "<option value='" + vessel.id + "'>" + vessel.vessel_name + "</option>";
                        });
                    } else {
                            options = "<option value='' disabled>No vessels found</option>";
                        }
                        $("#add-vessel-id").html(options);
                },
                    error: function(xhr, status, error) {
                        console.log("An error occurred: " + error);
                    }
            });
            $j('#schedulesForm').submit(function(e) {
                e.preventDefault();
                const vesselId = $('#add-vessel-id').val();
                const formData = new FormData(document.getElementById('schedulesForm'));
                formData.set('vessel_id', vesselId);
                axios.post(event.target.action, formData, {
                    headers: {
                                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                                
                    const dttb = $j('#schedules-table').DataTable();
                    const form = $j('#schedulesForm')[0];
                    form.reset();
                    dttb.ajax.reload();
                    $('#addSchedulesModal').modal('hide');
                    toastr.success(response.data.message, 'Success');
                })
                .catch(error => {
                                    
                    var errors = error.response.data.errors;
                    var error_msg = '';
                    $.each(errors, function(key, value) {
                        error_msg += value[0] + '<br>';
                    });
                    toastr.error(error_msg, 'Error');
                });
            });

        });

    </script>

@endsection
@extends('layouts.admin.app')

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
                                <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-primary">New Schedules</a>
                              

                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="events-table" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Schedule ID</th>
                                    <th>Origin</th>
                                    <th>Departure Date</th>
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

    <div class="modal fade" id="view-event-modal" tabindex="-1" aria-labelledby="view-event-modal-label" aria-hidden="true">
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
                            <label for="view-schedules-info">Origin</label>
                            <p id="view-schedules-info"></p>
                        </div>
                        <div class="form-group">
                            <label for="view-departure-date">Departure Date</label>
                            <p id="view-departure-date"></p>
                        </div>
                        <div class="form-group">
                            <label for="view-arrival-date">Departure Time</label>
                            <p id="view-arrival-date"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    




    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#events-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('schedules.index') }}', 
                method: 'get',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {
                    data: null,
                    orderable: false,
                    searchable: false,
                    width: '20%',
                    render: function(data, type, row) {

                        
                        return `
                            <div class="btn-group">
                                <button data-id="${data['id']}" data-action="view" class="btn btn-info btn-sm view" data-toggle="modal" data-target="#view-event-modal" data-id="' + events.id + '"><i class="fa fa-eye"></i> View</a></button>
                                

                            </div>
                        `;
                        

                        
                    },
                    
                    "className":"text-center",
                    
            },
                ],
                "columnDefs": [
                    {
                        "targets": [3,4],
                        "render": function(data, type, row){
                            if(type === 'display' || type === 'filter'){
                                return moment.utc(data).local().format('MMM DD, YYYY h:mm A');
                                
                            }else{
                                return data;
                            }
                        }
                    }
                ]
                });
        
            //view
            $j('#events-table').on('click', '.view', function() {
                var id = $j(this).data('id');
                
                $.ajax({
                    url: "{{ url('dashboard/schedules') }}/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) { 
                        var events = response.data;

                        // populate the modal with the data
                        $j('#view-schedule-id').text(events.id);
                        $j('#view-schedules-info').text(events.title);
                        $j('#view-departure-date').text(events.start);
                        $j('#view-arrival-date').text(events.end);     
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });





        });
    </script>

@endsection
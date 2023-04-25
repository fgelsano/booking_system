@extends('layouts.admin.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="container-fluid">
        <div class="toast" style="position: absolute; top: 0; right: 0; z-index: 999" data-delay="3000" data-autohide="false">
            <div class="toast-header">
              <img src="..." class="rounded mr-2" alt="...">
              <strong class="mr-auto">Bootstrap</strong>
              <small>11 mins ago</small>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
              Hello, world! This is a toast message.
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                Ports
                            </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('ports.store') }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-ports-modal">New Ports</a>
                                </div>  
                        </div>
                            
                    </div>

                    <div class="card-body table-responsive">
                            
                         <table id="ports-table" class="table table-striped table-bordered table-sm table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Port ID</th>
                                    <th>Port Name</th>
                                    <th>Pier Number</th>
                                    <th>Created At </th>
                                    <th>Action</th>
                    
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
                        <!-- Add Modal -->
                        <div class="modal fade" id="add-ports-modal" tabindex="-1" role="dialog" aria-labelledby="newPortsLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adding New Ports</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <form method="POST" action="{{ route('ports.store') }}" id="add-ports-form">
                                    <div class="modal-body">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input id="port-name" type="text" placeholder="Port name" class="form-control" name="port_name" required autocomplete="name" autofocus>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input id="pier_number" type="number" placeholder="Pier number" class="form-control" name="pier_number" required autocomplete="name">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                     
                            
                        <!-- View Modal  -->
                        <div class="modal fade" id="view-port-modal" tabindex="-1" aria-labelledby="view-port-modal-label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="view-modal-label">Port Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form id = "view-modal-form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="view-port-name">Port Name</label>
                                                <p id="view-port-name"></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="view-pier-number">Pier Number</label>
                                                <p id="view-pier-number"></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <!-- Edit Modal -->

                        <div class="modal fade" id="edit-ports" tabindex="-1" role="dialog" aria-labelledby="editPortsLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPortsLabel">Edit Port</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="edit-ports-form" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="id">
                                    <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit-ports-name" class="col-form-label">Port Name:</label>
                                        <input type="text" class="form-control" id="edit-ports-name" name="edit-ports-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-pier-number" class="col-form-label">Pier Number:</label>
                                        <input type="number" class="form-control" id="edit-pier-number" name="edit-pier-number" required>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Port</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        

<script>

//datatables
var $j = jQuery.noConflict();
$j(document).ready(function() {
    $j('#ports-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('ports.index') }}', 
        method: 'get',
        compact: true,
        order: [[3, "asc"]],
        columns: [
            {
                data: 'id', 
                name: 'id',
                width: '20%',
            },
            {
                data: 'name', 
                name: 'name',
                width: '30%', 
                "className":"text-center",
            },
            {
                data: 'pier_number', 
                name: 'pier_number',
                width: '20%',
            },
            {
                data: 'created_at',
                name: 'created_at',
                type: 'date',
              
                orderable: false,
            },
            
            {
                data: null,
                orderable: false,
                searchable: false,
                width: '20%',
                render: function(data, type, row) {

                    
                    return `
                        <div class="btn-group">
                            <button data-id="${data['id']}" data-action="view" class="btn btn-info btn-sm view" data-toggle="modal" data-target="#view-port-modal" data-id="' + ports.id + '"><i class="fa fa-eye"></i> View</a></button>
                           
                            <button data-id="${data['id']}" data-action="edit" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#edit-ports" data-id="' + ports.id + '"><i class="fa fa-edit"></i> Edit</a></button>

                            <button data-id="${data['id']}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>


                        </div>
                    `;
                    

                    
                },
                
                "className":"text-center",
                
            },
            
            
            
            
        ],
        
        

      
        
    });
            //delete
    $(document).on('click', '.delete', function(e) {
    $('.toast').toast('show');
    e.preventDefault();
    var clickedRow = $(this).closest('tr');
    var id = $j(this).data('id');

    // toastr.options = {
    //     "positionClass": "toast-top-center",
    //     "timeOut": "3000",
    //     "closeButton": true,
    //     "progressBar": true,
    // };

    // toastr.warning('Are you sure you want to delete this Port?', 'Confirmation', {
    //     "onclick": function() {
    //         $.ajax({
    //             url: "{{ url('dashboard/settings/ports') }}/" + id,
    //             type: 'DELETE',
    //             data: {
    //                 "_token": "{{ csrf_token() }}",
    //             },
    //             success: function(data) {
    //                 console.log('Delete request succeeded:');
    //                 if (data.status && data.status === 'error') {
    //                     toastr.error(data.message || 'An error occurred while deleting the Port!');
    //                 } else {
    //                     toastr.success('Port deleted successfully!', 'Success');
    //                     clickedRow.remove();
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 console.log("Error callback called.", error);
    //                 toastr.error(xhr.responseText || 'An error occurred while deleting the Port!');
    //             }
    //         });
    //     }
    // });
});







            //view
         $j('#ports-table').on('click', '.view', function() {
            var id = $j(this).data('id');
            $.ajax({
                url: "{{ url('dashboard/settings/ports') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                var ports = response.data;
                var portName = $(this).data('view-port-name');
                var pierNumber = $(this).data('view-pier-number');

            
                    // populate the modal with the data
                    $j('#view-port-name').html(ports.name);
                    $j('#view-pier-number').html(ports.pier_number);
                    $('#view-port-modal').modal('show');
                
                
                },
                error: function(xhr) {
                console.log(xhr.responseText);
                }   
            });
        });

            //edit
            $j('#ports-table').on('click', '.edit', function() {
            var id = $(this).data('id');
         
            console.log(id);

            $.get("{{ route('ports.edit', ':id') }}".replace(':id', id), function(data) {
               
                var ports = data.data;
                // populate the modal form fields with the retrieved data
                $j('#edit-ports-form').attr('action', "{{ url('dashboard/settings/ports') }}/" + id);
                $j('#edit-ports-name').val(ports.name);
                $j('#edit-pier-number').val(ports.pier_number);
                $j('#id').val(ports.id);
                // show the modal form
                $('#edit-ports').modal('show'); 
                

                
                // toastr.success(data.message, 'Updated Successfully');
               
                
                
                
            });
        });
        

});

//create
$j('#add-ports-form').submit(function(event) {
        event.preventDefault();
        const formData = new FormData(document.getElementById('add-ports-form'));

        axios.post(event.target.action, formData,{
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => {
            const dttb = $j('#ports-table').DataTable();
            const form = $j('#add-ports-form')[0];
            form.reset();
            dttb.ajax.reload();
            $('#add-ports-modal').modal('hide');
            toastr.success(response.data.message, 'Ports Added Successfully');
        })
        .catch(error => {
            console.log(error);
            toastr.error(error.data, 'Error');
        });
});

</script>
@endsection

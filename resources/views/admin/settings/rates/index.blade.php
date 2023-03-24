@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Rates
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#rates-modal">New Rates</a>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="fares-table" class="table table-bordered table-hover" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Rates Name</th>
                                <th>Price</th>
                                <th>Added On</th>
                                <th>Updated On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Rates Modal -->
<div class="modal fade" id="rates-modal" tabindex="-1" role="dialog" aria-labelledby="rates-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rates-modal-title">Add New Rates</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rates-form" method="POST">
                    @csrf
                    <input type="hidden" id="rates-id" name="id">
                    <div class="form-group">
                        <label for="fare_name">Rates Name:</label>
                        <input type="text" class="form-control" id="fare_name" name="fare_name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="rates-submit-btn" class="btn btn-primary">Add Rates</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Rates Modal -->
<!-- <div class="modal fade" id="rate_modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Fare</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Rates name:</label>
                        <input type="text" class="form-control" id="fare_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-form-label">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Fare</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fare_name" class="col-form-label">Rates Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-form-label">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('#fares-table').DataTable({
            processing: true,
            serverSide: true,
            method: 'get',
            ajax: '/dashboard/settings/rates',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'fare_name',
                    name: 'fare_name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'created_at',
                    name: 'Added On'
                },
                {
                    data: 'updated_at',
                    name: 'Updated On'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "createdRow": function(row, data, index) {
                $('td', row).css('text-align', 'center');
            },
            "columnDefs": [{
                "targets": [3, 4],
                "render": function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        return moment.utc(data).local().format('MMM DD, YYYY h:mm A');
                    } else {
                        return data;
                    }
                }
            }]
        });
        $('#new-rates').click(function() {
            $('#rates-modal-title').html('Add New Rates');
            $('#rates-form').trigger('reset');
            $('#rates-modal').modal('show');
            $('#rates-submit-btn').html('Add Rates');
        });
        $('#rates-form').on('submit', function(e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('rates.store') }}",
                type: "POST",
                data: form_data,
                success: function(data) {
                    $('#rates-modal').modal('hide');
                    table.draw();
                    Toastr.success('Rates added successfully.');
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

        // Update AJAX

        // $(document).on('click', '.edit', function() {
        //     var fare_id = $(this).attr('id');
        //     $.ajax({
        //         url: "{{ route('rates.edit') }}" + fare_id,
        //         dataType: "json",
        //         success: function(data) {
        //             $('#name').val(data.fare.name);
        //             $('#price').val(data.fare.price);
        //             $('#editForm').attr('action', "{{ route('rates.edit') }}" + fare_id);
        //             $('#editModal').modal('show');
        //         }
        //     });
        // });

        // $('#editForm').on('submit', function(e) {
        //     e.preventDefault();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         type: "PUT",
        //         url: url,
        //         data: $('#editForm').serialize(),
        //         success: function(response) {
        //             toastr.success(response.success);
        //             $('#rate_modal').modal('hide');
        //             $('.datatable').DataTable().ajax.reload();
        //         },
        //         error: function(response) {
        //             toastr.error(response.responseJSON.message);
        //         }
        //     });
        // });
        // Delete Fare
        // $('body').on('click', '.delete', function() {
        //     var fare_id = $(this).data("id");
        //     var url = "{{ route('rates.destroy', ':id') }}";
        //     url = url.replace(':id', fare_id);

        //     if (confirm("Are you sure you want to delete this fare?")) {
        //         $.ajax({
        //             type: "DELETE",
        //             url: url,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(data) {
        //                 toastr.success('Fare deleted successfully.');
        //                 table.draw();
        //             },
        //             error: function(data) {
        //                 console.log('Error:', data);
        //                 toastr.error('Something went wrong, please try again.');
        //             }
        //         });
        //     }
        // });
        $('#fares-table').on('click', '.delete', function() {
            var fare_id = $(this).data('id');
            var delete_url = $(this).data('url');

            if (confirm('Are you sure you want to delete this Fare?')) {
                $.ajax({
                    url: delete_url,
                    type: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': fare_id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                        $('#fare-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        toastr.error('Error deleting Fare');
                    }
                });
            }
        });

        // Edit Fare
        // $('body').on('click', '.edit', function () {
        //     var fare_id = $(this).data("id");
        //     var url = "{{ route('rates.edit', ':id') }}";
        //     url = url.replace(':id', fare_id);
        //     window.location.href = url;
        // });
        $('#fares-table').on('click', '.edit', function() {
            var fare_id = $(this).data('id');
            $.get("{{ route('rates.index') }}" + '/' + fare_id + '/edit', function(data) {
                $('#editForm').attr('action', "{{ route('rates.update', '') }}/" + fare_id);
                $('#name').val(data.fare_name);
                $('#price').val(data.price);
                $('#id').val(data.id);
                $('#editModal').modal('show');
            });
        });
    });
</script>
@endsection
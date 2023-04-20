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
                        <input type="text" class="form-control" id="fare_names" name="fare_names" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-form-label">Price:</label>
                        <input type="number" class="form-control" id="prices" name="prices" required>
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
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
                    Toastr.success('Rates added successfully.');
                    table.draw();
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
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

        // Edit Fare Modal
        $('#fares-table').on('click', '.edit', function() {
            var fare_id = $(this).data('id');
            $.get("{{ route('rates.index') }}" + '/' + fare_id + '/edit', function(data) {
                $('#editForm').attr('action', "{{ url('dashboard/settings/rates') }}/" + fare_id);
                $('#fare_names').val(data.fare_name);
                $('#prices').val(data.price);
                $('#id').val(data.id);
                $('#editModal').modal('show');
            });
        });

        // Update Fare
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            var fare_id = $('#id').val();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ url('dashboard/settings/rates') }}/" + fare_id,
                type: 'PUT',
                data: form_data,
                success: function(data) {
                    $('#editModal').modal('hide');
                    toastr.success('Rates Updated successfully.');
                    table.draw();
                    location.reload();
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


        $(document).on('click', '.delete', function() {
            var url = $(this).data('url');
            if (confirm('Are you sure you want to delete this rate?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        toastr.success('Rate deleted successfully.');
                        table.draw();
                        location.reload();
                    },
                    error: function(xhr) {
                        toastr.error('Failed to delete rate.');
                    }
                });
            }
        });



    });
</script>
@endsection
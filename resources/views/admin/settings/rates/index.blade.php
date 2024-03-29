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
                                <th>Rates </th>
                                <th>Price</th>
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
        const dttb = $j('#fares-table').DataTable({
            processing: true,
            serverSide: true,
            method: 'get',
            ajax: '/dashboard/settings/rates',
            columns: [{
                    data: 'fare_name',
                    name: 'fare_name'
                },
                {
                    data: 'price',
                    name: 'price'
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

        });
        // Add Rates
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
                    const form = $j('#rates-form')[0];
                    form.reset();
                    dttb.ajax.reload();
                    $('#rates-modal').modal('hide');
                    toastr.success('Rates added successfully.');
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
            // location.reload();
        });

        // Edit Rates Modal
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
                    dttb.ajax.reload();
                    table.draw();
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
        const swalWithBootstrapButtonss = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success custom-green',
                cancelButton: 'btn btn-danger custom-red',
                actions: 'd-flex justify-content-center'
            },
            buttonsStyling: true,
            reverseButtons: true

        })
        $(document).on('click', '.delete', function() {
            var url = $(this).data('url');
            var vesselId = $(this).data('id');

            swalWithBootstrapButtonss.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            swalWithBootstrapButtonss.fire(
                                'Deleted!',
                                'Delete Successfully.',
                                'success'
                            );
                            dttb.ajax.reload();
                        },
                        error: function(data) {
                            swalWithBootstrapButtonss.fire(
                                'Error!',
                                'Error deleting rates.',
                                'error'
                            );
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtonss.fire(
                        'Cancelled',
                        'Your Data is Safe'

                    )
                }
            })
        });
    });
</script>
@endsection
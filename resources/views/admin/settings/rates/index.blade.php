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
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header bg-primary text-white border-0 rounded-top">
                <h5 class="modal-title" id="rates-modal-title">Add New Rates</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="rates-form" method="POST">
                    @csrf
                    <input type="hidden" id="rates-id" name="id">
                    <div class="form-group">
                        <label for="fare_name" class="font-weight-bold mb-2">Rates Name</label>
                        <input type="text" class="form-control" id="fare_name" name="fare_name">
                    </div>
                    <div class="form-group">
                        <label for="price" class="font-weight-bold mb-2">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                    </div>
                    <div class="modal-footer border-0 rounded-bottom">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="rates-submit-btn" class="btn btn-primary rounded-pill px-4 ml-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header bg-primary text-white border-0 rounded-top">
                <h5 class="modal-title" id="editModalLabel">Update Rates</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fare_names" class="col-form-label">Rates Name:</label>
                        <input type="text" class="form-control" id="fare_names" name="fare_names" required>
                    </div>
                    <div class="form-group">
                        <label for="prices" class="col-form-label">Price:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" id="prices" name="prices" min="0" step="0.01" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div> -->
                <div class="modal-footer border-0 rounded-bottom">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 ml-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {
        const dttb = $jq('#fares-table').DataTable({
            processing: true,
            serverSide: true,
            method: 'get',
            ajax: '/dashboard/settings/rates',
            order: [
                [3, "asc"]
            ],
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
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    type: 'date',
                    visible: false,
                    orderable: false,
                }
            ],
            "createdRow": function(row, data, index) {
                $('td', row).css('text-align', 'center');
            },
            "order": [
                [3, 'asc']
            ]
        });
    });
    // Add Rates
    $jq('#new-rates').click(function() {
        $jq('#rates-modal-title').html('Add New Rates');
        $jq('#rates-form').trigger('reset');
        $jq('#rates-modal').modal('show');
        $jq('#rates-submit-btn').html('Add Rates');
    });
    $jq('#rates-form').on('submit', function(e) {
        e.preventDefault();
        var form_data = $jq(this).serialize();
        $jq.ajax({
            url: "{{ route('rates.store') }}",
            type: "POST",
            data: form_data,
            success: function(data) {
                const dttb = $jq('#fares-table').DataTable();
                const form = $jq('#rates-form')[0];
                form.reset();
                dttb.ajax.reload();
                $jq('#rates-modal').modal('hide');
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
    });

    // Edit Rates Modal
    $jq(document).on('click', '.edit', function(event) {
        var fare_id = $jq(this).data('id');
        $jq.get("{{ route('rates.index') }}" + '/' + fare_id + '/edit', function(data) {
            $jq('#editForm').attr('action', "{{ url('dashboard/settings/rates') }}/" + fare_id);
            $jq('#fare_names').val(data.fare_name);
            $jq('#prices').val(data.price);
            $jq('#id').val(data.id);
            $jq('#editModal').modal('show');
        });
    });

    // Update Fare
    $jq('#editForm').on('submit', function(event) {
        event.preventDefault();
        var fare_id = $jq('#id').val();
        var form_data = $jq(this).serialize();
        $jq.ajax({
            url: "{{ url('dashboard/settings/rates') }}/" + fare_id,
            type: 'PUT',
            data: form_data,
            success: function(data) {
                const dttb = $jq('#fares-table').DataTable();
                $jq('#editModal').modal('hide');
                toastr.success('Rates Updated successfully.');

                dttb.ajax.reload();
                dttb.draw();

            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var error_msg = '';
                $jq.each(errors, function(key, value) {
                    error_msg += value[0] + '<br>';
                });
                toastr.error(error_msg, 'Error');
            }
        });
    });

    $jq(document).on('click', '.delete', function(event) {
        var url = $jq(this).data('url');
        const swalWithBootstrapButtonss = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success custom-green',
                cancelButton: 'btn btn-danger custom-red',
                actions: 'd-flex justify-content-center'
            },
            buttonsStyling: true,
            reverseButtons: true
        })

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
                $jq.ajax({
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
</script>
@endsection
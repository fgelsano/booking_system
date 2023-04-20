@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Accommodations
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addAccommodationModal">New Accommodations</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="accommodations-table" class="table table-bordered table-hover" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Vessel Name</th>
                                <th>Accommodation Name</th>
                                <th>Accommodation Image</th>
                                <th>Cottage Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal -->
<!-- <div class="modal fade" id="addAccommodationModal" tabindex="-1" role="dialog" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccommodationModalLabel">Add Accommodation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="accommodationForm" name="accommodationForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="fare_id" class="control-label">Passenger Type:</label>
                        <select class="form-control" id="fare_id" name="fare_id">
                            <option value="">-- Select Fare --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accommodation_name" class="control-label">Accommodation Name:</label>
                        <input type="text" class="form-control" id="accommodation_name" name="accommodation_name" required />
                    </div>
                    <div class="form-group">
                        <label for="accommodation_type" class="control-label">Accommodation Type:</label>
                        <input type="text" class="form-control" id="accommodation_type" name="accommodation_type" required />
                    </div>
                    <div class="form-group">
                        <label for="cottage_qy" class="control-label">Cottage Quantity:</label>
                        <input type="number" class="form-control" id="cottage_qy" name="cottage_qy" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- Edit Modal -->
<!-- <div class="modal fade" id="edit-accommodation-modal" tabindex="-1" role="dialog" aria-labelledby="edit-accommodation-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-accommodation-modal-title">Edit Accommodation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-accommodation-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="accommodation_id" id="accommodation_id">
                    <div class="form-group">
                        <label for="fare_id">Fare</label>
                        <select class="form-control" name="fare_id" id="fare_id">

                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accommodation_name">Accommodation Name</label>
                        <input type="text" class="form-control" name="accommodation_name" id="edit-accommodation_name">
                    </div>
                    <div class="form-group">
                        <label for="accommodation_type">Accommodation Type</label>
                        <input type="text" class="form-control" name="accommodation_type" id="edit-accommodation_type">
                    </div>
                    <div class="form-group">
                        <label for="cottage_qy">Cottage Quantity</label>
                        <input type="number" class="form-control" name="cottage_qy" id="edit-cottage_qy">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="edit-accommodation-btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- View Modal -->
<!-- <div class="modal fade" id="viewModals" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Accommodation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fare_name">Passenger Type</label>
                    <p id="fare_name"></p>
                </div>
                <div class="form-group">
                    <label for="fare_price">Fare Price</label>
                    <p id="price"></p>
                </div>
                <div class="form-group">
                    <label for="accommodation_name">Accommodation Name</label>
                    <p id="view_accommodation_name"></p>
                </div>
                <div class="form-group">
                    <label for="accommodation_type">Accommodation Type</label>
                    <p id="view_accommodation_type"></p>
                </div>
                <div class="form-group">
                    <label for="cottage_qy">Cottage Quantity</label>
                    <p id="view_cottage_qy"></p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Add Modal With Image -->
<div class="modal fade add" id="addAccommodationModal" tabindex="-1" role="dialog" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccommodationModalLabel">Add Accommodation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('accomodations.store') }}" id="accommodationForm" name="accommodationForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="vessel_id" class="control-label">Vessel Name:</label>
                        <select class="form-control" id="add-vessel-id" name="vessel_id">
                            <option value="">-- Select Vessel --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accommodation_name" class="control-label">Accommodation Name:</label>
                        <input type="text" class="form-control" id="add-accommodation-name" name="accommodation_name" required />
                    </div>
                    <div class="form-group">
                        <input id="add-accommodation-img" type="file" class="form-control dropify" name="image_path" data-default-file="" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png gif" data-show-remove="false" required>
                    </div>
                    <div class="form-group">
                        <label for="cottage_qy" class="control-label">Cottage Quantity:</label>
                        <input type="number" class="form-control" id="add-cottage-qy" name="cottage_qy" required />
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

<!-- View Modal -->
<div class="modal fade" id="viewModalss" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Accommodation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-widget widget-user shadow-lg">

                    <div class="widget-user-header text-white" style="background: url('assets/frontpage/1.jpeg') center center;">
                       
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header" id="view-vessel-name"></h5>
                                    <span class="description-text">VESSEL NAME</span>
                                </div>

                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header" id="view-accommodation-name"></h5>
                                    <span class="description-text">ACCOMMODATION NAME</span>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header" id="view-cottage-qy"></h5>
                                    <span class="description-text">COTTAGE QUANTITY</span>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="accommodation_img">Accommodation Image</label>
                    <br>
                    <img id="view-accommodation-img" src="" alt="Accommodation Image">
                </div>
                <div class="form-group">
                    <label for="vessel_name">Vessel Name</label>
                    <p id="view-vessel-name"></p>
                </div>
                <div class="form-group">
                    <label for="accommodation_name">Accommodation Name</label>
                    <p id="view-accommodation-name"></p>
                </div>
                <div class="form-group">
                    <label for="cottage_qy">Cottage Quantity</label>
                    <p id="view-cottage-qy"></p>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-accommodation-modal" tabindex="-1" role="dialog" aria-labelledby="edit-accommodation-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-accommodation-modal-title">Edit Accommodation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-accommodation-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="accommodation_id" id="accommodation_id">
                    <div class="form-group">
                        <label for="vessel_id">Vessels</label>
                        <select class="form-control" name="edit_vessel_id" id="edit-vessel-id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accommodation_name">Accommodation Name</label>
                        <input type="text" class="form-control" name="edit_accommodation_name" id="edit-accommodation-name">
                    </div>
                    <div class="form-group">
                        <label for="image_path">Accommodation Image</label>
                        <input id="edit-accommodation-img" type="file" class="form-control dropify" name="edit_image_path" data-default-file="" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png gif" data-show-remove="false">
                    </div>
                    <div class="form-group">
                        <label for="cottage_qy">Cottage Quantity</label>
                        <input type="number" class="form-control" name="edit_cottage_qy" id="edit-cottage-qy">
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
        $('.dropify').dropify();
        var dttb = $j('#accommodations-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/dashboard/settings/accomodations',
            method: 'GET',
            compact: true,
            order: [
                [4, "asc"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'vessel_name',
                    name: 'vessels.vessel_name'
                },
                {
                    data: 'accommodation_name',
                    name: 'accommodation_name'
                },
                {
                    data: 'image_path',
                    name: 'image_path',
                    render: function(data, type, row) {
                        if (!data) {
                            return 'No Image uploaded';
                        } else if (data == 'No Image Uploaded') {
                            return data;
                        } else {
                            return `
                                <img src="/storage/accommodation-images/${data}" class="img-circle elevation-2" width="100px" height="100px">
                            `;
                        }
                    },
                },
                {
                    data: 'cottage_qy',
                    name: 'cottage_qy'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "createdRow": function(row, data, index) {
                $j('td', row).css('text-align', 'center');
            }
        });
        $.ajax({
            url: "{{ route('accomodations.index') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var options = "<option value=''>-- Select Vessel --</option>";
                $.each(data.data, function(key, value) {
                    options += "<option value='" + value.vessel_id + "'>" + value.vessel_name + "</option>";
                });
                $("#add-vessel-id").html(options);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        

        $j('#accommodationForm').submit(function(event) {
            event.preventDefault();
            const formData = new FormData(document.getElementById('accommodationForm'));
            $('.dropify').dropify();
            axios.post(event.target.action, formData, {
                    headers: {
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    const dttb = $j('#accommodations-table').DataTable();
                    const form = $j('#accommodationForm')[0];
                    form.reset();
                    dttb.ajax.reload();
                    $('#addAccommodationModal').modal('hide');
                    toastr.success(response.data.message, 'Success');
                })
                .catch(error => {
                    var errors = xhr.responseJSON.errors;
                    var error_msg = '';
                    $.each(errors, function(key, value) {
                        error_msg += value[0] + '<br>';
                    });
                    toastr.error(error_msg, 'Error');
                });
        });

        $('#accommodations-table').on('click', '.edit', function() {
            $('.dropify').dropify();
            var accommodation_id = $j(this).data('id');
            $.get("/dashboard/settings/accomodations/" + accommodation_id + "/edit", function(data) {

                $('#edit-accommodation-form').attr('action', "/dashboard/settings/accomodations/" + accommodation_id);
                $('select[name="edit_vessel_id"]')
                var options = "<option value=''>-- Select Fare --</option>";
                $.each(data.vessels, function(key, value) {
                    options += "<option value='" + value.vessel_id + "'>" + value.vessel_name + "</option>";
                });
                $("#edit-vessel-id").html(options);
                $('select[name="edit_vessel_id"]').html(options).val(data.vessels.vessel_name);
                $('input[name="edit_accommodation_name"]').val(data.accommodation.accommodation_name);
                $('input[name=edit_image_path]').val(data.accommodation.image_path);
                if (data.accommodation.image_path) {
                    $('input[name=edit_image_preview').attr('src', data.accommodation.image_path);
                    $('input[name=edit_image_preview').show();
                }
                $('input[name=edit_cottage_qy]').val(data.accommodation.cottage_qy);
                $('input[name="accommodation_id"]').val(data.accommodation.id);
                $('#edit-accommodation-modal').modal('show');
            });
        });
        $('#edit-accommodation-img').on('change', function(e) {
            // get the selected file
            var file = e.target.files[0];

            // create a new FileReader object
            var reader = new FileReader();

            // set the onload function of the reader
            reader.onload = function(e) {
                // set the src of the image element to the result of the reader
                $('#edit-image-preview').attr('src', e.target.result);
                // show the image element
                $('#edit-image-preview').show();
            }

            // read the file as a Data URL
            reader.readAsDataURL(file);
        });

        // Edit with Axios
        // $('#accommodations-table').on('click', '.edit', function() {
        //     var accommodation_id = $j(this).data('id');
        //     axios.get("/dashboard/settings/accomodations/" + accommodation_id + "/edit")
        //         .then(function(response) {
        //             var data = response.data;
        //             $('#edit-accommodation-form').attr('action', "/dashboard/settings/accomodations/" + accommodation_id);
        //             var options = "<option value=''>-- Select Fare --</option>";
        //             $.each(data.vessels, function(key, value) {
        //                 options += "<option value='" + value.vessel_id + "'>" + value.vessel_name + "</option>";
        //             });
        //             $("#edit-vessel-id").html(options);
        //             $('select[name="edit_vessel_id"]').html(options).val(data.vessels.vessel_name);
        //             $('input[name="edit_accommodation_name"]').val(data.accommodation.accommodation_name);
        //             $('input[name=edit_image_path]').val(data.accommodation.image_path);
        //             if (data.accommodation.image_path) {
        //                 $('img[name=edit_image_path]').attr('src', data.accommodation.image_path);
        //                 $('img[name=edit_image_path]').show();
        //             }
        //             $('input[name=edit_cottage_qy]').val(data.accommodation.cottage_qy);
        //             $('input[name="accommodation_id"]').val(data.accommodation.id);
        //             $('#edit-accommodation-modal').modal('show');
        //         })
        //         .catch(function(error) {
        //             console.log(error);
        //         });
        // });

        // Update Accommodation
        $('#edit-accommodation-form').on('submit', function(e) {
            e.preventDefault();
            var accommodation_id = $('input[name="accommodation_id"]').val();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ url('dashboard/settings/accomodations') }}/" + accommodation_id,
                type: 'PUT',
                data: form_data,
                success: function(data) {
                    $('#edit-accommodation-modal').modal('hide');
                    $('#accommodations-table').DataTable().ajax.reload();
                    table.draw();
                    toastr.success('Accommodations Updated successfully.');
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

        // $('#edit-accommodation-form').on('submit', function(e) {
        //     e.preventDefault();
        //     var accommodation_id = $('input[name="accommodation_id"]').val();
        //     var form_data = $(this).serialize();
        //     axios.put("/dashboard/settings/accomodations/" + accommodation_id, form_data)
        //         .then(function(response) {
        //             $('#edit-accommodation-modal').modal('hide');
        //             $('#accommodations-table').DataTable().ajax.reload();
        //             table.draw();
        //             toastr.success('Accommodations Updated successfully.');
        //         })
        //         .catch(function(error) {
        //             var errors = error.response.data.errors;
        //             var error_msg = '';
        //             $.each(errors, function(key, value) {
        //                 error_msg += value[0] + '<br>';
        //             });
        //             toastr.error(error_msg, 'Error');
        //         });
        // });



        // View Function with Image
        $j('#accommodations-table').on('click', '.view', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('dashboard/settings/accomodations') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var accommodation = response.data;
                    var vessel = response.vessels;
                    console.log(accommodation);
                    console.log(vessel);
                    $j('#view-accommodation-img').attr('src', accommodation.image_path);
                    $j('#view-vessel-name').html(accommodation.vessel.vessel_name);
                    $j('#view-accommodation-name').html(accommodation.accommodation_name);
                    $j('#view-cottage-qy').html(accommodation.cottage_qy);
                    $('#viewModalss').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Delete Function SweetAlert2
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        $(document).on('click', '.delete', function() {
            var url = $(this).data('url');
            var accommodationId = $(this).data('id');

            swalWithBootstrapButtons.fire({
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
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Delete Successfully.',
                                'success'
                            );
                            dttb.ajax.reload();
                        },
                        error: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Error!',
                                'Error deleting accommodation.',
                                'error'
                            );
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled Successfully'
                    )
                }
            })
        });


        // $.ajax({
        //     url: "{{ route('accomodations.index') }}",
        //     type: "GET",
        //     dataType: "json",
        //     success: function(data) {
        //         var options = "<option value=''>-- Select Fare --</option>";
        //         $.each(data.data, function(key, value) {
        //             options += "<option value='" + value.id + "'>" + value.fare.fare_name + " (" + value.fare.price + ")</option>";
        //         });
        //         $("#fare_id").html(options);
        //     },
        //     error: function(xhr) {
        //         console.log(xhr.responseText);
        //     }
        // });



        // $('#accommodationForm').submit(function(e) {
        //     e.preventDefault();
        //     var form_data = $(this).serialize();
        //     $.ajax({
        //         url: "{{ route('accomodations.store') }}",
        //         type: "POST",
        //         data: form_data,
        //         success: function(data) {
        //             $('#addAccommodationModal').modal('hide');
        //             toastr.success('Accommodation added successfully.');
        //             dttb.ajax.reload();
        //             table.draw();
        //         },
        //         error: function(xhr) {
        // var errors = xhr.responseJSON.errors;
        // var error_msg = '';
        // $.each(errors, function(key, value) {
        //     error_msg += value[0] + '<br>';
        // });
        // toastr.error(error_msg, 'Error');
        //         }
        //     });
        // });



        // View Function
        // $j('#accommodations-table').on('click', '.view', function() {
        //     var id = $j(this).data('id');
        //     $.ajax({
        //         url: "{{ url('dashboard/settings/accomodations') }}/" + id,
        //         type: "GET",
        //         dataType: "json",
        //         success: function(response) {
        //             var accommodation = response.data;
        //             var fare = response.fare;
        //             // populate the modal with the data
        //             $j('#fare_name').html(fare.fare_name);
        //             $j('#price').html(fare.price);
        //             $j('#view_accommodation_name').html(accommodation.accommodation_name);
        //             $j('#view_accommodation_type').html(accommodation.accommodation_type);
        //             $j('#view_cottage_qy').html(accommodation.cottage_qy);

        //             $('#viewModals').modal('show');
        //         },
        //         error: function(xhr) {
        //             console.log(xhr.responseText);
        //         }
        //     });
        // });

        //Delete Function
        // $(document).on('click', '.delete', function() {
        //     var urls = $(this).data('url');
        //     if (confirm('Are you sure you want to delete this Accommodations?')) {
        //         $.ajax({
        //             url: urls,
        //             type: 'DELETE',
        //             data: {
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             success: function(data) {
        //                 toastr.success('Accommodations deleted successfully.');
        //                 table.draw();
        //             },
        //             error: function(xhr) {
        //                 toastr.error('Failed to delete accommodations');
        //             }
        //         });
        //     }
        // });

        // $(document).on('click', '.delete', function(e) {
        //     e.preventDefault();
        //     var accommodationId = $(this).data('id');
        //     var token = $('meta[name="csrf-token"]').attr('content');
        //     var toastrConfirm = toastr.confirm('Are you sure you want to delete this accommodation?', {
        //         onOk: function() {
        //             $.ajax({
        //                 url: '/accommodations/' + accommodationId,
        //                 type: 'DELETE',
        //                 data: {
        //                     _token: token
        //                 },
        //                 success: function() {
        //                     toastr.success('Accommodation deleted successfully');
        //                     $('#accommodation-' + accommodationId).remove();
        //                 },
        //                 error: function() {
        //                     toastr.error('An error occurred while deleting the accommodation');
        //                 }
        //             });
        //         }
        //     });
        // });

        // $(document).on('click', '.delete', function(e) {
        //     e.preventDefault();
        //     var url = $(this).data('url');

        //     // Show toastr confirmation message
        //     toastr.options = {
        //         "positionClass": "toast-top-right",
        //         "progressBar": true,
        //         "timeOut": "5000",
        //     };
        //     toastr.warning("Are you sure you want to delete this accommodation?", "Warning", {
        //         "closeButton": true,
        //         "positionClass": "toast-top-right",
        //         "progressBar": true,
        //         "timeOut": "0",
        //         "extendedTimeOut": "0",
        //         "onShown": function() {
        //             var modalConfirm = function(callback) {
        //                 $("#confirm-delete").modal('show');
        //                 $("#btn-confirm-delete").on("click", function() {
        //                     callback(true);
        //                     $("#confirm-delete").modal('hide');
        //                 });
        //                 $("#btn-close-delete").on("click", function() {
        //                     callback(false);
        //                     $("#confirm-delete").modal('hide');
        //                 });
        //             };
        //             modalConfirm(function(confirm) {
        //                 if (confirm) {
        //                     $.ajax({
        //                         url: url,
        //                         type: 'DELETE',
        //                         dataType: 'json',
        //                         success: function(data) {
        //                             if (data.success) {
        //                                 // Show Toastr success message
        //                                 toastr.success(data.message, "Success");
        //                                 // Reload DataTables
        //                                 $('#accommodation-table').DataTable().ajax.reload();
        //                             }
        //                         },
        //                         error: function(xhr, status, error) {
        //                             // Show Toastr error message
        //                             toastr.error('An error occurred while deleting the accommodation. Please try again later.', "Error");
        //                         }
        //                     });
        //                 }
        //             });
        //         }
        //     });
        // });
        // toastr.options = {
        //     "closeButton": true,
        //     "progressBar": true,
        //     "positionClass": "toast-top-right",
        //     "showDuration": "300",
        //     "hideDuration": "1000",
        //     "timeOut": "5000",
        //     "extendedTimeOut": "1000",
        //     "showEasing": "swing",
        //     "hideEasing": "linear",
        //     "showMethod": "fadeIn",
        //     "hideMethod": "fadeOut"
        // };

        // $(document).on('click', '.delete', function() {
        //     var urls = $(this).data('url');
        //     toastr.options = {
        //         "closeButton": true,
        //         "positionClass": "toast-top-right",
        //         "timeOut": 0,
        //         "extendedTimeOut": 0,
        //         "tapToDismiss": false,
        //         "onShown": function(toast) {
        //             toast.find('.toastr-confirm-btn-yes').click(function() {
        //                 $.ajax({
        //                     url: urls,
        //                     type: 'DELETE',
        //                     dataType: 'json',
        //                     data: {
        //                         "_token": "{{ csrf_token() }}"
        //                     },
        //                     success: function(data) {
        //                         toastr.success(data.success);
        //                         $('#accommodations-table').DataTable().ajax.reload();
        //                     },
        //                     error: function(data) {
        //                         toastr.error('Error deleting accommodation.');
        //                     }
        //                 });
        //             });

        //             toast.find('.toastr-confirm-btn-no').click(function() {
        //                 toastr.dismissAll();
        //             });
        //         }
        //     };

        //     toastr.warning('<br/><button type="button" class="btn btn-success toastr-confirm-btn-yes">Yes</button><button type="button" class="btn btn-danger toastr-confirm-btn-no">No</button>', 'Are you sure you want to delete this accommodation?', {
        //         allowHtml: true,
        //         closeButton: false,
        //         onShown: function(toast) {
        //             $('.toast .toast-body').css('color', '#fff');
        //         }
        //     });
        // });

        // $(document).on('click', '.delete', function() {
        //     console.log("Delete button clicked");
        //     var url = $(this).data('url');

        //     toastr.options = {
        //         "closeButton": true,
        //         "positionClass": "toast-top-right",
        //         "timeOut": 0,
        //         "extendedTimeOut": 0,
        //         "tapToDismiss": false,
        //         "onShown": function(toast) {
        //             console.log("onShown called");
        //             toast.find('.toastr-confirm-btn-yes.btn-success').click(function() {
        //                 console.log("Yes button clicked");
        //                 $.ajax({
        //                     url: url,
        //                     type: 'DELETE',
        //                     dataType: 'json',
        //                     data: {
        //                         "_token": "{{ csrf_token() }}"
        //                     },
        //                     success: function(data) {
        //                         toastr.success(data.message);
        //                         $('#accommodations-table').DataTable().ajax.reload();
        //                     },
        //                     error: function(data) {
        //                         toastr.error('Error deleting accommodation.');
        //                     }
        //                 });
        //             });

        //             toast.find('.toastr-confirm-btn-no.btn-danger').click(function() {
        //                 console.log("No button clicked");
        //                 toastr.dismissAll();
        //             });
        //         }
        //     };

        //     toastr.warning('<br/><button type="button" class="btn btn-success toastr-confirm-btn-yes">Yes</button><button type="button" class="btn btn-danger toastr-confirm-btn-no">No</button>', 'Are you sure you want to delete this accommodation?', {
        //         allowHtml: true,
        //         closeButton: false,
        //         onShown: function(toast) {
        //             console.log("onShown called for toastr.warning");
        //             $('.toast .toast-body').css('color', '#fff');
        //         }
        //     });
        // });

    });
</script>

@endsection
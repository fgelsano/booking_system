<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: ''
            },
            height: 300,
            width: 300
        });
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
            var accommodation_id = $(this).data('id');
            $.ajax({
                url: "/dashboard/settings/accomodations/" + accommodation_id + "/edit",
                type: "GET",
                success: function(data) {
                    var imageUrl = data.image_url;
                    console.log(imageUrl);
                    $('#edit-accommodation-form').attr('action', "/dashboard/settings/accomodations/" + accommodation_id);
                    var options = "<option value=''>-- Select Vessel --</option>";
                    // $.each(data.vessels, function(key, value) {
                    //     options += "<option value='" + value.vessel_id + "'>" + value.vessel_name + "</option>";
                    // });
                    
                    $.each(data.vessels, function(key, value) {
                        options += "<option value='" + value.vessel_id + "'>" + value.vessel_name + "</option>";
                    });
                    
                    $("#edit-vessel-id").html(options).val(data.accommodation.vessel_name);
                    console.log(data.accommodation.vessel_name);
                    $('input[name="edit_accommodation_name"]').val(data.accommodation.accommodation_name);
r
                    if (imageUl) {
                        var dropifyWrapper = $('.dropify-wrapper');
                        dropifyWrapper.find('.dropify-preview').removeClass('dropify-preview');
                        dropifyWrapper.find('.dropify-render img').attr('src', imageUrl);
                        $('input[name="edit_image_path"]').attr('data-default-file', imageUrl);
                        $('.dropify').dropify('destroy');
                        $('.dropify').dropify();
                    }
                    $('input[name="accommodation_id"]').val(data.accommodation.id);
                    $('input[name="edit_cottage_qy"]').val(data.accommodation.cottage_qy);
                    $('#edit-accommodation-modal').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText); 
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        });

        // $('#edit-accommodation-img').on('change', function(e) {
        //     // get the selected file
        //     var file = e.target.files[0];

        //     // create a new FileReader object
        //     var reader = new FileReader();

        //     // set the onload function of the reader
        //     reader.onload = function(e) {
        //         // set the src of the image element to the result of the reader
        //         $('#edit-image-preview').attr('src', e.target.result);
        //         // show the image element
        //         $('#edit-image-preview').show();
        //     }

        //     // read the file as a Data URL
        //     reader.readAsDataURL(file);
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
            var id = $j(this).data('id');
            var modal = $j('#viewModalss');
            $j.ajax({
                url: "{{ url('dashboard/settings/accomodations') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var accommodation = data.data;
                    // var vessel = accommodation.vessels;
                    var rawAccommodationImage = data.data.image_path;
                    var baseUrl = window.location.origin;
                    var accomodationImage = accommodation.image_path;

                    console.log(accommodation);
                    console.log(accommodation.vessel_name);
                    console.log(accommodation.accommodation_name);
                    console.log(accommodation.image_path);
                    console.log(rawAccommodationImage);
                    console.log(accommodation.cottage_qy);



                    if (rawAccommodationImage == 'No Image Uploaded' || rawAccommodationImage == '') {
                        modal.find('#view-accommodation-img').css({
                            'background': 'url(' + baseUrl + '/storage/no-image-uploaded.webp' + ') center center',
                            'background-size': 'cover'
                        });
                    } else {
                        var accomodationImg = baseUrl + '/storage/accommodation-images/'+ data.data.image_path;
                        console.log(accomodationImg);
                        modal.find('#view-accommodation-img').css({
                            'background': 'url(' +accomodationImg+ ') center center',
                            'background-size': 'cover'
                        });
                    }
                    modal.find('#view-vessel-name').html(accommodation.vessel_name);
                    modal.find('#view-accommodation-name').html(accommodation.accommodation_name);
                    modal.find('#view-cottage-qy').html(accommodation.cottage_qy);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle the error
                    console.error('Error getting accommodation data: ' + textStatus);

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
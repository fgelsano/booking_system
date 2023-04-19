<script>

    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('#vessels-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('vessels.index') }}', 
            method: 'get',
            compact: true,
            order: [[3, "asc"]],
            columns: [
                {
                    data: 'vessel_img',
                    name: 'vessel_img',
                    render: function(data, type, row) {
                        if(!data){
                            return 'No Image uploaded';
                        } else if (data == 'No Image Uploaded') {
                            return data;
                        } else {
                            return `
                                <img src="/storage/vessel-images/${data}" class="img-circle elevation-2" width="100px" height="100px">
                            `;
                        }
                        
                    },
                },
                {
                    data: 'vessel_name', 
                    name: 'vessel_name',
                },
                {
                    data: 'vessel_capacity', 
                    name: 'vessel_capacity',
                    width: '10%', 
                    "className":"text-center",
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    width: '20%',
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group">
                                <button data-id="${data['id']}" data-action="view" class="btn btn-info btn-sm vessel-model-btn">
                                    <i class="fa fa-eye"></i> View
                                </button>
                                <button data-id="${data['id']}" data-action="edit" class="btn btn-primary btn-sm vessel-model-btn">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm delete-vessel" data-id="${data['id']}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        `;
                    },
                    "className":"text-center",
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    type: 'date',
                    visible: false,
                    orderable: false,
                }
            ],
            "order": [[3, 'asc']]
        });
    });


    $j('#add-vessel-form').submit(function(event) {
        event.preventDefault();
        const formData = new FormData(document.getElementById('add-vessel-form'));
        
        axios.post(event.target.action, formData,{
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => {
            const dttb = $j('#vessels-table').DataTable();
            const form = $j('#add-vessel-form')[0];
            form.reset();
            dttb.ajax.reload();
            $('#add-vessel-modal').modal('hide');
            toastr.success(response.data.message, 'Success');
        })
        .catch(error => {
            console.log(error);
            toastr.error(error.data, 'Error');
        });
    });

    $j(document).on('click','.vessel-model-btn', function (event) {
        var button = $j(this); 
        var vesselId = button.data('id');
        var action = button.data('action');

        $j('#'+action+'-vessel').modal('show');
        var modal = $j('#'+action+'-vessel');
        
        $j.ajax({
            url: "{{ route('vessels.show', ':vesselId') }}".replace(':vesselId', vesselId),
            method: 'GET',
            success: function(data) {
                modal.find('#vessel-name').val(data.vessel.vessel_name);
                modal.find('#vessel-capacity').val(data.vessel.vessel_capacity);
                modal.attr('data-id').val(data.vessel.id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error
                console.error('Error getting vessel data: ' + textStatus);
            }
        });
    });


    $j('#edit-vessel-form').submit(function (event) {
        event.preventDefault();
        var vesselId = this.data('id');
        console.log(vesselId);
        const form = this;
        const formData = new FormData(form);
        const url = "{{ route('vessels.update', ':vesselId') }}".replace(':vesselId', vesselId);
        $j.ajax({
            url: url,
            method: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseJSON);

            }
        });
    });


</script>
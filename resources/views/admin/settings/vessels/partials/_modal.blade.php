<div class="modal fade" id="add-vessel-modal" tabindex="-1" role="dialog" aria-labelledby="newVesselLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding New Vessel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form method="POST" action="{{ route('vessels.store') }}" id="add-vessel-form">
            <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="vessel-name" type="text" placeholder="Vessel name" class="form-control" name="vessel_name" required autocomplete="name" autofocus>
                    </div>
                    <div class="input-group mb-3">
                        <input id="capacity" type="number" placeholder="Vessel capacity" class="form-control" name="vessel_capacity" required autocomplete="name">
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

<div class="modal fade" id="view-vessel" tabindex="-1" role="dialog" aria-labelledby="viewVesselLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vessel Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="vessel-name" type="text" placeholder="Vessel name" class="form-control" name="vessel_name" required autocomplete="name" autofocus disabled>
                    </div>
                    <div class="input-group mb-3">
                        <input id="vessel-capacity" type="number" placeholder="Vessel capacity" class="form-control" name="vessel_capacity" required autocomplete="name" disabled>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="" data-id="${data['id']}" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-sm delete-vessel" data-id="${data['id']}">
                    <i class="fa fa-trash"></i> Delete
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-vessel" tabindex="-1" role="dialog" aria-labelledby="editVesselLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Vessel Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="edit-vessel-form">
            <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="vessel-name" type="text" placeholder="Vessel name" class="form-control" name="vessel_name" required autocomplete="name" autofocus>
                    </div>
                    <div class="input-group mb-3">
                        <input id="vessel-capacity" type="number" placeholder="Vessel capacity" class="form-control" name="vessel_capacity" required autocomplete="name">
                    </div>
            </div>
            <div class="modal-footer">
                {{-- <input type="submit" value="Update" class="btn btn-primary btn-sm"> --}}
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
                    <i class="fa fa-save"></i> Update
                </button>

                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

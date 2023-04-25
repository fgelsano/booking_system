<!-- Add Modal With Image -->
<div class="modal fade" id="addAccommodationModal" tabindex="-1" role="dialog" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
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
                        <input id="add-accommodation-img" type="file" class="form-control dropify" name="image_path" data-default-file="" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png gif" data-show-remove="false">
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
                    <div class="widget-user-header text-white" id="view-accommodation-img"></div>
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
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
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
                        <input type="text" class="form-control" name="edit_accommodation_name" id="edit-accommodation_name">
                    </div>
                    <div class="form-group">
                        <label for="image_path">Accommodation Image</label>
                        <input id="edit-accommodation-img" type="file" class="form-control dropify" name="edit_image_path" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png gif" data-show-remove="false" required>
                    </div>
                    <div class="form-group">
                        <label for="cottage_qy">Cottage Quantity</label>
                        <input type="number" class="form-control" name="edit_cottage_qy" id="edit-cottage_qy">
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
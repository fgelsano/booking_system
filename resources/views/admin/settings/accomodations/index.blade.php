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
    @include('admin.settings.accomodations.partials._modals')
    @include('admin.settings.accomodations.partials._scripts')
@endsection
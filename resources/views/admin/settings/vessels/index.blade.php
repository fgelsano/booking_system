@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                Vessels
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('vessels.create') }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-vessel-modal">New Vessel</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        @include('admin.settings.vessels.partials._datatables')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.settings.vessels.partials._modal')
    @include('admin.settings.vessels.partials._scripts')
@endsection

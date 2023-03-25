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
                                <a href="{{ route('vessels.create') }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#new-vessel">New Vessel</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="vessels-table" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Capacity</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="new-vessel" tabindex="-1" role="dialog" aria-labelledby="newVesselLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding New Vessel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3">
                  <input id="vessel-name" type="text" placeholder="Vessel name" class="form-control" name="vessel-name" required autocomplete="name" autofocus>
                </div>
                <div class="input-group mb-3">
                  <input id="capacity" type="number" placeholder="Vessel capacity" class="form-control" name="vessel-capacity" required autocomplete="name">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#vessels-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('vessels.index') }}', 
                method: 'get',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'capacity', name: 'capacity'},
                ],
            });
        });
    </script>
@endsection

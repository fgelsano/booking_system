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
                            <div class="col-md-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">New Vessel</a>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
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

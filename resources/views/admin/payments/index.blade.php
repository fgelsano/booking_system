@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Payments
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">New Payments</a>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="users-table" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Passenger Name</th>
                                <th>Booking Number</th>
                                <th>Discount Type</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                        <label for="amount">Passenger Name</label>
                        <input type="text" class="form-control" id="passenger" name="passenger">
                    </div>
                <div class="form-group">
                        <label for="amount">Booking Number</label>
                        <input type="text" class="form-control" id="booking" name="booking">
                    </div>
                <div class="form-group">
                        <label for="amount">Discount Type</label>
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status">
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
        $j('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/dashboard/payments',
            method: 'get',
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'profile_id',
                    name: 'profile_id'
                },
                {
                    data: 'booking_id.id',
                    name: 'booking_id.id'
                },
                {
                    data: 'discount_id',
                    name: 'discount_id'
                },
                {
                    data: 'booking_id.origin',
                    name: 'booking_id.origin'
                },
                {
                    data: 'booking_id.destination',
                    name: 'booking_id.destination'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ],
            "createdRow": function(row, data, index) {
                $('td', row).css('text-align', 'center');
            },
        });
    });
</script>
@endsection
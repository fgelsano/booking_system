@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bookings Information</div>

                    <div class="card-body">

                    <div class="form-group">
                        <label for="bookings_id">Bookings ID : </label>
                        <span>{{ $bookings->id }}</span>
                    </div>

                    <div class="form-group">
                        <label for="user_id">User ID : </label>
                        <span>{{ $bookings->user_id }}</span>
                    </div>

                    <div class="form-group">
                        <label for="customer_id">Customer ID : </label>
                        <span>{{ $bookings->customer_id }}</span>
                    </div>

                    <div class="form-group">
                        <label for="bookingdetails_id">Booking Details ID : </label>
                        <span>{{ $bookings->bookingdetails_id }}</span>
                    </div>
                       
                    <div class="form-group">
                        <label for="schedule_id">Travel Date :</label>
                        <span>{{ $bookings->schedule->departure_date }}</span>
                    </div>

                    <div class="form-group">
                        <label for="customer_id">Passenger Name :</label>
                        Ryan

                    </div>  

                    <div class="form-group">
                        <label for="amount">Amount:</label>
                         1000
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <span>{{ $bookings->status }}</span>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

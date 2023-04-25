@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Delete Data</div>

                    <div class="card-body">
                        
                    <form action="{{ route('bookings.destroy', $bookings->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

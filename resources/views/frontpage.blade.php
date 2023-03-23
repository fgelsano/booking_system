@extends('layouts.front.app')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0 position-static">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('assets/frontpage/1.jpeg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/frontpage/2.jpeg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/frontpage/4.jpg') }}" class="d-block w-100" alt="...">
              </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div> 
    <div class="datePicker position-absolute">
      <form action="{{ route('bookings.store') }}" method="post" width="100%" height="100%">
        @csrf
        <div id="datepicker" class="font-weight-bold" width="100%" height="100%">
          <p>Select your travel date</p>
          @php
              $selectedDate = old('selected-date') ?: date('Y-m-d');
          @endphp
          <input type="hidden" id="selectedDate" name="selected-date" value="{{ $selectedDate }}" required>
          <p id="datepicker-text">{{ date('M d, Y', strtotime($selectedDate)) }}</p>
        </div>

        <select name="origin" id="origin" placeholder="Origin" class="form-control my-3" required>
          <option value="0" disabled selected>Select Origin</option>
          <option value="cebu" {{ old('origin') == 'cebu' ? 'selected' : '' }}>Cebu</option>
          <option value="hilongos" {{ old('origin') == 'cebu' ? 'selected' : '' }}>Hilongos</option>
        </select>
        <select name="destination" id="destination" placeholder="Destination" class="form-control my-3" required>
          <option value="0" disabled selected>Select Destination</option>
          <option value="cebu" {{ old('destination') == 'cebu' ? 'selected' : '' }}>Cebu</option>
          <option value="hilongos" {{ old('destination') == 'cebu' ? 'selected' : '' }}>Hilongos</option>
        </select>
        <input type="submit" value="Go" class="btn btn-primary btn-block">
        @if ( session('booking-error'))
          {{-- {{ dd(session('booking-error')) }} --}}
          <div class="alert alert-danger mt-3">
            @foreach(session('booking-error')->all() as $booking_error)
              <p>{{ $booking_error }}</p>
            @endforeach
          </div>
        @endif
      </form>
    </div>
@endsection

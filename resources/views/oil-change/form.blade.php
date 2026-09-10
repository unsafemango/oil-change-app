@extends('layout')

@section('title', 'Check Your Oil Change')

@section('content')
  <h2>Check if your car is due for an oil change</h2>
  @if ($errors->any())
    <div class="alert alert-error">
      <p>Please fix the following:</p>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('oil-change.store') }}" method="POST" class="form">
    @csrf
    <div class="form-row">
      <label for="current_odometer">Current Odometer (KM)</label>
      <input type="number" id="current_odometer" name="current_odometer" min="0" value="{{ old('current_odometer') }}" required>
    </div>

    <div class="form-row">
      <label for="previous_oil_change_date">Date of Previous Oil Change</label>
      <input type="date" id="previous_oil_change_date" name="previous_oil_change_date" value="{{ old('previous_oil_change_date') }}" required>
    </div>

    <div class="form-row">
      <label for="previous_odometer">Previous Odometer (KM)</label>
      <input type="number" id="previous_odometer" name="previous_odometer" min="0" value="{{ old('previous_odometer') }}" required>
    </div>

    <div class="form-row">
      <button type="submit" class="btn">Check</button>
    </div>
  </form>
@endSection
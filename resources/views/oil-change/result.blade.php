@extends('layout')

@section('title', 'Result')

@section('content')
  <h2>Result</h2>

  @if ($check->is_due)
    <div class="alert alert-due">
      <p><b>Your car is due for an oil change.</b></p>
    </div>
  @else
    <div class="alert alert-ok">
      <p><b>Your car is not due for an oil change yet.</b></p>
    </div>
  @endif

  <table class="details">
    <tbody>
      <tr>
        <th>Current Odometer</th>
        <td>{{ number_format($check->current_odometer) }}km</td>
      </tr>

      <tr>
        <th>Date of Previous Oil Change</th>
        <td>{{ $check->previous_oil_change_date->format('F j, Y') }}</td>
      </tr>

      <tr>
        <th>Odometer at Previous Oil Change</th>
        <td>{{ number_format($check->previous_odometer) }}km</td>
      </tr>
    </tbody>
  </table>

  <p class="nav-link">
    <a href="{{ route('oil-change.create') }}">Check another car</a>
  </p>
@endsection
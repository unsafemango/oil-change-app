<?php

namespace App\Http\Controllers;

use App\Models\OilChangeCheck;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class OilChangeController extends Controller
{
  private const DISTANCE_SINCE_OIL_CHANGE = 5000;

  private const MONTHS_SINCE_OIL_CHANGE = 6;

  /**
   * Display the oil change form.
   * @return \Illuminate\Contracts\View\View
   */
  public function create()
  {
    return view("oil-change.form");
  }

  /**
   * Validate the oil change form, determine whether an oil change is due,
   * save the check, and redirect to the results page.
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request)
  {
    // Validate the submitted odometer readings and previous oil change date
    $validated = $request->validate(
      [
        'previous_odometer' => ['required', 'integer', 'min:0'],
        'current_odometer' => ['required', 'integer', 'min:0', 'gte:previous_odometer'],
        'previous_oil_change_date' => ['required', 'date', 'before:today']
      ],
      [
        'previous_odometer.required' => 'Please enter the previous odometer reading.',
        'previous_odometer.integer' => 'The previous odometer must be a whole number.',
        'previous_odometer.min' => 'The previous odometer cannot be negative.',

        'current_odometer.required' => 'Please enter the current odometer reading.',
        'current_odometer.integer' => 'The current odometer must be a whole number.',
        'current_odometer.min' => 'The current odometer cannot be negative.',
        'current_odometer.gte' => 'The current odometer must be greater than or equal to the odometer at the previous oil change.',

        'previous_oil_change_date.required' => 'Please enter the previous oil change date.',
        'previous_oil_change_date.date' => 'Please enter a valid date.',
        'previous_oil_change_date.before' => 'The date of the previous oil change date must be in the past.',
      ]
    );

    // Calculate the date and distance differences for the next oil change
    $dateDue = Carbon::parse($validated['previous_oil_change_date'])->addMonths(self::MONTHS_SINCE_OIL_CHANGE);
    $distanceCovered = $validated['current_odometer'] - $validated['previous_odometer'];

    // An oil change is due if either the time or distance limit has been exceeded
    $isDue = $distanceCovered > self::DISTANCE_SINCE_OIL_CHANGE || now()->greaterThan($dateDue);

    // Save the validated data and calculated oil change status
    $check = OilChangeCheck::create([
      ...$validated,
      'is_due' => $isDue
    ]);

    // Redirect to the results page
    return redirect()->route('oil-change.show', $check);
  }

  /**
   * Display the oil change check result.
   * @param OilChangeCheck $check
   * @return \Illuminate\Contracts\View\View
   */
  public function show(OilChangeCheck $check)
  {
    return view('oil-change.result', ['check' => $check]);
  }
}

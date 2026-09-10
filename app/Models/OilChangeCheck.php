<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilChangeCheck extends Model
{
  protected $fillable = [
    'previous_odometer',
    'current_odometer',
    'previous_oil_change_date',
    'is_due'
  ];

  protected $casts = [
    'previous_odometer' => 'integer',
    'current_odometer' => 'integer',
    'previous_oil_change_date' => 'date',
    'is_due' => 'boolean',
  ];
}

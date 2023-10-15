<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FisheriesData extends Model
{
    use HasFactory;
    protected $fillable = ['entry_id', 'dissolved_oxygen', 'ph', 'turbidity', 'water_temperature', 'electrical_conductivity', 'datetime'];
}

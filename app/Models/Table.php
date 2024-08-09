<?php

namespace App\Models;

use App\Models\DiningArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'minimum_capacity', 'maximum_capacity', 'active', 'restaurant_id', 'dining_area_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function diningArea()
    {
        return $this->belongsTo(DiningArea::class);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function getTables($restaurantId, Request $request)
    {
        $type = $request->query('type', 'all');

        $query = Table::where('restaurant_id', $restaurantId);

        if ($type == 'active') {
            $query->where('active', true);
        }

        $tables = $query->get();

        $formattedTables = $tables->map(function ($table) {
            return [
                'name' => $table->name,
                'min_capacity' => $table->minimum_capacity,
                'max_capacity' => $table->maximum_capacity,
                'status' => $table->active == 1 ? 'Active' : 'Inactive',
                'dining_area' => $table->diningArea->name
            ];
        });

        return response()->json($formattedTables);
    }
}

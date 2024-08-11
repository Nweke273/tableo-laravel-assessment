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

        $restaurant = Restaurant::findOrFail($restaurantId);

        $tablesQuery = $restaurant->tables();

        if ($type == 'active') {
            $tablesQuery->where('active', true);
        }

        $tables = $tablesQuery->get();

        $formattedTables = $tables->map(function ($table) {
            return [
                'name' => $table->name,
                'min_capacity' => $table->minimum_capacity,
                'max_capacity' => $table->maximum_capacity,
                'status' => $table->active ? 'Active' : 'Inactive',
                'dining_area' => $table->diningArea->name
            ];
        });

        return response()->json($formattedTables);
    }
}

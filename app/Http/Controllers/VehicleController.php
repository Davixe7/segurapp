<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VehicleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required',
            'plate'        => 'required',
        ]);

        $vehicle  = Vehicle::create($request->except(['id']));
        $vehicles = Vehicle::where('apartment_id', $vehicle->apartment_id)->get();
        return Inertia::render('Apartments', compact('vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'apartment_id' => 'required',
            'plate'        => 'required',
        ]);

        $vehicle->update($request->except(['apartment_id', 'id']));
        $vehicles = Vehicle::where('apartment_id', $vehicle->apartment_id)->get();
        return Inertia::render('Apartments', compact('vehicles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        $vehicles = Vehicle::where('apartment_id', $vehicle->apartment_id)->get();
        return Inertia::render('Apartments', compact('vehicles'));
    }
}

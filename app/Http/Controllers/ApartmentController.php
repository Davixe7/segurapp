<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApartmentController extends Controller
{
    public function index(){
        $apartments = auth()->user()->residence->apartments()->with('residents')->orderBy('name')->get();
        return Inertia::render('Apartments', compact('apartments'));
    }

    public function store(Request $request){
        $request->validate(['name' => 'required|min:1']);

        $apartment  = Apartment::create([
            'name'         => $request->name,
            'residence_id' => auth()->user()->residence->id,
        ]);
        $apartments = Apartment::orderBy('name')->get();
        return Inertia::render('Apartments', compact('apartments'));
    }

    public function update(Request $request, Apartment $apartment){
        $request->validate(['name' => 'required|min:1']);

        $apartment->update($request->except('residents'));
        $apartments = Apartment::orderBy('name')->get();
        return Inertia::render('Apartments', compact('apartments'));
    }

    public function destroy(Request $request, Apartment $apartment){
        $apartment->delete();
        $apartments = Apartment::orderBy('name')->get();
        return Inertia::render('Apartments', compact('apartments'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResidentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'apartment_id' => 'required',
        ]);

        $resident  = Resident::create($request->except('id'));
        $residents = Resident::orderBy('name')->get();
        return Inertia::render('Apartments', compact('residents'));
    }

    public function update(Request $request, Resident $resident){
        $request->validate(['name' => 'required|min:8']);

        $resident->update($request->except('id'));
        $residents = Resident::orderBy('name')->get();
        return Inertia::render('Apartments', compact('residents'));
    }

    public function destroy(Request $request, Resident $resident){
        $resident->delete();
        $residents = Resident::orderBy('name')->get();
        return Inertia::render('Residents', compact('residents'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Visits', [
            'visits' => auth()->user()->residence->visits()->with('apartment')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required',
            'name' => 'required',
            'residence_id' => 'required',
        ]);

        Visit::create($request->except('id'));
        return Inertia::render('Visits', [
            'visits' => auth()->user()->residence->visits()->with('apartment')->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'dni' => 'required',
            'name' => 'required',
        ]);

        $visit->update($request->except(['id', 'residence_id']));
        return Inertia::render('Visits', [
            'visits' => auth()->user()->residence->visits()->with('apartment')->latest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return Inertia::render('Visits', [
            'visits' => auth()->user()->residence->visits()->latest()->get()
        ]);
    }
}

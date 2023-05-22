<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Reports', [
            'reports' => auth()->user()->residence->reports()->with('porteria')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'  => 'required'
        ]);

        Report::create([
            'description'  => $request->description,
            'user_id'      => auth()->id(),
            'residence_id' => auth()->user()->residence->id,
        ]);

        return Inertia::render('Reports', [
            'reports' => auth()->user()->residence->reports()->with('porteria')->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'description'  => 'required',
            'phone'        => 'required',
        ]);

        $data = $request->only(['description']);

        if( $request->filled('response') && $report->response == ''){
            $data['closed_at'] = now();
        }

        $report->update($data);
        return Inertia::render('Reports', [
            'reports' => auth()->user()->residence->reports()->with('porteria')->latest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return Inertia::render('Reports', [
            'reports' => auth()->user()->residence->reports()->latest()->get()
        ]);
    }
}

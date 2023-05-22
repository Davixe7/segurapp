<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Complaints', [
            'complaints' => auth()->user()->residence->complaints()->with('apartment')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'description'  => 'required',
            'phone'        => 'required',
            'residence_id' => 'required',
        ]);

        Complaint::create($request->except('id', 'apartment'));
        return Inertia::render('Complaints', [
            'complaints' => auth()->user()->residence->complaints()->with('apartment')->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'title'        => 'required',
            'description'  => 'required',
            'phone'        => 'required',
        ]);

        $data = $request->except(['id', 'residence_id', 'apartment']);

        if( $request->filled('response') && $complaint->response == ''){
            $data['closed_at'] = now();
        }

        $complaint->update($data);
        return Inertia::render('Complaints', [
            'complaints' => auth()->user()->residence->complaints()->with('apartment')->latest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return Inertia::render('Complaints', [
            'complaints' => auth()->user()->residence->complaints()->latest()->get()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = auth()->user()->residence->bills()->latest()->get();
        return Inertia::render('Bills', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreateBill');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|min:8',
            'amount' => 'required|numeric'
        ]);

        $data = array_merge($request->except(['id']), ['residence_id'=>auth()->user()->residence->id]);
        $bills = Bill::create($data);
        $bills = auth()->user()->residence->bills()->latest()->get();
        return Inertia::render('Bills', compact('bills'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'title'  => 'required|min:8',
            'amount' => 'required|numeric'
        ]);

        $bills = Bill::create($request->only(['starts_at', 'expires_at', 'description']));
        $bills = auth()->user()->residence->bills()->latest()->get();
        return Inertia::render('Bills', compact('bills'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        $bills = auth()->user()->residence->bills()->latest()->get();
        return Inertia::render('Bills', compact('bills'));
    }
}

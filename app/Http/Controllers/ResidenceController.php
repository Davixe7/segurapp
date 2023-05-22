<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResidenceController extends Controller
{
    public function index(){
        $residences = Residence::orderBy('name')->with('user')->get();
        return Inertia::render('Residences', compact('residences'));
    }

    public function store(Request $request){
        $request->validate([
            'name'       => 'required|min:8',
            'address'    => 'required|min:8',
            'user.email' => 'unique:App\Models\User,email'
        ]);

        $user = User::create([
            'name'     => $request->user['name'],
            'email'    => $request->user['email'],
            'password' => $request->user['password']
        ]);

        $data = $request->only('name', 'address', 'phone');
        $data['user_id'] = $user->id;

        $residence  = Residence::create($data);
        $residences = Residence::orderBy('name')->get();
        return Inertia::render('Residences', compact('residences'));
    }

    public function update(Request $request, Residence $residence){
        $request->validate([
            'name'    => 'required|min:8',
            'address' => 'required|min:8',
            'phone'   => 'numeric',
        ]);

        $residence->update($request->only('name', 'address', 'phone'));
        $residence->user->update([
            'name'     => $request['user.name']  ?: $residence->user->name,
            'email'    => $request['user.email'] ?: $residence->user->email,
            'password' => $request['user.password'] ? bcrypt($request['user.password']) : $residence->user->password
        ]);

        $residences = Residence::orderBy('name')->with('user')->get();
        return Inertia::render('Residences', compact('residences'));
    }

    public function destroy(Request $request, Residence $residence){
        $residence->delete();
        $residences = Residence::orderBy('name')->with('user')->get();
        return Inertia::render('Residences', compact('residences'));
    }
}

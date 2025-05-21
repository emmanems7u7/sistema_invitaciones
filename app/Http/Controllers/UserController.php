<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Celular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('celulares')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //  dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'celular' => 'required|numeric',
            'whatsapp' => 'required|boolean'
        ]);

        // Crear el usuario
        $user = User::create(attributes: [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('diego123'),
        ]);

        $celular = Celular::create([

            'celular' => $request->celular,
            'whatsapp' => $request->whatsapp,
            'tipo_id' => $user->id,
            'tipo_type' => 'user'
        ]);
        // Asignar el rol de Cliente
        $user->assignRole('cliente');

        return redirect()->back()->with('success', 'Usuario creado correctamente.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }

    public function getUserData(User $user)
    {
        dd($user);
        return response()->json($user);
    }


}

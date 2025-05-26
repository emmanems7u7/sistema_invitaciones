<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Models\Invitacion;
use App\Models\User;
class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ubicacion $ubicacion)
    {

        $users = User::all();
        $invitacion = Invitacion::with(['ubicaciones'])->findOrFail($ubicacion->invitacion_id);
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'invitaciones', 'url' => route('crear_invitacion', ['id' => $invitacion->user_id])],
            ['name' => 'Editar', 'url' => route('home')],
        ];
        return view('invitaciones.edit', compact('invitacion', 'users', 'breadcrumb', 'ubicacion'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        $request->validate([

            'actividad' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i:s',
            'direccion' => 'required|string|max:255',
            'geolocalizacion' => 'nullable|string|regex:/^-?\d+(\.\d+)?\s*,\s*-?\d+(\.\d+)?$/',

            // Validar que al menos uno exista
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icono' => 'nullable|string|max:100',

        ], [

            'actividad.required' => 'La actividad es obligatoria.',
            'fecha.required' => 'La fecha es obligatoria.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'direccion.required' => 'La dirección es obligatoria.',
            'geolocalizacion.regex' => 'La geolocalización debe tener el formato correcto: latitud, longitud.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser jpeg, png, jpg o webp.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
            'icono.max' => 'El ícono no debe tener más de 100 caracteres.',
        ]);

        if (!$request->filled('icono') && !$request->hasFile('imagen')) {
            return back()->withErrors(['representacion' => 'Debe seleccionar una imagen o un ícono.'])->withInput();
        }

        $ubicacion->update([

            'actividad' => $request->actividad,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'direccion' => $request->direccion,
            'geolocalizacion' => $request->geolocalizacion,
            'icono' => $request->icono,
            'imagen' => $ubicacion->imagen,
        ]);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}

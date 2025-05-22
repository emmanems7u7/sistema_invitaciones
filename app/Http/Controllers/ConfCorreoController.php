<?php

namespace App\Http\Controllers;

use App\Models\ConfCorreo;
use Illuminate\Http\Request;
use App\Mail\CorreoPrueba;
use Illuminate\Support\Facades\Mail;
class ConfCorreoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Configuracion', 'url' => route('home')],
        ];
        $config = ConfCorreo::first();

        return view('configuracion_correo.index', compact('breadcrumb', 'config'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'port' => 'required|integer',
            'username' => 'required|email',
            'password' => 'required|string',
            'encryption' => 'nullable|string',
            'from_address' => 'required|email',
            'from_name' => 'required|string',
        ]);

        $config = ConfCorreo::first();

        if ($config) {
            $config->update($request->all());
        } else {
            // Si no existe configuración, la crea
            ConfCorreo::create($request->all());
        }

        return redirect()->route('configuracion_correo.index')
            ->with('success', 'Configuración actualizada correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfCorreo $confCorreo)
    {
        //
    }

    public function enviarPrueba()
    {

        $conf = ConfCorreo::first();

        if (!$conf) {
            return response()->json(['error' => 'Configuración no encontrada'], 404);
        }


        // Enviar el correo de prueba
        Mail::to('emmanuelz7u7@gmail.com')->send(new CorreoPrueba('Este es un correo de prueba.'));

        // $this->enviarCorreoPrueba(1, 'emmanuelz7u7@gmail.com');

        return response()->json(['mensaje' => 'Correo enviado correctamente.']);
    }
}

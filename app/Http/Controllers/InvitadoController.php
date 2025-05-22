<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use App\Models\Invitacion;
use Illuminate\Http\Request;
use App\Models\Invitaciones;
use App\Exports\InvitadosExport;
use Maatwebsite\Excel\Facades\Excel;
use Hashids\Hashids;
use App\Mail\InvitacionConfirmacionMail;
use Illuminate\Support\Facades\Mail;
class InvitadoController extends Controller
{
    public function index()
    {
        $invitados = Invitado::all();
        return view('invitados.index', compact('invitados'));
    }

    public function create()
    {
        $invitaciones = Invitacion::all();
        return view('invitados.create', compact('invitaciones'));
    }

    public function store(Request $request, Invitacion $invitacion)
    {

        $request->validate([
            'nombre_completo' => 'required|string',
            'email' => 'required|email|unique:invitados,email',
            'celular' => 'required|integer',
        ]);


        Invitado::create([
            'nombre_completo' => $request->nombre_completo,
            'email' => $request->email,
            'celular' => $request->celular,
            'asistencia' => 0,
            'invitacion_id' => $invitacion->id
        ]);

        return redirect()->back()->with('success', 'Invitado creado exitosamente.');
    }

    public function show(Invitado $invitado)
    {
        return view('invitados.show', compact('invitado'));
    }

    public function edit(Invitado $invitado)
    {
        $invitaciones = Invitacion::all();
        return view('invitados.edit', compact('invitado', 'invitaciones'));
    }

    public function update(Request $request, Invitado $invitado)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apepat' => 'required|string',
            'apemat' => 'required|string',
            'invitacion_id' => 'required|exists:invitacions,id',
            'email' => 'required|email|unique:invitados,email,' . $invitado->id,
        ]);

        $invitado->update($request->all());

        return redirect()->back()->with('success', 'Invitado actualizado exitosamente.');
    }

    public function destroy(Invitado $invitado)
    {
        $invitado->delete();
        return redirect()->back()->with('success', 'Invitado eliminado exitosamente.');
    }

    public function confirmar_asistencia($invitado_id)
    {
        $hashids = new Hashids(config('app.key'), 10);
        $decoded = $hashids->decode($invitado_id);

        if (empty($decoded)) {
            return response()->json(['status' => 0, 'message' => 'Lo sentimos, el enlace es inválido. Por favor, verifica e intenta de nuevo.'], 404);
        }

        $id = $decoded[0];
        $invitado = Invitado::find($id);

        if (!$invitado) {
            return response()->json(['status' => 0, 'message' => 'No pudimos encontrar tu invitación. ¿Seguro que el enlace es correcto?'], 404);
        }

        if ($invitado->asistencia == 1) {
            return response()->json(['status' => 1, 'message' => '¡Ya has confirmado tu asistencia! ¡Gracias!']);
        }

        $invitado->asistencia = 1;
        $invitado->save();

        return response()->json(['status' => 1, 'message' => '¡Gracias por confirmar tu asistencia! Nos vemos pronto.']);


    }
    public function export($invitacion_id)
    {
        return Excel::download(new InvitadosExport($invitacion_id), 'invitados.xlsx');
    }

    public function enviarEmail($id)
    {
        $hashids = new Hashids(config('app.key'), 10);
        $invitados = Invitado::where('invitacion_id', $id)->get()->map(function ($invitado) use ($id, $hashids) {
            $invitado->enlace = route('invitacion.generar_invitado', [
                'id' => $hashids->encode($id),
                'invitado_id' => $hashids->encode($invitado->id)
            ]);
            return $invitado;
        });

        $invitacion = Invitacion::with('user')->find($id);

        foreach ($invitados as $invitado) {
            Mail::to($invitado->email)->send(new InvitacionConfirmacionMail($invitado, $invitacion));
        }
    }
}

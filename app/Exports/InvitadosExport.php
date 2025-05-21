<?php

namespace App\Exports;

use App\Models\Invitado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Hashids\Hashids;
use App\Models\Invitacion;

class InvitadosExport implements FromView
{
    protected $invitacion_id;

    public function __construct($invitacion_id)
    {
        $this->invitacion_id = $invitacion_id;
    }

    public function view(): View
    {
        $id = $this->invitacion_id;
        $invitacion = Invitacion::find($id);
        $hashids = new Hashids(config('app.key'), 10);
        $invitados = Invitado::where('invitacion_id', $id)->get()->map(function ($invitado) use ($id, $hashids) {
            $invitado->enlace = route('invitacion.generar_invitado', [
                'id' => $hashids->encode($id),
                'invitado_id' => $hashids->encode($invitado->id)
            ]);
            return $invitado;
        });
        return view('invitados.tabla_invitados', [
            'invitados' => $invitados,
            'nombre_invitacion' => $invitacion->tipo . ' ' . $invitacion->nombre
        ]);
    }
}

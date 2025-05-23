<?php

namespace App\Imports;

use App\Models\Invitado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class InvitadosImport implements ToModel
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $invitacion_id;

    public function __construct($invitacion_id)
    {
        $this->invitacion_id = $invitacion_id;
    }

    public function model(array $row)
    {
        HeadingRowFormatter::default('none');
        return new Invitado([
            'nombre_completo' => $row[0],  // Columna A
            'email' => $row[1],            // Columna B
            'celular' => $row[2],          // Columna C
            'asistencia' => 0,
            'invitacion_id' => $this->invitacion_id,
        ]);
    }
}

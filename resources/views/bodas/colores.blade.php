@php
    // Definir la función fuera del ciclo foreach
    function hexToRgba($hex, $opacity = 1)
    {
        // Eliminar el símbolo '#' si está presente
        $hex = ltrim($hex, '#');

        // Si el valor hexadecimal es corto (3 caracteres), expandirlo a 6 caracteres
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        // Extraer los componentes RGB del valor hexadecimal
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // Devolver el valor en formato RGBA
        return "rgba($r, $g, $b, $opacity)";
    }
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <title>Confirmación de asistencia</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 30px auto;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4a90e2;
            margin-bottom: 10px;
        }

        p {
            line-height: 1.6;
            font-size: 16px;
        }

        a.button {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background-color: #4a90e2;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
        }

        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>¡Hola {{ $invitado->nombre_completo }}!</h2>

        <p>
            <strong>{{ $invitacion->user->name  }}</strong> te invita cordialmente al evento
            <strong>"{{ $invitacion->nombre }}"</strong>.
        </p>

        <p>
            Por favor, haz clic en el siguiente botón para ver la invitación y confirmar tu asistencia:
        </p>
        <p>
            <a href="{{ $invitado->enlace }}" class="button" target="_blank" rel="noopener noreferrer">
                Confirmar asistencia
            </a>
        </p>

        <p>
            ¡Esperamos contar con tu presencia en esta ocasión especial!
        </p>

        <br>
        <p>Saludos cordiales,</p>
        <p>El equipo organizador</p>

        <div class="footer">
            <p>
                Este correo ha sido enviado automáticamente por <strong>Invitaciones CR-Monkeys</strong>.
            </p>
            <p>
                Para cualquier consulta, puede contactarnos al teléfono
                <a href="https://wa.me/178777346" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i> 78777346
                </a>
                o al correo electrónico
                <a href="mailto:diego.chavez@crmonkeys-codestudio.com">diego.chavez@crmonkeys-codestudio.com</a>.
            </p>
            <p>
                Visite nuestra página web: <a href="https://invitaciones.crmonkeys-codestudio.com/" target="_blank"
                    rel="noopener noreferrer">https://invitaciones.crmonkeys-codestudio.com/</a>
            </p>
        </div>
    </div>
</body>

</html>
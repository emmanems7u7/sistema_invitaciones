<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invitación de Cumpleaños</title>
  <!-- Enlace a Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('https://example.com/imagen-fondo.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
    }

    .invitation-container {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 40px 60px;
      border-radius: 20px;
      box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.5);
      text-align: center;
      animation: slideIn 1.5s ease-out;
    }

    @keyframes slideIn {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    h1 {
      font-size: 3.5em;
      font-weight: 700;
      letter-spacing: 5px;
      text-transform: uppercase;
      margin-bottom: 20px;
      color: #ff9800;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .rsvp-button {
      padding: 12px 30px;
      background-color: #ff6347;
      color: white;
      font-size: 1.2em;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      margin-top: 30px;
      transition: background-color 0.3s ease;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }

    .rsvp-button:hover {
      background-color: #ff4500;
      transform: scale(1.05);
    }

    .form-container {
      display: none;
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      margin-top: 30px;
    }

    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 1em;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus, input[type="email"]:focus {
      border-color: #ff6347;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background-color: #32CD32;
      color: white;
      font-size: 1.2em;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #228B22;
    }

    .additional-info {
      margin-top: 40px;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.7);
      border-radius: 15px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
    }

    .section-title {
      font-size: 2em;
      color: #ff9800;
      margin-bottom: 15px;
      text-transform: uppercase;
      text-align: center;
    }

    .info {
      font-size: 1.2em;
      margin: 10px 0;
    }

    .timeline {
      list-style-type: none;
      margin-top: 20px;
      padding-left: 0;
      font-size: 1.2em;
    }

    .timeline li {
      margin: 10px 0;
      position: relative;
      padding-left: 25px;
    }

    .timeline li::before {
      content: '';
      position: absolute;
      left: 0;
      top: 7px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #ff6347;
    }

    .timeline li span {
      font-weight: 600;
      color: #ff6347;
    }
  </style>
</head>
<body>
  <div class="invitation-container">
    <h1>¡Estás invitado!</h1>
    <p>¡Ven a celebrar el cumpleaños de [Nombre]!</p>
    <p>Una fiesta llena de sorpresas, diversión y mucha alegría.</p>
    <button class="rsvp-button" onclick="showForm()">Confirmar Asistencia</button>

    <div class="form-container" id="rsvpForm">
      <h3>Confirma tu Asistencia</h3>
      <form id="rsvpFormContent">
        <input type="text" id="name" placeholder="Tu nombre" required>
        <input type="email" id="email" placeholder="Tu correo electrónico" required>
        <button type="submit" class="submit-btn">Enviar</button>
      </form>
    </div>
  </div>

  <!-- Información adicional -->
  <div class="container mt-5 additional-info">
    <div class="section-title">Datos del Cumpleañero</div>
    <div class="info">Nombre: [Nombre del Cumpleañero]</div>
    <div class="info">Edad: [Edad]</div>
    <div class="info">Fecha de nacimiento: [Fecha]</div>

    <div class="section-title">Datos de los Papás y Padrinos</div>
    <div class="info">Papá: [Nombre del Papá]</div>
    <div class="info">Mamá: [Nombre de la Mamá]</div>
    <div class="info">Padrinos: [Nombre de los Padrinos]</div>

    <div class="section-title">Cronograma de Actividades</div>
    <ul class="timeline">
      <li><span>15:00</span> - Recepción de los invitados</li>
      <li><span>16:00</span> - Actividades para niños</li>
      <li><span>17:00</span> - Show en vivo</li>
      <li><span>18:00</span> - Comida y bebida</li>
      <li><span>19:00</span> - Corte de pastel</li>
      <li><span>20:00</span> - Baile y fiesta</li>
    </ul>
  </div>

  <!-- Script de Bootstrap JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    function showForm() {
      const formContainer = document.getElementById('rsvpForm');
      formContainer.style.display = 'block';
    }

    document.getElementById('rsvpFormContent').addEventListener('submit', function(event) {
      event.preventDefault();
      alert('¡Gracias por confirmar tu asistencia! Nos vemos en la fiesta.');
      document.getElementById('rsvpForm').style.display = 'none';
    });
  </script>
</body>
</html>

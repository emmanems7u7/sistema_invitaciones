<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>{{ $nombre_evento }}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Monkey-Invitaciones" name="keywords">
  <meta content="Monkey-Invitaciones" name="description">

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap"
    rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Chewy&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&display=swap" rel="stylesheet">
  <!-- Font Awesome CDN (versión 6.4.0) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


  <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <style>
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
    @foreach ($fuentes as $fuente)
    @php 
    $fuente_ = $fuente->fuente;

    @endphp
  @endforeach

    @foreach($invitacion->colores as $color)
    @php
      // Convertir los colores a RGBA y asignar a las variables
      if ($color->tipo == 'primario') {
      $primario = $color->codigo;
      $primario_rgba = hexToRgba($color->codigo, 0.8);
      }

      if ($color->tipo == 'hover') {
      $primario_hover = $color->codigo;
      $primario_hover_rgba = hexToRgba($color->codigo, 0.8);
      }

      if ($color->tipo == 'borde') {
      $primario_border = $color->codigo;
      $primario_border_rgba = hexToRgba($color->codigo, 0.8);
      }

      if ($color->tipo == 'secundario') {
      $secundario = $color->codigo;
      $secundario_rgba = hexToRgba($color->codigo, 0.8);
      }

      if ($color->tipo == 'fondo') {
      $fondo = $color->codigo;
      $fondo_rgba = hexToRgba($color->codigo, 0.8);
      }
      if ($color->tipo == 'fuente_primaria') {
      $fondo = $color->codigo;
      $fondo_rgba = hexToRgba($color->codigo, 0.8);
      }
      if ($color->tipo == 'fuente_secundaria') {
      $fondo = $color->codigo;
      $fondo_rgba = hexToRgba($color->codigo, 0.8);
      }
    @endphp
  @endforeach :root {
      --blue: #007bff;
      --indigo: #6610f2;
      --purple: #6f42c1;
      --pink: #e83e8c;
      --red: #dc3545;
      --orange: #fd7e14;
      --yellow: #ffc107;
      --green: #28a745;
      --teal: #20c997;
      --cyan: #17a2b8;
      --white: #fff;
      --gray: #6c757d;
      --gray-dark: #343a40;
      --primary:
        {{$primario}}
      ;
      --primary_rgba:
        {{$primario_rgba}}
      ;

      --primary_hover:
        {{$primario_hover}}
      ;
      --primary_hover_rgba:
        {{$primario_hover_rgba}}
      ;

      --primary_border:
        {{$primario_border}}
      ;
      --primary_border_rgba:
        {{$primario_border_rgba}}
      ;

      --secondary:
        {{$secundario}}
      ;
      --secondary_rgba:
        {{$secundario_rgba}}
      ;

      --fondo:
        {{$fondo}}
      ;
      --fondo-rgba:
        {{$fondo_rgba}}
      ;
      --fuente:
        {{$fuente_}}
      ;

      --success: #28a745;
      --info: #17a2b8;
      --warning: #ffc107;
      --danger: #dc3545;
      --light: #FFFFFF;
      --dark: #121F38;
      --breakpoint-xs: 0;
      --breakpoint-sm: 576px;
      --breakpoint-md: 768px;
      --breakpoint-lg: 992px;
      --breakpoint-xl: 1200px;
      --font-family-sans-serif: "Montserrat", sans-serif;
      --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }
  </style>

  <style>
    #drop-area {
      border: 3px dashed #aaa;
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      background-color: #f8f9fa;
      transition: border-color 0.3s;
    }

    #drop-area.dragover {
      border-color: var(--primary_border);
      background-color: #e9f5ff;
    }

    .preview-container {
      position: relative;
      display: inline-block;
      margin: 10px;
    }

    .preview-container img {
      max-height: 200px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .remove-image {
      position: absolute;
      top: 5px;
      right: 5px;
      background: rgba(255, 0, 0, 0.7);
      border: none;
      border-radius: 50%;
      color: white;
      font-size: 20px;
      cursor: pointer;
    }

    .preview-container img {
      max-height: 200px;
      border-radius: 10px;
    }

    .card {


      background-color: var(--fondo);

    }

    .modal-content {

      background-color: var(--fondo);

    }

    .bg-input {
      background-color: var(--fondo);
    }

    .bg-input:focus {

      box-shadow: 0 0 0 0.2rem var(--primary_rgba) !important;
    }

    html,
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      width: 100%;
    }
  </style>
</head>

<style>
  #overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(93 55 98 / 96%);
    /* Fondo oscuro con opacidad */
    z-index: 9999;
    /* Asegura que esté encima de todo el contenido */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
  }

  /* Estilo para el texto animado */
  #invitationText {
    font-size: 24px;
    color: white;
    font-weight: bold;
    margin-bottom: 20px;
    opacity: 0;
    transform: translateY(-20px);
    animation: slideIn 1s forwards;
    /* Animación de deslizamiento */
  }

  /* Animación de deslizamiento */
  @keyframes slideIn {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Estilo para el botón dentro de la capa */
  #closeButton {
    padding: 15px 30px;
    background-color: var(--primary);
    color: white;
    border: none;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  #closeButton:hover {
    background-color: var(--primary_hover);
  }

  /* Estilo para bloquear el desplazamiento */
  body.no-scroll,
  html.no-scroll {
    overflow: hidden;
    height: 100%;
  }
</style>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
  <!-- Capa superpuesta -->
  <div id="overlay">
    <!-- Texto animado que menciona abrir invitación -->
    <div id="invitationText">¡Abre tu invitación!</div>

    <!-- Botón para cerrar la capa -->
    <button id="closeButton">Abrir</button>
  </div>
  <script>

    $(document).ready(function () {

      $('body, html').addClass('no-scroll');


      $('#closeButton').on('click', function () {
        $('#overlay').fadeOut();
        $('body, html').removeClass('no-scroll');
      });
    });
  </script>
  @foreach ($bloques_vista as $bloque)
    @if(
    in_array($bloque['tipo'], [
    'carrusel',
    'info_general',
    'info',
    'galeria',
    'galeria_2',
    'hora',
    'ubicacion',
    'reproductor_audio',
    'boton_recuerdos',
    'recuerdos_cargados',
    'asistencia'
    ])
    )
    @include($bloque['ruta_componente'])
    @else
    <p>Tipo de bloque no reconocido.</p>
    @endif
  @endforeach
  <style>
    /* From Uiverse.io by cssbuttons-io */
    .c-button {
      color: #000;
      font-weight: 700;
      font-size: 16px;
      text-decoration: none;
      padding: 0.9em 1.6em;
      cursor: pointer;
      display: inline-block;
      vertical-align: middle;
      position: relative;
      z-index: 1;
    }

    .c-button--gooey {
      color: var(--primary);
      text-transform: uppercase;
      letter-spacing: 2px;
      border: 4px solid var(--primary);
      border-radius: 0;
      position: relative;
      transition: all 700ms ease;
    }

    .c-button--gooey .c-button__blobs {
      height: 100%;
      filter: url(#goo);
      overflow: hidden;
      position: absolute;
      top: 0;
      left: 0;
      bottom: -3px;
      right: -1px;
      z-index: -1;
    }

    .c-button--gooey .c-button__blobs div {
      background-color: var(--primary);
      width: 34%;
      height: 100%;
      border-radius: 100%;
      position: absolute;
      transform: scale(1.4) translateY(125%) translateZ(0);
      transition: all 700ms ease;
    }

    .c-button--gooey .c-button__blobs div:nth-child(1) {
      left: -5%;
    }

    .c-button--gooey .c-button__blobs div:nth-child(2) {
      left: 30%;
      transition-delay: 60ms;
    }

    .c-button--gooey .c-button__blobs div:nth-child(3) {
      left: 66%;
      transition-delay: 25ms;
    }

    .c-button--gooey:hover {
      color: #fff;
    }

    .c-button--gooey:hover .c-button__blobs div {
      transform: scale(1.4) translateY(0) translateZ(0);
    }
  </style>




  <!-- RSVP End -->


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-white py-5" id="contact" style="margin-top: 90px;">
    <div class="container text-center py-5">
      <div class="section-title position-relative text-center">
        <h1 class="font-secondary display-3 text-white">Contactanos</h1>

      </div>
      <div class="d-flex justify-content-center mb-4">

        <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
      </div>
      <div class="d-flex justify-content-center py-2">
        <p class="text-white" href="#">diego.chavez@crmonkeys-codestudio.com</p>
        <span class="px-3">|</span>
        <p class="text-white" href="#">78777346</p>
      </div>
      <p class="m-0">&copy; <a class="text-primary" href="crmonkeys-codestudio.com">crmonkeys-codestudio.com</a>
      </p>
    </div>
  </div>
  <!-- Footer End -->




  <!-- Scroll to Bottom -->
  <i class="fa fa-2x fa-angle-down text-white scroll-to-bottom"></i>

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-outline-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

  <!-- Template Javascript -->
  <script src="{{ asset('js/main.js') }}"></script>


  <script>
    $(document).ready(function () {
      let dropArea = $("#drop-area");
      let fileInput = $("#file-input");
      let previewContainer = $("#preview-container");

      // Evento para seleccionar archivos
      fileInput.change(function (event) {
        handleFiles(event.target.files);
      });

      // Arrastrar y soltar (drag & drop)
      dropArea.on("dragover", function (e) {
        e.preventDefault();
        dropArea.addClass("dragover");
      });

      dropArea.on("dragleave", function () {
        dropArea.removeClass("dragover");
      });

      dropArea.on("drop", function (e) {
        e.preventDefault();
        dropArea.removeClass("dragover");

        handleFiles(e.originalEvent.dataTransfer.files);
      });

      // Función para manejar los archivos
      function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
          let file = files[i];
          if (file.type.startsWith("image/")) {
            let fileURL = URL.createObjectURL(file);

            // Crear contenedor de vista previa para la imagen
            let preview = $('<div class="preview-container"></div>');
            let img = $('<img src="' + fileURL + '" class="img-fluid">');
            let removeBtn = $('<button class="remove-image"><i class="fas fa-times"></i></button>');

            // Agregar imagen y botón de eliminar al contenedor
            preview.append(img).append(removeBtn);
            previewContainer.append(preview);

            // Eliminar imagen al hacer clic en el botón "X"
            removeBtn.click(function () {
              preview.remove();
            });
          }
        }
      }
    });
  </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
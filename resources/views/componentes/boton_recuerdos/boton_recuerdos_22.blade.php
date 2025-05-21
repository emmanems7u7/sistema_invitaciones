<style>
    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
    }
</style>
<div class="center-container mt-4">
    <button class="c-button c-button--gooey" data-bs-toggle="modal" data-bs-target="#rsvpModal">
        {{$bloque['contenido']['titulo']}}
        <div class="c-button__blobs">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </button>

    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display: block; height: 0; width: 0;">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7"
                    result="goo"></feColorMatrix>
                <feBlend in="SourceGraphic" in2="goo"></feBlend>
            </filter>
        </defs>
    </svg>
</div>

<!-- Modal -->
<div class="modal fade" id="rsvpModal" tabindex="-1" aria-labelledby="rsvpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">


        <div class="modal-content">

            <div class="modal-header">
                <h6> <strong>¡Comparte tu experiencia!</strong><br></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="bg-light p-4 rounded shadow-sm mb-4">
                    <p class="mb-3">

                        Deja tu nombre, escribe unas palabras especiales y, si lo deseas, sube fotos tomadas durante el
                        evento.
                    </p>
                    <ul class="mb-0 list-unstyled">
                        <li class="mb-2"><i class="fas fa-pen me-2 text-primary"></i>Escribe un mensaje memorable.</li>
                        <li class="mb-2"><i class="fas fa-camera me-2 text-primary"></i>Sube una o varias imágenes del
                            evento.</li>
                        <li><i class="fas fa-eye me-2 text-primary"></i>Tus fotos se mostrarán en esta página y también
                            estarán disponibles para los organizadores.</li>
                    </ul>
                </div>
                </p>
                <form action="{{ route('mensajes.store', $invitacion_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Nombre -->
                    <div class="form-floating mb-3 shadow-sm">
                        <input type="text" class="form-control bg-input border-0 py-4 px-3" id="nombre" name="nombre"
                            placeholder="Añade tu nombre">
                        <label for="nombre">Nombre</label>
                    </div>

                    <div class="form-floating mb-3 shadow-sm">
                        <textarea class="form-control bg-input border-0 px-3 pt-4" placeholder="Escribe tu mensaje aquí"
                            id="mensaje" name="mensaje" style="height: 150px;" required></textarea>
                        <label for="mensaje">Mensaje</label>
                    </div>

                    <!-- Área de arrastrar y soltar -->
                    <div class="form-group">
                        <div class="card shadow-sm p-4">
                            <div id="drop-area" class="mb-3 position-relative text-center">
                                <p class="text-muted">Arrastra y suelta imágenes aquí o</p>
                                <label class="btn btn-primary">
                                    Seleccionar Imágenes
                                    <input type="file" id="file-input" name="imagenes[]" class="d-none" accept="image/*"
                                        multiple>
                                </label>
                            </div>

                            <!-- Vista previa de las imágenes -->
                            <div id="preview-container" class="d-flex flex-wrap justify-content-center"></div>
                        </div>
                    </div>

                    <!-- Botón para enviar el formulario -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
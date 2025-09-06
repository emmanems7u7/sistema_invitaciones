<script>

    let textArray = [];

    // Función para cerrar el modal y limpiar el formulario
    function closeModal() {
        $('#textModal').modal('hide');
        $('#textForm')[0].reset();
    }


    let tiposDisponibles = ['Titulo', 'Subtitulo', 'Parrafo'];  // Array que guarda los tipos disponibles

    let campoCounter = 0;
    // mapa fieldId -> tipo seleccionado (ej: {'campo_1': 'titulo'})
    let selectedTipos = {};

    function closeModal() {
        $('#textModal').modal('hide');
    }

    function availableTipos() {
        return tiposDisponibles.filter(t => !Object.values(selectedTipos).includes(t));
    }

    function addTextField(preselectedTipo = null, preColor = '#000000', preContenido = '') {
        const disponibles = availableTipos();
        if (disponibles.length === 0 && preselectedTipo === null) {
            alert('No hay más tipos disponibles.');
            return;
        }

        campoCounter++;
        const fieldId = 'campo_' + campoCounter;

        // Construir select
        let optionsHtml = '';
        tiposDisponibles.forEach(tipo => {
            const usedElsewhere = Object.values(selectedTipos).includes(tipo);
            const disabled = (usedElsewhere && tipo !== preselectedTipo) ? 'disabled' : '';
            const selected = (preselectedTipo === tipo) ? 'selected' : '';
            optionsHtml += `<option value="${tipo}" ${disabled} ${selected}>${tipo}</option>`;
        });

        const html = `
      <div class="border rounded p-3 mb-3" id="${fieldId}">
        <div class="form-group mb-3">
          <label><strong>Tipo</strong></label>
          <select class="form-control tipo-select" data-field-id="${fieldId}">
            ${optionsHtml}
          </select>
        </div>

        <div class="form-group mb-3">
          <label><strong>Color</strong></label>
          <div class="d-flex align-items-center">
            <input type="color" class="form-control form-control-color mr-2" value="${preColor}">
            <span id="preview_${fieldId}" class="ml-2" 
                  style="display:inline-block; width:24px; height:24px; border:1px solid #ccc; background:${preColor}; border-radius:4px;">
            </span>
          </div>
        </div>

        <div class="form-group mb-3">
          <label><strong>Contenido</strong></label>
          <textarea class="form-control" rows="3" required>${preContenido}</textarea>
        </div>

        <div class="text-right">
          <button type="button" class="btn btn-danger btn-sm btn-remove">
            <i class="fa fa-trash"></i> Eliminar
          </button>
        </div>
      </div>
    `;

        $('#textFieldsContainer').append(html);

        // seleccionar elementos recién creados
        const $field = $(`#${fieldId}`);
        const tipo = preselectedTipo || $field.find('select.tipo-select option:not([disabled])').first().val();
        selectedTipos[fieldId] = tipo;

        // agregar al array global
        textArray.push({
            fieldId: fieldId,
            tipo: tipo,
            color: preColor,
            contenido: preContenido
        });
        // eventos
        $field.find('.btn-remove').on('click', function () {
            removeTextField(fieldId);
        });

        $field.find('.tipo-select').on('change', function () {
            const val = $(this).val();
            selectedTipos[fieldId] = val;
            const item = textArray.find(t => t.fieldId === fieldId);
            if (item) item.tipo = val;
            updateAllSelects();
        });

        $field.find('input[type="color"]').on('input', function () {
            const color = $(this).val();
            document.getElementById('preview_' + fieldId).style.background = color;
            const item = textArray.find(t => t.fieldId === fieldId);
            if (item) item.color = color;
        });

        $field.find('textarea').on('input', function () {
            const contenido = $(this).val();
            const item = textArray.find(t => t.fieldId === fieldId);
            if (item) item.contenido = contenido;
        });

        updateAllSelects();
    }

    function removeTextField(fieldId) {
        delete selectedTipos[fieldId];
        $(`#${fieldId}`).remove();
        textArray = textArray.filter(t => t.fieldId !== fieldId);
        updateAllSelects();
    }
    function updateColorPreview(input, fieldId) {
        document.getElementById('preview_' + fieldId).style.background = input.value;
    }

    function updateAllSelects() {
        // actualizar opciones en todos los selects para deshabilitar las usadas en otros campos
        $('.tipo-select').each(function () {
            const $s = $(this);
            const fieldId = $s.data('field-id');
            const currentVal = selectedTipos[fieldId];

            $s.find('option').each(function () {
                const val = $(this).val();
                if (val === currentVal) {
                    $(this).prop('disabled', false);
                } else {
                    const usedElsewhere = Object.values(selectedTipos).some(v => v === val);
                    $(this).prop('disabled', usedElsewhere);
                }
            });
        });

        // Habilitar/deshabilitar botón Agregar
        $('#btnAddText').prop('disabled', availableTipos().length === 0);
    }

    function submitTextForm() {
        const bloqueId = $('#bloque_id').val();

        $.ajax({
            url: $('#textForm').attr('action'),
            type: 'POST',
            data: {
                bloque_id: bloqueId,
                textos: textArray.map(({ tipo, color, contenido }) => ({ tipo, color, contenido })),
                _token: $('input[name="_token"]').val()
            },
            success: function (response) {
                // Limpiar formulario y array
                $('#textFieldsContainer').empty();
                textosArray = [];
                selectedTipos = {};

                // Contenedor donde se mostrarán los textos
                const $container = $(`#addedTexts_${bloqueId}`);
                $container.empty();

                if (response.length === 0) {
                    $container.html('<p>No hay textos para este bloque.</p>');
                    return;
                }

                // Construir las cards
                let html = '<div class="row">';
                response.forEach(texto => {
                    html += `
                    <div class="col-md-6 mb-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title" style="display:flex; align-items:center;">
                                    <span style="width:16px; height:16px; display:inline-block; margin-right:8px; background:${texto.color}; border:1px solid #ccc; border-radius:4px;"></span>
                                    <span style="color:${texto.color}">${texto.tipo}</span>
                                </h5>
                                <p class="card-text">${texto.contenido}</p>
                                <form action="/textos/${texto.id}" method="POST" style="display:inline;">
                                    <input type="hidden" name="_token" value="${$('input[name=_token]').val()}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <button type="button" class="btn btn-warning" onclick="openEditModal(${texto.id})">Editar</button>
                            </div>
                        </div>
                    </div>
                `;
                });
                html += '</div>';

                $container.html(html);

                alert('Textos guardados!');
            },
            error: function (xhr) {
                alert('Error al guardar los textos');
            }
        });
    }

    // inicialización al abrir modal (opcional)
    $(document).ready(function () {


        updateAllSelects();
    });

</script>


<!-- Modal texto -->
<div class="modal" tabindex="-1" role="dialog" id="textModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Agregar Texto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ajusta action y method según tu ruta -->
                <form id="textForm" method="POST" action="{{ route('textos.store') }}">
                    @csrf
                    <div id="textFieldsContainer"></div>

                    <!-- Campo para seleccionar el bloque (si lo necesitas escondido) -->
                    <input type="hidden" id="bloque_id" name="bloque_id" value="">

                    <div class="mt-3">
                        <button type="button" id="btnAddText" onclick="addTextField();" class="btn btn-primary">Agregar
                            Texto</button>
                        <button type="button" class="btn btn-success" onclick="submitTextForm()">Guardar Textos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addTipoLetraModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('fuentes.store') }}" method="POST" id="form_fuentes">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Registrar Datos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">


                    <input type="hidden" name="invitacion_id" class="form-control" id="invitacion_id"
                        value="{{  $id }}">

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" name="tipo" class="form-control" id="tipo" required>
                    </div>

                    <div class="mb-3">
                        <label for="fuente" class="form-label">Fuente</label>
                        <input type="text" name="fuente" class="form-control" id="fuente">
                    </div>

                    <div class="mb-3">
                        <label for="cdn" class="form-label">CDN</label>
                        <input type="text" name="cdn" class="form-control" id="cdn">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn-fuente" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    // Función para editar tipo de letra
    function editTipoLetra(id) {
        const url = "{{ route('fuentes.edit', ['id' => ':id']) }}".replace(':id', id);
        fetch(url)
            .then(response => response.json())
            .then(data => {

                document.getElementById('registroModalLabel').textContent = 'Editar Fuente';

                document.getElementById('invitacion_id').value = data.invitacion_id;
                document.getElementById('tipo').value = data.tipo;
                document.getElementById('fuente').value = data.fuente;
                document.getElementById('cdn').value = data.cdn;
                document.getElementById('btn-fuente').textContent = 'Actualizar Fuente';

                document.getElementById('form_fuentes').action = `/fuentes/${data.id}`;
                const form = document.getElementById('form_fuentes');
                form.method = 'POST'
                let methodInput = document.getElementById('method_input');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.id = 'method_input';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PUT';
            });
    }
    function crearTipoLetra() {
        document.getElementById('registroModalLabel').textContent = 'Crear Fuente';
        document.getElementById('btn-fuente').textContent = 'Crear Fuente';

        document.getElementById('form_fuentes').action = '/fuentes';
        const methodInput = document.getElementById('method_input');
        if (methodInput) {
            methodInput.remove();
        }
    }
</script>
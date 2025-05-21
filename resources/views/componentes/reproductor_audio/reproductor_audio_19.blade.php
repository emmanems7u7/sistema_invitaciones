<style>
    /* From Uiverse.io by ElsayedShamsEldeen */
    /* The switch - the box around the speaker*/
    .toggleSwitch {
        width: 50px;
        height: 50px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        transition-duration: 0.3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.13);
        overflow: hidden;
    }

    /* Hide default HTML checkbox */
    #checkboxInput {
        display: none;
    }

    .bell {
        width: 18px;
    }

    .bell path {
        fill: white;
    }

    .speaker {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition-duration: 0.3s;
    }

    .speaker svg {
        width: 18px;
    }

    .mute-speaker {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        z-index: 3;
        transition-duration: 0.3s;
    }

    .mute-speaker svg {
        width: 18px;
    }

    #checkboxInput:checked+.toggleSwitch .speaker {
        opacity: 0;
        transition-duration: 0.3s;
    }

    #checkboxInput:checked+.toggleSwitch .mute-speaker {
        opacity: 1;
        transition-duration: 0.3s;
        background-color: var(--secondary);
    }

    #checkboxInput:active+.toggleSwitch {
        transform: scale(0.7);
    }

    #checkboxInput:hover+.toggleSwitch {
        background-color: rgb(61, 61, 61);
    }
</style>


<!-- From Uiverse.io by ElsayedShamsEldeen -->

<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <input type="checkbox" id="checkboxInput" hidden />
        <label for="checkboxInput" class="toggleSwitch">
            <div class="speaker">
                <!-- Ícono de sonido -->
                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" viewBox="0 0 75 75">
                    <path
                        d="M39.389,13.769 L22.235,28.606 L6,28.606 L6,47.699 L21.989,47.699 L39.389,62.75 L39.389,13.769z"
                        style="stroke:#fff;stroke-width:5;stroke-linejoin:round;fill:#fff;"></path>
                    <path
                        d="M48,27.6a19.5,19.5 0 0 1 0,21.4M55.1,20.5a30,30 0 0 1 0,35.6M61.6,14a38.8,38.8 0 0 1 0,48.6"
                        style="fill:none;stroke:#fff;stroke-width:5;stroke-linecap:round"></path>
                </svg>
            </div>

            <div class="mute-speaker">
                <!-- Ícono de silencio -->
                <svg version="1.0" viewBox="0 0 75 75" stroke="#fff" stroke-width="5">
                    <path d="m39,14-17,15H6V48H22l17,15z" fill="#fff" stroke-linejoin="round"></path>
                    <path d="m49,26 20,24m0-24-20,24" fill="#fff" stroke-linecap="round"></path>
                </svg>
            </div>

            <!-- Reproductor de audio oculto -->
            <audio id="audio" src="{{ asset('storage/' . $bloque['contenido'][0]['audio']) }}"></audio>
        </label>
    </div>
</div>

<script>
    const checkbox = document.getElementById('checkboxInput');
    const audio = document.getElementById('audio');
    const closeButton = document.getElementById('closeButton');
    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            audio.play();
        } else {
            audio.pause();

        }
    });

    closeButton.addEventListener('click', function () {

        audio.play().catch(error => {
            console.error("Error al intentar reproducir el audio:", error);
        });
        checkbox.checked = true;
    });
</script>
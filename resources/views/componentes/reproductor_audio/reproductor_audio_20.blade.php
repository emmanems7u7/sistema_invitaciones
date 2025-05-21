<style>
    .audio-player {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 300px;
        height: 80px;
        background-color: var(--primary);
        border-radius: 8px;
        padding: 8px;
        box-sizing: border-box;
    }

    .album-cover {
        width: 64px;
        height: 64px;
        background-color: #fff;
        border-radius: 50%;
        margin-right: 12px;
    }

    .player-controls {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .song-info {
        margin-bottom: 4px;
    }

    .song-title {
        font-size: 16px;
        color: #fff;
        margin: 0;
    }

    .artist {
        font-size: 12px;
        color: #b3b3b3;
        margin: 0;
    }

    .progress-bar {
        width: 100%;
        height: 4px;
        background-color: var(--secondary);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress {
        width: 0%;
        height: 100%;
        background-color: var(--primary_border);
        transform-origin: left;
        transition: width 0.1s ease-out;

    }

    .buttons {
        display: flex;
    }

    button {
        background: none;
        border: none;
        cursor: pointer;
        outline: none;
    }

    .play-btn,
    .pause-btn {
        font-size: 16px;
        color: #fff;
        margin-right: 8px;
        transition: transform 0.2s ease-in-out;
    }

    .play-btn:hover,
    .pause-btn:hover {
        transform: scale(1.2);
    }
</style>
<div class="container-fluid" @if(!empty($bloque['textura']))
    style="background-image: url('{{ asset('storage/' . $bloque['textura']) }}'); padding: 40px; ; background-position: center;"
@endif>
    <div class="d-flex justify-content-center align-items-center">
        <div class="audio-player">
            <div class="album-cover">
                <img src="{{asset('storage/' . $bloque['contenido'][1]['imagen']) }}" style="width: 66px;
    border-radius: 50px;" alt="Album Cover">
            </div>
            <div class="player-controls">
                <div class="song-info">
                    <div class="song-title">{{$bloque['titulo']}}</div>
                    <p class="artist">{{$bloque['subtitulo']}}</p>
                </div>
                <div class="progress-bar">
                    <div class="progress" id="progress"></div>
                </div>
                <div class="buttons">
                    <button class="play-btn" id="playButton">
                        <svg viewBox="0 0 16 16" class="bi bi-play-fill" fill="currentColor" height="16" width="16"
                            xmlns="http://www.w3.org/2000/svg" style="color: white">
                            <path fill="white"
                                d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z">
                            </path>
                        </svg>
                    </button>
                    <button class="pause-btn" id="pauseButton" style="display:none;">
                        <svg viewBox="0 0 16 16" class="bi bi-pause-fill" fill="currentColor" height="16" width="16"
                            xmlns="http://www.w3.org/2000/svg" style="color: white">
                            <path fill="white"
                                d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <audio id="audioPlayer" src="{{ asset('storage/' . $bloque['contenido'][0]['audio']) }}"></audio>
        </div>
    </div>
</div>
<script>
    // Obtener los elementos necesarios
    const playButton = document.getElementById('playButton');
    const pauseButton = document.getElementById('pauseButton');
    const audioPlayer = document.getElementById('audioPlayer');
    const progressBar = document.getElementById('progress');

    // Evento de clic en el botón de play
    playButton.addEventListener('click', function () {
        // Reproducir el audio
        audioPlayer.play().catch(error => {
            console.error("Error al intentar reproducir el audio:", error);
        });

        // Mostrar el botón de pausa y ocultar el botón de play
        playButton.style.display = 'none';
        pauseButton.style.display = 'inline-block';
    });

    // Evento de clic en el botón de pause
    pauseButton.addEventListener('click', function () {
        // Pausar el audio
        audioPlayer.pause();

        // Mostrar el botón de play y ocultar el botón de pausa
        playButton.style.display = 'inline-block';
        pauseButton.style.display = 'none';
    });

    // Actualizar la barra de progreso mientras se reproduce el audio
    audioPlayer.addEventListener('timeupdate', function () {
        // Calcular el porcentaje de la barra de progreso
        const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progressBar.style.width = progress + '%';
    });


    closeButton.addEventListener('click', function () {

        playButton.click();

    });
</script>
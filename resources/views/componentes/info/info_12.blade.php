<style>
    .wedding-box {

        background: url(../images/ptn-bg.jpg);
    }

    .serviceBox {
        padding: 25px 30px;
        text-align: center;
        background: #ffffff;
        border-top: 3px solid var(--primary);
        border-bottom: 3px solid var(--primary);
        position: relative;
    }

    .serviceBox h4 {
        font-size: 17px;
    }

    .serviceBox:before {
        content: "";
        border-top: 0 solid var(--primary);
        border-right: 0 solid transparent;
        position: absolute;
        left: 0;
        top: 0;
        z-index: 1;
        transition: all 0.3s ease 0s;
    }

    .serviceBox:hover:before {
        border-top-width: 78px;
        border-right-width: 78px;
    }

    .serviceBox:after {
        content: "";
        border-bottom: 0 solid var(--primary);
        border-left: 0 solid transparent;
        position: absolute;
        bottom: 0;
        right: 0;
        z-index: 1;
        transition: all 0.3s ease 0s;
    }

    .serviceBox:hover:after {
        border-bottom-width: 78px;
        border-left-width: 78px;
    }

    .serviceBox .service-icon {
        display: inline-block;
        width: 100px;
        height: 100px;

        border: 2px solid var(--primary);
        background: #ffffff;
        font-size: 60px;
        color: var(--primary);
        margin-bottom: 20px;
        position: relative;
    }

    .service-icon img {
        width: 96%;
        /* Ajusta la imagen al 100% del contenedor */
        height: 94%;
        /* Ajusta la imagen al 100% del contenedor */
        object-fit: cover;
        /* Recorta la imagen para llenar el espacio sin deformarse */
    }

    .serviceBox .title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        letter-spacing: 1px;
        margin: 0 0 12px 0;
        text-transform: uppercase;
        position: relative;
        transition: all 0.3s ease 0s;
    }

    .serviceBox:hover .title {
        letter-spacing: 3px;
    }

    .serviceBox .description {
        font-size: 15px;
        color: #333333;
        letter-spacing: 1px;
        line-height: 27px;
        margin: 0;
    }

    @media only screen and (max-width:990px) {
        .serviceBox {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 767px) {
        .title-box h2 {
            font-size: 38px;
        }
    }

    .title-box {
        text-align: center;
        margin-bottom: 30px;
    }
</style>
<div id="wedding" class="wedding-box">
    <div class="container">
        <div class="row">
            @foreach ($bloque['contenido'] as $index => $info)
                <div class="col-md-4 col-sm-6">
                    <div class="serviceBox">
                        <div class="service-icon"><img src="{{asset('storage/' . $info['imagen'])}}" alt=""></div>
                        <h3 class="title">{{$info['titulo']}}</h3>
                        <h4>{{$info['subtitulo']}}</h4>
                        <p class="description">
                            {{$info['parrafo']}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
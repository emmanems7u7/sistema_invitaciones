<style>
    /*------------------------------------------------------------------
    About
-------------------------------------------------------------------*/

    .about-box {
        padding: 40px 0px;
    }

    .title-box {
        text-align: center;
        margin-bottom: 30px;
    }

    .title-box h2 {
        font-size: 60px;
        font-family: 'Marck Script', cursive;
        color: #222222;
    }

    .title-box h2 span {
        color: #dd666c;
        text-decoration: underline;
    }

    .about-main-info h2 {
        font-size: 40px;
        font-family: 'Marck Script', cursive;
    }

    .about-main-info h2 span {
        color: #dd666c;
        text-decoration: underline;
    }


    @media (min-width: 768px) and (max-width: 991px) {
        .about-img {
            margin-bottom: 30px;
            margin-top: 30px;
        }

    }

    @media (max-width: 767px) {
        .about-main-info h2 {
            font-size: 24px;
        }

        .about-img {
            margin-bottom: 30px;
        }
    }
</style>
<div id="about" class="about-box">
    <div class="about-a1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    @foreach ($bloque['contenido'] as $index => $info)
                        <div class="row align-items-center about-main-info">
                            @if($index % 2 == 0)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="about-img">
                                        <img class="img-fluid rounded" src="{{ asset('storage/' . $info['imagen']) }}" alt="" />
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <h2>{{$info['titulo']}}</h2>
                                <p>{{$info['subtitulo']}} </p>
                                <p>{{$info['parrafo']}} </p>

                            </div>
                            @if($index % 2 != 0)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="about-img">
                                        <img class="img-fluid rounded" src="{{ asset('storage/' . $info['imagen']) }}" alt="" />
                                    </div>
                                </div>
                            @endif
                        </div>


                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
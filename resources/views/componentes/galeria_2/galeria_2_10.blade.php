<!-- Start Family -->

<style>
    /*------------------------------------------------------------------
    Family
-------------------------------------------------------------------*/



    .single-team-member {
        position: relative;
        margin-top: 30px;
        border: 10px solid #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    .family-img {
        position: relative;
    }

    .family-img::after {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        width: 100%;
        height: 100%;
        content: '';
        -webkit-transition: .3s;
        transition: .3s;
        opacity: 0;
        background-color: #535c68;
    }

    .family-info {
        padding: 25px 30px;
        background-color: var(--primary);
        text-align: center;
        position: absolute;
        bottom: 15px;
        left: 15px;
        width: auto;
        z-index: 7;
        opacity: 0;
        visibility: hidden;
        right: 15px;
        text-align: center;
        margin: 0 auto;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
        -ms-transition: all 0.25s ease-in-out;
        -o-transition: all 0.25s ease-in-out;
        transition: all 0.25s ease-in-out;
    }

    .single-team-member:hover .family-info {
        bottom: 0;
        opacity: 1;
        visibility: visible;
    }

    .family-info h4 {
        font-family: 'Engagement', cursive;
        font-size: 24px;
        color: #ffffff;
    }

    .family-info p {
        margin: 0px;
        font-size: 18px;
        color: #ffffff;
    }

    .title h2 {
        color: #ffffff;
        padding: 10px 0px;
    }

    .title-box {
        text-align: center;
        margin-bottom: 30px;
    }

    @media (max-width: 767px) {
        .title-box h2 {
            font-size: 38px;
        }
    }
</style>
<div id="family" class="family-box mb-5">
    <div class="container">
        <div class="row">
            @foreach ($bloque['contenido'] as $index => $contenido)

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-team-member">
                        <div class="family-img">
                            <img class="img-fluid" src="{{asset('storage/' . $contenido['imagen'])}}" alt="" />
                        </div>
                        <div class="family-info">
                            <h4>{{$bloque['titulo']}}</h4>
                            <p>{{$bloque['subtitulo']}}</p>
                        </div>
                    </div>
                </div>

            @endforeach



        </div>
    </div>
</div>
<!-- End Family -->
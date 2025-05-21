<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800');
    @import url('https://fonts.googleapis.com/css?family=Engagement');

    .title-box {
        text-align: center;
        margin-bottom: 30px;
    }

    .title-box h2 {
        font-size: 60px;
        font-family: 'Engagement', cursive;
        color: #222222;
    }

    .title-box h2 span {
        color: #881228;
        text-decoration: underline;
    }

    @media (max-width: 767px) {
        .title-box h2 {
            font-size: 38px;
        }
    }
</style>
<div class="container-fluid mt-5 mb-2" @if(!empty($bloque['textura']))
    style="background-image: url('{{ asset('storage/' . $bloque['textura']) }}'); padding: 35px; background-position: center; "
@endif>

    <div class="row">
        <div class="col-lg-12">
            <div class="title-box">
                <h2>{{$bloque['contenido']['titulo']}}</h2>
                <p>{{$bloque['contenido']['subtitulo']}}</p>
            </div>
        </div>
    </div>
</div>
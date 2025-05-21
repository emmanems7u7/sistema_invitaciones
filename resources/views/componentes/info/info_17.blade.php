<style>
    /*------------------------------------------------------------------
    Story
-------------------------------------------------------------------*/

    .story-box {
        padding: 0px 0px;
    }

    .align-left {
        padding: 0px 44px;
        text-align: left;
    }

    .align-right {
        text-align: right;
    }

    .main-timeline-box {
        position: relative;
        word-wrap: break-word;
    }

    .main-timeline-box .timeline-element {
        margin-bottom: 50px;
        position: relative;
        word-wrap: break-word;
        word-break: break-word;
        display: -webkit-flex;
        flex-direction: row;
        -webkit-flex-direction: row;
    }

    .main-timeline-box .reverse {
        flex-direction: row-reverse;
        -webkit-flex-direction: row-reverse;
    }

    .main-timeline-box .separline::before {
        top: 20px;
        bottom: 0;
        position: absolute;
        content: "";
        width: 2px;
        background-color: #f1f1f1;
        left: calc(50% - 1px);
        height: calc(100% + 4rem);
    }

    .main-timeline-box .iconBackground {
        position: absolute;
        left: 50%;
        width: 20px;
        height: 20px;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
        font-size: 30px;
        display: inline-block;
        background-color: #f1f1f1;
        top: 20px;
        margin-left: -10px;
    }

    .main-timeline-box .timeline-text-content {
        padding: 30px 35px;
        background: #f1f1f1;
    }

    .main-timeline-box .reverse .timeline-text-content {
        margin-right: 30px;
    }

    .main-timeline-box .reverse .time-line-date-content p {
        float: left;
        padding: 30px 35px;
        background: #f1f1f1;
    }

    .main-timeline-box .reverse .time-line-date-content {
        margin-right: 30px;
    }

    .display-font {
        font-family: 'Marck Script', cursive;
        font-size: 30px;
        color: #222222;
    }

    .main-timeline-box .timeline-text-content {
        margin-left: 30px;
    }

    .main-timeline-box .time-line-date-content p {
        float: right;
        padding: 30px 35px;
        background: #f1f1f1;
    }

    .main-timeline-box .time-line-date-content {
        margin-right: 30px;
    }

    .main-timeline-box .time-line-date-content .mbr-timeline-date {
        background: var(--primary);
        color: #ffffff;
    }

    .main-timeline-box .reverse .time-line-date-content .mbr-timeline-date {
        background: var(--secondary);
        color: #ffffff;
    }
</style>
<div id="story" class="story-box main-timeline-box">
    <div class="container">
        @foreach ($bloque['contenido'] as $index => $info)
            @if($index % 2 != 0)

                @php
                    $reverse = 'reverse';
                    $align = 'align-right';
                @endphp
            @else
                @php
                    $reverse = '';
                    $align = 'align-left';
                @endphp
            @endif

            <div class="row timeline-element {{ $reverse }} separline">
                <div class="timeline-date-panel col-xs-12 col-md-6  align-left">
                    <div class="time-line-date-content">
                        <p class="mbr-timeline-date mbr-fonts-style display-font">
                            {{$info['titulo']}}
                        </p>
                    </div>
                </div>
                <span class="iconBackground"></span>
                <div class="col-xs-12 col-md-6 {{ $align }}">
                    <div class="timeline-text-content">
                        <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-font">{{$info['subtitulo']}}</h4>
                        <p class="mbr-timeline-text mbr-fonts-style display-7">
                            {{$info['parrafo']}}
                        </p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
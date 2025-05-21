@if(isset($bloque['contenido']))
<div class="container-fluid py-1" id="event">

        <div class="container py-5">
          
            <div class="row">
            @foreach ($bloque['contenido'] as $index => $info)
            @if ($index % 2 == 0)
            <div class="col-md-6 border-right border-primary">
            <div class="text-center text-md-right mr-md-3 mb-4 mb-md-0">
            @else
            <div class="col-md-6">
            <div class="text-center text-md-left ml-md-3">
            @endif
                
                    
            @if (isset($info['imagen']))          
            <img class="img-fluid mb-4" src="{{asset('storage/' .$info['imagen'])}}" alt="">
            @endif     

            <h4 class="mb-3">{{$info['titulo']}}</h4>
            <p class="mb-2">{{$info['parrafo']}}</p>
                       
                    </div>
                </div>
        @endforeach
    </div>
   
    @endif
    </div>
@extends(Auth::user() == null ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<div class="container">
    @if($paginas->imagen_header == NULL)
        <img src="https://via.placeholder.com/1500x400" alt="img">
    @else
        <img src="{{URL::to('/uploads/paginas/'.$paginas->idpagina.'/'.$paginas->imagen_header)}}" alt="{{$paginas->titulo}}">
    @endif
    <div class="row general-view profesionales-info" style="padding-top: 0">
        <div class="col-sm-12">
            <div class="card" style="background-color: white; border-radius: 0;">
                <div class="card-header">
                    <br>
                    <div class="card-title"> {{$paginas->titulo}} </div>
                </div>
                <div class="card-body">
                    @foreach ($contenido as $item)
                        {!!$item->descripcion!!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    var videoId = '';
    $(document).ready(function() {
        $('.media').css('display','none');
        videoId = getId($('oembed').attr("url"));
        var iframeMarkup = '<center><iframe width="560" height="315" src="//www.youtube.com/embed/' 
        + videoId + '" frameborder="0" allowfullscreen></iframe></center>';
        $(".media").before(iframeMarkup);
    });

    function getId(url) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);

        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return 'error';
        }
    }


    
</script>
@endsection
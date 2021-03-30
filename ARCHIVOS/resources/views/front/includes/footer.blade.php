<div class="container">
    @php
        $paginas = \App\Models\Admin\Pagina::where('estado','activo')->get();
    @endphp
    <div class="row align-items-center flex-row-reverse">
        <div class="col-md-3 col-sm-3 mt-3 mt-lg-0 text-center"></div>
        <div class="col-md-3 col-sm-3 mt-3 mt-lg-0 text-center">
            <div class="blog-content">
                <h4 class="blog-title">Soporte</h4>
                <p class="blog-category text-white">
                    <ul>
                        @foreach ($paginas as $pagina)
                            @if($pagina->asociada_a == 'soporte')
                                <li>
                                    <a href="{{URL::to('clientes/contenidos/'.$pagina->ruta_pagina)}}" style="color: white; padding: 0 0 0 0">{{$pagina->titulo}}</a>
                                </li>
                                <br>
                            @endif
                        @endforeach
                    </ul>
                </p>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 mt-3 mt-lg-0 text-center">
            <div class="blog-content">
                <h4 class="blog-title">¿Quienes Somos?</h4>
                <p class="blog-category text-white text-right">
                    <ul class="links-foot">
                        @foreach ($paginas as $pagina)
                            @if($pagina->asociada_a == 'quienes_somos')
                                <li>
                                    <a href="{{URL::to('clientes/contenidos/'.$pagina->ruta_pagina)}}" style="color: white; padding: 0 0 0 0">{{$pagina->titulo}}</a>
                                </li>
                                <br>

                            @endif
                        @endforeach
                    </ul>
                </p>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 mt-3 mt-lg-0 text-center"></div>
        <div class="col-md-12 col-sm-12 mt-12 mt-lg-0 text-right" style="font-size: 10px">
            Build It © {{date("Y")}} Build it S.A.S - Todos los derechos reservados
        </div>
    </div>
</div>

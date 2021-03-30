@extends('admin.layouts.default')
@section('content')
<div class="side-app" >
    <div class="page-header">
        <h4 class="page-title">Editar Contenido: {{ $contenido->nombre }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Editar Contenido de Página</li>
        </ol>
    </div>
    {!!Form::model($contenido,array('action'=>array('Admin\ContenidosPaginasController@actualizar',$contenido->idcontenido),'method'=>'post','class'=>'card','files'=>'true'))!!}
    @php
        $arrayPagina = [];
        foreach ($paginas as $pagina) {
            $arrayPagina[$pagina->idpagina] = $pagina->titulo;
        }
    @endphp

    <div class="card-body ">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                {!!Form::label('nombre','Nombre del contenido',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('nombre',null,array('placeholder'=>'Ingrese el nombre del contenido','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('nombre') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                {!!Form::label('idpagina','Página del contenido',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::select('idpagina', $arrayPagina,
                            null,
                            array('class'=>'form-control')
                            )!!}
                        <span class="help-block has-error"> {{ $errors->first('idpagina') }}</span>
    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('descripcion','Descripción de la pagina',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::textarea('descripcion',null,array('placeholder'=>'Ingrese la descripcion','class'=>'form-control editor'))!!}
                        <span class="help-block has-error"> {{ $errors->first('descripcion') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                {!!Form::label('imagen','Imagen',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <input type="file" name="imagen" id="imagen" class="dropify" >
                        <span class="help-block has-error"> {{$errors->first('imagen')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                {!!Form::label('estado','Estado del contenido',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::select('estado', [
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo'],
                        null,
                        array('class'=>'form-control')
                        )!!}
                        <span class="help-block has-error"> {{ $errors->first('estado') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Editar',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('contenidos-paginas/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop
@section('scriptsown')

<script>
    ClassicEditor
        .create( document.querySelector( '.editor' ), {
            
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'mediaEmbed',
                    'alignment',
                    'fontColor',
                    'fontBackgroundColor',
                    'fontFamily',
                    'fontSize',
                    'htmlEmbed',
                    'horizontalLine',
                    'undo',
                    'removeFormat',
                    'redo'
                ]
            },
            language: 'es',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side',
                    'linkImage'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells',
                    'tableCellProperties',
                    'tableProperties'
                ]
            },
            licenseKey: '',
            
        } )
        .then( editor => {
            window.editor = editor;
    
            
            
            
    
            
            
            
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: 29n6hkpbzxuf-6rzngoggyc3e' );
            console.error( error );
        } );
</script>

@endsection

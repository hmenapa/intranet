@extends('layouts.app')
@section('title', 'Notificaciones | Temporales | Proyectos |')
@section('clase-open-proyecto','expand')
@section('clase-active-proyecto','active')
@section('clase-active-temporales','active')
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item"><a href="{{route('temporales.index')}}">Temporales</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Notificaciones </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Crear Notificaciones</h4>
        </div>
        <div class="panel-body">
            <div class="container">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops! </strong> there where some problems with your input.<br>
                        <ul>
                            @foreach ($errors as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-8 offset-md-2">
                    <form action="{{route('notificaciones.store')}}" method="post" enctype="multipart/form-data" data-parsley-validate="true" autocomplete="off" >
                        @csrf
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="cliente">De:</label>
                            <div class="col-md-6">
                                <input readonly type="text" class="form-control" name="usuario_carga" id="usuario_carga" value="{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}">

                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="cliente">Para:</label>
                            <div class="col-md-6">
                                    <select  name="usuario_id[]" id="usuario_id" class="multiple-select2 form-control" {{--data-live-search="true"--}} multiple="multiple" {{--data-style="btn-white" --}}data-parsley-required="true" data-parsley-required-message="Por favor Seleccione Area">
                                    @foreach ($usuarios as $usuario)
                                    <option value="{{$usuario->id}}" >{{$usuario->firstname}} {{$usuario->lastname}} ({{$usuario->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="version">Comentarios</label>
                            <div class="col-md-6">
                                <textarea name="comentarios" id="comentarios" placeholder="Comentarios" class="form-control" rows="3" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Comentario" >{{$temporales->comentarios}}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="id_temporal" name="id_temporal" value={{$temporales->id_temporal}}>


                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label"></label>

                            <div class="col-md-6">
                                <a href="javascript:window.history.back()" class="btn btn-sm btn-success">Regresar</a>
                                <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
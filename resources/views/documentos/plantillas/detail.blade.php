@extends('layouts.app')
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active"><a href="javascript:;">Plantillas</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Plantillas </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Ver Plantillas</h4>
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
                    <form action="{{route('plantillas.update', $plantillas->id)}}" method="post" data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="codigo">Codigo</label>
                            <div class="col-md-6">
                                <input disabled type="text" name="codigo" id="codigo" placeholder="Ingresa Codigo" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Codigo" value="{{$plantillas->codigo}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="id_areas">Areas</label>
                            <div class="col-md-6">
                                <select disabled name="id_areas" id="id_areas" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Seleccione Area">
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id}}"  {{ $plantillas->id_areas == $area->id ? 'selected="selected"' : '' }}>{{$area->nombre_area}}</option>
                                    @endforeach
                                </select>                            </div>


                        </div>

                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="nombre_plantilla">Plantilla</label>
                            <div class="col-md-6">
                                <input disabled type="text" name="nombre_plantilla" id="nombre_plantilla" placeholder="Nombre de plantilla" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Nombre de plantilla" value="{{$plantillas->nombre_plantilla}}">
                            </div>
                        </div>


                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="version">Version</label>
                            <div class="col-md-6">
                                <input  disabled type="text" name="version" id="version" placeholder="Ingresa Version" class="form-control"  data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Version" value="{{$plantillas->version}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="fecha_proc">Fecha</label>
                            <div class="col-md-6">
                                <input disabled type="text" name="fecha_proc" id="fecha_proc" placeholder="Ingresa Fecha" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Fecha" value='{{$plantillas->fecha_proc}}'>
                            </div>
                        </div>
                        <input type="hidden" name="id_users" id="id_users" value="{{ Auth::user()->id }}">
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="archivo_plantilla">Archivo</label>
                            <div class="col-md-6">
                                <a href="{{route('downloadfile', $plantillas->id)}}" title="{{$plantillas->archivo_plantilla}}" class="btn btn-success btn-icon btn-circle">
                                    <i class="fa fa-file-excel"></i>
                                </a>
                            </div>
                        </div>


                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label"></label>

                            <div class="col-md-6">
                                <a href="{{route('plantillas.index')}}" class="btn btn-sm btn-success">Back</a>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
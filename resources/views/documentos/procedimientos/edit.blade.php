@extends('layouts.app')
@section('title', 'Documentos | Procedimientos |')
@section('clase-active-documentos','active')
@section('clase-open-documentos-'.$areas[0]->id_area.'','expand')
@section('clase-active-documentos-'.$areas[0]->id_area.'','active')
@section('clase-active-procedimientos-'.$areas[0]->id_area.'','active')
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active"><a href="javascript:;">Procedimientos</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Procedimientos </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Editar Procedimientos</h4>
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
                    <form action="{{route('procedimientos.update', $procedimientos->id)}}" method="post" data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="codigo">Codigo</label>
                            <div class="col-md-6">
                                <input type="text" name="codigo" id="codigo" placeholder="Ingresa Codigo" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Codigo" value="{{$procedimientos->codigo}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="id_areas">Areas</label>
                            <div class="col-md-6">
                                <select name="id_areas" id="id_areas" class="form-control selectpicker" data-live-search="true" data-style="btn-white" data-parsley-required="true" data-parsley-required-message="Por favor Seleccione Area">
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id_area}}"  {{ $procedimientos->id_area == $area->id_area ? 'selected="selected"' : '' }}>{{$area->nombre_area}}</option>
                                    @endforeach
                                </select>

                            </div>


                        </div>

                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="nombre_proc">Procedimiento</label>
                            <div class="col-md-6">
                                <input type="text" name="nombre_proc" id="nombre_proc" placeholder="Nombre de Procedimiento" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Nombre de procedimiento" value="{{$procedimientos->nombre_proc}}">
                            </div>
                        </div>

                       
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="version">Version</label>
                            <div class="col-md-6">
                                <input type="text" name="version" id="version" placeholder="Ingresa Version" class="form-control"  data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Version" value="{{$procedimientos->version}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="fecha_proc">Fecha</label>
                            <div class="col-md-6">
                                <input type="text" name="fecha_proc" id="fecha_proc" placeholder="Ingresa Fecha" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Fecha" value='{{$procedimientos->fecha_proc}}'>
                            </div>
                        </div>
                        <input type="hidden" name="id_users" id="id_users" value="{{ Auth::user()->id }}">
                        
                        {{-- @if($procedimientos->pdf_proc)                                    
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label" for="pdf_proc">Archivo</label>
                                <div class="col-md-6">
                                    <a href="{{route('downloadfile', $procedimientos->id)}}"
                                        title="{{$procedimientos->pdf_proc}}"
                                        class="btn btn-danger btn-icon btn-circle">
                                            <i class="fa fa-file-pdf"></i>
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" name="pdf_proc" id="pdf_proc" value="{{($procedimientos->pdf_proc) }}">
                        @else --}}
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="pdf_proc">Archivo</label>
                            <div class="col-md-6">
                                <input type="file" accept=".pdf"  name="pdf_proc" id="pdf_proc" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Seleccione Archivo">
                            </div>
                        </div>
                       


                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label"></label>

                            <div class="col-md-6">
                                <a href="{{route('procedimientos.index')}}" class="btn btn-sm btn-success">Regresar</a>
                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
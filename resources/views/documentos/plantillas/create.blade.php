@extends('layouts.app')
@section('title', 'Documentos | Plantillas | Crear |')
@section('clase-active-documentos','active')
@section('clase-open-documentos-'.$areas[0]->id_area.'','expand')
@section('clase-active-documentos-'.$areas[0]->id_area.'','active')
@section('clase-active-plantillas-'.$areas[0]->id_area.'','active')
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
            <h4 class="panel-title">Crear Plantillas</h4>
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
                    <form action="{{route('plantillas.store')}}" method="post" enctype="multipart/form-data" data-parsley-validate="true" autocomplete="off" >
                        @csrf
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="codigo">Codigo</label>
                            <div class="col-md-6">
                                <input type="text" name="codigo" id="codigo" placeholder="Ingresa Codigo" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Codigo">
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="id_areas">Areas</label>
                            <div class="col-md-6">
                                <select  name="id_areas" id="id_areas" class="form-control selectpicker" data-live-search="true" data-style="btn-white" data-parsley-required="true" data-parsley-required-message="Por favor Seleccione Area">
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id_area}}"  {{ $area->id_area == $area->id_area ? 'selected="selected"' : '' }}>{{$area->nombre_area}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="nombre_plantilla">Plantilla</label>
                            <div class="col-md-6">
                                <input type="text" name="nombre_plantilla" id="nombre_plantilla" placeholder="Nombre de plantilla" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Nombre de plantilla" >
                            </div>
                        </div>

                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="version">Version</label>
                            <div class="col-md-6">
                                <input type="text" name="version" id="version" placeholder="Ingresa Version" class="form-control"  data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Version">
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="fecha_proc">Fecha</label>
                            <div class="col-md-6">
                                <input type="text" name="fecha_proc" id="fecha_proc" placeholder="Ingresa Fecha" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Ingresa Fecha">
                            </div>
                        </div>
                        <input type="hidden" name="id_users" id="id_users" value="{{ Auth::user()->id }}">
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label" for="archivo_plantilla">Archivo</label>
                            <div class="col-md-6">
                                <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .doc, .docx, .pdf"  name="archivo_plantilla" id="archivo_plantilla" placeholder="Seleccione Archivo" class="form-control" data-parsley-required="true" data-parsley-required-message="Por favor Seleccione Archivo">
                            </div>
                        </div>


                        <div class="form-group row m-b-10">
                            <label class="col-md-3 text-md-right col-form-label"></label>

                            <div class="col-md-6">
                                <a href="javascript:window.history.back()" class="btn btn-sm btn-success">Regresar</a>
                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
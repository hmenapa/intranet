@extends('layouts.app')
@section('title', 'Documentos | Plantillas |')
@section('clase-active-documentos','active')
@section('clase-open-documentos-'.$areas->id_area.'','expand')
@section('clase-active-documentos-'.$areas->id_area.'','active')
@section('clase-active-plantillas-'.$areas->id_area.'','active')
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active"><a href="javascript:;">Plantillas</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Plantillas de {{$areas->nombre_area}}</h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a class="btn btn-green btn-xs" href="{{route('plantillasAreasCreate', $areas->id_area)}}">Crear nueva plantilla</a>
            </div>
            <h4 class="panel-title">Plantillas de {{$areas->nombre_area}}</h4>
        </div>
        <div class="panel-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success fade show" data-auto-dismiss="2000">
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>{{$message}}</strong>
                </div>
                @endif
                <div class="table-responsive">
                    @if(count($plantillas))
                    <table class="table table-hover table-sm m-b-10">
                        <thead>
                        <tr>
                            <th><b>No.</b></th>
                            <th>Codigo</th>
                            <th>Areas</th>
                            <th>Nombre</th>
                            <th>Version</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Archivo</th>
                            <th width="90px">Acciones</th>
                        </tr>
                        </thead>

                        @php
                            $i=1;
                        @endphp
                        @foreach ($plantillas as $plantilla)
                            <tr>
                                <td><b>{{$i++}}.</b></td>
                                <td>{{$plantilla->codigo}}</td>
                                <td>{{$plantilla->nombre_area}}</td>
                                <td>{{$plantilla->nombre_plantilla}}</td>
                                <td>{{$plantilla->version}}</td>
                                <td>{{$plantilla->fecha_proc}}</td>
                                <td>
                                    @if ($plantilla->estado_plantilla == 0)
                                        <span class="label label-green">Vigente</span>
                                    @else
                                        <span class="label label-danger">Caducado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($plantilla->archivo_plantilla)
                                        <a href="{{ route('downloadfilePlantillas', $plantilla->id)}}"
                                           title=""
                                           class="btn btn-success btn-icon btn-circle" data-toggle="tooltip" data-container="body" data-title="Descargas">
                                            <i class="fa fa-file-excel"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('plantillas.destroy', $plantilla->id,$areas->id_area) }}" method="post">
                                        {{--
                                            <a class="btn btn-success btn-icon btn-circle" href="{{route('plantillas.show',$plantilla->id)}}">  <i class="fa fa-eye"></i></a>
                                        --}}
                                        <a class="btn btn-icon btn-circle btn-warning"
                                           href="{{ route('plantillas.edit',$plantilla->id)}}" data-toggle="tooltip" data-container="body" data-title="Editar"><i
                                                    class="fa fa-pencil-alt"></i></a>

                                        @csrf
                                        @method('DELETE')

                                        <a href="javascript:;" data-click="swal-danger-plantillas"
                                           class="btn btn-icon btn-circle btn-danger" data-toggle="tooltip" data-container="body" data-title="Eliminar"><i
                                                    class="fa fa-trash-alt"></i></a>

                                        <button style="display: none" id="btn-plantillas-delete" type="submit"
                                                class="btn btn-icon btn-circle btn-danger"><i
                                                    class="fa fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <div class="alert alert-info fade show" data-auto-dismiss="2000">
                            <span class="close" data-dismiss="alert">×</span>
                            <strong>No hay registros</strong>
                        </div>
                    @endif
                </div>

        </div>
    </div>
    <!-- end panel -->

@endsection
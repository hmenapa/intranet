@extends('layouts.app')
@section('title', 'Documentos | Procedimientos |')
@section('clase-active-documentos','active')
@section('clase-open-documentos-'.$areas->id_area.'','expand')
@section('clase-active-documentos-'.$areas->id_area.'','active')
@section('clase-active-procedimientos-'.$areas->id_area.'','active')
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active"><a href="javascript:;">Procedimientos</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Procedimientos de {{$areas->nombre_area}} </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a class="btn btn-green btn-xs" href="{{route('procedimientosAreasCreate',$areas->id_area)}}">Crear nuevo
                    procedimientos</a>
            </div>
            <h4 class="panel-title">Procedimientos de {{$areas->nombre_area}}</h4>
        </div>
        <div class="panel-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success fade show" data-auto-dismiss="2000">
                        <span class="close" data-dismiss="alert">×</span>
                        <strong>{{$message}}</strong>
                    </div>
                @endif
                <div class="table-responsive">
                    @if(count($procedimientos))
                        <table class="table table-hover m-b-10">
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
                            @foreach ($procedimientos as $procedimiento)
                                <tr>
                                    <td><b>{{$i++}}.</b></td>
                                    <td>{{$procedimiento->codigo}}</td>
                                    <td>{{$procedimiento->nombre_area}}</td>
                                    <td>{{$procedimiento->nombre_proc}}</td>
                                    <td>{{$procedimiento->version}}</td>
                                    <td>{{$procedimiento->fecha_proc}}</td>
                                    <td>
                                        @if ($procedimiento->estado_proc == 0)
                                            <span class="label label-green">Vigente</span>
                                        @else
                                            <span class="label label-danger">Caducado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($procedimiento->pdf_proc)
                                            <a href="{{route('downloadfileProcedimientos', $procedimiento->id)}}"
                                               title=""
                                               class="btn btn-danger btn-icon btn-circle" data-toggle="tooltip"
                                               data-container="body" data-title="Descargar">
                                                <i class="fa fa-file-pdf"></i>
                                            </a>
                                    @endif
                                    <td>
                                        <form action="{{ route('procedimientos.destroy', $procedimiento->id,$areas->id_area) }}"
                                              method="post">
                                            <a class="btn btn-icon btn-circle btn-warning"
                                               href="{{route('procedimientos.edit',$procedimiento->id)}}"
                                               data-toggle="tooltip" data-container="body" data-title="Editar"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:;" data-click="swal-danger-procedimientos"
                                               class="btn btn-icon btn-circle btn-danger" data-toggle="tooltip"
                                               data-container="body" data-title="Eliminar"><i
                                                        class="fa fa-trash-alt"></i></a>
                                            <button id="btn-procedimientos-delete" style="display: none" type="submit"
                                                    class="btn btn-sm btn-danger">Delete
                                            </button>
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
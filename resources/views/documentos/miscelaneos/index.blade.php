@extends('layouts.app')
@section('title', 'Documentos | Miscelaneos |')
@section('clase-open-documentos','expand')
@section('clase-open-documentos-block','display:block')
@section('clase-active-documentos','active')
@section('clase-open-documentos-'.$areas->id_area.'','expand')
@section('clase-active-documentos-'.$areas->id_area.'','active')
@section('clase-active-miscelaneos-'.$areas->id_area.'','active')
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active"><a href="javascript:;">Miscelaneos</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Miscelaneos de {{$areas->nombre_area}}</h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a class="btn btn-green btn-xs" href="{{ route('miscelaneosAreasCreate',$areas->id_area)}}">Crear nueva miscelaneos</a>
            </div>
            <h4 class="panel-title">Miscelaneos de {{$areas->nombre_area}}</h4>
        </div>
        <div class="panel-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success fade show" data-auto-dismiss="2000">
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>{{$message}}</strong>
                    </div>
                @endif
                <div class="table-responsive">
                    @if(count($miscelaneos))
                        <table class="table table-hover table-sm m-b-10">
                            <thead>
                            <tr>
                                <th><b>No.</b></th>
                                <th>Codigo</th>
                                <th>Area</th>
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
                            @foreach ($miscelaneos as $miscelaneo)
                                <tr>
                                    <td><b>{{$i++}}.</b></td>
                                    <td>{{$miscelaneo->codigo}}</td>
                                    <td>{{$miscelaneo->nombre_area}}</td>
                                    <td>{{$miscelaneo->nombre_documento}}</td>
                                    <td>{{$miscelaneo->version}}</td>
                                    <td>{{$miscelaneo->fecha_proc}}</td>
                                    <td>
                                        @if ($miscelaneo->estado_documento == "0")
                                            <span class="label label-green">Vigente</span>
                                        @else
                                            <span class="label label-danger">Caducado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($miscelaneo->archivo_documento)
                                            <a href="{{route('downloadfileMiscelaneos', $miscelaneo->id)}}"
                                               title=""
                                               class="btn btn-info btn-icon btn-circle" data-toggle="tooltip" data-container="body" data-title="Descargar">
                                                <i class="fa fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('miscelaneos.destroy', $miscelaneo->id,$areas->id_area) }}" method="post">
                                            {{--
                                                <a class="btn btn-success btn-icon btn-circle" href="{{route('plantillas.show',$plantilla->id)}}">  <i class="fa fa-eye"></i></a>
                                            --}}
                                            <a class="btn btn-icon btn-circle btn-warning"
                                               href="{{route('miscelaneos.edit',$miscelaneo->id)}}" data-toggle="tooltip" data-container="body" data-title="Editar"><i
                                                        class="fa fa-pencil-alt"></i></a>

                                            @csrf
                                            @method('DELETE')

                                            <a href="javascript:;" data-click="swal-danger-miscelaneos"
                                               class="btn btn-icon btn-circle btn-danger" data-toggle="tooltip" data-container="body" data-title="Eliminar"><i
                                                        class="fa fa-trash-alt"></i></a>

                                            <button style="display: none" id="btn-miscelaneos-delete" type="submit"
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
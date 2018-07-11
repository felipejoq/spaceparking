@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                @include('admin.menu.menu')
            </div>

            <div class="col-md-9">

                @if(session()->has('flash'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('flash') }}
                    </div>
                @endif

                @if(session()->has('flash2'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('flash2') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header" style="display: inline;">
                        Lista de reportes
                        <div class="btn-group" style="float: right;">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verreportemodal">
                                Generar
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#verconsolidado">
                                Consolidado
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" width="100%" class="display">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Número Plaza</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reportes as $reporte)

                                <tr>
                                    <td>{{ $reporte->nombre_reporte }}</td>
                                    <td>{{ $reporte->descripcion_reporte }}</td>
                                    <td>{{ $reporte->fechainicio }}</td>
                                    <td>{{ $reporte->fechafin }}</td>
                                    <td>{{ $reporte->plaza->numero_plaza }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" id="verr-{{ $reporte->id }}" name="btngenerareporte" class="btn btn-sm" data-toggle="modal" data-target="#verreporte">
                                                <i class="material-icons tiny" style="vertical-align: middle;">remove_red_eye</i>
                                            </button>

                                            <script>
                                                $('table').on('click', "#verr-{!! $reporte->id !!}", function() {
                                                    $.ajax({
                                                        url: "{{route('reportes.show',compact('reporte'))}}",
                                                        error: function () {
                                                            console.log('hubo un error');
                                                        },
                                                        success: function (data) {

                                                            console.log(data);
                                                            $('#nomrepo').text(data.nombre_reporte);
                                                            $('#pid').text(data.plaza.numero_plaza);
                                                            $('#finicio').text(data.fechainicio);
                                                            $('#ftermino').text(data.fechafin);

                                                            pedir(data.plaza_id,data.fechainicio,data.fechafin);
                                                        }
                                                    });
                                                });
                                            </script>

                                            <form action="{{ route('reportes.destroy',$reporte) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button id="" type="submit" class="btn btn-sm">
                                                    <i class="material-icons tiny" style="vertical-align: middle;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('admin.modal.reportes.muestrareporte')
    @include('admin.modal.reportes.verreporte')
    @include('admin.modal.reportes.verconsolidado',compact(['plazas' => $plazas]))

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker.min.css"/>
    <script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datepicker.es.min.js"></script>
@endpush

@push('scripts')
    <script src="../js/midatatable.js"></script>
@endpush
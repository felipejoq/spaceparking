@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                @include('admin.menu.menu')
            </div>

            <div class="col-md-9">


                @if(session()->has('flash'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('flash') }}
                            </div>
                        </div>
                    </div>
                @endif


                <div class="card">
                    <div class="card-header" style="display: inline;">
                        Tipos de plazas
                        <div class="" style="float: right;">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#agregartipoplaza">
                                Agregar un tipo
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <table id="example" width="100%" class="display">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tipos as $tipo)
                                        <tr>
                                            <td>{{ $tipo->id }}</td>
                                            <td>{{ $tipo->nombre }}</td>
                                            <td>{{ $tipo->descripcion }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" id="vertipo-{{ $tipo->id }}" class="btn btn-sm" data-toggle="modal" data-target="#vertipoplaza">
                                                        <i class="material-icons tiny">remove_red_eye</i>
                                                    </button>

                                                    <script>
                                                        $('table').on('click', "#vertipo-{!! $tipo->id !!}", function() {
                                                            $.ajax({
                                                                url: "{{route('tipos.show',compact('tipo'))}}",
                                                                error: function () {
                                                                    console.log('hubo un error');
                                                                },
                                                                success: function (data) {
                                                                    console.log(data);
                                                                    $('#txtnombretipo').val(data.nombre);
                                                                    $('#txtdescripciontipo').val(data.descripcion);
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <button type="button" id="edittipo-{!! $tipo->id !!}" class="btn btn-sm" data-toggle="modal" data-target="#editartipoplaza">
                                                        <i class="material-icons tiny">edit</i>
                                                    </button>

                                                    <script>
                                                        $('table').on('click', "#edittipo-{!! $tipo->id !!}", function() {
                                                            $.ajax({
                                                                url: "{{route('tipos.show',compact('tipo'))}}",
                                                                error: function () {
                                                                    console.log('hubo un error');
                                                                },
                                                                success: function (data) {
                                                                    console.log(data);
                                                                    $('#nombre').val(data.nombre);
                                                                    $('#descripcion').val(data.descripcion);

                                                                    $('#formeditatipo').attr('action', 'tipos/'+data.id);
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <button id="deletetipo-{!! $tipo->id !!}" type="button" class="btn btn-sm" data-toggle="modal" data-target="#eliminartipoplaza">
                                                        <i class="material-icons tiny">delete</i>
                                                    </button>

                                                    <script>
                                                        $('table').on('click', "#deletetipo-{!! $tipo->id !!}", function() {
                                                            $.ajax({
                                                                url: "{{route('tipos.show',compact('tipo'))}}",
                                                                error: function () {
                                                                    console.log('hubo un error');
                                                                },
                                                                success: function (data) {
                                                                    console.log(data);
                                                                    $('#txteliminanombretipo').val(data.nombre);
                                                                    $('#txteliminadescripcion').val(data.descripcion);
                                                                    $('#idelimina').val(data.id);

                                                                    $('#formeliminatipoplaza').attr('action', 'tipos/'+data.id);
                                                                }
                                                            });
                                                        });
                                                    </script>

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

        </div>
    </div>

    @include('admin.modal.tipos.vertipoplaza')
    @include('admin.modal.tipos.editartipoplaza')
    @include('admin.modal.tipos.eliminartipoplaza')
    @include('admin.modal.tipos.agregartipoplaza')

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
@endpush

@push('scripts')
    <script src="../js/midatatable.js"></script>
@endpush
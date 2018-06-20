@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                @include('admin.menu.menu')
            </div>

            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">

                            @if(session()->has('flash'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('flash') }}
                                </div>
                            @endif
                            @if(session()->has('flash2'))
                                <div class="alert alert-warning">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('flash2') }}
                                </div>
                            @endif
                            @if(session()->has('flash3'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('flash3') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Administración de plazas</div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <p class="row">
                                    <div class="col-md-12">
                                        @if(auth()->user()->hasRole('Administrador'))
                                            <form class="text-left" method="POST" action="{{route('nodemcu.store')}}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="material-icons iconos">add</i>
                                                    Agregar un Nodemcu
                                                </button>

                                                <button id="btadminnodemcu" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#adminnodemcu">
                                                    <i class="material-icons iconos">settings_applications</i>
                                                    Admin Nodemcu
                                                </button>

                                                <button id="agregarp" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#agregarplaza">
                                                    <i class="material-icons tiny" style="vertical-align: middle;">add_box</i>
                                                    Agregar Plaza
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    </p>
                                </div>
                                <div class="card-body col-md-12">
                                    <table id="example" width="100%" class="display">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Número</th>
                                            <th>Descripción</th>
                                            <th>Tipo</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($listadeplazas as $unaplaza)

                                            <tr>
                                                <td>{{ $unaplaza->id }}</td>
                                                <td>{{ $unaplaza->numero_plaza }}</td>
                                                <td>{{ $unaplaza->descripcion }}</td>
                                                <td>{{ $unaplaza->tipo->nombre }}</td>
                                                <td>{{ $unaplaza->estado_inicial }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" id="verp-{{ $unaplaza->id }}" class="btn btn-sm" data-toggle="modal" data-target="#verplaza">
                                                            <i class="material-icons tiny">remove_red_eye</i>
                                                        </button>
                                                        <script>
                                                            $('table').on('click', "#verp-{!! $unaplaza->id !!}", function() {
                                                                $.ajax({
                                                                    url: "{{route('plazas.show',compact('unaplaza'))}}",
                                                                    error: function () {
                                                                        console.log('hubo un error');
                                                                    },
                                                                    success: function (data) {
                                                                        $('#txtnumeroplaza').val(data.numero_plaza);
                                                                        $('#txtdescripcionplaza').val(data.descripcion);
                                                                        $('select[name=verplazanodemcu]').val(data.nodemcu.id);
                                                                        $('select[name=verplazatipo]').val(data.tipo.id);
                                                                        $('select[name=verplazaestado]').val(data.estado_inicial);
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                        <button type="button" id="editp-{!! $unaplaza->id !!}" class="btn btn-sm" data-toggle="modal" data-target="#editarplaza">
                                                            <i class="material-icons tiny">edit</i>
                                                        </button>

                                                        <script>
                                                            $('table').on('click', "#editp-{!! $unaplaza->id !!}", function() {
                                                                $.ajax({
                                                                    url: "{{route('plazas.show',$unaplaza)}}",
                                                                    error: function () {
                                                                        console.log('hubo un error');
                                                                    },
                                                                    success: function (data) {
                                                                        $('#plaza_id').val(data.id);
                                                                        $('#numero_plaza').val(data.numero_plaza);
                                                                        $('#descripcion').val(data.descripcion);
                                                                        $('select[id=nodemcu_id]').val(data.nodemcu.id);
                                                                        $('select[id=tipo_id]').val(data.tipo.id);
                                                                        $('select[id=estado_inicial]').val(data.estado_inicial);

                                                                        $('#formedita').attr('action', 'plazas/'+data.id);
                                                                    }
                                                                });
                                                            });

                                                        </script>

                                                        @if(auth()->user()->hasRole('Administrador'))
                                                            <button id="eliminar-{!! $unaplaza->id !!}" type="button" class="btn btn-sm" data-toggle="modal" data-target="#eliminarplaza">
                                                                <i class="material-icons tiny">delete</i>
                                                            </button>

                                                            <script>
                                                                $('table').on('click', "#eliminar-{!! $unaplaza->id !!}", function() {
                                                                    $.ajax({
                                                                        url: "{{route('plazas.show',compact('unaplaza'))}}",
                                                                        error: function () {
                                                                            console.log('hubo un error');
                                                                        },
                                                                        success: function (data) {
                                                                            $('#txtnumeroplazae').val(data.numero_plaza);
                                                                            $('#txtdescripcionplazae').val(data.descripcion);
                                                                            $('select[name=verplazanodemcu]').val(data.nodemcu.id);
                                                                            $('select[name=verplazatipo]').val(data.tipo.id);
                                                                            $('select[name=verplazaestado]').val(data.estado_inicial);

                                                                            $('#formeliminarplaza').attr('action', 'plazas/'+data.id);
                                                                        }
                                                                    });
                                                                });

                                                            </script>
                                                        @endif


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
        <div class="row">
        </div>
    </div>

    @include('admin.modal.plazas.agregarplaza')
    @include('admin.modal.plazas.verplaza')
    @include('admin.modal.plazas.editarplaza')
    @include('admin.modal.plazas.eliminarplaza')
    @include('admin.modal.plazas.adminnodemcu',['nodemculista' => $listadenodemcu])

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
@endpush

@push('scripts')
    <script src="../js/midatatable.js"></script>
    <script>
        $(document).ready( function () {

            @if(request()->nodemcu)
                window.location.hash = '#addnodemcu';
            @endif
                    @if(!empty($errors->first()))
                window.location.hash = '#erroradd';
            @endif

            if(window.location.hash === '#erroradd' ||  window.location.hash === '#create'  ){
                $('#agregarplaza').modal('show');
            }

            @if(session()->has('flash4'))
            if(window.location.hash = '#deletenodemcu'){
                $('#adminnodemcu').modal('show');
            }
            @endif

                    @if(session()->has('flash5'))
            if(window.location.hash = '#addnodemcu'){
                $('#adminnodemcu').modal('show');
            }
            @endif

        });
    </script>

@endpush
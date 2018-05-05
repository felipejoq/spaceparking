@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                <div class="card">
                    @include('admin.menu.menu')
                </div>
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
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Administración de plazas</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12 text-right">
                                    <p class="row">
                                    <div class="col-md-6">
                                        <form class="text-left" method="POST" action="{{route('nodemcu.store')}}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-primary">¿Nuevo Nodemcu?</button>
                                            <button id="agregarp" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#agregarplaza">
                                                Agregar Plaza
                                            </button>
                                        </form>
                                    </div>
                                    </p>
                                </div>
                                <div class="card-body col-md-12">
                                    <table id="example" width="100%" class="display">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Número</th>
                                            <th>Descripcion</th>
                                            <th>Tipo</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($listadeplazas as $unaplaza)
                                            <tr>
                                                <td>{{ $unaplaza->id }}</td>
                                                <td>{{ $unaplaza->numero_plaza }}</td>
                                                <td>{{ $unaplaza->descripcion }}</td>
                                                <td>{{ $unaplaza->tipo->nombre }}</td>
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
                                                                        $('#eplaza_id').val(data.id);
                                                                        $('#enumero_plaza').val(data.numero_plaza);
                                                                        $('#edescripcion').val(data.descripcion);
                                                                        $('select[id=enodemcu_id]').val(data.nodemcu.id);
                                                                        $('select[id=etipo_id]').val(data.tipo.id);
                                                                        $('select[id=eestado_inicial]').val(data.estado_inicial);
                                                                    }
                                                                });
                                                            });

                                                        </script>

                                                        <button type="button" class="btn btn-sm">
                                                            <i class="material-icons tiny">delete</i>
                                                        </button>
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

    @include('admin.modal.agregarplaza')
    @include('admin.modal.verplaza')
    @include('admin.modal.editarplaza')

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
@endpush

@push('scripts')
    <script src="../js/midatatable.js"></script>
    <script>
        $(document).ready( function () {
            @if(!empty($errors->first()))
                window.location.hash = '#create';
            @endif

            if(window.location.hash === '#create'){
                window.location.hash = '#';
            }

            @if(!empty($errors->first('enodemcu_id')))
                window.location.hash = '#edita';
            @endif


            $('#btneditarplaza').click(function (event) {

                var metodo = $('input[name=_method]').val();
                var token = $('input[name=_token]').val();
                var plaza_id = $('#eplaza_id').val();
                var nodemcu = $('#enodemcu_id').val();
                var numeroplaza = $('#enumero_plaza').val();
                var descripcion = $('#edescripcion').val();
                var tipoplaza = $('#etipo_id').val();
                var estadoinicial = $('#eestado_inicial').val();

                var obj ={
                    _method: metodo,
                    _token: token,
                    id: plaza_id,
                    descripcion: descripcion,
                    numero_plaza: numeroplaza,
                    estado_inicial: estadoinicial,
                    tipo_id: {
                        id: tipoplaza
                    },
                    nodemcu_id: {
                        id: nodemcu
                    }
                };

                console.log(obj);

                $.ajax("plazas/"+plaza_id, {
                    type: "PUT",
                    data: JSON.stringify(obj),
                    //url: "plazas/"+plazaid,
                    contentType: "application/json",
                    success: function(data) {
                        window.location.hash = '';
                        $('#editarplaza').modal('hide');

                    },
                    error: function(xhr,estado,error) {
                        var mensaje = xhr.responseJSON;
                        window.location.hash = '#erroredita';

                        $.each(mensaje,function(indice,valor){
                            console.log(indice + ' - ' + valor);
                        });
                    }
                });

            });

        });
    </script>

@endpush
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                @include('admin.menu.menu')
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('flash'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('flash') }}
                            </div>
                        @endif

                            @if(!empty($errors->first()))
                               @foreach($errors as $error)
                                   {{ $error }}
                                @endforeach
                            @endif

                        <div class="card">
                            <div class="card-header">
                                <div class="" style="display: inline;">
                                    Datos del estacionamiento @if(auth()->user()->hasRole('Administrador'))<div class="" style="float: right;"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarestacionamiento"><i class="material-icons iconos md-18 iconos">edit</i> Editar</button></div>@endif
                                </div>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-3 text-center">
                                        <p><i class="material-icons md-24">directions_car</i></p> {{ $estacionamiento->nombre }}
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <p><i class="material-icons md-24">add_location</i></p> {{ $estacionamiento->direccion }}
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <p><i class="material-icons md-24">phone</i></p> {{ $estacionamiento->telefono }}
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <p><i class="material-icons md-24">person</i></p>Administradores: {{ $numAdmin }}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Lista de usuarios @if(auth()->user()->hasRole('Administrador'))<div class="" style="float: right;"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#agregarusuario"><i class="material-icons iconos md-18 iconos">add</i> Agregar Usuario</button></div>@endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" width="100%" class="display">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Rol</th>
                                                @if(auth()->user()->hasRole('Administrador'))
                                                    <th>Acción</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($administradores as $admin)
                                                <tr>
                                                    <td>{{ $admin->id }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->getRoleNames()->implode(', ') }}</td>
                                                    @if(auth()->user()->hasRole('Administrador'))
                                                        <td>
                                                        <div class="btn-group">

                                                            <button type="button" id="verusuario-{{ $admin->id }}" class="btn btn-sm" data-toggle="modal" data-target="#verusuario">
                                                                <i class="material-icons tiny">remove_red_eye</i>
                                                            </button>

                                                            <script>
                                                                $('table').on('click', "#verusuario-{!! $admin->id !!}", function() {
                                                                    $.ajax({
                                                                        url: "{{route('usuario.show',compact('admin'))}}",
                                                                        error: function () {
                                                                            console.log('hubo un error');
                                                                        },
                                                                        success: function (data) {

                                                                            $('#adminv').val(data.roles[0].name);
                                                                            $('#nombrev').val(data.name);
                                                                            $('#emailv').val(data.email);
                                                                        }
                                                                    });
                                                                });
                                                            </script>

                                                            <button type="button" id="editarusuario-{!! $admin->id !!}" class="btn btn-sm" data-toggle="modal" data-target="#editarusuario">
                                                                <i class="material-icons tiny">edit</i>
                                                            </button>

                                                            <script>
                                                                $('table').on('click', "#editarusuario-{!! $admin->id !!}", function() {
                                                                    $.ajax({
                                                                        url: "{{route('usuario.show',compact('admin'))}}",
                                                                        error: function () {
                                                                            console.log('hubo un error');
                                                                        },
                                                                        success: function (data) {
                                                                            $('#nombree').val(data.name);
                                                                            $('#emaile').val(data.email);
                                                                            $('select[id=rolee]').val(data.roles[0].id);

                                                                            $('#formedita').attr('action', 'usuario/'+data.id);
                                                                        }
                                                                    });
                                                                });
                                                            </script>

                                                            <button id="deletetipo-{!! $admin->id !!}" type="button" class="btn btn-sm" data-toggle="modal" data-target="#eliminarusuario">
                                                                <i class="material-icons tiny">delete</i>
                                                            </button>

                                                            <script>
                                                                $('table').on('click', "#deletetipo-{!! $admin->id !!}", function() {
                                                                    $.ajax({
                                                                        url: "{{route('usuario.show',compact('admin'))}}",
                                                                        error: function () {
                                                                            console.log('hubo un error');
                                                                        },
                                                                        success: function (data) {

                                                                            $('#nombred').val(data.name);
                                                                            $('#emaild').val(data.email);
                                                                            $('select[name=admind]').val(data.roles[0].id);

                                                                            $('#formelimina').attr('action', 'usuario/'+data.id);
                                                                        }
                                                                    });
                                                                });
                                                            </script>

                                                        </div>
                                                    </td>
                                                    @endif
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
        </div>
    </div>

    @include('admin.modal.estacionamiento.estacionamientoedit',['administradoresestacionamiento' => $administradores, 'estacionamientoedita' => $estacionamiento])
    @include('admin.modal.estacionamiento.users.verusuario')
    @include('admin.modal.estacionamiento.users.editarusuario')
    @include('admin.modal.estacionamiento.users.eliminarusuario')
    @include('admin.modal.estacionamiento.users.agregarusuario')

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
@endpush

@push('scripts')
    <script src="../js/midatatable.js"></script>
    <script>
    </script>

@endpush


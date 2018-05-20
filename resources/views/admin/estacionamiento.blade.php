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
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('flash'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('flash') }}
                            </div>
                        @endif

                         <div class="card">
                                <div class="card-header">
                                    <div class="" style="display: inline;">
                                        Datos del estacionamiento <div class="" style="float: right;"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarestacionamiento"><i class="material-icons iconos md-18 iconos">edit</i> Editar</button></div>
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
                                            <p><i class="material-icons md-24">person</i></p>Administradores: {{ $estacionamiento->administradores->count() }}
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
                            <div class="card-header">Lista de usuarios</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" width="100%" class="display">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Admin</th>
                                                <th>Acción</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($administradores as $admin)
                                                <tr>
                                                    <td>{{ $admin->id }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->admin == 1 ? 'Si' : 'No' }}</td>
                                                    <td>
                                                        <div class="btn-group">

                                                            <button type="button" id="vertipo-{{ $admin->id }}" class="btn btn-sm" data-toggle="modal" data-target="#vertipoplaza">
                                                                <i class="material-icons tiny">remove_red_eye</i>
                                                            </button>

                                                            <button type="button" id="edittipo-{!! $admin->id !!}" class="btn btn-sm" data-toggle="modal" data-target="#editartipoplaza">
                                                                <i class="material-icons tiny">edit</i>
                                                            </button>

                                                            <button id="deletetipo-{!! $admin->id !!}" type="button" class="btn btn-sm" data-toggle="modal" data-target="#eliminartipoplaza">
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



        </div>
    </div>

    @include('admin.modal.estacionamientoedit',['administradoresestacionamiento' => $administradores, 'estacionamientoedita' => $estacionamiento])

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


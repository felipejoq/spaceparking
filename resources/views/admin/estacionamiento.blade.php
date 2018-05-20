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
                    @if(session()->has('flash'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('flash') }}
                        </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="" style="display: inline;">
                            Datos del estacionamiento <div class="" style="float: right;"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarestacionamiento">Editar datos</button></div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-3">
                                <p><strong>Nombre:</strong></p> {{ $estacionamiento->nombre }}
                            </div>
                            <div class="col-md-3">
                                <p><strong>Dirección:</strong></p> {{ $estacionamiento->direccion }}
                            </div>
                            <div class="col-md-3">
                                <p><strong>Teléfono:</strong></p> {{ $estacionamiento->telefono }}
                            </div>
                            <div class="col-md-3">
                                <p><strong>Administrador:</strong></p> {{ $estacionamiento->administradores[0]->name }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('admin.modal.estacionamientoedit',
    ['administradoresestacionamiento' => $administradores, 'estacionamientoedita' => $estacionamiento]
    )

@endsection


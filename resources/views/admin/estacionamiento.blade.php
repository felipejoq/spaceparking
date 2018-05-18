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
                <div class="card">
                    <div class="card-header">Datos del estacionamiento:</div>
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

@endsection


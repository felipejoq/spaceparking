@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                @include('admin.menu.menu')
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Administración - Vista General</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($plazas as $plaza)

                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Número plaza: {{ $plaza->numero_plaza }}</h5>
                                            <div class="card-text">
                                                <p><strong>Descripción:</strong> {{ $plaza->descripcion }}</p>
                                                <p><strong>Estado:</strong> <span id="estado_plaza_{!! $plaza->id !!}" class="{{ $plaza->estado_inicial == "No disponible" ? 'red-color' : '' }}">{{ $plaza->estado_inicial }}</span></p>
                                            </div>
                                            <a href="{{ route('plazas.index') }}" class="btn btn-primary text-white">Ver detalles</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

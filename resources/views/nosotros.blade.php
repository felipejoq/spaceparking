@extends('layouts.app')

@section('content')

    <div class="flex-center position-ref full-height">

        <div class="container">
            <div class="card">
                <div class="text-center"><h5 class="card-header">Nosotros</h5></div>
                <div class="card-body">
                    <div class="text-center"><h5 class="card-title">¿Qué es SpaceParking?</h5></div>
                    <p class="card-text text-center">Space Parking es la solución a una gran problemática que se presenta hoy en día al momento de buscar un lugar donde estacionar su vehículo dentro de un establecimiento por lo cual Space Parking se encarga de administrar las diferentes plazas de los estacionamiento dando aviso si hay un lugar disponible,ocupado o reservado así evitando que hayan retrasos ya que con solo consultar esta pagina web podrás saber si hay un lugar donde tener tu vehículo, entre muchas otras opciones.</p>
                    <div class="text-center"><img src="img/logo.png" width="500"/></div>
                    <p></p>
                    <div class="text-center"><a href="{{route('index')}}" class="btn btn-primary">Ir a la portada</a></div>
                </div>
            </div>
        </div>
    </div>


@endsection
<!-- Scripts -->
@push('scripts')
    <script src="js/scripts.js"></script>
@endpush
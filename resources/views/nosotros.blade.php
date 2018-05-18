@extends('layouts.app')

@section('content')

    <div class="flex-center position-ref full-height">

        <div class="container">
            <div class="card">
                <div class="text-center"><h5 class="card-header">Nosotros</h5></div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 offset-md-2">
                            <div class="text-center"><h5 class="card-title">¿Qué es SpaceParking?</h5></div>
                            <p class="card-text text-justify">Space Parking es la solución a una gran problemática que se presenta hoy en día al momento de buscar un lugar donde estacionar su vehículo dentro de un establecimiento por lo cual Space Parking se encarga de administrar las diferentes plazas de los estacionamiento dando aviso si hay un lugar disponible,ocupado o reservado así evitando que hayan retrasos ya que con solo consultar esta pagina web podrás saber si hay un lugar donde tener tu vehículo, entre muchas otras opciones.</p>
                            <div class="text-center">
                                <iframe width="100%" height="395" src="https://www.youtube.com/embed/uSlh75cnDL4?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <p></p>
                            <div class="text-center"><a href="{{route('index')}}" class="btn btn-primary" style="color:white;">Ir a la portada</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
<!-- Scripts -->
@push('scripts')
    <script src="js/scripts.js"></script>
@endpush
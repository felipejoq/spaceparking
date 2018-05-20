@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="flex-center position-ref full-height">

        <div class="content">
            <h2>Disponibilidad</h2>
            <div class="col-md-4 block">
                <div class="circle">
                    <p id="informacion">
                        <span id="plazasdisponibles">0</span> <small>de</small> <span id="totalplazas">0</span><br />
                        <small>Plazas</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->

@endsection

@push('scripts')
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
@endpush

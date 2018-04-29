@extends('layouts.app')

@section('content')

    <div class="flex-center position-ref full-height">

        <div class="content">
            <h2>Disponibilidad</h2>
            <div class="col-md-4 block">
                <div class="circle">
                    <p id="informacion">
                        <span id="plazasdisponibles">0</span>/<span id="totalplazas">0</span><br />
                        <small>Plazas</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->

@endsection

@push('scripts')
    <script src="js/scripts.js"></script>
@endpush

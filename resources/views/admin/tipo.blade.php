@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                @include('admin.menu.menu')
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Tipos de plazas</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <table id="example" width="100%" class="display">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tipos as $tipo)

                                        <tr>
                                            <td>{{ $tipo->id }}</td>
                                            <td>{{ $tipo->nombre }}</td>
                                            <td>{{ $tipo->descripcion }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" id="vertipo-{{ $tipo->id }}" class="btn btn-sm" data-toggle="modal" data-target="#verplaza">
                                                        <i class="material-icons tiny">remove_red_eye</i>
                                                    </button>

                                                    <button type="button" id="edittipo-{!! $tipo->id !!}" class="btn btn-sm" data-toggle="modal" data-target="#editarplaza">
                                                        <i class="material-icons tiny">edit</i>
                                                    </button>

                                                    <button id="deletetipo-{!! $tipo->id !!}" type="button" class="btn btn-sm" data-toggle="modal" data-target="#eliminarplaza">
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
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
@endpush

@push('scripts')
    <script src="../js/midatatable.js"></script>
@endpush
<!-- Modal -->
<div class="modal fade" id="editarestacionamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar estacionamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('estacionamiento.update', $estacionamientoedita) }}" method="POST">
                    {{ csrf_field() }} {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre del estacionamiento</label>
                                <input value="{{ $estacionamientoedita->nombre }}" id="nombre" name="nombre" class="form-control" type="text" placeholder="Nombre del estacionamiento" required>
                                {!! $errors->first('nombre', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input value="{{ $estacionamientoedita->direccion }}" id="direccion" name="direccion" class="form-control" type="text" placeholder="Ej: 18 de Septiembre, #444. Chillán." required>
                                {!! $errors->first('direccion', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input value="{{ $estacionamientoedita->telefono }}" id="telefono" name="telefono" class="form-control" type="text" placeholder="Ej: +56924456479" required>
                                {!! $errors->first('telefono', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Administradores</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($estacionamientoedita->administradores as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="modal-footer btn-group">
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush
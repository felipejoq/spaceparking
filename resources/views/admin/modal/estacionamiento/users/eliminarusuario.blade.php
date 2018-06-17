<!-- Modal -->
<div class="modal fade" id="eliminarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formelimina" action="" method="POST">

                @csrf @method('DELETE')

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombred">Nombre:</label>
                                <input value="" id="nombred" name="nombre" class="form-control" type="text" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailv">Email:</label>
                                <input value="" id="emaild" name="email" class="form-control" type="text" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="admind">Es administrador:</label>
                            <select class="custom-select" name="admind" id="adminv" disabled>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="modal-footer btn-group">
                        <button type="submit" class="btn btn-primary btn-sm">Aceptar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')

@endpush
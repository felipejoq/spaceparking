<!-- Modal -->
<div class="modal fade" id="editartipoplaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar tipo de plaza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formeditatipo" action="" method="POST">

                    {{ csrf_field() }} {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input minlength="5" class="form-control" name="nombre" id="nombre" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea minlength="10" class="form-control" name="descripcion" id="descripcion" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer btn-group">
                        <button type="submit" class="btn btn-primary btn-sm">Aceptar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush
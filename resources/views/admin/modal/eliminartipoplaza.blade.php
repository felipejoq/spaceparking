<!-- Modal -->
<div class="modal fade" id="eliminartipoplaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar tipo de plaza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formeliminatipoplaza" action="" method="POST">
                    {{ csrf_field() }} {{ method_field('DELETE') }}

                    <input type="text" value="" name="idelimina" id="idelimina" hidden>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txteliminanombretipo">Nombre:</label>
                                <input class="form-control" name="txteliminanombretipo" id="txteliminanombretipo" type="text" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txteliminadescripcion">Descripción:</label>
                                <input class="form-control" name="txteliminadescripcion" id="txteliminadescripcion" type="text" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer btn-group">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
<!-- Modal -->
<div class="modal fade" id="vertipoplaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles tipo de plaza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtnombretipo">Nombre:</label>
                            <input class="form-control" id="txtnombretipo" type="text" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtdescripciontipo">Descripción:</label>
                            <textarea class="form-control" id="txtdescripciontipo" type="text" readonly></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer btn-group">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
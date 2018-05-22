<!-- Modal -->
<div class="modal fade" id="agregartipoplaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar tipo de plaza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formaddtipoplaza" action="{{ route('tipos.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input class="form-control" placeholder="Nombre..." name="nombre" id="nombre" value="{{ old('nombre') }}" type="text">
                                {!! $errors->first('nombre', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" placeholder="Descripción..." name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                                {!! $errors->first('descripcion', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer btn-group">
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')

    @if(!empty($errors->first()))
        <script>
            window.location.hash = '#erroraddtipo';

            if(window.location.hash === '#erroraddtipo'){
                $('#agregartipoplaza').modal('show');
            }
        </script>
    @endif

@endpush
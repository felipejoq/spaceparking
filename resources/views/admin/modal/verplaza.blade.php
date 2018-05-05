<!-- Modal -->
<div class="modal fade" id="verplaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la plaza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nodemcu_id">Nodemcu al que pertenece</label>
                                    <select class="form-control" id="verplazanodemcu" name="verplazanodemcu" disabled>
                                        <option>
                                            Seleccione una...
                                        </option>
                                        @foreach($listadenodemcu as $unnodemcu)
                                            <option value="{{$unnodemcu->id}}" id="{{ $unnodemcu->id }}" {{ app('request')->get('nodemcu') == $unnodemcu->id ? 'selected' : '' }} {{ old('nodemcu_id') == $unnodemcu->id ? 'selected' : ''}}>
                                                Id: {{ $unnodemcu->id }} | Clave: {{ $unnodemcu->nodemcu_clave }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('nodemcu_id', '<span class="help-block text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="numero_plaza">Numero de la plaza</label>
                                    <input class="form-control" id="txtnumeroplaza" type="text" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción de la plaza</label>
                                    <textarea id="txtdescripcionplaza" class="form-control" name="descripcion" readonly></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de plaza</label>
                                    <select class="form-control" id="verplazatipo" name="verplazatipo" disabled>
                                        <option value="0" id="0">
                                            Seleccione un tipo...
                                        </option>
                                        @foreach($listadetipos as $untipo)
                                            <option value="{{ $untipo->id }}" id="{{ $untipo->id }}" {{ old('tipo_id') == $untipo->id ? 'selected' : ''}}>
                                                {{ $untipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('tipo_id', '<span class="help-block text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="estado_inicial">Estado inicial</label>
                                    <select class="form-control" id="verplazaestado" name="verplazaestado" disabled>
                                        <option value="">
                                            Seleccione un estado...
                                        </option>
                                        <option value="Disponible" {{ old('estado_inicial') == "Disponible" ? 'selected' : ''}}>
                                            Disponible
                                        </option>
                                        <option value="No disponible" {{ old('estado_inicial') == "No disponible" ? 'selected' : ''}}>
                                            No disponible
                                        </option>
                                    </select>
                                    {!! $errors->first('estado_inicial', '<span class="help-block text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer btn-group">
                            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')



@endpush
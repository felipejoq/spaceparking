<!-- Modal -->
<div class="modal fade" id="agregarplaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Plaza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('plazas.store')}}">
                    {{ csrf_field() }}

                    <input type="text" hidden value="{{ auth()->user()->id }}" name="quien_edita">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nodemcu_id">Seleccione un Nodemcu</label>
                                    @if(!empty($errors))
                                        @foreach($errors as $error)
                                            {{ $error }}
                                        @endforeach
                                    @endif
                                    <select class="form-control" id="nodemcu_id" name="nodemcu_id" required>
                                        <option value="" id="0">
                                            Seleccione un nodemcu...
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
                                    <input value="{{ old('numero_plaza') }}" class="form-control" type="text" placeholder="Ejemplo: 001" name="numero_plaza" maxlength="3" required>
                                    {!! $errors->first('numero_plaza', '<span class="help-block text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción de la plaza</label>
                                    <textarea minlength="10" class="form-control" placeholder="Descripción de la plaza. Ejem. Plaza del genrente..." name="descripcion" required>{{ old('descripcion') }}</textarea>
                                    {!! $errors->first('descripcion', '<span class="help-block text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de plaza</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id" required>
                                        <option value="" id="0">
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
                                    <select class="form-control" id="estado_inicial" name="estado_inicial" required>
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
                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')


@endpush
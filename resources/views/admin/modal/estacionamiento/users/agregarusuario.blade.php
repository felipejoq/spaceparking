<!-- Modal -->
<div class="modal fade" id="agregarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('usuario.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombrev">Nombre:</label>
                                <input value="{{ old('name') }}" placeholder="Nombre y apellido del usuario" id="nombrev" name="name" class="form-control" type="text" required>
                                {!! $errors->first('nombre', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailv">Email:</label>
                                <input value="{{ old('email') }}" id="emailv" placeholder="ejemplo@ejemplo.com" name="email" class="form-control" type="email" required>
                                {!! $errors->first('email', '<span class="help-block text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Password:</label>

                                <div class="input-group">
                                    <input name="password" value="{{ old('password') }}" placeholder="******" id="password" type="password" class="form-control" required>
                                    <div class="input-group-btn">
                                        <button title="Mostrar contraseña ingresada" class="btn btn-default border" type="button" onclick="mostrarPassword()">
                                            <i class="material-icons md-18">remove_red_eye</i>
                                        </button>
                                    </div>
                                    {!! $errors->first('password', '<span class="help-block text-danger">:message</span>') !!}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="adminv">Seleccione el rol:</label>
                            <select class="custom-select" name="role" id="adminv" required>
                                <option value="">Seleccione una opción…</option>
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

    <script>
        function mostrarPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

@endpush
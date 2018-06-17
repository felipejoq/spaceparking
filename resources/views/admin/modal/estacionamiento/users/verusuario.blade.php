<!-- Modal -->
<div class="modal fade" id="verusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombrev">Nombre:</label>
                            <input value="" id="nombrev" name="nombre" class="form-control" type="text" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="emailv">Email:</label>
                            <input value="" id="emailv" name="email" class="form-control" type="text" readonly>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Password:</label>

                            <div class="input-group">
                                <input name="password" id="password" type="password" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-default border" type="button" onclick="mostrarPassword()">
                                        <i class="material-icons md-18">remove_red_eye</i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <p></p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Recuperar contraseña usuario</button>
                        </div>
                    </div>
                </div>
                -->

                <div class="row">
                    <div class="col-md-12">
                        <label for="adminv">Rol(es):</label>
                        <input value="" id="adminv" name="adminv" class="form-control" type="text" readonly>
                    </div>
                </div>

                <div class="modal-footer btn-group">
                    <button type="button" class="btn btn-primary btn-sm">Aceptar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
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
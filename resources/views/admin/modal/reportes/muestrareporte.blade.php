<!-- Modal -->
<div class="modal fade" id="verreportemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vista Reportes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- aquí los reportes -->
                <form action="{{route('reportes.store')}}" method="POST">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="idplaza">Elija la plaza:</label>
                                        <select class="form-control" id="idplaza" name="idplaza" required>
                                            <option value="" id="0">
                                                Seleccione una plaza...
                                            </option>
                                            @foreach($plazas as $plaza)
                                                <option value="{{ $plaza->id }}" id="{{ $plaza->id }}" {{ old('tipo_id') == $plaza->id ? 'selected' : ''}}>
                                                    Id: {{ $plaza->id }} | Número: {{ $plaza->numero_plaza }} | Tipo: {{ $plaza->tipo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('plazas', '<span class="help-block text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="datestart">Fecha de inicio:</label>
                                        <input minlength="10" id="datestart" class="form-control" placeholder="" name="datestart" id="datestart" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dateend">Fecha de termino:</label>
                                        <input minlength="10" id="dateend" class="form-control" placeholder="" name="dateend" id="dateend" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Generar Reporte:</label>
                                        <button id="btnverreporte" type="button" class="btn btn-primary btn-block">Ver Reporte</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input minlength="10" id="nombre_reporte" class="form-control" placeholder="Nombre del reporte..." name="nombre_reporte" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input minlength="10" id="descripcion_reporte" class="form-control" placeholder="Descripción del reporte..." name="descripcion_reporte" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button id="btnguardarreporte" type="submit" class="btn btn-primary btn-block">Guardar Reporte</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <div class="chartContainer">
                            <canvas id="chartReporte" width="300" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $(document).ready( function () {

            $("#datestart").datepicker({
                language: "es",
                format: "d-m-yyyy"
            });
            $("#dateend").datepicker({
                language: "es",
                format: "d-m-yyyy"
            });

            $('#btnverreporte').on('click', function() {

                $('#chartReporte').remove('#chartReporte');
                $(".chartContainer").append("<canvas id=\"chartReporte\" width=\"300\" height=\"200\"></canvas>");

                var idplaza = $('select[id=idplaza]').val();
                var fechainicia = $('#datestart').val();
                var fechafin = $('#dateend').val();

                if(fechafin === fechainicia){
                    var tipo = 'bar';
                }else{
                    var tipo = 'line';
                }

                $.ajax({
                    url: "/admin/reporte/"+ idplaza +"/fecha/"+ fechainicia +"/"+ fechafin,
                    error: function () {
                        console.log('hubo un error')
                    },
                    success: function (data) {

                        var etiquetas = [], datos = [];

                        $.each(data, function(i, item) {
                            etiquetas.push(item.fecha);
                            datos.push(item.tiempo);
                        });

                        var ctx = document.getElementById("chartReporte").getContext('2d');
                        var chartReporte = new Chart(ctx, {
                            type: tipo,
                            data: {
                                labels: etiquetas,
                                datasets: [{
                                    label: "Horas de uso plaza",
                                    data: datos,
                                    lineTension: 0,
                                    fill: false,
                                    borderColor: 'blue',
                                    backgroundColor: 'rgb(78, 83, 219)',
                                    borderDash: [],
                                    pointBorderColor: 'blue',
                                    pointBackgroundColor: 'rgb(78, 83, 219)',
                                    pointRadius: 5,
                                    pointHoverRadius: 10,
                                    pointHitRadius: 30,
                                    pointBorderWidth: 2,
                                    pointStyle: 'rectRounded'
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                },
                                title: {
                                    display: true,
                                    text: 'Reporte de la ocupación de la plaza en el periodo seleccionado'
                                },
                                layout: {
                                    padding: {
                                        left: 0,
                                        right: 0,
                                        top: 0,
                                        bottom: 0
                                    }
                                }
                            }
                        });

                    }
                });

            });


        });

    </script>
@endpush
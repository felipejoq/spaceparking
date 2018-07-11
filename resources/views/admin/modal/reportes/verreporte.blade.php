<!-- Modal -->
<div class="modal fade" id="verreporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="row">

                    <div class="col-md-12 text-center">
                        <div><strong>Nombre reporte:</strong> <span id="nomrepo"></span></div>
                        <div><strong>Numero plaza:</strong> <span id="pid"></span> | <strong>Fecha de inicio Reporte:</strong> <span id="finicio"></span> | <strong>Fecha de fin Reporte:</strong> <span id="ftermino"></span></div>
                    </div>

                    <div class="col-md-12">
                        <div class="chartContainer2">
                            <canvas id="chartReporte2" width="300" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        //$(document).ready( function () {

        function pedir(idp,fi,ff) {

            $('#chartReporte2').remove('#chartReporte2');
            $(".chartContainer2").append("<canvas id=\"chartReporte2\" width=\"300\" height=\"200\"></canvas>");

            if(ff === fi){
                var tipo = 'bar';
            }else{
                var tipo = 'line';
            }

            $.ajax({
                url: "/admin/reporte/"+ idp +"/fecha/"+ fi +"/"+ ff,
                error: function () {
                    console.log('hubo un error')
                },
                success: function (data) {

                    var etiquetas = [], datos = [];

                    $.each(data, function(i, item) {
                        etiquetas.push(item.fecha);
                        datos.push(item.tiempo);
                    });

                    var ctx = document.getElementById("chartReporte2").getContext('2d');
                    var chartReporte2 = new Chart(ctx, {
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

        };

        //});

    </script>
@endpush
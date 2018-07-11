<!-- Modal -->
<div class="modal fade" id="verconsolidado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte consolidado por Año</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="yearsolicita">Año que solicita:</label>
                                    <input id="yearsolicita" class="form-control" placeholder="" name="yearsolicita" value="2018" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="btnverconsolidado">Ver consolidado</label>
                                    <button id="btnverconsolidado" type="button" class="btn btn-primary btn-block">Ver consolidado</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <d id="genera"></d>
                                <d id="mesrepo"></d>
                            </div>
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

            $("#yearsolicita").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                defaultDate: new Date()
            });

            $('#btnverconsolidado').on('click', function() {

                var year = $('#yearsolicita').val();

                if(!$('#yearsolicita').val()){
                    alert('Elija un año');
                }else{



                    $('#genera').append("<div id=\"gen\" class=\"text-center\"><p>Generando...</p><img src=\"{!! route('index') !!}/img/load.gif\" width=\"200\"/><div>");


                    $.ajax({
                        url: "/admin/reporte/consolidado/"+year,
                        error: function () {
                            alert('Hubo un error (Intente elegir el año actual)');
                            $('#gen').remove();
                        },
                        success: function (data) {

                            if (data.length === 0) alert('No hay datos');

                            $('#gen').remove();

                            $.each(data, function(i, item) {
                                $('#mesrepo').append("<br /><p><strong>Desde " + item[0].inicio +" al " + item[0].fin +"</strong></p>");
                                $.each(item, function(i, valor) {
                                    $('#mesrepo').append("<div><i class=\"material-icons iconos\">directions_car</i> La plaza <strong>" + valor.plaza +"</strong> fue usada <strong>" + valor.veces_que_fue_ocupada +"</strong> veces con un tiempo total de <strong>"+ valor.tiempo_fue_ocupada +"</strong> Hora(as).</div>");
                                });
                            });

                        }
                    });


                }


            });

        });
    </script>
@endpush
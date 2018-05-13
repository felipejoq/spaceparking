$(document).ready(function() {

    var call = function () {
        $.ajax({
            url: "api/disponibilidad",
            error: function () {
                console.log('hubo un error')
            },
            success: function (data) {

                $('#plazasdisponibles').html(data.disponibilidad.plazas_libres);
                $('#totalplazas').html(data.disponibilidad.total_plazas);

            }
        });
    };
    setInterval(call, 1000);

});


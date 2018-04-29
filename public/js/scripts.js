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
            //timeout: 1000 // sets timeout to 3 seconds
        });
    };
    setInterval(call, 1000);
});


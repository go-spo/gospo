$(document).ready(function () {
    /*================= TOTAL CENTROS =====================*/
    $.ajax({
        url: '../../../vendor/GospoAPI/totalcentros',
        dataType: 'json',
        type: 'GET',
        success: function (resultado) {
            $("#total-centers").append(resultado[0].totalCentros);
        }
    }
    );
    /*================= TOTAL USUARIOS =====================*/
    $.ajax({
        url: '../../../vendor/GospoAPI/totalusuarios',
        dataType: 'json',
        type: 'GET',
        success: function (resultado) {
            $("#total-users").append(resultado[0].totalUsuarios);
        }
    }
    );
    /*================= TOTAL DEPORTES =====================*/
    $.ajax({
        url: '../../../vendor/GospoAPI/totaldeportes',
        dataType: 'json',
        type: 'GET',
        success: function (resultado) {
            $("#total-sports").append(resultado[0].totalDeportes);
        }
    }
    );
    /*================= TOTAL EVENTOS =====================*/
    $.ajax({
        url: '../../../vendor/GospoAPI/totaleventos',
        dataType: 'json',
        type: 'GET',
        success: function (resultado) {
            $("#total-events").append(resultado[0].totalEventos);
        }
    }
    );


    /* ===============     Reservas  Chart initialization    ================*/

    $.ajax({
        url: '../../../vendor/GospoAPI/chart',
        dataType: 'json',
        type: 'GET',
        success: function (resultado) {

            var reservasDeporteChart = [];
            var reservasCantidadChart = [];
            var maxChartData = 100;

            resultado.forEach(n => {
                reservasDeporteChart.push(n.deporte);
                reservasCantidadChart.push(n.cantidad_reservas);
                $("#leyeneda-reservas-chart").append("<p>" + n.deporte + "</p>");

            });


            maxChartData = Math.max.apply(null, reservasCantidadChart) + 5;


            var dataReservasChart = {
                labels: reservasDeporteChart,
                series: [reservasCantidadChart]
            };
            var optionsReservasChart = {
                axisX: {
                    showGrid: false
                },
                low: 0,
                high: maxChartData,
                chartPadding: {
                    top: 0,
                    right: 5,
                    bottom: 0,
                    left: 0
                }
            };
            var responsiveOptions = [
                ['screen and (max-width: 850px)', {
                        showPoint: false,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                // Will return Mon, Tue, Wed etc. on medium screens
                                return value.slice(0, 3);
                            }
                        }
                    }],
                ['screen and (max-width: 640px)', {
                        showLine: false,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                // Will return M, T, W etc. on small screens
                                return value[0];
                            }
                        }
                    }]
            ];
            var resrervasChart = Chartist.Bar('#resrervasChart', dataReservasChart, optionsReservasChart, responsiveOptions);

//start animation for the Resrvas  Chart
            md.startAnimationForBarChart(resrervasChart);
        }
    }
    );


    /* ================== USERS TABLE ==========================*/

    $.ajax({
        url: '../../../vendor/GospoAPI/usuarios',
        dataType: 'json',
        type: 'GET',
        success: function (resultado) {
            console.log(resultado);
            resultado.forEach(n => {
                $("#users-table").append("<tr><td>" + n.id_usuario + "</td><td>" + n.nombre + "</td></td>");
            });

        }
    }
    );

});
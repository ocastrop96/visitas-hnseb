// if (localStorage.getItem("capturarRango2") != null) {
//     $("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));
// } else {
//     $("#daterange-btn2 span").html('<i class="fa fa-calendar-alt"></i> Rango de fecha')
// }
$('#daterange-btn2').daterangepicker({
    ranges: {
        Hoy: [moment(), moment()],
        Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
        "Últimos 7 días": [moment().subtract(6, "days"), moment()],
        "Últimos 30 días": [moment().subtract(29, "days"), moment()],
        "Este mes": [moment().startOf("month"), moment().endOf("month")],
        "Último mes": [
            moment().subtract(1, "month").startOf("month"),
            moment().subtract(1, "month").endOf("month"),
        ],
    },
    startDate: moment(),
    endDate: moment(),
    maxSpan: {
        days: 30,
    },
    opens: "center",
    locale: {
        format: "DD/MM/YYYY",
        separator: " - ",
        applyLabel: "APLICAR",
        cancelLabel: "CANCELAR",
        fromLabel: "Desde",
        toLabel: "Hasta",
        customRangeLabel: "Personalizar",
        weekLabel: "W",
        daysOfWeek: ["Do", "Lu", "Ma", "Mie", "Ju", "Vi", "Sa"],
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        firstDay: 1,
    },
}, function(start, end) {
    $("#daterange-btn2 span").html(
        start.format("MMMM D, YYYY") + "-" + end.format("MMMM D, YYYY")
    );
    var fechaInicialR = start.format("YYYY-MM-DD");
    var fechaFinalR = end.format("YYYY-MM-DD");

    var capturarRango2 = $("#daterange-btn2 span").html();
    localStorage.setItem("capturarRango2", capturarRango2);
    window.location =
        "index.php?ruta=reporte-visitas&fechaInicialR=" +
        fechaInicialR +
        "&fechaFinalR=" +
        fechaFinalR;
    let timerInterval;
    Swal.fire({
        title: "Se está cargando la información",
        html: "Espere por favor...",
        timer: 7000,
        timerProgressBar: true,
        onBeforeOpen: () => {
            Swal.showLoading();
            timerInterval = setInterval(() => {
                const content = Swal.getContent();
                if (content) {
                    const b = content.querySelector("b");
                    if (b) {
                        b.textContent = Swal.getTimerLeft();
                    }
                }
            }, 100);
        },
        onClose: () => {
            clearInterval(timerInterval);
        },
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
    });
});
$(".daterangepicker.openscenter .drp-buttons .cancelBtn").on(
    "click",
    function() {
        localStorage.removeItem("capturarRango2");
        localStorage.clear();
        window.location = "reporte-visitas";
        let timerInterval;
        Swal.fire({
            title: "Se está cargando la información",
            html: "Espere por favor...",
            timer: 7000,
            timerProgressBar: true,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    const content = Swal.getContent();
                    if (content) {
                        const b = content.querySelector("b");
                        if (b) {
                            b.textContent = Swal.getTimerLeft();
                        }
                    }
                }, 100);
            },
            onClose: () => {
                clearInterval(timerInterval);
            },
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
            }
        });
    });
$(".daterangepicker.openscenter .ranges li").on("click", function() {
    var textoHoy2 = $(this).attr("data-range-key");

    if (textoHoy2 == "Hoy") {
        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);

        var fechaInicialR = año + "-" + mes + "-" + dia;
        var fechaFinalR = año + "-" + mes + "-" + dia;

        localStorage.setItem("capturarRango2", "Hoy");

        window.location =
            "index.php?ruta=reporte-visitas&fechaInicialR=" +
            fechaInicialR +
            "&fechaFinalR=" +
            fechaFinalR;
        let timerInterval;
        Swal.fire({
            title: "Se está cargando la información",
            html: "Espere por favor...",
            timer: 7000,
            timerProgressBar: true,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    const content = Swal.getContent();
                    if (content) {
                        const b = content.querySelector("b");
                        if (b) {
                            b.textContent = Swal.getTimerLeft();
                        }
                    }
                }, 100);
            },
            onClose: () => {
                clearInterval(timerInterval);
            },
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
            }
        });
    }
});

$("#deshacer2").on("click", function() {
    window.location = "reporte-visitas";
});
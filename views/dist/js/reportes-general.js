$("#desReport").on("click", function() {
    window.location = "reporte-general";
});

$('#calendario-reportes').daterangepicker({
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
    opens: "left",
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
    $("#calendario-reportes span").html(
        start.format("MMMM D, YYYY") + "-" + end.format("MMMM D, YYYY")
    );
    var fechaInicialRG = start.format("YYYY-MM-DD");
    var fechaFinalRG = end.format("YYYY-MM-DD");

    var capturarRangoReporte = $("#calendario-reportes span").html();
    localStorage.setItem("capturarRangoReporte", capturarRangoReporte);
    window.location =
        "index.php?ruta=reporte-general&fechaInicialRG=" +
        fechaInicialRG +
        "&fechaFinalRG=" +
        fechaFinalRG;
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
$(".daterangepicker.opensleft .drp-buttons .cancelBtn").on(
    "click",
    function() {
        localStorage.removeItem("capturarRangoReporte");
        localStorage.clear();
        window.location = "reporte-general";
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

$(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy3 = $(this).attr("data-range-key");

    if (textoHoy3 == "Hoy") {
        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);

        var fechaInicialRG = año + "-" + mes + "-" + dia;
        var fechaFinalRG = año + "-" + mes + "-" + dia;

        localStorage.setItem("capturarRangoReporte", "Hoy");

        window.location =
            "index.php?ruta=reporte-general&fechaInicialRG=" +
            fechaInicialRG +
            "&fechaFinalRG=" +
            fechaFinalRG;
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
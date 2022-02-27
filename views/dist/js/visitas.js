$(".tablaVisitas").DataTable({
    deferRender: true,
    retrieve: true,
    processing: true,
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    language: {
        url: "views/dist/js/dataTables.spanish.lang",
    },
});

// VALIDA RAZON SOCIAL EXISTENTE

$("#confRuc").val("1");

$("#customRadio1").click(function() {
    if ($("#customRadio1").is(":checked")) {
        $("#confRuc").val("1");
        $("#bloqueRUC").removeClass("d-none");
    } else {
        $("#confRuc").val("2");
    }
});
$("#customRadio2").click(function() {
    if ($("#customRadio2").is(":checked")) {
        $("#confRuc").val("2");
        $("#bloqueRUC").addClass("d-none");
    } else {
        $("#confRuc").val("1");
    }
});
$("#vsHSalidaF").mdtimepicker();

$(".tablaVisitas tbody").on("click", ".btnRegistrarSalida", function() {
    var idVisita = $(this).attr("idVisita");
    var datos = new FormData();

    datos.append("idVisita", idVisita);
    $.ajax({
        url: "lib/ajaxVisitas.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#idVisita").val(respuesta["idVisita"]);
        },
    });
});
$("#deshacer").on("click", function() {
    window.location = "registro";
});
$("#daterange-btn").daterangepicker({
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
    },
    function(start, end) {
        $("#daterange-btn span").html(
            start.format("MMMM D, YYYY") + "-" + end.format("MMMM D, YYYY")
        );
        var fechaInicial = start.format("YYYY-MM-DD");
        var fechaFinal = end.format("YYYY-MM-DD");

        var capturarRango = $("#daterange-btn span").html();
        localStorage.setItem("capturarRango", capturarRango);
        window.location =
            "index.php?ruta=registro&fechaInicial=" +
            fechaInicial +
            "&fechaFinal=" +
            fechaFinal;
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
);
$(".daterangepicker.opensright .drp-buttons .cancelBtn").on(
    "click",
    function() {
        localStorage.removeItem("capturarRango");
        localStorage.clear();
        window.location = "registro";
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
);

$(".daterangepicker.opensright .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");

    if (textoHoy == "Hoy") {
        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);

        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;

        localStorage.setItem("capturarRango", "Hoy");

        window.location =
            "index.php?ruta=registro&fechaInicial=" +
            fechaInicial +
            "&fechaFinal=" +
            fechaFinal;
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

$("#vTDoc").on("change", function() {
    var tDoc = $(this).val();
    if (tDoc == 1) {
        $("#vNDoc").attr("maxlength", "8");
    } else {
        $("#vNDoc").attr("maxlength", "12");
    }
});
// Cargar datos DNI
$("#vNDoc").on("change", function() {
    var nDoc = $(this).val();
    var tDoc = $("#vTDoc").val();
    if (tDoc == 1) {
        // $("#vNAVis").prop("readonly", true);
        $.ajax({
            type: "GET",
            url: "https://dniruc.apisperu.com/api/v1/dni/" +
                nDoc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data) {
                $("#vNAVis").val(
                    data["nombres"] +
                    " " +
                    data["apellidoPaterno"] +
                    " " +
                    data["apellidoMaterno"]
                );
                $("#vEntidad").focus();
            },
            failure: function(data) {
                alert("Ha ocurrido un error en la conexión a la consulta de datos");
            },
            error: function(data) {
                $("#vNAVis").prop("readonly", false);
                $("#vNAVis").focus();
                toastr.info(
                    "Ingresa nombres y apellidos",
                    "Nombres y Apellidos de Visitante"
                );
            },
        });
    }
});

$("#vPersonal").on("change", function() {
    var idEmpleado = $(this).val();
    if (idEmpleado > 0) {
        var datos = new FormData();

        datos.append("idEmpleado", idEmpleado);
        $.ajax({
            url: "lib/ajaxEmpleados.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                $("#vOficina").val(respuesta["ofiEmp"]);
                $("#vOficina").html(respuesta["descOficina"]);
                $("#vCargo").val(respuesta["cargoEmp"]);
            },
        });
    } else {
        $("#vOficina").val("0");
        $("#vOficina").html("Seleccione responsable primero");
        $("#vCargo").val("");
    }
});
// Setteo
$("#vNDoc").keyup(function() {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#vNAVis").keyup(function() {
    var rv1 = $(this).val();
    var mayusrv1 = rv1.toUpperCase();
    $("#vNAVis").val(mayusrv1);
});
$("#vNAVis").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$.validator.addMethod(
    "valueNotEquals",
    function(value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);
//Validar Formulario


$("#btnRegVisita").on("click", function () {
    $("#frmRegVisita").validate({
        rules: {
            vTDoc: {
                valueNotEquals: "0",
            },
            vEntidad: {
                valueNotEquals: "0",
            },
            vNDoc: {
                required: true,
            },
            vNAVis: {
                required: true,
            },
            vMotivo: {
                valueNotEquals: "0",
            },
            vPersonal: {
                valueNotEquals: "0",
            },
            vOficina: {
                valueNotEquals: "0",
            },
            vCargo: {
                valueNotEquals: "0",
            },
            vLugar: {
                valueNotEquals: "0",
            },               
        },
        messages: {
            vTDoc: {
                valueNotEquals: "Selecciona un tipo Doc",
            },
            vEntidad: {
                valueNotEquals: "Seleccina lugar de visita",
            },
            vNDoc: {
                required: "Ingrese N° de Documento",
            },
            vNAVis: {
                required: "Ingrese nombres y apellidos de visitante",
            },
            vMotivo: {
                valueNotEquals: "Selecciona motivo de visita",
            },
            vPersonal: {
                valueNotEquals: "Selecciona personal visitado",
            },
            vOficina: {
                valueNotEquals: "Seleccioe Oficina",
            },
            vCargo: {
                valueNotEquals: "Ingrese cargo",
            },
            vLugar: {
                valueNotEquals: "Ingrese lugar de visita",
            },     
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-control").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });
});
$("#btnRegVisita").click(function() {
    var form1 = $("#frmRegVisita");
    validacion = form1.valid();
    if (validacion != true) {
        Swal.fire({
            type: "error",
            title: "Por favor completa todos los datos requeridos",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$.validator.addMethod(
    "valueNotEquals2",
    function(value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);
$("#formRegSalida").validate({
    rules: {
        vsEstadoF: {
            valueNotEquals2: "0",
        },
        vsHSalidaF: {
            required: true,
        },
    },
    messages: {
        vsEstadoF: {
            valueNotEquals2: "Selecciona un estado final",
        },
        vsHSalidaF: {
            required: "Ingrese hora de salida",
        },
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        element.closest(".form-control").append(error);
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid");
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
    },
});
$("#btnRegSalida").click(function() {
    var form2 = $("#formRegSalida");
    validacion2 = form2.valid();
    if (validacion2 != true) {
        Swal.fire({
            type: "error",
            title: "Por favor ingresa correctamente los datos de fin de visita",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});
$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '< Ant',
    nextText: 'Sig >',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);


$("#deshacer-filtro-acti").on("click", function() {
    window.location = "registro-agenda";
});
$("#rango-actividades").daterangepicker({
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
        var fechaInicialAct = start.format("YYYY-MM-DD");
        var fechaFinalAct = end.format("YYYY-MM-DD");

        var capRangoAct = $("#daterange-btn span").html();
        localStorage.setItem("capRangoAct", capRangoAct);
        window.location =
            "index.php?ruta=registro-agenda&fechaInicialAct=" +
            fechaInicialAct +
            "&fechaFinalAct=" +
            fechaFinalAct;
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
            }
        });
    }
);
$(".daterangepicker.opensright .drp-buttons .cancelBtn").on(
    "click",
    function() {
        localStorage.removeItem("capRangoAct");
        localStorage.clear();
        window.location = "registro-agenda";
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

        var fechaInicialAct = año + "-" + mes + "-" + dia;
        var fechaFinalAct = año + "-" + mes + "-" + dia;

        localStorage.setItem("capRangoAct", "Hoy");

        window.location =
            "index.php?ruta=registro-agenda&fechaInicialAct=" +
            fechaInicialAct +
            "&fechaFinalAct=" +
            fechaFinalAct;
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


$(".tablaAgenda").DataTable({
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
$("#fechaActi").datepicker({
    dateFormat: 'dd/mm/yy',
    showOtherMonths: true,
    selectOtherMonths: false,
    yearRange: ("-0:+0")
});

$("#horaActi").mdtimepicker();

$("#lugarAct").select2({
    ajax: {
        url: "lib/getDataLugaresActividad.php",
        type: "post",
        dataType: "json",
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term,
            };
        },
        processResults: function (response) {
            return {
                results: response,
            };
        },
        cache: true,
    },
});
// Filtro de campos
$("#descActi").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ0-9\-.,° ]/g, "");
});
$("#descActi").keyup(function () {
    var neq = $(this).val();
    var mayusteq = neq.toUpperCase();
    $("#descActi").val(mayusteq);
});
$.validator.addMethod(
    "valueNotEquals2",
    function (value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);

$("#btnRegActividad").on("click", function () {
    $("#frmRegActividad").validate({
        rules: {
            empActi: {
                valueNotEquals2: "0",
            },
            lugarAct: {
                valueNotEquals2: "0",
            },
            fechaActi: {
                required: true,
            },
            horaActi: {
                required: true,
            },
        },
        messages: {
            empActi: {
                valueNotEquals2: "Selecciona un Funcionario Público",
            },
            lugarAct: {
                valueNotEquals2: "Seleccina lugar de actividad",
            },
            fechaActi: {
                required: "Ingrese fecha de actividad",
            },
            horaActi: {
                required: "Ingrese hora de actividad",
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
$("#btnRegActividad").click(function () {
    var form1 = $("#frmRegActividad");
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
$("#descLugarAct").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ0-9\-.,° ]/g, "");
});
$("#descLugarAct").keyup(function () {
    var neq = $(this).val();
    var mayusteq = neq.toUpperCase();
    $("#descLugarAct").val(mayusteq);
});
$("#btnGLugarAct").click(function (e) {
    e.preventDefault();
    var datos = $("#RegLugarAct").serialize();
    $.ajax({
        method: "post",
        url: "lib/registroLugarAct.php",
        data: datos,
        success: function (e) {
            if (e == 1) {
                $("#modal-registrar-lugar").modal("hide");
                Swal.fire({
                    type: "success",
                    title: "¡Se registró el nuevo lugar con éxito!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                $("#descLugarAct").val("");
            } else {
                Swal.fire({
                    type: "error",
                    title: "Error al registrar, ingrese los datos del nuevo lugar",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
    });
    return false;
});
$("#descLugarAct").change(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaLugar2 = $(this).val();
    var datos = new FormData();
    datos.append("validaLugar2", validaLugar2);
    $.ajax({
        url: "lib/ajaxLugares.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                Toast.fire({
                    type: "warning",
                    title: "El lugar ingresado ya existe",
                });
                $("#descLugarAct").focus();
                $("#descLugarAct").val("");
            }
        },
    });
});
// Editar Agenda
$(".tablaAgenda tbody").on("click", ".btnEditarActividad", function () {
    var idActividad = $(this).attr("idActividad");
    var datos = new FormData();

    datos.append("idActividad", idActividad);
    $.ajax({
        url: "lib/ajaxActividades.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#idActividad").val(respuesta["idActividad"]);
            $("#edtfechaActi").val(respuesta["fechaAct"]);
            $("#edthoraActi").val(respuesta["horaAct"]);
            $("#edtempActi").val(respuesta["empAct"]);
            $("#edtempActi").html(respuesta["nombresEmp"]);
            $("#edtdescActi").val(respuesta["descAct"]);
            $("#edtlugarAct").val(respuesta["lugarAct"]);
            $("#edtlugarAct").html(respuesta["descLugar"]);
            $("#info-lugar").html(respuesta["descLugar"]);
        },
    });
});

$("#edtfechaActi").datepicker({
    dateFormat: 'dd/mm/yy',
    showOtherMonths: true,
    selectOtherMonths: false,
    yearRange: ("-0:+0")
});

$("#edthoraActi").mdtimepicker();

$("#edtlugarAct1").select2({
    ajax: {
        url: "lib/getDataLugaresActividad.php",
        type: "post",
        dataType: "json",
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term,
            };
        },
        processResults: function (response) {
            return {
                results: response,
            };
        },
        cache: true,
    },
});
$("#edtdescActi").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ0-9\-.,° ]/g, "");
});
$("#edtdescActi").keyup(function () {
    var neq = $(this).val();
    var mayusteq = neq.toUpperCase();
    $("#edtdescActi").val(mayusteq);
});

$("#btnEdtActividad").on("click", function () {
    $("#frmEdtActividad").validate({
        rules: {
            edtempActi: {
                valueNotEquals2: "0",
            },
            edtlugarAct: {
                valueNotEquals2: "0",
            },
            edtfechaActi: {
                required: true,
            },
            edthoraActi: {
                required: true,
            },
        },
        messages: {
            edtempActi: {
                valueNotEquals2: "Selecciona un Funcionario Público",
            },
            edtlugarAct: {
                valueNotEquals2: "Seleccina lugar de actividad",
            },
            edtfechaActi: {
                required: "Ingrese fecha de actividad",
            },
            edthoraActi: {
                required: "Ingrese hora de actividad",
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
$("#btnEdtActividad").click(function () {
    var form1 = $("#frmEdtActividad");
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

// Eliminar Actividad
$(".tablaAgenda tbody").on("click", ".btnEliminarActividad", function () {
    var idActividad = $(this).attr("idActividad");
    Swal.fire({
        title: '¿Está seguro de eliminar actividad?',
        text: "¡Si no lo está, puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonText: 'No, cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!'
    }).then(function (result) {
        if (result.value) {
            window.location = "index.php?ruta=registro-agenda&idActividad=" + idActividad;
        }
    })
});


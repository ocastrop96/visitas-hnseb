toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-left",
    preventDuplicates: true,
    onclick: null,
    showDuration: "100",
    hideDuration: "300",
    timeOut: "1500",
    extendedTimeOut: "100",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};
// Cargar tabla con ajax
$(".tablaEntidades").DataTable({
    ajax: "util/datatable-entidades.php",
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
// $("#confRuc1").val("1");

// $("#customRadio1").click(function() {
//     if ($("#customRadio1").is(":checked")) {
//         $("#confRuc1").val("1");
//         $("#blockRuc1").removeClass("d-none");
//     } else {
//         $("#confRuc1").val("2");
//     }
// });
// $("#customRadio2").click(function() {
//     if ($("#customRadio2").is(":checked")) {
//         $("#confRuc").val("2");
//         $("#blockRuc1").addClass("d-none");
//     } else {
//         $("#confRuc1").val("1");
//     }
// });
$("#btnGEntidad").click(function(e) {
    e.preventDefault();
    var datos = $("#RegEntidad").serialize();
    $.ajax({
        method: "post",
        url: "lib/registroEntidad.php",
        data: datos,
        success: function(e) {
            if (e == 1) {
                $("#modal-registrar-entidad").modal("hide");
                Swal.fire({
                    type: "success",
                    title: "¡Se registró la  entidad con éxito!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                $("#nRucEnt").val("");
                $("#rSocialEnt").val("");
            } else {
                Swal.fire({
                    type: "error",
                    title: "Error al registrar, ingrese los datos de la nueva entidad",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
    });
    return false;
});

$("#vEntidad").select2({
    ajax: {
        url: "lib/getData.php",
        type: "post",
        dataType: "json",
        delay: 250,
        data: function(params) {
            return {
                searchTerm: params.term,
            };
        },
        processResults: function(response) {
            return {
                results: response,
            };
        },
        cache: true,
    },
});

// valida razon social existente
$("#rSocialEnt").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaRS = $(this).val();
    var datos = new FormData();
    datos.append("validaRS", validaRS);
    $.ajax({
        url: "lib/ajaxEntidades.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                Toast.fire({
                    type: "warning",
                    title: "La razón social ya existe",
                });
                $("#rSocialEnt").focus();
                $("#rSocialEnt").val("");
                $("#nRucrSocialEntEnt").val("");
            }
        },
    });
});
// VALIDAR RUC EXISTENTE
$("#nRucEnt").attr("maxlength", "11");
$("#nRucEnt").keyup(function() {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#nRucEnt").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaEntidad = $(this).val();
    var datos = new FormData();
    datos.append("validaEntidad", validaEntidad);
    $.ajax({
        url: "lib/ajaxEntidades.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                Toast.fire({
                    type: "warning",
                    title: "La entidad ingresada ya existe",
                });
                $("#nRucEnt").focus();
                $("#nRucEnt").val("");
                $("#rSocialEnt").val("");
            } else {
                $.ajax({
                    type: "GET",
                    url: "https://dniruc.apisperu.com/api/v1/ruc/" +
                        validaEntidad +
                        "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data) {
                        $("#rSocialEnt").val("");
                        $("#rSocialEnt").prop("readonly", true);
                        $("#rSocialEnt").val(data["razonSocial"]);
                    },
                    failure: function(data) {
                        alert("Ha ocurrido un error en la conexión a la consulta de datos");
                    },
                    error: function(data) {
                        $("#rSocialEnt").prop("readonly", false);
                        $("#rSocialEnt").focus();
                        toastr.info("Ingresa tu Razón Social", "Razón Social");
                    },
                });
            }
        },
    });
});
$("#rSocialEnt").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$("#rSocialEnt").keyup(function() {
    var rs = $(this).val();
    var mayusrs = rs.toUpperCase();
    $("#rSocialEnt").val(mayusrs);
});

$("#newRUC").change(function() {
    // $("#newRS").prop("readonly", true);
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaEntidad1 = $(this).val();
    var datos = new FormData();
    datos.append("validaEntidad", validaEntidad1);
    $.ajax({
        url: "lib/ajaxEntidades.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                Toast.fire({
                    type: "warning",
                    title: "La entidad ingresada ya existe",
                });
                $("#newRUC").focus();
                $("#newRUC").val("");
                $("#newRS").val("");
            } else {
                $.ajax({
                    type: "GET",
                    url: "https://dniruc.apisperu.com/api/v1/ruc/" +
                        validaEntidad1 +
                        "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data) {
                        $("#newRS").val("");
                        $("#newRS").prop("readonly", true);
                        $("#newRS").val(data["razonSocial"]);
                    },
                    failure: function(data) {
                        alert("Ha ocurrido un error en la conexión a la consulta de datos");
                    },
                    error: function(data) {
                        $("#newRS").prop("readonly", false);
                        $("#newRS").focus();
                        toastr.info("Ingresa tu Razón Social", "Razón Social");
                    },
                });
            }
        },
    });
});

$("#newRUC").attr("maxlength", "11");
$("#newRUC").keyup(function() {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#newRS").keyup(function() {
    var rs1 = $(this).val();
    var mayusr1 = rs1.toUpperCase();
    $("#newRS").val(mayusr1);
});
$("#newRS").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ. ]/g, "");
});
$(".tablaEntidades tbody").on("click", ".btnEditarEntidad", function() {
    var idEntidad = $(this).attr("idEntidad");

    var datos = new FormData();
    datos.append("idEntidad", idEntidad);
    $.ajax({
        url: "lib/ajaxEntidades.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#idEntidad").val(respuesta["idEntidad"]);
            $("#edtRUC").val(respuesta["docRuc"]);
            $("#edtRS").val(respuesta["descEntidad"]);
        },
    });
});

$("#edtRS").keyup(function() {
    var rs12 = $(this).val();
    var mayusr12 = rs12.toUpperCase();
    $("#edtRS").val(mayusr12);
});
$("#edtRS").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ. ]/g, "");
});
$("#edtRUC").attr("maxlength", "11");
$("#edtRUC").keyup(function() {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});

$("#edtRUC").change(function() {
    $("#edtRS").prop("readonly", true);
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaEntidad12 = $(this).val();
    var datos = new FormData();
    datos.append("validaEntidad", validaEntidad12);
    $.ajax({
        url: "lib/ajaxEntidades.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                Toast.fire({
                    type: "warning",
                    title: "La entidad ingresada ya existe",
                });
                $("#edtRUC").focus();
                $("#edtRUC").val("");
                $("#edtRS").val("");
            } else {
                $.ajax({
                    type: "GET",
                    url: "https://dniruc.apisperu.com/api/v1/ruc/" +
                        validaEntidad12 +
                        "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data) {
                        $("#edtRS").val("");
                        $("#edtRS").prop("readonly", true);
                        $("#edtRS").val(data["razonSocial"]);
                    },
                    failure: function(data) {
                        alert("Ha ocurrido un error en la conexión a la consulta de datos");
                    },
                    error: function(data) {
                        $("#edtRS").prop("readonly", false);
                        $("#edtRS").focus();
                        toastr.info("Ingresa tu Razón Social", "Razón Social");
                    },
                });
            }
        },
    });
});

$(".tablaEntidades tbody").on("click", ".btnEliminarEntidad", function() {
    var idEntidad = $(this).attr("idEntidad");
    Swal.fire({
        title: "¿Está seguro de eliminar la entidad?",
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#343a40",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, eliminar!",
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=entidades&idEntidad=" + idEntidad;
        }
    });
});
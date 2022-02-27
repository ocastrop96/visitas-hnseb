$(".tablaMotivos").DataTable({
    ajax: "util/datatable-motivos.php",
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
$("#newMotivo").keyup(function() {
    var r1 = $(this).val();
    var mayus1 = r1.toUpperCase();
    $("#newMotivo").val(mayus1);
});
$("#newMotivo").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$("#edtMotivo").keyup(function() {
    var r2 = $(this).val();
    var mayus2 = r2.toUpperCase();
    $("#edtMotivo").val(mayus2);
});
$("#edtMotivo").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});

$(".tablaMotivos tbody").on("click", ".btnEditarMotivo", function() {
    var idMotivo = $(this).attr("idMotivo");

    var datos = new FormData();
    datos.append("idMotivo", idMotivo);
    $.ajax({
        url: "lib/ajaxMotivos.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#edtMotivo").val(respuesta["descMotivo"]);
            $("#idMotivo").val(respuesta["idMotivo"]);
        },
    });
});
$("#newMotivo").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaMotivo = $(this).val();
    var datos = new FormData();
    datos.append("validaMotivo", validaMotivo);
    $.ajax({
        url: "lib/ajaxMotivos.php",
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
                    title: "El motivo ingresado ya existe",
                });
                $("#newMotivo").focus();
                $("#newMotivo").val("");
            }
        },
    });
});
$("#edtMotivo").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaMotivo1 = $(this).val();
    var datos = new FormData();
    datos.append("validaMotivo", validaMotivo1);
    $.ajax({
        url: "lib/ajaxMotivos.php",
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
                    title: "El motivo ingresado ya existe",
                });
                $("#edtMotivo").focus();
                $("#edtMotivo").val("");
            }
        },
    });
});
$(".tablaMotivos tbody").on("click", ".btnEliminarMotivo", function() {
    var idMotivo = $(this).attr("idMotivo");
    Swal.fire({
        title: "¿Está seguro de eliminar el motivo?",
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#343a40",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, eliminar!",
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=motivos&idMotivo=" + idMotivo;
        }
    });
});
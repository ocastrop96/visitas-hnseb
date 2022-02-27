$(".tablaLugares").DataTable({
    ajax: "util/datatable-lugares.php",
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
$(".tablaLugares tbody").on("click", ".btnEditarLugar", function() {
    var idLugar = $(this).attr("idLugar");

    var datos = new FormData();
    datos.append("idLugar", idLugar);
    $.ajax({
        url: "lib/ajaxLugares.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#edtLugar").val(respuesta["descLugar"]);
            $("#idLugar").val(respuesta["idLugar"]);
        },
    });
});
$("#newLugar").keyup(function() {
    var rL = $(this).val();
    var mayusL = rL.toUpperCase();
    $("#newLugar").val(mayusL);
});
$("#newLugar").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$("#newLugar").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaLugar = $(this).val();
    var datos = new FormData();
    datos.append("validaLugar", validaLugar);
    $.ajax({
        url: "lib/ajaxLugares.php",
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
                    title: "El lugar ingresado ya existe",
                });
                $("#newLugar").focus();
                $("#newLugar").val("");
            }
        },
    });
});
$("#edtLugar").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaLugar1 = $(this).val();
    var datos = new FormData();
    datos.append("validaLugar", validaLugar1);
    $.ajax({
        url: "lib/ajaxLugares.php",
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
                    title: "El lugar ingresado ya existe",
                });
                $("#edtLugar").focus();
                $("#edtLugar").val("");
            }
        },
    });
});
$("#edtLugar").keyup(function() {
    var rLE = $(this).val();
    var mayusLE = rLE.toUpperCase();
    $("#edtLugar").val(mayusLE);
});
$("#edtLugar").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$(".tablaLugares tbody").on("click", ".btnEliminarLugar", function() {
    var idLugar = $(this).attr("idLugar");
    Swal.fire({
        title: "¿Está seguro de eliminar el lugar?",
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#343a40",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, eliminar!",
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=lugares&idLugar=" + idLugar;
        }
    });
});
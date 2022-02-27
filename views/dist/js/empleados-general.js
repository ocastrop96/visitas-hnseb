$(".tablaEmpleadosGeneral").DataTable({
    ajax: "util/datatable-empleados.php",
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
$(".tablaEmpleadosGeneral tbody").on("click", ".btnEditarEmpleado", function() {
    var idEmpleado = $(this).attr("idEmpleado");
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
            $("#idEmpleado").val(respuesta["idEmpleado"]);
            $("#edtOficinaEmp1").val(respuesta["ofiEmp"]);
            $("#edtOficinaEmp1").html(respuesta["descOficina"]);
            $("#edtEmpP").val(respuesta["nombresEmp"]);
            $("#edtCargEmp").val(respuesta["cargoEmp"]);
        },
    });
});
$("#newEmpP").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑñÁáÉéÍíÓóÚúÜü ]/g, "");
});
$("#newEmpP").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaEmpleado = $(this).val();
    var datos = new FormData();
    datos.append("validaEmpleado", validaEmpleado);
    $.ajax({
        url: "lib/ajaxEmpleados.php",
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
                    title: "El Empleado ingresado ya se encuentra registrado",
                });
                $("#newEmpP").focus();
                $("#newEmpP").val("");

            }
        },
    });
});
$("#newCargEmp").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑñÁáÉéÍíÓóÚúÜü ]/g, "");
});
$("#newEmpP").keyup(function() {
    var rNE = $(this).val();
    var mayusNE = rNE.toUpperCase();
    $("#newEmpP").val(mayusNE);
});
$("#newCargEmp").keyup(function() {
    var rNE1 = $(this).val();
    var mayusNE1 = rNE1.toUpperCase();
    $("#newCargEmp").val(mayusNE1);
});

$("#edtEmpP").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑñÁáÉéÍíÓóÚúÜü ]/g, "");
});
$("#edtEmpP").change(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var validaEmpleado1 = $(this).val();
    var datos = new FormData();
    datos.append("validaEmpleado", validaEmpleado1);
    $.ajax({
        url: "lib/ajaxEmpleados.php",
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
                    title: "El Empleado ingresado ya se encuentra registrado",
                });
                $("#edtEmpP").focus();
                $("#edtEmpP").val("");

            }
        },
    });
});
$("#edtCargEmp").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑñÁáÉéÍíÓóÚúÜü ]/g, "");
});

$("#edtEmpP").keyup(function() {
    var rNE2 = $(this).val();
    var mayusNE2 = rNE2.toUpperCase();
    $("#edtEmpP").val(mayusNE2);
});
$("#edtCargEmp").keyup(function() {
    var rNE12 = $(this).val();
    var mayusNE12 = rNE12.toUpperCase();
    $("#edtCargEmp").val(mayusNE12);
});
$(".tablaEmpleadosGeneral tbody").on("click", ".btnEliminarEmpleado", function() {
    var idEmpleado = $(this).attr("idEmpleado");
    Swal.fire({
        title: "¿Está seguro de eliminar el empleado?",
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#343a40",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, eliminar!",
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=empleados-publicos&idEmpleado=" + idEmpleado;
        }
    });
});
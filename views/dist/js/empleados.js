$(".tablaEmpleadosOf").DataTable({
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

$("#nEmpNA").keyup(function() {
    var re1 = $(this).val();
    var mayusre1 = re1.toUpperCase();
    $("#nEmpNA").val(mayusre1);
});
$("#nEmpNA").keyup(function() {
    this.value = (this.value + "").replace(/[^A-ZÑÁÉÍÓÚÜ ]/g, "");
});
$("#nEmpCar").keyup(function() {
    var re2 = $(this).val();
    var mayusre2 = re2.toUpperCase();
    $("#nEmpCar").val(mayusre2);
});
$("#nEmpCar").keyup(function() {
    this.value = (this.value + "").replace(/[^A-ZÑÁÉÍÓÚÜ ]/g, "");
});

$(".tablaEmpleadosOf tbody").on("click", ".btnEditarEmpleado", function() {
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
            $("#edtNEmp").val(respuesta["nombresEmp"]);
            $("#edtCEmp").val(respuesta["cargoEmp"]);
        },
    });
});

$("#nEmpNA").change(function() {
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
                $("#nEmpNA").focus();
                $("#nEmpNA").val("");

            }
        },
    });
});
$("#edtNEmp").keyup(function() {
    var re3 = $(this).val();
    var mayusre3 = re3.toUpperCase();
    $("#edtNEmp").val(mayusre3);
});
$("#edtNEmp").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$("#edtNEmp").change(function() {
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
                $("#edtNEmp").focus();
                $("#edtNEmp").val("");
            }
        },
    });
});
$("#edtCEmp").keyup(function() {
    var re4 = $(this).val();
    var mayusre4 = re4.toUpperCase();
    $("#edtCEmp").val(mayusre4);
});
$("#edtCEmp").keyup(function() {
    this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});


$("#frmRegEmp").validate({
    rules: {
        nEmpNA: {
            required: true,
        },
        nEmpCar: {
            required: true,
        },
    },
    messages: {
        nEmpNA: {
            required: "Ingrese este dato requerido",
        },
        nEmpCar: {
            required: "Ingrese este dato requerido",
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
$("#btnRegEmp").click(function() {
    var form3 = $("#frmRegEmp");
    validacion3 = form3.valid();
    if (validacion3 != true) {
        Swal.fire({
            type: "error",
            title: "Por favor ingresa correctamente los datos del Empleado",
            showConfirmButton: false,
            timer: 1500,
        });
    }
})
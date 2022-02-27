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
$(".tablaUsuarios").DataTable({
  ajax: "util/datatable-usuarios.php",
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
// $.ajax({

//     url: "util/datatable-usuarios.php",
//     success: function(respuesta) {
//         console.log("respuesta", respuesta);
//     }
// });
// CARGAR DATOS DE DNI
$("#newDNI").change(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
  });
  var validaDNI = $(this).val();
  var datos = new FormData();
  datos.append("validaDNI", validaDNI);
  $.ajax({
    url: "lib/ajaxUsuarios.php",
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
          title: "El DNI ya se encuentra registrado",
        });
        $("#newDNI").focus();
        $("#newDNI").val("");
      } else {
        $.ajax({
          type: "GET",
          url:
            "https://dniruc.apisperu.com/api/v1/dni/" +
            validaDNI +
            "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function (data) {
            // $("#newNombres").prop("readonly", true);
            // $("#newAPaterno").prop("readonly", true);
            // $("#newAMaterno").prop("readonly", true);
            $("#newNombres").val("");
            $("#newAPaterno").val("");
            $("#newAMaterno").val("");
            $("#newNombres").val(data["nombres"]);
            $("#newAPaterno").val(data["apellidoPaterno"]);
            $("#newAMaterno").val(data["apellidoMaterno"]);
            $("#newRol").focus();
          },
          failure: function (data) {
            alert("Ha ocurrido un error en la conexión a la consulta de datos");
          },
          error: function (data) {
            $("#newNombres").prop("readonly", false);
            $("#newAPaterno").prop("readonly", false);
            $("#newAMaterno").prop("readonly", false);
            $("#newNombres").focus();
            toastr.info(
              "Ingresa nombres y apellidos",
              "Nombres y Apellidos de Usuario"
            );
          },
        });
      }
    },
  });
});
$("#newOficina").change(function () {
  var name1 = $("#newNombres").val();
  var name2 = $("#newAPaterno").val();
  var name3 = $("#newAMaterno").val();

  var rechange1 = name1
    .toLowerCase()
    .trim()
    .split(" ")
    .map((v) => v[0].toUpperCase() + v.substr(1))
    .join(" ");
  var rechange2 = name2
    .toLowerCase()
    .trim()
    .split(" ")
    .map((v) => v[0].toUpperCase() + v.substr(1))
    .join(" ");
  var rechange3 = name3
    .toLowerCase()
    .trim()
    .split(" ")
    .map((v) => v[0].toUpperCase() + v.substr(1))
    .join(" ");
  $("#newNombres").val(rechange1);
  $("#newAPaterno").val(rechange2);
  $("#newAMaterno").val(rechange3);
});
$("#newCorreo").focusout(function () {
  if (
    validadorEmail($("#newCorreo").val()) === false &&
    $("#newCorreo").val() !== ""
  ) {
    toastr.error(
      "Ingrese un correo válido. correo@hnseb.gob.pe",
      "E-mail de Usuario"
    );
    $("#newCorreo").val("");
    $("#newCorreo").focus();
  }
});

function validadorEmail(email) {
  var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  if (regex.test(email)) {
    return true;
  } else {
    return false;
  }
}
$("#newUsuario").change(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
  });
  var validaUsuario = $(this).val();
  var datos = new FormData();
  datos.append("validaUsuario", validaUsuario);
  $.ajax({
    url: "lib/ajaxUsuarios.php",
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
          title: "El Usuario ya existe",
        });
        $("#newUsuario").focus();
        $("#newUsuario").val("");
      }
    },
  });
});

$("#rvCuenta").keyup(function () {
  this.value = (this.value + "").replace(/[^a-zA-Z\u00f1\u00d1]/g, "");
});
$("#rvCuenta").keyup(function () {
  var Us1 = $(this).val();
  var mayusUs1 = Us1.toLowerCase();
  $("#rvCuenta").val(mayusUs1);
});
$("#newUsuario").keyup(function () {
  var Us1 = $(this).val();
  var mayusUs1 = Us1.toLowerCase();
  $("#newUsuario").val(mayusUs1);
});
$("#newUsuario").keyup(function () {
  this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ]/g, "");
});
$("#newCorreo").keyup(function () {
  var Us2 = $(this).val();
  var mayusUs2 = Us2.toLowerCase();
  $("#newCorreo").val(mayusUs2);
});
$("#newNombres").keyup(function () {
  var Us3 = $(this).val();
  var mayusUs3 = Us3.toUpperCase();
  $("#newNombres").val(mayusUs3);
});
$("#newNombres").keyup(function () {
  this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$("#newAPaterno").keyup(function () {
  var Us4 = $(this).val();
  var mayusUs4 = Us4.toUpperCase();
  $("#newAPaterno").val(mayusUs4);
});
$("#newAPaterno").keyup(function () {
  this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
$("#newAMaterno").keyup(function () {
  var Us5 = $(this).val();
  var mayusUs5 = Us5.toUpperCase();
  $("#newAMaterno").val(mayusUs5);
});
$("#newAMaterno").keyup(function () {
  this.value = (this.value + "").replace(/[^A-Za-zÑÁÉÍÓÚÜ ]/g, "");
});
// EditarUsuario
$(".tablaUsuarios tbody").on("click", ".btnEditarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");
  var datos = new FormData();
  datos.append("idUsuario", idUsuario);
  $.ajax({
    url: "lib/ajaxUsuarios.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#idUsuario").val(respuesta["id_usuario"]);
      $("#edtDNI").val(respuesta["dni"]);
      $("#edtNombres").val(respuesta["nombres"]);
      $("#edtAPaterno").val(respuesta["aPaterno"]);
      $("#edtAMaterno").val(respuesta["aMaterno"]);
      $("#edtUsuario").val(respuesta["cuenta"]);
      $("#passActual").val(respuesta["clave"]);
      $("#edtCorreo").val(respuesta["correo"]);
      $("#edtRol1").val(respuesta["rolId"]);
      $("#edtRol1").html(respuesta["dscRol"]);
      $("#edtOficina1").val(respuesta["oficinaId"]);
      $("#edtOficina1").html(respuesta["descOficina"]);
    },
  });
});
$("#edtDNI").change(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
  });
  var validaDNI1 = $(this).val();
  var datos = new FormData();
  datos.append("validaDNI", validaDNI1);
  $.ajax({
    url: "lib/ajaxUsuarios.php",
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
          title: "El DNI ya se encuentra registrado",
        });
        $("#edtDNI").focus();
        $("#edtDNI").val("");
      } else {
        $.ajax({
          type: "GET",
          url:
            "https://dniruc.apisperu.com/api/v1/dni/" +
            validaDNI1 +
            "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function (data) {
            $("#edtNombres").prop("readonly", true);
            $("#edtAPaterno").prop("readonly", true);
            $("#edtAMaterno").prop("readonly", true);
            $("#edtNombres").val("");
            $("#edtAPaterno").val("");
            $("#edtAMaterno").val("");

            var name11 = data["nombres"];
            var name21 = data["apellidoPaterno"];
            var name31 = data["apellidoMaterno"];

            var rechange11 = name11
              .toLowerCase()
              .trim()
              .split(" ")
              .map((v) => v[0].toUpperCase() + v.substr(1))
              .join(" ");
            var rechange21 = name21
              .toLowerCase()
              .trim()
              .split(" ")
              .map((v) => v[0].toUpperCase() + v.substr(1))
              .join(" ");
            var rechange31 = name31
              .toLowerCase()
              .trim()
              .split(" ")
              .map((v) => v[0].toUpperCase() + v.substr(1))
              .join(" ");

            $("#edtNombres").val(rechange11);
            $("#edtAPaterno").val(rechange21);
            $("#edtAMaterno").val(rechange31);
            $("#edtRol").focus();
          },
          failure: function (data) {
            alert("Ha ocurrido un error en la conexión a la consulta de datos");
          },
          error: function (data) {
            $("#edtNombres").prop("readonly", false);
            $("#edtAPaterno").prop("readonly", false);
            $("#edtAMaterno").prop("readonly", false);
            $("#edtNombres").val("");
            $("#edtAPaterno").val("");
            $("#edtAMaterno").val("");
            $("#edtNombres").focus();
            toastr.info(
              "Ingresa nombres y apellidos",
              "Nombres y Apellidos de Usuario"
            );
          },
        });
      }
    },
  });
});
$("#edtUsuario").change(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
  });
  var validaUsuario = $(this).val();
  var datos = new FormData();
  datos.append("validaUsuario", validaUsuario);
  $.ajax({
    url: "lib/ajaxUsuarios.php",
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
          title: "El Usuario ya existe",
        });
        $("#edtUsuario").focus();
        $("#edtUsuario").val("");
      }
    },
  });
});

// Cambiar estado de usuarios activos e inactivos
$(".tablaUsuarios tbody").on("click", ".btnActivar", function () {
  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);

  $.ajax({
    url: "lib/ajaxUsuarios.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (window.matchMedia("(max-width:767px)").matches) {
        swal({
          title: "El estado del usuario ha sido actualizado",
          type: "success",
          confirmButtonText: "¡Cerrar!",
        }).then(function (result) {
          if (result.value) {
            window.location = "usuarios";
          }
        });
      }
    },
  });

  if (estadoUsuario == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html('<i class="fas fa-user-minus"></i>Inactivo');
    $(this).attr("estadoUsuario", 1);
  } else {
    $(this).addClass("btn-success");
    $(this).removeClass("btn-danger");
    $(this).html('<i class="fas fa-user-check"></i>Activo');
    $(this).attr("estadoUsuario", 0);
  }
});
// btnEliminarUsuario
$(".tablaUsuarios tbody").on("click", ".btnEliminarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    Swal.fire({
      title: "¿Está seguro de eliminar al usuario?",
      text: "¡Si no lo está, puede cancelar la acción!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#343a40",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Sí, eliminar usuario!",
    }).then(function (result) {
      if (result.value) {
        window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario;
      }
    });
  });
  
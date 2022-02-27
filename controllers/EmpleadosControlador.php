<?php
class EmpleadosControlador
{
    static public function ctrListarEmpleadosAdmin($item, $valor)
    {
        $tabla = "rv_empleados";
        $respuesta = EmpleadosModelo::mdlListarEmpleadosAd($tabla, $item, $valor);
        return $respuesta;
    }
    static public function ctrListarEmpleadosParam($Oficina)
    {
        $repuesta = EmpleadosModelo::mdlListarEmpleadosParam($Oficina);
        return $repuesta;
    }
    static public function ctrRegistraEmpleado()
    {
        if (isset($_POST["newEmpP"]) && isset($_POST["newCargEmp"])) {
            if (preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["newEmpP"]) && preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["newCargEmp"]) && preg_match('/^[0-9]+$/', $_POST["newOficinaEmp"])) {
                $tabla = "rv_empleados";
                $datos = array(
                    "nombresEmp" => $_POST["newEmpP"],
                    "cargoEmp" => $_POST["newCargEmp"],
                    "ofiEmp" => $_POST["newOficinaEmp"]
                );
                $rptRegOficina1 = EmpleadosModelo::mdlRegistrarEmpleado($tabla, $datos);
                if ($rptRegOficina1 == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El empleado ha sido registrado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "empleados-publicos";
                            }});
                      </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                      type: "error",
                      title: "Hubo un error al registrar sus datos",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                    }).then((result)=>{
                      if(result.value){
                          window.location = "empleados-publicos";
                      }});
                </script>';
                }
            }
            else {
                echo '<script>
                Swal.fire({
                  type: "error",
                  title: "Ingrese correctamente sus datos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "empleados-publicos";
                  }});
            </script>';
            }
        }
    }
    static public function ctrEditarEmpleado(){
        if (isset($_POST["edtEmpP"]) && isset($_POST["edtCargEmp"])) {
            if (preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["edtEmpP"]) && preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["edtCargEmp"]) && preg_match('/^[0-9]+$/', $_POST["edtOficinaEmp"])) {
                $tabla = "rv_empleados";
                $datos = array(
                    "nombresEmp" => $_POST["edtEmpP"],
                    "cargoEmp" => $_POST["edtCargEmp"],
                    "ofiEmp" => $_POST["edtOficinaEmp"],
                    "idEmpleado" => $_POST["idEmpleado"]
                );
                $rptEdEmpO = EmpleadosModelo::mdlEditarEmpleado($tabla, $datos);
                if ($rptEdEmpO == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El empleado ha sido modificado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "empleados-publicos";
                            }});
                      </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                      type: "error",
                      title: "Hubo un error al modificar sus datos",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                    }).then((result)=>{
                      if(result.value){
                          window.location = "empleados-publicos";
                      }});
                </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                  type: "error",
                  title: "Ingrese correctamente sus datos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "empleados-publicos";
                  }});
            </script>';
            }
        }
    }

    static public function ctrRegistrarEmpleadoOficina()
    {
        if (isset($_POST["nEmpNA"]) && isset($_POST["nEmpCar"])) {
            if (preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["nEmpNA"]) && preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["nEmpCar"]) && preg_match('/^[0-9]+$/', $_POST["idOfiEmp"])) {
                $tabla = "rv_empleados";
                $datos = array(
                    "nombresEmp" => $_POST["nEmpNA"],
                    "cargoEmp" => $_POST["nEmpCar"],
                    "ofiEmp" => $_POST["idOfiEmp"]
                );

                $rptRegOficina = EmpleadosModelo::mdlRegistrarEmpleadoOf($tabla, $datos);

                if ($rptRegOficina == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El empleado ha sido registrado en la Oficina",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "empleados";
                            }});
                      </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                      type: "error",
                      title: "Hubo un error al registrar sus datos",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                    }).then((result)=>{
                      if(result.value){
                          window.location = "empleados";
                      }});
                </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                  type: "error",
                  title: "Ingrese correctamente sus datos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "empleados";
                  }});
            </script>';
            }
        }
    }
    static public function ctrEditarEmpleadoOficina()
    {
        if (isset($_POST["edtNEmp"]) && isset($_POST["edtCEmp"])) {
            if (preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["edtNEmp"]) && preg_match('/^[A-ZÑÁÉÍÓÚÜ ]+$/', $_POST["edtCEmp"]) && preg_match('/^[0-9]+$/', $_POST["idEmpleado"])) {
                $tabla = "rv_empleados";
                $datos = array(
                    "nombresEmp" => $_POST["edtNEmp"],
                    "cargoEmp" => $_POST["edtCEmp"],
                    "idEmpleado" => $_POST["idEmpleado"]
                );
                $rptEdEmpOf = EmpleadosModelo::mdlEditarEmpleadoOf($tabla, $datos);
                if ($rptEdEmpOf == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El empleado ha sido modificado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "empleados";
                            }});
                      </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                      type: "error",
                      title: "Hubo un error al modificar sus datos",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                    }).then((result)=>{
                      if(result.value){
                          window.location = "empleados";
                      }});
                </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                  type: "error",
                  title: "Ingrese correctamente sus datos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "empleados";
                  }});
            </script>';
            }
        }
    }

    static public function ctrEliminarEmpleado()
    {
        if (isset($_GET["idEmpleado"])) {
            $tabla = "rv_empleados";
            $datos = $_GET["idEmpleado"];

            $respuesta = EmpleadosModelo::mdlEliminarEmpleado($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                        type: "success",
                        title: "¡El empleado ha sido eliminado con éxito!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                            window.location = "empleados-publicos";
                        }});
                    </script>';
            }
        }
    }
}

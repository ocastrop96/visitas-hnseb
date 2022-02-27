<?php
//Controladores añadiss
require_once "controllers/PlantillaControlador.php";
require_once "controllers/UsuariosControlador.php";
require_once "controllers/VisitasControlador.php";
require_once "controllers/TipoDocumentoControlador.php";
require_once "controllers/EstadoVisitaControlador.php";

require_once "controllers/RolesControlador.php";
require_once "controllers/OficinasControlador.php";
require_once "controllers/EntidadesControlador.php";
require_once "controllers/EmpleadosControlador.php";
require_once "controllers/MotivosControlador.php";
require_once "controllers/LugaresControlador.php";
require_once "controllers/ActividadesControlador.php";

//Modelos
require_once "models/UsuariosModelo.php";
require_once "models/VisitasModelo.php";
require_once "models/TipoDocumentoModelo.php";
require_once "models/EstadoVisitaModelo.php";

require_once "models/RolesModelo.php";
require_once "models/OficinasModelo.php";
require_once "models/EntidadesModelo.php";
require_once "models/EmpleadosModelo.php";
require_once "models/MotivosModelo.php";
require_once "models/LugaresModelo.php";
require_once "models/ActividadesModelo.php";

// Llamado a los objetos
$plantilla = new PlantillaControlador();
$plantilla->ctrPlantilla();

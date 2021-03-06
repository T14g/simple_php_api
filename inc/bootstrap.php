<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";

// include the Pendencia model file
require_once PROJECT_ROOT_PATH . "/Model/PendenciaModel.php";
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";
require_once PROJECT_ROOT_PATH . "/Model/SetorModel.php";
require_once PROJECT_ROOT_PATH . "/Model/AreaModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ComentarioModel.php";
require_once PROJECT_ROOT_PATH . "/Model/AtaModel.php";
?>
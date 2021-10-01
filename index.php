<?php
header("Access-Control-Allow-Origin: *");
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// if ((isset($uri[3]) && $uri[3] != 'pendencia') || !isset($uri[4])) {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }

require PROJECT_ROOT_PATH . "/Controller/Api/PendenciaController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/SetorController.php";

if($uri[3] === 'pendencia'){
    $objFeedController = new PendenciaController();
}else if($uri[3] === 'users'){
    $objFeedController = new UserController();
}else if($uri[3] === 'setores'){
    $objFeedController = new SetorController();
}


$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();

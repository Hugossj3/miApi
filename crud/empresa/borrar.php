<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../basedatos/App.php';
include_once '../../tablas/Empresa.php';

//Se crea conexión y objeto act
$database = new App();
$db = $database->dameConexion();
$act = new Empresa($db);

$datos = json_decode(file_get_contents("php://input"));

if (!empty($datos->id)) {
	$act->id = $datos->id;
	if ($act->borrar()) {
		http_response_code(200);
		echo json_encode(array("info" => "Actor borrado con éxito o no está en el sistema!"));
	} else {
		http_response_code(503);
		echo json_encode(array("info" => "No se puede borrar"));
	}
} else {
	http_response_code(400);
	echo json_encode(array("info" => "No se puede borrar, datos incompletos"));
}
?>
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

//Esto es para depurar, saldrá antes de la respuesta JSON, pero habrá que quitarlo para evitar errores!!
echo "Datos de depuración:";
echo $datos->id;
echo $datos->nombre;
echo $datos->campo;
echo $datos->correo;
echo $datos->telefono;


if( !empty($datos->id) && !empty($datos->nombre) && !empty($datos->campo) && !empty($datos->correo) && !empty($datos->telefono)){    

	//Se rellena actor con datos
	$act->id = $datos->id;
	$act->nombre = $datos->nombre;
	$act->campo = $datos->campo;
	$act->correo = $datos->correo;
	$act->telefono = $datos->telefono;

	if ($act->actualizar()) {
		http_response_code(200);
		echo json_encode(array("info" => "Actor/Actriz actualizado"));
	} else {
		http_response_code(503);
		echo json_encode(array("info" => "No se ha podido actualizar"));
	}

} else {
	http_response_code(400);
	echo json_encode(array("info" => "No se ha podido actualizar. Datos incompletos."));
}
?>
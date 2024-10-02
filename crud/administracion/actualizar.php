<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../basedatos/App.php';
include_once '../../tablas/Administracion.php';

//Se crea conexión y objeto act
$database = new App();
$db = $database->dameConexion();
$act = new Administracion($db);

$datos = json_decode(file_get_contents("php://input"));
//idEmpresa,idEmpleado,horasxContrato,horasTrabajadas,sueldoxHora
//Esto es para depurar, saldrá antes de la respuesta JSON, pero habrá que quitarlo para evitar errores!!
echo "Datos de depuración:";
echo $datos->idEmpleado;
echo $datos->horasxContrato;
echo $datos->horasTrabajadas;
echo $datos->sueldoxHora;


if(!empty($datos->idEmpresa) &&  !empty($datos->idEmpleado) && !empty($datos->horasxContrato) && !empty($datos->horasTrabajadas) && !empty($datos->sueldoxHora)){    

	$act->idEmpresa = $datos->idEmpresa;
	$act->idEmpleado = $datos->idEmpleado;
	$act->horasxContrato = $datos->horasxContrato;
	$act->horasTrabajadas = $datos->horasTrabajadas;
	$act->sueldoxHora = $datos->sueldoxHora;

	if ($act->actualizar()) {
		http_response_code(200);
		echo json_encode(array("info" => "Datos actualizados"));
	} else {
		http_response_code(503);
		echo json_encode(array("info" => "No se ha podido actualizar"));
	}

} else {
	http_response_code(400);
	echo json_encode(array("info" => "No se ha podido actualizar. Datos incompletos."));
}
?>
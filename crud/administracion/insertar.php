<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type");

include_once '../../basedatos/App.php';
include_once '../../tablas/Administracion.php';

//Se crea conexión y objeto act
$database = new App();
$db = $database->dameConexion();
$act = new Administracion($db);

$datos = json_decode(file_get_contents("php://input"));

//Esto es para depurar, saldrá antes de la respuesta JSON, pero habrá que quitarlo para evitar errores!!
echo $datos->horasxContrato;
echo $datos->horasTrabajadas;
echo $datos->sueldoxHora;

if (!empty($datos->idEmpresa) && !empty($datos->idEmpleado) && !empty($datos->horasxContrato) && !empty($datos->horasTrabajadas) && !empty($datos->sueldoxHora)) {

    //Se rellena actor con datos salvo el id
    $act->idEmpresa = $datos->idEmpresa;
    $act->idEmpleado = $datos->idEmpleado;
    $act->horasxContrato = $datos->horasxContrato;
    $act->horasTrabajadas = $datos->horasTrabajadas; 
    $act->sueldoxHora = $datos->sueldoxHora;

    if ($act->insertar()) {
        http_response_code(201);
        echo json_encode(array("info" => "Actor/Actriz Creado!"));
    } else {
        http_response_code(503);
        echo json_encode(array("info" => "No se puede crear"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("info" => "No se puede crear, falta algo!"));
}

?>
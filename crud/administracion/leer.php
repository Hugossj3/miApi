<?php
//Se han activado los ERRORES (displayError) en el servidor!!!
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../basedatos/App.php';
include_once '../../tablas/Administracion.php';


//Se crea conexión y objeto act
$database = new App();
$db = $database->dameConexion();
$act = new Administracion($db);

//Verificamos que se le está pasando una variable y no está vacía, en cuyo caso buscará esa id, si no, devuelve -1
//Y mostrará todo
if (isset($_GET['idEmpleado']) && $_GET['idEmpleado'] )
	$act->idEmpleado=$_GET['idEmpleado'];
else
	$act->idEmpleado=-1;//Mostrará todo

$result = $act->leer();

if($result->num_rows > 0){   
    $listaEmpleados["Administracion"]=array(); //Hace un array y dentro otro llamado ACTORES 
	while ($actor = $result->fetch_assoc()) { //Crea un array asociativo con cada actor	
        extract($actor);//Exporta las variables de un array
        $datosExtraidos=array(
            "idEmpresa" => $idEmpresa,
            "idEmpleado" => $idEmpleado,
            "horasxContrato" => $horasxContrato,
			"horasTrabajadas" => $horasTrabajadas,
            "sueldoxHora" => $sueldoxHora,
            ); 
       array_push($listaEmpleados["Administracion"], $datosExtraidos);//Hace un append al final de la lista 
    }    
    http_response_code(200);     
    echo json_encode($listaEmpleados);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("info" => "No se encontraron datos")
    );
} 
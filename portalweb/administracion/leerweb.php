<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once '../../basedatos/App.php';
include_once '../../tablas/Administracion.php';


//Se crea conexión y objeto act
$database = new App();
$db = $database->dameConexion();
$act = new Administracion($db);

//Verificamos que se le está pasando una variable y no está vacía, en cuyo caso buscará esa id, si no, devuelve -1
//Y mostrará todo

//LEER POR ID
if (isset($_GET['idEmpleado']) && $_GET['idEmpleado'])
    $act->idEmpleado = $_GET['idEmpleado'];
else
    $act->idEmpleado = -1; //Mostrará todo

$result = $act->leer();


if ($result->num_rows > 0) {

    echo '<th><a href="insertar.html">INSERTAR</a></th>';
    echo '<table border="1">';
    echo '<tr><th>idEmpresa</th><th>idEmpleado</th><th>horasxContrato</th><th>horasTrabajadas</th><th>sueldoxHora</th><th>Edicion</th><th colspan="3">Despido</th>
   
    </tr>';

    while ($actor = $result->fetch_assoc()) { //Crea un array asociativo con cada actor	
        extract($actor); //Exporta las variables de un array
        $dato = array(
            "idEmpresa" => $idEmpresa,
            "idEmpleado" => $idEmpleado,
            "horasxContrato" => $horasxContrato,
            "horasTrabajadas" => $horasTrabajadas,
            "sueldoxHora" => $sueldoxHora,
            
        );

        //$fotocodif=base64_decode($fotocodif);

        echo '<tr>';
        echo '<td>' . $idEmpresa . '</td>';
        echo '<td>' . $idEmpleado . '</td>';
        echo '<td>' . $horasxContrato . '</td>';
        echo '<td>' . $horasTrabajadas . '</td>';
        echo '<td>' . $sueldoxHora . '</td>';
        echo "<td><a href='editar.php?idEmpleado=$idEmpleado&horasxContrato=$horasxContrato&horasTrabajadas=$horasTrabajadas&sueldoxHora=$sueldoxHora'>Editar</a></td>";
 
        echo "<td><button id='botonBorrar' onclick='miFuncion(" . $idEmpleado . ", " . $idEmpresa . ")'>Borrar</button></td>";
        echo '</tr>';
    }
    echo '</table>';

}

?>


<script>

    function miFuncion(miid,superid) {


        var idJSON = {
            idEmpresa: superid,
            idEmpleado: miid
        };

        // Realiza una solicitud a tu script PHP para eliminar el elemento
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../crud/administracion/borrar.php", true);
        xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhr.send(JSON.stringify(idJSON));

        //Manejamos la respuesta del servidor
        xhr.onload = function () {
            if (xhr.status === 200) {
                // La solicitud se completó correctamente, procesa la respuesta si es necesario
                var respuesta = JSON.parse(xhr.responseText);
                console.log("Respuesta del servidor:", respuesta);
            } else {
                // Manejo de errores aquí
                console.error("Error en la solicitud:", xhr.status, xhr.statusText);
            }
        };

        //Recarga la página pasado 1 segundo
        setTimeout(function () {
            location.reload();
        }, 1000); 

    }

</script>
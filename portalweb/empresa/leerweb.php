<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once '../../basedatos/App.php';
include_once '../../tablas/Empresa.php';


//Se crea conexión y objeto act
$database = new App();
$db = $database->dameConexion();
$act = new Empresa($db);

//Verificamos que se le está pasando una variable y no está vacía, en cuyo caso buscará esa id, si no, devuelve -1
//Y mostrará todo

//LEER POR ID
if (isset($_GET['id']) && $_GET['id'])
    $act->id = $_GET['id'];
else
    $act->id = -1; //Mostrará todo

$result = $act->leer();


if ($result->num_rows > 0) {

    echo '<th><a href="insertar.html">INSERTAR</a></th>';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nombre</th><th>Campo</th><th>Correo</th><th>Telefono</th><th>Edicion</th><th colspan="3">Bancarrota</th>
   
    </tr>';

    while ($actor = $result->fetch_assoc()) { //Crea un array asociativo con cada actor	
        extract($actor); //Exporta las variables de un array
        $dato = array(
            "id" => $id,
            "nombre" => $nombre,
            "campo" => $campo,
            "correo" => $correo,
            "telefono" => $telefono,
            
        );

        //$fotocodif=base64_decode($fotocodif);

        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . $nombre . '</td>';
        echo '<td>' . $campo . '</td>';
        echo '<td>' . $correo . '</td>';
        echo '<td>' . $telefono . '</td>';
        echo "<td><a href='editar.php?id=$id&nombre=$nombre&campo=$campo&correo=$correo&telefono=$telefono'>Editar</a></td>";
 
        echo "<td><button id='botonBorrar' onclick='miFuncion($id)'>Borrar</button></td>";
        echo '</tr>';
    }
    echo '</table>';

}

?>


<script>

    function miFuncion(miid) {


        var idJSON = {
            id: miid
        };

        // Realiza una solicitud a tu script PHP para eliminar el elemento
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../crud/empresa/borrar.php", true);
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
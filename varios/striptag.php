<?php

$frase = "Este es un <b>ejemplo</b> con etiquetas HTML y un <script>alert('ataque')</script> intento.<br>";
echo $frase;

//Elimina todas las etiquetas HTML. Evita problemas de scripting (ejecución sin permiso)
echo "Se eliminan etiquetas HTML: ";
$res = strip_tags($frase);
echo $res;
echo "<br>";

?>
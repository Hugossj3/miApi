<?php

include_once '../basedatos/App.php';

$database=new App();
$conexion=$database->dameConexion();

if(!empty($_POST["register"])){
    if(empty($_POST["usuario"]) || empty($_POST["password"])){
        echo "Hay campos vacios";
    }else{
        $usu=$_POST["usuario"];
        $clave=md5($_POST["password"]);
        $sql=$conexion->query(" insert into usuario(login,password,esRoot)values('$usu','$clave',0)");
        if($sql==1){
            echo 'Usuario Registrado Correctamente';
        }else{
            echo 'Error al registrar al usuario';
        }
    }
}
?>
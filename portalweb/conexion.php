<?php



include_once '../basedatos/App.php';

$database=new App();
$conexion=$database->dameConexion();

if(!empty($_POST["logear"])){
    if(empty($_POST["login"]) && empty($_POST["password"])){
        echo "Los campos estan vacios";
    }else{
        $usuario=$_POST["login"];
        $clave=md5($_POST["password"]);
        $sql=$conexion->query(" select * from usuario where login='$usuario' && password='$clave'");
        if($datos=$sql->fetch_object()){
            header("location:seleccion.html");
        }else{
            echo 'Acceso Denegado';
        }
    
    }
}
?>
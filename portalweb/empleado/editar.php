<!DOCTYPE html>
<html>

<head>
    <title>Formulario JSON - Prueba API - EDITAR</title>
</head>

<body>
    <form id="miFormulario">

        <label for="id">id:</label>
        <input type="text" name="id" id="id" value="<?php echo $_GET["id"] ?>"><br>


        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $_GET["nombre"] ?>"><br>

        <label for="puesto">Puesto:</label>
        <input type="text" name="puesto" id="puesto" value="<?php echo $_GET["puesto"] ?>"><br>

        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" value="<?php echo $_GET["correo"] ?>"><br>

        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo $_GET["telefono"] ?>"><br>

        

        <input type="submit" value="Enviar">
    </form>

    <div id="respuesta"></div>

    <script>
        //Agrega un controlador de eventos para el formulario
        document.getElementById("miFormulario").addEventListener("submit", function (event) {
            event.preventDefault(); // Evitar el envío predeterminado del formulario

            //Cogemos los valores de los campos
            var id = document.getElementById("id").value;
            var nombre = document.getElementById("nombre").value;
            var puesto = document.getElementById("puesto").value;
            var correo = document.getElementById("correo").value;
            var telefono = document.getElementById("telefono").value;

            //Creamos un objeto JavaScript con los datos
            var datos = {
                id: id,
                nombre: nombre,
                puesto: puesto,
                correo: correo,
                telefono: telefono
            };

            console.log(datos);
            console.log(JSON.stringify(datos));

            // Enviamos los datos al servidor en formato JSON
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../crud/empleado/actualizar.php", true);
            xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            xhr.send(JSON.stringify(datos));

            //Manejamos la respuesta del servidor
            xhr.onload = function () {
                if (xhr.status == 200) {
                    document.getElementById("respuesta").innerHTML = "Datos enviados OK";
                } else {
                    document.getElementById("respuesta").innerHTML = "Error al enviar datos";
                }
            };


        }

        );
    </script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Formulario JSON - Prueba API - EDITAR</title>
</head>

<body>
    <form id="miFormulario">

        <label for="idEmpleado">idEmpleado:</label>
        <input type="text" name="idEmpleado" id="idEmpleado" value="<?php echo $_GET["idEmpleado"] ?>"><br>


        <label for="horasxContrato">Horas por contrato:</label>
        <input type="text" name="horasxContrato" id="horasxContrato" value="<?php echo $_GET["horasxContrato"] ?>"><br>

        <label for="horasTrabajadas">Horas trabajadas a la semana:</label>
        <input type="text" name="horasTrabajadas" id="horasTrabajadas" value="<?php echo $_GET["horasTrabajadas"] ?>"><br>

        <label for="sueldoxHora">Sueldo cobrado por hora:</label>
        <input type="text" name="sueldoxHora" id="sueldoxHora" value="<?php echo $_GET["sueldoxHora"] ?>"><br>        

        

        <input type="submit" value="Enviar">
    </form>

    <div id="respuesta"></div>

    <script>
        //Agrega un controlador de eventos para el formulario
        document.getElementById("miFormulario").addEventListener("submit", function (event) {
            event.preventDefault(); // Evitar el envío predeterminado del formulario

            //Cogemos los valores de los campos
            var idEmpleado = document.getElementById("idEmpleado").value;
            var horasxContrato = document.getElementById("horasxContrato").value;
            var horasTrabajadas = document.getElementById("horasTrabajadas").value;
            var sueldoxHora = document.getElementById("sueldoxHora").value;

            //Creamos un objeto JavaScript con los datos
            var datos = {
                idEmpleado: idEmpleado,
                horasxContrato: horasxContrato,
                horasTrabajadas: horasTrabajadas,
                sueldoxHora: sueldoxHora
            };

            console.log(datos);
            console.log(JSON.stringify(datos));

            // Enviamos los datos al servidor en formato JSON
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../crud/administracion/actualizar.php", true);
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
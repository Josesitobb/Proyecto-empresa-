<?php
session_start();

// Verifica si se ha iniciado sesión
$varsesion = $_SESSION['useremaillog'];

if ($varsesion == null || $varsesion == '') {
    echo 'USTED INICIE SESION';
    die();
}

include("../Controllers/db.php");

// Realiza una consulta SQL para obtener el nombre del usuario
$sql = "SELECT USUARI_Nombre____b FROM usuari WHERE USUARI_Correo___b = '$varsesion'";
$resultado = $conn->query($sql);

if ($resultado) {
    // Comprueba si se encontraron filas
    if ($resultado->num_rows > 0) {
        // Obtiene el nombre del usuario
        $fila = $resultado->fetch_assoc();
        $nombreUsuario = $fila['USUARI_Nombre____b'];
    }
}

// Almacena el nombre del usuario en una variable de sesión
$_SESSION['nombreUsuario'] = $nombreUsuario;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../Diseños/Estilo_Agregar.css">
    <link rel="stylesheet" href="../Diseños/Estilos_inicio_Admin.css">
</head>

<body>
<div class="login">
        <h2 class="">Bienvenido <?php echo $nombreUsuario; ?></h2>
        <h2> <a href="../Controllers/cerrar_sesion.php">Cerrar sesión</a></h2>
    </div>
    <br><br>
    <div class="container">
    <form action="../Controllers/Agregar_Usuario.php" method="post" enctype="multipart/form-data" onsubmit="return ValidacionAgregarUsuario();">

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Nombre</label>
                    <input type="text" class="Nombre" id="validationDefault01" placeholder="Nombre"  required name="Name_usuarios">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Correo</label>
                    <input type="email" class="Email" id="validationDefault02" placeholder="example@gmail.com"  required name="Email_usuarios">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Contraseña</label>
                    <input type="text" class="Contraseña" id="validationDefault02" placeholder="123465numeros"  required name="Password_usuarios">
                </div>



                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Indentificacion</label>
                    <input type="number" class="Indentificacion" id="validationDefault02" placeholder="123456789"  required name="Id_usuarios">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">Imagen</label>
                    <input type="file" class="Imagen" class="form-control" id="validationDefault03" placeholder="City" required name="Image_usuarios">
                </div>

                <!-- <div class="col-md-3 mb-3">
                <label for="validationDefault04">Rol</label>
                <input type="text" class="form-control" id="validationDefault04" placeholder="example1,2,3" required name="Role_usuarios">
            </div>
        </div> -->

                <label for="Role_usuarios">ROLES</label>
                <select name="Role_usuarios" id="Role_usuarios">
                    <option value="Empleado"> Empleado </option>
                    <option value="Admin">Admin </option>
                </select>

                <br>
                <br>
                <br>
                <button class="btn btn-secondary" id="BotonEnviar" type="submit"> Enviar</button>
                <br>
                <a href="./Pagina_Principal.php" id="BotonCancelar" class="btn btn-secondary">Cancelar</a>
          
                
                <br>

                <div id="formulario">

                <table>
    <thead>
        <tr>
            <th>Día</th>
            <th>Hora de Entrada</th>
            <th>Hora de Salida</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Lunes</td>
            <td><input type="time" name="horal1" id="horal1"></td>
            <td><input type="time" name="horal2" id="horal2"></td>
        </tr>
        <tr>
            <td>Martes</td>
            <td><input type="time" name="horam1" id="horam1"></td>
            <td><input type="time" name="horam2" id="horam2"></td>
        </tr>
        <tr>
            <td>Miércoles</td>
            <td><input type="time" name="horami1" id="horami1"></td>
            <td><input type="time" name="horami2" id="horami2"></td>
        </tr>
        <tr>
            <td>Jueves</td>
            <td><input type="time" name="horaj1" id="horaj1"></td>
            <td><input type="time" name="horaj2" id="horaj2"></td>
        </tr>
        <tr>
            <td>Viernes</td>
            <td><input type="time" name="horav1" id="horav1"></td>
            <td><input type="time" name="horav2" id="horav2"></td>
        </tr>
        <tr>
            <td>Sábado</td>
            <td><input type="time" name="horas1" id="horas1"></td>
            <td><input type="time" name="horas2" id="horas2"></td>
        </tr>
        <tr>
            <td>Domingo</td>
            <td><input type="time" name="horad1" id="horad1"></td>
            <td><input type="time" name="horad2" id="horad2"></td>
        </tr>
    </tbody>
</table>




        </form>
    </div>
    </form>
    </div>



    <script src="../Controllers/JS/Validar_SI_Rol_Es_Empleado.js"></script>
    <script src="../Controllers/JS/Validar_Agregar_Usuario.js"></script>
</body>

</html>
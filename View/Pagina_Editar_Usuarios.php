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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Diseños/Estilos_inicio_Admin.css">
    <link rel="stylesheet" href="../Diseños/Estilos_Editar.css">
    <title>Document</title>
</head>

<body>
<div class="login">
        <h2 class="">Bienvenido <?php echo $nombreUsuario; ?></h2>
        <h2> <a href="../Controllers/cerrar_sesion.php">Cerrar sesión</a></h2>
    </div>
    <?php
    // include("../Controllers/db.php");
    // $USUARI_ConsInte__b =$_REQUEST['USUARI_ConsInte__b'];
    // $sql = "SELECT * FROM usuari  WHERE USUARI_ConsInte__b =$USUARI_ConsInte__b";
    // $Resultado = $conn->query($sql);

    // $filas= $Resultado ->fetch_assoc();
    include("../Controllers/db.php");
    $USUARI_ConsInte__b = $_REQUEST['USUARI_ConsInte__b'];
    $sql = "SELECT * FROM usuari WHERE USUARI_ConsInte__b = " . intval($USUARI_ConsInte__b);
    $Resultado = $conn->query($sql);

    $filas = $Resultado->fetch_assoc();

    ?>

    
    <div class="container">
        <form action="../Controllers/Editar_Usuario.php?USUARI_ConsInte__b=<?php echo $filas['USUARI_ConsInte__b'] ?>" method="post" enctype="multipart/form-data"onsubmit="return ValidacionEditarUsuarios();">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nombre</label>
                    <input type="text"   class="Nombre " id="inputEmail4" placeholder="Email" value="<?php echo $filas['USUARI_Nombre____b'] ?>" name="Name_usuarios">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Correo</label>
                    <input type="email" class="Email" id="inputEmail4" placeholder="Email" value="<?php echo $filas['USUARI_Correo___b'] ?>" name="Email_usuarios">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Contraseña</label>
                <input type="text" class="Contraseña" id="inputEmail4" placeholder="Email" value="<?php echo $filas['USUARI_passCorreo_b'] ?>" name="Password_usuarios">
            </div>


            <div class="form-group col-md-6">
                <label for="inputEmail4">Identificacion</label>
                <input type="number " class="Indetificacion" id="inputEmail4" placeholder="Email" value="<?php echo $filas['USUARI_Identific_b'] ?>" name="Id_usuarios">
            </div>

            <td><img id="Imagen" style="width: 150px;" src="data:image/jpg;base64,<?php echo base64_encode($filas['USUARI_Foto______b']) ?>" alt=""></td>
            <div class="form-group col-md-6">
                <label for="inputEmail4">imagen</label>
                <input class="Imagen" type="file" class="" id="inputEmail4"  name="Image_usuarios">
            </div>

            <!-- seleciona los roles que estan en la base de datos  -->
            <label for="Role_usuarios">ROLES</label>
            <select name="Role_usuarios" id="Role_usuarios">
                <option value="Admin" <?php if ($filas['USUARI_Cargo_____b'] == 'Admin') echo 'selected'; ?>>
                    Admin
                </option>
                <option value="Empleado" <?php if ($filas['USUARI_Cargo_____b'] == 'Empleado') echo 'selected'; ?>>
                    Empleado
                </option>
            </select>

            <!-- Cambia el formulario por un div oculto -->
            <div id="empleadoDiv" style="display: none;">
                <!-- Agrega aquí el contenido que deseas mostrar cuando se selecciona "Empleado" -->
                <label for="campo1">Campo 1:</label>
                <input type="text" name="campo1" id="campo1">
                <!-- Más contenido aquí... -->
            </div>


            <button type="submit" id="botones"   class="btn btn-primary"> Enviar</button>
            
            <a id="botones" class="btn btn-primary" href="../View/Pagina_Principal.php">Cancelar</a>
        </form>
    </div>

    <script src="../Controllers/JS/Validar_SI_Rol_Es_Empleado.js"></script>
    <script src="../Controllers/JS/Validar_Editar_Usuario.js"></script>
</body>

</html>
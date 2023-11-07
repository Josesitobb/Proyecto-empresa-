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
    <!-- Encabezado HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Diseños/Estilos_inicio_Admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caprasimo&family=Oswald:wght@400;500;600;700&family=Poppins:ital,wght@0,500;0,600;0,700;0,800;1,400&family=Roboto+Mono:ital,wght@0,300;1,400;1,500&family=Slabo+27px&display=swap" rel="stylesheet">
    <title>Página Principal</title>
</head>
<body>
    <div class="login">
        <h2 class="">Bienvenido <?php echo $nombreUsuario; ?></h2>
        <h2> <a href="../Controllers/cerrar_sesion.php">Cerrar sesión</a></h2>
    </div>

    <!-- Resto del contenido HTML -->
  
</div>

    <a href="./Pagina_Agregar_Usuario.php" class="btn btn-secondary" id="Boton_Agregar">AGREGAR NUEVO USUARIO</a>
<table class="table table-dark table-striped" id="Datos">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Contraseña</th>
      <th scope="col">Identificacion</th>
      <th scope="col">Imagen</th>
      <th scope="col">Rol</th>
      <th scope="col">¿Que desea hacer?</th>


    </tr>
  </thead>
  <tbody>
    <?php
    include("../Controllers/db.php");

    $sql="SELECT * FROM usuari ";
    $Resultado =$conn->query($sql);

    while($filas=$Resultado->fetch_assoc()){?>

    


    <tr>
      
      <th scope="row"><?php echo $filas['USUARI_ConsInte__b'] ?></th>
      <td><?php echo $filas['USUARI_Nombre____b'] ?></td>
      <td><?php echo $filas['USUARI_Correo___b'] ?></td>
      <td><?php echo $filas['USUARI_passCorreo_b'] ?></td>
      <td><?php echo $filas['USUARI_Identific_b'] ?></td>
      <td><img style="width: 200px; height: 200px;" src="data:image/jpg;base64,<?php echo base64_encode($filas['USUARI_Foto______b']) ?>" alt=""></td>
      <td><?php echo $filas['USUARI_Cargo_____b'] ?></td>
      <td>
        <div class="Botones">
      <a href="../Controllers/Eliminar_usuario.php?USUARI_ConsInte__b=<?php echo $filas['USUARI_ConsInte__b'] ?>" class="btn btn-secondary" id=Botones>ELIMINAR</a>
      <a href="Pagina_Editar_Usuarios.php?USUARI_ConsInte__b=<?php echo $filas['USUARI_ConsInte__b'] ?>" class="btn btn-secondary" id="Botones">Editar</a>
      </div>
      </td>
    </tr>
  
  </tbody>
  <?php  }  ?>
</table>


</body>
</html>







<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: http://localhost/barberShop/login.php');
        die();
    }
    $base_url = 'http://localhost/barberShop/src/';
?>
<!doctype html>
<html lang="en">

<head>
  <title>Barber Shop</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $base_url?>" aria-current="page">Sistema <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url?>sessions/empleados/index.php">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url?>sessions/puestos/index.php">Puestos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url?>sessions/usuarios/index.php">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url?>../logout.php"">Cerrar sesión</a>
            </li>
        </ul>
    </nav>
  </header>


  <main>
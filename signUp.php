<?php
    session_start();  
    include('./src/clases/Conexion.php');
    include('./src/clases/Client.php');
    $connect = new Client();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="./src/output.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
    <!-- component -->
    <div class="bg-gray-100 flex justify-center items-center h-screen">
        <!-- Left: Image -->
    <div class="w-1/2 h-screen hidden lg:block">
      <img src="https://placehold.co/800x/667fff/ffffff.png?text=Your+Image&font=Montserrat" alt="Placeholder Image" class="object-cover w-full h-full">
    </div>
    <!-- Right: Login Form -->
    <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
      <h1 class="text-2xl font-semibold mb-4">Regístrate</h1>
      <form action="signUp.php" method="POST">
        <!-- Nombre Input -->
        <div class="mb-4">
          <label for="nombre" class="block text-gray-600">Nombre</label>
          <input type="nombre" id="nombre" name="txtNombre" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- Apellido Input -->
        <div class="mb-4">
          <label for="apellido" class="block text-gray-600">Apellido</label>
          <input type="apellido" id="apellido" name="txtApellido" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- Cedula Input -->
        <div class="mb-4">
          <label for="cedula" class="block text-gray-600">Cedula</label>
          <input type="cedula" id="cedula" name="txtCedula" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- Email Input -->
        <div class="mb-4">
          <label for="email" class="block text-gray-600">Email</label>
          <input type="email" id="email" name="txtEmail" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- telefono Input -->
        <div class="mb-4">
          <label for="telefono" class="block text-gray-600">Telefono</label>
          <input type="telefono" id="telefono" name="txtTelefono" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- Register Button -->
        <button name="btnRegister" type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Registrar</button>
      </form>
      <!-- Sign up  Link -->
      <div class="mt-6 text-blue-500 text-center">
        <a href="./login.php" class="hover:underline">Inicia sesión aquí</a>
      </div>
    </div>
    </div>
</body>
</html>


<?php 

if(isset($_POST['btnRegister'])){
  if(!isset($_POST['txtTelefono']) || $_POST['txtTelefono'] === '') {
    echo "<script>Swal.fire('El número de teléfono es obligatorio')</script>";
} elseif (!preg_match('/^04\d{9}$/', $_POST['txtTelefono'])) {
    echo "<script>Swal.fire('El número de teléfono debe empezar por 04 y contener exactamente 11 caracteres.')</script>";
}elseif (!ctype_digit($_POST['txtTelefono'])) {
    echo "<script>Swal.fire('El número de teléfono no puede contener letras')</script>";
}elseif (!isset($_POST['txtNombre']) || $_POST['txtNombre'] === '') {
    echo "<script>Swal.fire('El Nombre es un campo obligatorio')</script>";
}elseif (!isset($_POST['txtApellido']) || $_POST['txtApellido'] === '') {
    echo "<script>Swal.fire('El Apellido es un campo obligatorio')</script>";
}elseif (!isset($_POST['txtCedula']) || $_POST['txtCedula'] === '') {
    echo "<script>Swal.fire('La cédula es un campo obligatorio')</script>";
}elseif (strlen($_POST['txtCedula']) < 7 || strlen($_POST['txtCedula']) > 8) {
    echo "<script>Swal.fire('La cédula debe contener entre 7 y 8 caracteres')</script>";
}elseif (!ctype_digit($_POST['txtCedula'])) {
    echo "<script>Swal.fire('La cédula no puede contener letras')</script>";
}elseif (!isset($_POST['txtEmail']) || $_POST['txtEmail'] === '') {
    echo "<script>Swal.fire('El email es obligatorio')</script>";
}elseif (!filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)) {
    echo "<script>Swal.fire('El campo email debe ser una dirección valida')</script>";
}else {
      $usuario = $connect->signUpClient(
          $_POST['txtNombre'],
          $_POST['txtApellido'], 
          $_POST['txtCedula'],
          $_POST['txtTelefono'],
          $_POST['txtEmail']
      );
      if($usuario){
          $_SESSION['user_id'] = $usuario["id"];
          $_SESSION["user_role"] = $usuario["role"];
          $_SESSION['employee_id'] = null;
          $_SESSION['logueado'] = true;
          header('Location: index.php');
    }else{
        echo "qlq";
    } 
}
}

?>

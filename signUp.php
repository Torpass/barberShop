<?php
    session_start();  
    include('./src/clases/Conexion.php');
    include('./src/clases/Client.php');
    $connect = new Client();
    
    if(isset($_POST['btnRegister'])){
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
            $_SESSION['logueado'] = true;
            header('Location: index.php');
        }else{
            $message = "Error";
        } 
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
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


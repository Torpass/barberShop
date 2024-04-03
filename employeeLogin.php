<?php
    session_start();  
    include('./src/clases/Conexion.php');
    include('./src/clases/Employee.php');
    $Employees = new Employee();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="./src/output.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion como empleado</title>
</head>
<body>
    <!-- component -->
    <div class="bg-gray-100 flex justify-center items-center h-screen">
        <!-- Left: Image -->
    <div class="w-1/2 h-screen hidden lg:block">
      <img src="https://onpointfresh.com/wp-content/uploads/2023/09/hair-600x600.png" alt="Placeholder Image" class="object-cover w-full h-full">
    </div>
    <!-- Right: Login Form -->
    <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
      <h1 class="text-2xl font-semibold mb-4">Iniciar Sesión como empleado</h1>
      <form action="employeeLogin.php" method="POST">
        <!-- Username Input -->
        <div class="mb-4">
          <label for="nombre" class="block text-gray-600">Nombre del empleado</label>
          <input type="nombre" id="nombre" name="txtNombre" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- Password Input -->
        <div class="mb-4">
          <label for="cedula" class="block text-gray-600">Cedula del empleado</label>
          <input type="cedula" id="cedula" name="txtCedula" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
        </div>
        <!-- Remember Me Checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="remember" name="remember" class="text-blue-500">
          <label for="remember" class="text-gray-600 ml-2">Recuerdame</label>
        </div>
        <!-- Forgot Password Link -->
        <div class="mb-6 text-blue-500">
          <a href="#" class="hover:underline">¿Olvidó la contraseña?</a>
        </div>
        <!-- Login Button -->
        <button type="submit" name="btnLogin" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full" >Iniciar Sesión</button>
      </form>
      <div class="mt-6 text-blue-500 text-center">
        <a href="./Login.php" class="hover:underline">Logueate como cliente</a>
        <br>
        <a href="./signUp.php" class="hover:underline">Registrate aquí</a>
      </div>
    </div>
</body>
</html>

<?php 
if(isset($_POST['btnLogin'])){
  if(!isset($_POST['txtNombre']) || $_POST['txtNombre'] === '') {
    echo "<script>Swal.fire('El Nombre es un campo obligatorio')</script>";
  }elseif (!isset($_POST['txtCedula']) || $_POST['txtCedula'] === '') {
    echo "<script>Swal.fire('La cédula es un campo obligatorio')</script>";
  }elseif (!ctype_digit($_POST['txtCedula'])) {
    echo "<script>Swal.fire('La cédula no puede contener letras')</script>";
  }else{
    $usuario = $Employees->loginEmployee($_POST['txtNombre'],$_POST['txtCedula']);
    if($usuario){
      $_SESSION['employee_id'] = $usuario['Id_Empleado'];
      $_SESSION['user_id'] = null;
      $_SESSION['user_role'] = $usuario["role"];

      $_SESSION['logueado'] = true;
      header('Location:index.php');
    
    }else{
      echo "<script>Swal.fire('Combinacion de usuario y contraseña incorrectos')</script>";
    }
  }

}


?>

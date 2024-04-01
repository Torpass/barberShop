<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Employee.php")?>
<?php include('../../templates/header.php');?>

<?php
    $Employees= new Employee();

?>

<?php
if(isset($_POST['btnRegistrar'])){   
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
    }elseif (!isset($_POST['txtDescripcion']) || $_POST['txtDescripcion'] === '') {
        echo "<script>Swal.fire('La descripción es una campo obligatorio')</script>";
    }elseif (strlen($_POST['txtDescripcion']) > 250) {
        echo "<script>Swal.fire('El campo Descripción no debe superar los 250 caracteres.')</script>";
    }elseif (!isset($_POST['txtHorarios']) || $_POST['txtHorarios'] === '') {
        echo "<script>Swal.fire('El campo Horarios es obligatorio.')</script>";
    }else {

        $nombre = $_POST['txtNombre'];
        $apellido = $_POST['txtApellido'];
        $cedula = $_POST['txtCedula'];
        $telefono = $_POST['txtTelefono'];
        $email = $_POST['txtEmail'];
        $descripcion = $_POST['txtDescripcion'];
        $horarios = $_POST['txtHorarios'];

        if($Employees->createEmployee($nombre, $apellido, $cedula, $telefono, $email, $descripcion, $horarios)){
            echo "<script>Swal.fire('Empleado registrado correctamente')</script>";
        }else{
            echo "<script>Swal.fire('Error al registrar el empleado')</script>";
        }
    }
}
?>


<head>
    <link href="../../output.css" rel="stylesheet">
</head>
<body>
    <!-- component -->
<section class="max-w-4xl mb-12 p-6 mx-auto rounded-md shadow-md dark:bg-gray-800 mt-20">
    <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-500 rounded shadow ripple hover:shadow-lg hover:bg-red-600 focus:outline-none" href="./index.php">Salir</a>	
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Crear Empleado</h1>
    <form method="post" action="createEmployee.php" onsubmit="validateForm()">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <!-- input name -->
            <div>
                <label class="text-white dark:text-gray-200" for="txtNombre">Nombre</label>
                <input id="username" type="text" name="txtNombre" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <!-- input lastname -->
            <div>
                <label class="text-white dark:text-gray-200" for="txtApellido">Apellido</label>
                <input id="emailAddress" type="input" name="txtApellido" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="password">Cédula</label>
                <input id="password" type="input" name="txtCedula" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Email</label>
                <input id="" type="email" name="txtEmail" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Teléfono</label>
                <input id="" type="input" name="txtTelefono" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>


            <div class="mt-4">
                <label class="text-white dark:text-gray-200" for="horarios">Horarios de Trabajo</label>
                <select id="horarios" name="txtHorarios[]" multiple class="block w-full px-4 py-2 mt-2 text-gray-70 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring
                bg-gray-100">
                    <option value="1" class="mt-2">Lunes 8:00:00am | 5:00:00pm</option>
                    <option value="2" class="mt-2">Martes 8:00:00am | 5:00:00pm</option>
                    <option value="3" class="mt-2">Miercoles 8:00:00am | 5:00:00pm</option>
                    <option value="4" class="mt-2">Jueves 8:00:00am | 5:00:00pm</option>
                    <option value="5" class="mt-2">Viernes 8:00:00am | 5:00:00pm</option>
                    <option value="6" class="mt-2">Sabado 9:00:00am | 3:00:00pm</option>
                </select>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Puntuacion</label>
                <input checked id="range" type="range" name="txtPuntuacion" class="block w-full py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Descripción</label>
                <textarea id="textarea" type="textarea" name="txtDescripcion" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button name="btnRegistrar" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Crear</button>
        </div>
    </form>
</section>


</body>
</html>
<script>
    function toggleCheckbox(id) {
        const checkbox = document.getElementById(id);
        checkbox.checked = !checkbox.checked;
    }
</script>

<script>
function validateForm() {
    var telefono = document.getElementById('txtTelefono').value;
    var nombre = document.getElementById('txtNombre').value;
    var apellido = document.getElementById('txtApellido').value;
    var cedula = document.getElementById('txtCedula').value;
    var email = document.getElementById('txtEmail').value;
    var descripcion = document.getElementById('txtDescripcion').value;
    var horarios = document.getElementById('txtHorarios').value;

    if (!telefono.startsWith('04') || telefono.length !== 11) {
        Swall.fire('El número de teléfono debe empezar por 04 y contener exactamente 11 caracteres.');
        return false;
    }

    if (!nombre || !apellido || !cedula || !email || !descripcion || !horarios) {
        Swal.fire('Todos los campos deben estar llenos');
        return false;
    }

    if (descripcion.length > 250) {
        alert('La descripción no debe superar los 250 caracteres.');
        return false;
    }

    return true;
}
</script>
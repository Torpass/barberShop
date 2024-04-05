<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Employee.php")?>
<?php include('../../templates/header.php');?>

<?php
    $Employees= new Employee();
    if(isset($_GET["txtID"])){
        $employee = $Employees->getEmployeeById($_GET["txtID"]);
    }
    $contactId = $employee["id_Contacto"];
    $infoId= $employee["id_infoEmpleado"];
    $agendaId = $employee["Id_Empleado"]; 


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

        $id = $_GET['txtID'];
        $nombre = $_POST['txtNombre'];
        $apellido = $_POST['txtApellido'];
        $cedula = $_POST['txtCedula'];
        $telefono = $_POST['txtTelefono'];
        $email = $_POST['txtEmail'];
        $descripcion = $_POST['txtDescripcion'];
        $horarios = $_POST['txtHorarios'];


        $result = $Employees->updateEmployee($id, $nombre, $apellido, $descripcion, $cedula, $horarios, $telefono, $email, $contactId, $infoId, $agendaId);
        if ($result) {
            echo "<script>Swal.fire('Empleado actualizado correctamente')</script>";
        } else {
            echo "<script>Swal.fire('Error al actualizar los datos del empleado')</script>";
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
   
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Crear Empleado</h1>
    <form method="post" action="">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <!-- input name -->
            <div>
                <label class="text-white dark:text-gray-200" for="password">Cédula</label>
                <input id="txtCedula" type="input" name="txtCedula" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Cedula"]?>>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="txtNombre">Nombre</label>
                <input id="txtNombre" type="text" name="txtNombre" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Nombre"]?>
                >
            </div>
            <!-- input lastname -->
            <div>
                <label class="text-white dark:text-gray-200" for="txtApellido">Apellido</label>
                <input id="txtApellido" type="input" name="txtApellido" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Apellido"]?>>
            </div>


            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Email</label>
                <input id="txtEmail" type="email" name="txtEmail" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Gmail"]?>>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Teléfono</label>
                <input id="txtTelefono" type="number" name="txtTelefono" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Telefono"]?>
                >
            </div>


            <div class="mt-4">
                <label class="text-white dark:text-gray-200" for="horarios">Horarios de Trabajo</label>
                <select id="txtHorarios" name="txtHorarios[]" multiple class="block w-full px-4 py-2 mt-2 text-gray-70 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring
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
                <textarea id="txtDescripcion" type="textarea" name="txtDescripcion" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <?php echo $employee["descripcion"]?>
                </textarea>
            </div>
        </div>

        <div class="flex justify-between mt-6">
        <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-500 rounded shadow ripple hover:shadow-lg hover:bg-red-600 focus:outline-none" href="./index.php">Salir</a>	
            <button name="btnRegistrar" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Actualizar</button>
        </div>
    </form>
</section>


<script src="../../validators/createEmployee.js" ></script>
</body>
</html>
<script>
    function toggleCheckbox(id) {
        const checkbox = document.getElementById(id);
        checkbox.checked = !checkbox.checked;
    }
</script>
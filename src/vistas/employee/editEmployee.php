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
    if(!empty($_POST['txtTelefono']) && !empty($_POST['txtNombre']) && !empty($_POST['txtApellido']) && !empty($_POST['txtCedula'] && !empty($_POST['txtEmail'] && !empty($_POST['txtHorarios'] && !empty($_POST['txtDescripcion']))))){

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
            echo "La actualización del empleado No falló.";
        } else {
            echo "El empleado NO se actualizó correctamente.";
        }
    }else{
        echo "Faltan datos";
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
    <form method="post" action="">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <!-- input name -->
            <div>
                <label class="text-white dark:text-gray-200" for="txtNombre">Nombre</label>
                <input id="username" type="text" name="txtNombre" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Nombre"]?>
                >
            </div>
            <!-- input lastname -->
            <div>
                <label class="text-white dark:text-gray-200" for="txtApellido">Apellido</label>
                <input id="emailAddress" type="input" name="txtApellido" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Apellido"]?>>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="password">Cédula</label>
                <input id="password" type="input" name="txtCedula" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Cedula"]?>>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Email</label>
                <input id="" type="email" name="txtEmail" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Gmail"]?>>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="passwordConfirmation">Teléfono</label>
                <input id="" type="input" name="txtTelefono" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                value= <?php echo $employee["Telefono"]?>
                >
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
                <textarea id="textarea" type="textarea" name="txtDescripcion" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <?php echo $employee["descripcion"]?>
                </textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button name="btnRegistrar" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Actualizar</button>
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
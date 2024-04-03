<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Services.php")?>
<?php include("../../clases/Employee.php")?>
<?php include("../../clases/Citas.php")?>

<?php
    $today = date("Y-m-d");

    $Services= new Service();
    $tblServices= $Services->getAllServices(); 
    $Employee= new Employee();
    $tblEmployees = $Employee->getEmployeesWithDetails();
    $Cita = new Citas();

    $startTime = DateTime::createFromFormat('H:i', '08:00');
    $endTime = DateTime::createFromFormat('H:i', '17:00');


    if(isset($_POST['txtRegister'])){
        $time = DateTime::createFromFormat('H:i', $_POST['txtTime']);
        if(!isset($_POST['txtTime']) || $_POST['txtTime'] === '') {
            echo "<script>Swal.fire('La Hora es un campo obligatorio')</script>";
        }elseif ($time < $startTime || $time > $endTime) {
            echo "<script>Swal.fire('La hora debe estar entre las 8am y las 5pm')</script>";
        }elseif (!isset($_POST['txtService']) || $_POST['txtService'] === '') {
            echo "<script>Swal.fire('El servicio es un campo obligatorio')</script>";
        }elseif (!isset($_POST['txtEmployee']) || $_POST['txtEmployee'] === '') {
            echo "<script>Swal.fire('El empleado es un campo obligatorio')</script>";
        }else {
        $FechaInicio = $_POST['txtDate'];
        $horaInicio = $_POST['txtTime'];
        $serviceId = $_POST['txtService'];
        $employeeId = $_POST['txtEmployee'];
        $clientId = $_SESSION['user_id'];

        
        $result = $Cita->createCita($FechaInicio, $horaInicio, $serviceId, $employeeId, $clientId);
        
        if($result){
            echo "<script>Swal.fire('Cita registrada')</script>";
        }else{
            echo "<script>Swal.fire('Error al registrar la cita')</script>";
        }
    }
}
?>

<div class="w-full">
    <div class="bg-gradient-to-b from-indigo-800 to-indigo-600 h-96"></div>
    <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
        <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
            <p class="text-3xl font-bold leading-7 text-center">¡Crea tu cita aquí!</p>
            <form action="" method="post">
                <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Fecha del servicio</label>
                        <input min="<?php echo $today; ?>"  name="txtDate" type="date" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Hora de inicio</label>
                        <input name="txtTime" type="time" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label class="font-semibold leading-none">Servico a selecionar</label>
                        <select name="txtService" type="" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">
                        <option disabled selected>Seleccion un Servicio</option>
                          <?php foreach ($tblServices as $service): ?>
                            <option 
                            value=<?php echo $service["id_Servicio"]?>>
                                 <?php echo $service["Nombre_Categoria"]?>
                            </option>
                          <?php endforeach; ?>
                        <select/>
                    </div>
                </div>

                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label class="font-semibold leading-none">Empleado</label>
                        <select  name="txtEmployee" type="" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"> 
                            <option disabled selected>Seleccion un empleado</option>
                          <?php foreach ($tblEmployees as $employee): ?>
                            <option value=<?php echo $employee["Id_Empleado"]?>>
                            <?php echo $employee["Nombre"]." ".$employee["Apellido"]?></option>
                          <?php endforeach; ?>
                        <select/>
                    </div>
                </div>
                
                <div class="flex items-center justify-center w-full">
                    <button name="txtRegister" class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-indigo-700 rounded hover:bg-indigo-600 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:outline-none">
                        Send message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
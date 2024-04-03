<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Employee.php")?>
<?php include("../../clases/Citas.php")?>

<?php 
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();}

    $employeeID = $_SESSION['employee_id'];
    $Employee= new Employee();
	$Citas = new Citas();

	$tblCitasEmployee = $Employee->getWaitingAppointmentWithServiceData($employeeID);

	if(isset($_GET['txtID'])){
		$citaID = $_GET['txtID'];
		$Citas->finishAppointment($citaID);
		if($Citas){
			echo "<script>Swal.fire('Cita terminada exitosamente')</script>";
		}else{
			echo "<script>Swal.fire('Error al terminar cita')</script>";
		}
	}
?>
<head>
    <link href="../../output.css" rel="stylesheet">
</head>

<div class="flex items-center justify-center">
</div>
<table class="min-w-full mt-0 border-collapse block md:table">
		<thead class="block md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Id</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Fecha</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Hora</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Status</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Categoria</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Empleado</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Precio</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Acciones</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
            <?php if($tblCitasEmployee): ?>
			<?php foreach ($tblCitasEmployee as $cita): ?>
				<tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">ID</span>
						<?php echo $cita["id_Citas"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold"></span>
						<?php echo $cita["Fecha_Cita"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold"></span>
						<?php echo $cita["Hora_Inicio"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold"></span>
						<?php echo $cita["status"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold"></span>
						<?php echo $cita["Categoria"] ?>
					</td>
					<td class="p-2 md:border max-w-xs overflow-auto whitespace-nowrap md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold"></span>
						<?php echo $cita["Nombre"]." ".$cita["Apellido"] ?>
					</td>
					<td class="p-2 md:border max-w-xs overflow-auto whitespace-nowrap md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold"></span>
						<?php echo $cita["Precio"]."$" ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Actions</span>
                            <a
                            href="./citasEmployee.php?txtID=<?php echo $cita["id_Citas"] ?>"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">Marcar como terminado</a>
					</td>
			</tr>
  	<?php endforeach; ?>
      <?php endif ?>
		</tbody>
	</table>
</body>

<?php include('../../templates/footer.php');?>

<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Employee.php")?>
<?php include('../../templates/header.php');?>

<?php 
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();}
    
    $Employee= new Employee();

	$tblEmployees = $Employee->getEmployeesWithDetails();

    if(isset($_GET['txtID'])){
      $deleteID = $_GET['txtID'];
      if($Services){
        echo "<script>Swal.fire('Servicio eliminado')</script>";
      }else{
      }
      
    }
?>
<head>
    <link href="../../output.css" rel="stylesheet">
</head>

<div class="flex items-center justify-center">
	<a class="px-6 my-6 middle none center mr-4 rounded-lg bg-blue-500 py-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true" href="./createEmployee.php" >
		Agregar Empleado
	</a>
</div>
<table class="min-w-full mt-0 border-collapse block md:table">
		<thead class="block md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Id</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Nombre</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Apellido</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Cédula</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Teléfono</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Email</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Descripcion</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Acciones</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<?php foreach ($tblEmployees as $employee): ?>
				<tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">ID</span>
						<?php echo $employee["Id_Empleado"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Nombre</span>
						<?php echo $employee["Nombre"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Apellido</span>
						<?php echo $employee["Apellido"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Cedula</span>
						<?php echo $employee["Cedula"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Teléfono</span>
						<?php echo $employee["Telefono"] ?>
					</td>
					<td class="p-2 md:border max-w-xs overflow-auto whitespace-nowrap md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Email</span>
						<?php echo $employee["Gmail"] ?>
					</td>
					<td class="p-2 md:border max-w-xs overflow-auto whitespace-nowrap md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Descripcion</span>
						<?php echo $employee["descripcion"] ?>
					</td>
					<td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
						<span class="inline-block w-1/3 md:hidden font-bold">Actions</span>
						<a
						 href="./editEmployee.php?txtID=<?php echo $employee["Id_Empleado"] ?>"
						 class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">Editar</a>
					</td>
			</tr>
  	<?php endforeach; ?>
		</tbody>
	</table>
</body>
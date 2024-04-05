<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Horarios.php")?>

<?php
    $Horarios= new Horarios();
    $id = $_GET["txtID"];
    $horario = $Horarios->getHorarioByID($id);
    if(isset($_POST['btnRegistrar'])){
        if(!isset($_POST['txtDia']) || $_POST['txtDia'] === '') {
            echo "<script>Swal.fire('El día es un campo obligatorio')</script>";
        }elseif(!isset($_POST['txtTimeInit']) || $_POST['txtTimeInit'] === '') {
            echo "<script>Swal.fire('La hora de inicio es un campo obligatorio')</script>";
        }
        elseif(!isset($_POST['txtTimeFinish']) || $_POST['txtTimeFinish'] === '') {
            echo "<script>Swal.fire('La hora de salida es un campo obligatorio')</script>";
        }else {
            $dia = $_POST['txtDia'];
            $horaInicio = $_POST['txtTimeInit'];
            $horaFinal = $_POST['txtTimeFinish'];
            if($Horarios->updateHorario($horario["id_Horario"], $dia, $horaInicio, $horaFinal)){
                echo "<script>Swal.fire('Horario se ha actualizado exitosamente')</script>";
            }else{
                echo "<script>Swal.fire('Error al actualizar el horario')</script>";
            }
        
        }
    }
?>

<head>
    <link href="../../output.css" rel="stylesheet">
</head>
<body>
<!-- component -->
<div class="bg-gray-100 flex items-center justify-center">
			<div class="my-12 max-w-md w-full bg-white p-8 rounded-lg shadow-md">
				<form action="" method="post">
                    <!-- nombre de la categoria -->
                <div class="md:flex flex-col items-start mt-8">
                    <div class="w-full flex flex-col">
                        <label class="font-semibold leading-none">Horario</label>
                        <select  name="txtDia" type="" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"> 
                            <option value=<?php $horario["dia"]?> disabled selected><?php echo $horario["dia"]?></option>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                        <select/>
                    </div>
                    <div class="md:flex items-center mt-8">
                        <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                            <label class="font-semibold leading-none">Hora de inicio</label>
                            <input value=<?php echo $horario["hora_inicio"]?> name="txtTimeInit" type="time" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                        <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                            <label class="font-semibold leading-none">Hora de salida</label>
                            <input value=<?php echo $horario["hora_Finalizacion"]?> name="txtTimeFinish" type="time" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                    </div>
                </div>

					<!-- Submit Button and Character Limit Section -->
					<div class="flex items-center justify-between mt-12">
                        <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-500 rounded shadow ripple hover:shadow-lg hover:bg-red-600 focus:outline-none" href="./index.php">Salir</a>	
						<button name="btnRegistrar" type="submit" class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2"> Actualizar <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send" fill="#fff">
								<path fill="none" d="M0 0h24v24H0V0z"></path>
								<path d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z"></path>
							</svg>
						</button>
					</div>
				</form>
			</div>
		</div>
</body>
</html>
<?php include('../../templates/footer.php');?>

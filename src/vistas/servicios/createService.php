<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Services.php")?>

<?php
    $Services= new Service();
    $tblCategoryServices= $Services->getAllCategoryServices(); 
    if(isset($_POST['btnRegistrar'])){
        if (!isset($_POST['txtPrecio']) || $_POST['txtPrecio'] === '') {
            echo "<script>Swal.fire('El precio del servicio es obligatorio')</script>";
        } elseif (!is_numeric($_POST['txtPrecio'])) {
            echo "<script>Swal.fire('El precio del servicio debe ser un numero')</script>";
        } elseif (!isset($_POST['txtDuracion']) || $_POST['txtDuracion'] === '') {
            echo "<script>Swal.fire('La duración del servicio es obligatoria')</script>";
        } elseif (!ctype_digit($_POST['txtDuracion'])) {
            echo "<script>Swal.fire('La duración del servicio debe ser un número entero')</script>";
        } elseif (!isset($_POST['txtDetalles']) || $_POST['txtDetalles'] === '') {
            echo "<script>Swal.fire('Los detalles del servicio son obligatorios')</script>";
        } elseif (strlen($_POST['txtDetalles']) > 255) {
            echo "<script>Swal.fire('Los detalles del servicio no deben superar los 255 caracteres')</script>";
        } elseif (!isset($_POST['txtCategoria']) || $_POST['txtCategoria'] === '') {
            echo "<script>Swal.fire('La categoría del servicio es obligatoria')</script>";
        } elseif (!isset($_FILES['photo']) || $_FILES['photo']['error'] != UPLOAD_ERR_OK) {
            echo "<script>Swal.fire('La foto del servicio es obligatoria')</script>";
        } else {
                $precio = $_POST['txtPrecio'];
                $duracion = $_POST['txtDuracion'];
                $detalles = $_POST['txtDetalles'];
                $categoria = $_POST['txtCategoria'];
                
                $foto = $_FILES['photo']['name'];
                $ruta = $_FILES['photo']['tmp_name'];
                $foto = $_FILES['photo']['name'];
                $extension = pathinfo($foto, PATHINFO_EXTENSION);
                $uniqueName = uniqid() . '.' . $extension;
                $destino = "../../public/servicesImg/" . $uniqueName;
                copy($ruta,$destino);
                
                if($Services->createService($precio, $duracion, $detalles, $categoria, $uniqueName)){
                    echo "<script>Swal.fire('Servicio creado exitosamente')</script>";
                }else{
                    echo "<script>Swal.fire('Error al crear el servicio')</script>";
                }
            }
    }
?>

<head>
    <link href="../../output.css" rel="stylesheet">
</head>
<body>
<!-- component -->
<!-- component -->
<div class="bg-gray-100 flex items-center justify-center">
    <div class="my-12 max-w-md w-full bg-white p-8 rounded-lg shadow-md">
                <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-500 rounded shadow ripple hover:shadow-lg hover:bg-red-600 focus:outline-none" href="./index.php">Salir</a>	
				<form action="createService.php" method="post" enctype="multipart/form-data">
                    <!-- Precio del servicio -->
                    <div class="mb-6">
						<label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Precio</label>
						<input id="postContent" name="txtPrecio" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Precio del servicio..."></input>
					</div>

                    <!-- Duración del servicio -->
                    <div class="mb-6">
						<label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Duracion en minutos</label>
						<input id="postContent" name="txtDuracion" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Ingrese la cantidad de minutos que durará el servicio...."></input>
					</div>

                    <!-- Detalles del servicio -->
                    <div class="mb-6">
						<label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Detalles</label>
						<textarea id="postContent" name="txtDetalles" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Detalles del servicio..."></textarea>
					</div>

                    <!-- Categoria del servicio -->
                    <div class="mb-6">
						<label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Categoria del servicio</label>
						<select id="postContent" name="txtCategoria" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Categoria del servicio...">
                            <option disabled selected>Selecciona una categoria</option>
                            <?php foreach ($tblCategoryServices as $service){?>
                            <option placeholder="Selecciona una categoria" value="<?php echo $service['Id_Categoria']?>"><?php echo $service['nombre']?></option>
                        <?php }?>
                        </select>
					</div>

					<!-- File Attachment Section -->
					<div class="mb-6">
						<label for="fileAttachment" class="block text-gray-700 text-sm font-bold mb-2">Foto del servicio</label>
						<div class="relative border-2 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
							<input type="file" id="fileAttachment" name="photo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
							<div class="flex items-center">
								<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
								</svg>
								<span class="ml-2 text-sm text-gray-600">Elije una foto</span>
							</div>
							<span class="text-sm text-gray-500">Tamaño máximo: 5MB</span>
						</div>
					</div>
					<!-- Submit Button and Character Limit Section -->
					<div class="flex items-center justify-between">
						<button name="btnRegistrar" type="submit" class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2"> Crear <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send" fill="#fff">
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
<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Services.php")?>

<?php
    $Services= new Service();
    $tblCategoryServices= $Services->getAllCategoryServices(); 
    if(isset($_POST['btnRegistrar'])){
        if (!isset($_POST['txtNombre']) || $_POST['txtNombre'] === '') {
            echo "<script>Swal.fire('El nombre de la categoría no puede estar vacío')</script>";
        } elseif (strlen($_POST['txtNombre']) > 50) {
            echo "<script>Swal.fire('El nombre de la categoría no debe superar los 50 caracteres')</script>";
        } elseif (preg_match('/\d/', $_POST['txtNombre'])) {
            echo "<script>Swal.fire('El nombre de la categoría no debe contener números')</script>";
        } else {
            $nombre = $_POST['txtNombre'];   
            if($Services->createCateogry($nombre)){
                echo "<script>Swal.fire('Categoria creada exitosamente')</script>";
            }else{
                echo "<script>Swal.fire('Error al crear la categoria')</script>";
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
				<form action="createCategory.php" method="post">
                    <!-- nombre de la categoria -->
                    <div class="mb-6">
						<label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
						<input id="postContent" name="txtNombre" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Nombre de la categoria..."></input>
					</div>

					<!-- Submit Button and Character Limit Section -->
					<div class="flex items-center justify-between">
                        <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-500 rounded shadow ripple hover:shadow-lg hover:bg-red-600 focus:outline-none" href="./index.php">Salir</a>
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
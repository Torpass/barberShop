<?php include('./src/templates/header.php');?>
<?php include("./src/clases/Conexion.php")?>
<?php include("./src/clases/Services.php")?>
<?php include("./src/clases/Employee.php")?>
<?php 
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  $Services= new Service();
  $tblServices= $Services->getAllServices(); 
  $Employee= new Employee();
  $tblEmployees = $Employee->getEmployeesWithDetails();
?>
<link rel="stylesheet" href="./src/output.css">

<div class="text-gray-900 pt-12 pr-0 pb-14 pl-0 bg-white">
  <div class="w-full pt-4 pr-5 pb-6 pl-5 mt-0 mr-auto mb-0 ml-auto space-y-5 sm:py-8 md:py-12 sm:space-y-8 md:space-y-16
      max-w-7xl">
    <div class="flex flex-col items-center sm:px-5 md:flex-row">
      <div class="flex flex-col items-start justify-center w-full h-full pt-6 pr-0 pb-6 pl-0 mb-6 md:mb-0 md:w-1/2">
        <div class="flex flex-col items-start justify-center h-full space-y-3 transform md:pr-10 lg:pr-16
            md:space-y-5">
          <div class="bg-green-500 flex items-center leading-none rounded-full text-gray-50 pt-1.5 pr-3 pb-1.5 pl-2 uppercase">
            <p class="inline">
              <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewbox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0
                  00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755
                  1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1
                  0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </p>
            <p class="inline text-xs font-medium">PROMOCIONES DISPONIBLES</p>
          </div>
          <a class="text-4xl font-bold leading-none lg:text-5xl xl:text-6xl">Todo el estilo en un solo lugar. <span class="text-indigo-600">Barber Shop</span></a>
          <div class="pt-2 pr-0 pb-0 pl-0">
            <p class="text-sm font-medium inline">Encuentranos en:</p>
            <a class="inline text-sm font-medium mt-0 mr-1 mb-0 ml-1 underline">Barquismeto estado Lara</a>
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2">
        <div class="block">
          <img
              src="https://images.unsplash.com/photo-1626314928277-1d373ddb6428?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mzd8fHxlbnwwfHx8fA%3D%3D&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60" class="object-cover rounded-lg max-h-64 sm:max-h-96 btn- w-full h-full"/>
        </div>
      </div>
    </div>
    <section id="services" class="mt-6">
    <hr class="h-4 border-gray-300"/>
      <h1 class="mb-8 text-2xl font-bold leading-none lg:text-3xl xl:text-3xl">Servicios Disponibles</h1>
      <div class="grid grid-cols-12 sm:px-5 gap-x-8 gap-y-16">
      <?php $counter = 0;?>
      <?php foreach ($tblServices as $service): ?>
        <?php 
          if ($counter == 3) {
            break;
          }
        ?>
        <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4">
          <img
              class="w-64 h-64 rounded-lg rounded-b-none"
              src=<?php echo './src/public/servicesImg/'.$service["Ruta_Imagen"] ?> />
          <p class="bg-green-500 flex items-center leading-none text-sm font-medium text-gray-50 pt-1.5 pr-3 pb-1.5 pl-3 rounded-full uppercase"><?php echo $service["Precio"]."$"?></p>
          <a class="text-lg font-bold sm:text-xl md:text-2xl"><?php echo $service["Nombre_Categoria"]?></a>
          <p class="text-sm text-black"><?php echo $service["Detalle"]?></p>
          <div class="pt-2 pr-0 pb-0 pl-0">
          </div>
        </div>
        <?php $counter++; ?>
      <?php endforeach; ?>
        </div>
    </section>

    
    <section id="employees" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4">
      <hr class="h-4 border-gray-300"/>
      <div class="text-center pb-12">
        <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl font-heading text-gray-900">
              Nuestro equipo de trabajo
        </h1>
          <h2 class="mt-2 text-base font-bold text-indigo-600">
              Preparado para atenderte
          </h2>
      </div>
      <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php $counter = 0;?>
      <?php foreach ($tblEmployees as $employee): ?>
        <?php 
          if ($counter == 6) {
            break;
          }
        ?>
          <div class="w-full bg-white rounded-lg sahdow-lg overflow-hidden flex flex-col justify-center items-center">
              <div>
                  <img class="object-center object-cover h-auto w-full" src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1171&q=80" alt="photo">
              </div>
              <div class="text-center py-8 sm:py-6">
                  <p class="text-xl text-gray-700 font-bold mb-2"><?php echo $employee["Nombre"]?></p>
                  <p class="text-base text-gray-400 font-normal"><?php echo $employee["descripcion"]?></p>
              </div>
          </div>
        <?php $counter++; ?>
      <?php endforeach; ?>
      </div>
  </section>
    </div>
  </div>
</div>
<?php include('./src/templates/footer.php');?>

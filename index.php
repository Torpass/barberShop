<?php include('./src/templates/header.php');?>
<?php include("./src/clases/Conexion.php")?>
<?php include("./src/clases/Services.php")?>
<?php include("./src/clases/Employee.php")?>
<?php include("./src/clases/Review.php")?>
<?php 
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  $Review = new Review();
  $tblReviews = $Review->getBarberReviews();
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
              src="https://th.bing.com/th/id/OIP.1ezVrI_M0nAP6spJLF9JSQHaE6?rs=1&pid=ImgDetMain" class="object-cover rounded-lg max-h-64 sm:max-h-96 btn- w-full h-full"/>
        </div>
      </div>
    </div>
    <section id="services" class="mt-6">
    <hr class="h-4 border-gray-300"/>
      <h1 class="mb-8 text-2xl font-bold leading-none lg:text-3xl xl:text-3xl">Nuestro servicios mas populares</h1>
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
      <?php 
        $images = [
          'https://th.bing.com/th/id/OIP.zG9EwntdmTMpNgtT5xldTwHaEu?rs=1&pid=ImgDetMain',
          'https://th.bing.com/th/id/OIP.ZWI_iIWLhh-xuwq-TozUzwHaE5?w=1998&h=1321&rs=1&pid=ImgDetMain',
          'https://th.bing.com/th/id/R.20f54d6bb3958eda1e2eb9a6e6df920e?rik=jsnhtIaRuGhnZg&riu=http%3a%2f%2fbeautyandhairdressing.co.uk%2ffiles%2fweb%2fAdobeStock_101037217-5009.jpg&ehk=3%2bl7lVnD5qBplw1gvePAM6%2bA%2fyot2Kry0f2UgHoAXLE%3d&risl=&pid=ImgRaw&r=0',
          'https://viewstockholm.com/wp-content/uploads/2020/06/man-stockholm-barbershop-barberare.jpg',
          'https://th.bing.com/th/id/OIP.Jcle3ArIZRFGZzvIcEzDCAHaHa?w=696&h=696&rs=1&pid=ImgDetMain',
          'https://th.bing.com/th/id/OIP.-lHmX7a6x23fIyZaH7Rs1QHaE8?rs=1&pid=ImgDetMain'
        ];
      ?>
      <img class="w-128 h-128 rounded-lg rounded-b-none object-center object-cover" src="<?php echo $images[$counter]; ?>" alt="photo">
    </div>
    <a class="text-center py-8 sm:py-6"
      href=<?php echo './src/vistas/user/reviews.php?txtId='.$employee["Id_Empleado"] ?>>
        <p class="text-xl text-gray-700 font-bold mb-2"><?php echo $employee["Nombre"]?></p>
        <p class="text-base text-gray-400 font-normal"><?php echo $employee["descripcion"]?></p>
    </a>
  </div>
  <?php $counter++; ?>
<?php endforeach; ?>
      </div>
  </section>

    <section id="reviews" aria-labelledby="testimonial-heading" class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
      <div class="mx-auto max-w-2xl lg:max-w-none ">
        <h1 id="testimonial-heading" class="text-4xl font-bold tracking-tight text-gray-900">Lo que las personas opinan de nuestra barberia</h1>
        <div class="mt-16 space-y-16 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:space-y-0">
        <?php $counter = 0;?>
        <?php foreach($tblReviews as $review): ?>
          <?php 
            if ($counter == 3) {
              break;
            }
          ?>
            <blockquote class="sm:flex lg:block">
                    <svg width="24" height="18" viewBox="0 0 24 18" aria-hidden="true" class="flex-shrink-0 text-gray-300">
                    <path d="M0 18h8.7v-5.555c-.024-3.906 1.113-6.841 2.892-9.68L6.452 0C3.188 2.644-.026 7.86 0 12.469V18zm12.408 0h8.7v-5.555C21.083 8.539 22.22 5.604 24 2.765L18.859 0c-3.263 2.644-6.476 7.86-6.451 12.469V18z" fill="currentColor" />
                    </svg>
                <div class="mt-8 sm:ml-6 sm:mt-0 lg:ml-0 lg:mt-10">
                    <?php for($i=0; $i<$review["Puntuacion"]; $i++){
                        echo "⭐";
                    } ?>
                <p class="text-lg text-gray-600"><?php echo $review["Descripcion"]?></p>
                <cite class="mt-4 block font-semibold not-italic text-gray-900"><?php echo $review["Nombre"]." ".$review["Apellido"]?></cite>
                <?php if($user_role == 2):?>
                    <a href=<?php echo "./index.php?txtId=".$review["id_Resena_Barberia"]?> class="text-red-500">Eliminar</a>
                <?php endif;?>
                </div>
                </blockquote>
            <?php $counter++; ?>
            <?php endforeach;?>
        </div>
      </div>
    </section>
    </div>
  </div>
</div>


<?php include('./src/templates/footer.php');?>

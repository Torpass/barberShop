<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Client.php")?>
<?php include("../../clases/Review.php")?>
<?php 
    $Review = new Review();
    $employeeID = $_GET['txtId'];
    $employeeReviews = $Review->getReviewsByEmployee($employeeID);
    $user_role = $_SESSION["user_role"];
?>

<link
  rel="stylesheet"
  href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"
/>
<link rel="stylesheet" href="../../output.css">

<h1 class="mt-10 mb-2 block font-sans text-4xl font-bold leading-snug tracking-normal text-blue-gray-900 antialiased" >Reseñas del empleado</h1>
<div class="p-6 pt-0">
  <?php if(!$user_role == 1):?>
    <a
      class="select-none rounded-lg bg-pink-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
      type="button"
      data-ripple-light="true"
      href=<?php echo './createReview.php?txtId='.$employeeID?>
    >
      Añadir Reseña
    </a>
    <?php endif?>
  </div>
<section class="grid grid-cols-4 sm:px-5 gap-x-8 gap-y-16 mt-10">
    <?php foreach ($employeeReviews as $review): ?>
        <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
  <div class="p-6">
    <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
        <?php for($i=0; $i<$review["Puntuacion"]; $i++){
            echo "⭐";
        } ?>
        Estrellas
    </h5>
    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
        <?php echo $review["Descripcion"]?>
    </p>
  </div>

</div>
    <?php endforeach; ?>



<!-- stylesheet -->

 
<!-- Ripple Effect -->

<!-- from cdn -->

</section>

<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
<?php include('../../templates/footer.php');?>

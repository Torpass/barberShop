<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Review.php")?>

<?php

$Review = new Review();
$tblReviews = $Review->getBarberReviews();
$user_role = $_SESSION["user_role"];

if(isset($_GET['txtId'])){
    $deleteID = $_GET['txtId'];
    $Review->deleteReview($deleteID);
    if($Review){
        echo "<script>Swal.fire('Reseña eliminada')</script>";
    }else{
        echo "<script>Swal.fire('Error al eliminar la reseña')</script>";
    }
    
}

?>

<div class="flex items-center justify-center">
	  <a class="px-6 my-6 middle none center mr-4 rounded-lg bg-blue-500 py-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true" href="./createReview.php" >
		Agregar Reseña
	</a>
    <?php if($user_role == 2):?>
        <a class="px-6 my-6 middle none center mr-4 rounded-lg bg-blue-500 py-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true" target="_blank" href="../../fpdf/allReviews.php" >
            Generar reporte de reseñas
        </a>
    <?php endif; ?>
</div>
<section id="reviews" aria-labelledby="testimonial-heading" class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-12">
    <div class="mx-auto max-w-2xl lg:max-w-none ">
        <h1 id="testimonial-heading" class="text-4xl font-bold tracking-tight text-gray-900">Lo que las personas opinan de nuestra barberia</h1>
        <div class="mt-16 space-y-16 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:space-y-0">
            <?php foreach($tblReviews as $review): ?>
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
            <?php endforeach;?>
        </div>
    </div>
</section>

<?php include('../../templates/footer.php');?>

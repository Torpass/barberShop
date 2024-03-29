<?php include('../../templates/header.php');?>
<?php 
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<head>
    <link href="../../output.css" rel="stylesheet">
</head>
<body class="px-3">
    <a class="px-3 middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    data-ripple-light="true" href="./createService.php" >
    Añadir servicio
    </a>
<section class="flex flex-row flex-wrap mx-auto">
<!-- Card Component -->
  <div class="transition-all duration-150 flex w-full px-4 py-6 md:w-1/2 lg:w-1/3">
    <div class="flex flex-col items-stretch min-h-full pb-4 mb-6 transition-all duration-150 bg-white rounded-lg shadow-lg hover:shadow-2xl">
      <div class="md:flex-shrink-0">
        <img
          src="https://www.unfe.org/wp-content/uploads/2019/04/SM-placeholder-1024x512.png"
          alt="Blog Cover"
          class="object-fill w-full rounded-lg rounded-b-none md:h-56" />
      </div>
      <div class="flex items-center justify-between px-4 py-2 overflow-hidden">
        <span class="text-xs font-medium text-blue-600 uppercase">
          Tittle
        </span>
      </div>
      <hr class="border-gray-300" />
      <div class="flex flex-wrap items-center flex-1 px-4 py-1 text-center mx-auto">
        <a href="#" class="hover:underline">
          <h2 class="text-2xl font-bold tracking-normal text-gray-800">
            Ho to Yawn in 7 Days
          </h2>
        </a>
      </div>
      <hr class="border-gray-300" />
      <p class="flex flex-row flex-wrap w-full px-4 py-2 overflow-hidden text-sm text-justify text-gray-700">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, magni
        fugiat, odit incidunt necessitatibus aut nesciunt exercitationem aliquam
        id voluptatibus quisquam maiores officia sit amet accusantium aliquid
        quo obcaecati quasi.
      </p>
      <hr class="border-gray-300" />
      <section class="px-4 py-2 mt-2">
        <div class="flex items-center justify-between">
          <div class="flex items-center flex-1">
            <a class="flex gap-3 p-2.5 bg-yellow-500 rounded-xl hover:rounded-3xl hover:bg-yellow-600 transition-all duration-300 text-white" href="./updateService.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            

                <a class="flex p-2.5 pl-3 bg-red-500 rounded-xl hover:rounded-3xl hover:bg-red-600 transition-all duration-300 text-white" href="./deleteService.php">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-6 w-6" viewBox="0 0 24 24">
                    <path d="M 10.806641 2 C 10.289641 2 9.7956875 2.2043125 9.4296875 2.5703125 L 9 3 L 4 3 A 1.0001 1.0001 0 1 0 4 5 L 20 5 A 1.0001 1.0001 0 1 0 20 3 L 15 3 L 14.570312 2.5703125 C 14.205312 2.2043125 13.710359 2 13.193359 2 L 10.806641 2 z M 4.3652344 7 L 5.8925781 20.263672 C 6.0245781 21.253672 6.877 22 7.875 22 L 16.123047 22 C 17.121047 22 17.974422 21.254859 18.107422 20.255859 L 19.634766 7 L 4.3652344 7 z"></path>
                    </svg>
                </a>
          </div>
        </div>
      </section>
      </section>
    </div>
  </div>
</section>
</body>
</html>

<?php include('../../templates/footer.php');?>

<?php include('./src/templates/header.php');?>
<?php 
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
        echo "<h1 class='text-3xl  font-bold underline'>Holiiis  </h1>";
        echo $_SESSION['userId'];
        echo $_SESSION['userName'];
    ?>
    <p class="text-sky-400">The quick brown fox...</p>

    <p class="text-slate-400 hover:text-sky-400">The quick brown fox...</p>
    <p class="text-slate-400 hover:text-sky-400">The quick brown fox...</p>
    <p class="text-slate-400 hover:text-sky-800">The quick brown fox...</p>
    <p class="text-slate-400 hover:text-sky-400">The quick brown fox...</p>
    <p class="text-[#50d71e]">Holas</p>
</body>
</html>
<?php include('templates/footer.php');?>

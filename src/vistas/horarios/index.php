<?php include('../../templates/header.php');?>
<?php include("../../clases/Conexion.php")?>
<?php include("../../clases/Horarios.php")?>

<?php 
$horario = new Horarios();
$tblHorario = $horario->getHorarios();
?>


<div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
<div class="rounded-t mb-0 px-0 border-0">
    <div class="flex flex-wrap items-center px-4 py-2">
    <div class="relative w-full max-w-full flex-grow flex-1">
        <h3 class="font-semibold mb-5 text-base text-gray-900 dark:text-gray-50">Módulo de horarios</h3>
        <a
        href="./createHorario.php"
        class="bg-blue-500 hover:bg-blue-700 mt-8 text-white font-bold py-1 px-2 border-blue-500 rounded">Agregar horario</a>
    </div>
    </div>
    <div class="block w-full overflow-x-auto">
    <table class="items-center w-full bg-transparent border-collapse">
        <thead>
        <tr>
            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">ID</th>
            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Día</th>
            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Hora Inicio</th>
            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Hora Final</th>
            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($tblHorario as $horario):?>
        <tr class="text-gray-700 dark:text-gray-100">
            <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            <?php echo $horario["id_Horario"]?>
            </th>
            <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            <?php echo $horario["dia"]?>
            </th>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <?php echo $horario["hora_inicio"]?>
            </td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <?php echo $horario["hora_Finalizacion"]?>
            </td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <a
                    href="./editEmployee.php?txtID=<?php echo $horario["id_Horario"] ?>"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border-blue-500 rounded">Editar</a>
                <a
                    href="?txtID=<?php echo $horario["id_Horario"] ?>"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border-blue-500 rounded">Eliminar</a>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>
</div>
    

<?php include('../../templates/footer.php');?>

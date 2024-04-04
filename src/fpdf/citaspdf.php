<?php
    include("../clases/Conexion.php");
    include("../clases/Client.php");
    include("../clases/Admin.php");

    $id = $_GET["Id"];
    $admin = new Admin();
    $citasPerEmployee = $admin->reportCitasByPerEmployee();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Reporte de Empleados</title>
        <link rel="stylesheet" href="../public/css/pdf.css">
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="../public/servicesImg/logo.png">
            </div>
            <h1>Reporte de Empleados</h1>
            <!--
            <div id="company" class="clearfix">
                <div>Company Name</div>
                <div>455 Foggy Heights,<br /> AZ 85004, US</div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
            </div>
            <div id="project">
                <div><span>PROJECT</span> Website development</div>
                <div><span>CLIENT</span> John Doe</div>
                <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
                <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
                <div><span>DATE</span> August 17, 2015</div>
                <div><span>DUE DATE</span> September 17, 2015</div>
            </div>
        -->
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th><center>NOMBRE</center></th>
                        <th><center>APELLIDO</center></th>
                        <th><center>CÉDULA</center></th>
                        <th><center>SERVICIOS EN ESPERA</center></th>
                        <th><center>SERVICIOS CANCELADOS</center></th>
                        <th><center>SERVICIOS TERMINADOS</center></th>
                        <th><center>TOTAL SERVICIOS SOLICITADOS</center></th>
                    </tr>
                </thead>
                <?php
                    $total = 0;        
                ?>
                <tbody>
                    <?php
                        foreach ($citasPerEmployee as $post_employee) {
                            # code...
                            ?>
                            <tr>
                                <td><center><?php echo $post_employee["Nombre"]; ?></center></td>
                                <td><center><?php echo $post_employee["Apellido"]; ?></center></td>
                                <td><center><?php echo $post_employee["Cedula"]; ?></center></td>
                                <td><center><?php echo $post_employee["servicios_en_espera"]; ?></center></td>
                                <td><center><?php echo $post_employee["servicios_cancelados"]; ?></center></td>
                                <td><center><?php echo $post_employee["servicios_terminados"]; ?></center></td>
                                <td><center><?php echo $post_employee["total_servicios"]; ?></center></td>
                            </tr>
                            <?php

                            $total = $total + $post_employee["cantidad_citas"];
                        }
                    ?>
                    <tr>
                        <td colspan="3">TOTAL DE CONSULTAS</td>
                        <td><center><?php echo $total; ?></center></td>
                    </tr>
                </tbody>
            </table>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
            </div>
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>
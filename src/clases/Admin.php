<?php
class Admin extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function generateServicesReport(){

        $sql = "SELECT 
        sc.nombre,
        s.duracion,
        s.Precio,
        COUNT(sr.id_Servicio) AS cantidad_solicitudes
        FROM 
        servicios_reservados sr
        INNER JOIN 
        Servicios s ON sr.Id_Servicio = s.id_Servicio
        INNER JOIN 
        servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        GROUP BY 
        sr.Id_Servicio, sc.nombre, s.duracion;
        ";

        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
}

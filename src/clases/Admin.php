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


    public function generateEmployeePuntationAverage(){
        $sql = "SELECT 
        e.Nombre,
        e.Apellido,
        round(AVG(re.Puntuacion), 2) AS Promedio_Puntuacion
        FROM 
        Empleado e
        inner JOIN 
        resenas_empleados re ON e.Id_Empleado = re.Id_Empleado
        GROUP BY 
        e.Id_Empleado, e.Nombre, e.Apellido;
        ";


        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function reportCitasByPerEmployee(){
        $sql="SELECT 
        e.Id_Empleado,
        e.Nombre,
        e.Apellido,
        e.Cedula,
        SUM(CASE WHEN c.status = 'En espera' THEN 1 ELSE 0 END) AS servicios_en_espera,
        SUM(CASE WHEN c.status = 'Terminado' THEN 1 ELSE 0 END) AS servicios_terminados,
        SUM(CASE WHEN c.status = 'Cancelado' THEN 1 ELSE 0 END) AS servicios_cancelados,
        COUNT(*) AS total_servicios
        FROM 
        citas c
        INNER JOIN 
        empleado e ON c.Id_Empleado = e.Id_Empleado
        GROUP BY 
        e.Id_Empleado, e.Nombre, e.Apellido, e.Cedula";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else  {
            return false;
        }
    }
    

    public function reportPuntuacionBarberia(){
        $sql = "SELECT 
        ROUND(AVG(Puntuacion), 2) AS puntuacion
        FROM 
        resenas_barberia;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getAllBarberReviews(){
        $sql ="SELECT 
        rb.id_Resena_barberia,
        rb.Puntuacion,
        rb.Descripcion,
        rb.status,
        c.id_Cliente,
        c.Nombre AS nombre_cliente,
        c.Apellido AS apellido_cliente
        FROM 
        resenas_barberia rb
        INNER JOIN 
        clientes c ON rb.id_Cliente = c.id_Cliente;
        ";

        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }


    public function getAvgAgeOfEachService(){
        $sql = "SELECT 
        sc.nombre AS nombre_servicio,
        ROUND(AVG(cl.edad), 2) AS promedio_edad
        FROM 
            servicios_reservados sr
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        JOIN 
            citas c ON sr.Id_Cita = c.Id_Citas
        JOIN 
            clientes cl ON c.id_Cliente = cl.id_Cliente
        GROUP BY 
        sc.nombre;";

        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getAvgAge(){
        $sql ="SELECT 
        ROUND(AVG(clientes.edad), 2) AS promedio_edad_barberia
        FROM 
        barber.clientes";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }


    public function getAllRegisteredClients(){
        $sql = "SELECT 
        COUNT(*) AS cantidad_clientes_registrados
        FROM 
        clientes;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
           return false;
        }
    }

    public function getAllClients(){
        $sql = "SELECT 
        c.Id_Cliente,
        c.Nombre,
        c.Apellido,
        c.Cedula,
        c.edad,
        co.Telefono,
        co.Gmail
        FROM 
        clientes c
        JOIN 
        contacto co ON co.id_Contacto= c.id_Contacto;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getClientsWithMoreApointments(){
        $sql="SELECT 
        c.id_Cliente,
        cl.Nombre,
        cl.Apellido,
        COUNT(*) AS cantidad_citas_realizadas
        FROM 
        citas c
        JOIN 
        clientes cl ON c.id_Cliente = cl.id_Cliente
        GROUP BY 
        c.id_Cliente, cl.Nombre, cl.Apellido
        ORDER BY 
        COUNT(*) DESC
        LIMIT 5;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getServicesStats(){
        $sql="SELECT 
        SUM(CASE WHEN c.status = 'Terminado' THEN 1 ELSE 0 END) AS citas_terminadas,
        SUM(CASE WHEN c.status = 'En espera' THEN 1 ELSE 0 END) AS citas_en_espera,
        SUM(CASE WHEN c.status = 'Cancelado' THEN 1 ELSE 0 END) AS citas_canceladas
        FROM 
        citas c;";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

}

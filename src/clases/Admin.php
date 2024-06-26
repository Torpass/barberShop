<?php
class Admin extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function generateServicesReport(){

        $sql = "SELECT
        s.id_Servicio,
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

    public function mostUnpopularServices(){
        $sql="SELECT 
        sr.Id_Servicio,
        sc.nombre AS nombre_servicio,
        COUNT(*) AS solicitudes
        FROM 
            servicios_reservados sr
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        GROUP BY 
            sr.Id_Servicio, sc.nombre
        ORDER BY 
            solicitudes ASC
        LIMIT 5;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }


    public function generateEmployeeWorsePuntationAverage(){
        $sql = "SELECT 
            e.id_Empleado,
            e.Nombre,
            e.Apellido,
            ROUND(AVG(re.Puntuacion), 2) AS Promedio_Puntuacion
            FROM 
            Empleado e
            INNER JOIN 
            resenas_empleados re ON e.Id_Empleado = re.Id_Empleado
            GROUP BY 
            e.Id_Empleado, e.Nombre, e.Apellido
            ORDER BY 
            Promedio_Puntuacion
            LIMIT 4;;
        ";
        
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getEMployeesWithMoreCanceledApointments(){
        $sql ="SELECT
        e.Id_Empleado, 
        e.Nombre,
        e.Apellido,
        COUNT(*) AS cantidad_citas_canceladas
        FROM 
            Empleado e
        INNER JOIN 
            citas c ON e.Id_Empleado = c.Id_Empleado
        WHERE 
            c.status = 'Cancelado'
        GROUP BY 
            e.Id_Empleado, e.Nombre, e.Apellido
        ORDER BY 
            cantidad_citas_canceladas DESC
        LIMIT 5;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getAvgPuntuationPerEmployee(){
        $sql = "SELECT 
        ea.Id_Empleado,
        ea.Nombre,
        ea.Apellido,
        COALESCE(ROUND(AVG(re.Puntuacion), 2), 'Sin reseñas') AS Promedio_Puntuacion
        FROM 
        Empleado ea
        LEFT JOIN 
        resenas_empleados re ON ea.Id_Empleado = re.Id_Empleado
        GROUP BY 
        ea.Id_Empleado, ea.Nombre, ea.Apellido
        ORDER BY 
        CASE WHEN Promedio_Puntuacion = 'Sin reseñas' THEN 1 ELSE 0 END,
        Promedio_Puntuacion DESC;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getGeneralAvgBarbers(){
        $sql = "SELECT 
        ROUND(AVG(re.Puntuacion), 2) AS Promedio_Puntuacion
        FROM 
        resenas_empleados re;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
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

    public function mostCanceledService(){
        $sql="SELECT 
        sr.Id_Servicio,
        sc.nombre AS nombre_servicio,
        COUNT(CASE WHEN c.status = 'Cancelado' THEN 1 END) AS citas_canceladas
        FROM 
            servicios_reservados sr
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        JOIN 
            citas c ON sr.Id_Cita = c.Id_Citas
        GROUP BY 
            sr.Id_Servicio, sc.nombre
        ORDER BY 
            citas_canceladas DESC
        LIMIT 1;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }

    public function mostCanceledServices(){
        $sql="SELECT 
        sr.Id_Servicio,
        sc.nombre AS nombre_servicio,
        COUNT(CASE WHEN c.status = 'Cancelado' THEN 1 END) AS citas_canceladas
        FROM 
            servicios_reservados sr
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        JOIN 
            citas c ON sr.Id_Cita = c.Id_Citas
        GROUP BY 
            sr.Id_Servicio, sc.nombre
        ORDER BY 
            citas_canceladas DESC
        LIMIT 5;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }

    public function mostPopularService(){
        $sql="SELECT 
        sr.Id_Servicio,
        sc.nombre AS nombre_servicio,
        COUNT(*) AS solicitudes
        FROM 
            servicios_reservados sr
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        GROUP BY 
            sr.Id_Servicio, sc.nombre
        ORDER BY 
            solicitudes DESC
        LIMIT 1;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function mostPopularServices(){
        $sql="SELECT 
        sr.Id_Servicio,
        sc.nombre AS nombre_servicio,
        COUNT(*) AS solicitudes
        FROM 
            servicios_reservados sr
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        GROUP BY 
            sr.Id_Servicio, sc.nombre
        ORDER BY 
            solicitudes DESC
        LIMIT 5;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }

    public function mostFinishedApoitments(){
        $sql="SELECT 
        e.Id_Empleado,
        e.Nombre,
        e.Apellido,
        COUNT(CASE WHEN c.status = 'Terminado' THEN 1 END) AS citas_terminadas
        FROM 
            Empleado e
        JOIN 
            citas c ON e.Id_Empleado = c.Id_Empleado
        GROUP BY 
            e.Id_Empleado, e.Nombre, e.Apellido
        ORDER BY 
            citas_terminadas DESC
        LIMIT 1;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function avgEmployeeParticipation(){
        $sql = "SELECT 
        e.Id_Empleado,
        e.Nombre,
        e.Apellido,
        COUNT(CASE WHEN c.status = 'Terminado' THEN 1 END) AS citas_terminadas,
        ROUND(COUNT(CASE WHEN c.status = 'Terminado' THEN 1 END) * 100.0 / 
              (SELECT COUNT(*) FROM citas WHERE status = 'Terminado'), 2) AS procentaje_participacion
        FROM 
            Empleado e
        JOIN 
            citas c ON e.Id_Empleado = c.Id_Empleado
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
    public function getLastApointments(){
        $sql="SELECT 
        c.id_Citas,
        c.status,
        c.Fecha_Creacion,
        sc.nombre AS nombre_servicio,
        s.Precio,
        sc.nombre AS nombre_categoria
        FROM 
            citas c
        JOIN 
            servicios_reservados sr ON c.Id_Citas = sr.Id_Cita
        JOIN 
            servicios s ON sr.Id_Servicio = s.id_Servicio
        JOIN 
            servicios_categoria sc ON s.Id_Categoria = sc.Id_Categoria
        ORDER BY 
            c.Fecha_Creacion DESC
        LIMIT 8;";
    $query = $this->conexion->prepare($sql);
    if($query->execute()){
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
    }
    
    public function countAllCitas(){
        $sql="SELECT 
        COUNT(*) AS total_citas_realizadas
        FROM 
        citas;
        ";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
}

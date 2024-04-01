<?php
class Citas extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function createCita($fecha_cita, $hora_inicio, $id_servicio, $id_empleado, $id_cliente){
        $status = "En Espera";
        $FechaCreacion = new DateTime();
        $FechaCreacionStr = $FechaCreacion->format('Y-m-d H:i:s');
        
        //start the transaction
        $this->conexion->beginTransaction();
        try {
            //insert the cita information into the "citas" table
            $citaSQL = "INSERT INTO citas 
            (id_Citas, Fecha_Creacion, Fecha_Cita, Hora_Inicio, Status, Razon_Cancelacion, id_Cliente,Id_Empleado) 
            VALUES (NULL, :Fecha_Creacion, :Fecha_Cita, :Hora_Inicio, :Status, NULL, :id_Cliente, :Id_Empleado)";
            $query=$this->conexion->prepare($citaSQL);
            $query->bindParam(':Fecha_Cita', $fecha_cita);
            $query->bindParam(':Fecha_Creacion', $FechaCreacionStr);
            $query->bindParam(':Hora_Inicio', $hora_inicio);
            $query->bindParam(':id_Cliente', $id_cliente);
            $query->bindParam(':Id_Empleado', $id_empleado);
            $query->bindParam(':Status', $status);
            $query->execute();

            //get the id of the last cita inserted
            $citaID = $this->conexion->lastInsertId();
            
            //insert the cita information into the "citas_servicio" table
            $citaServicioSQL = "INSERT INTO servicios_reservados
            (id_Servicio_Reservado, id_Cita, id_Servicio)
            VALUES (NULL, :id_Cita, :id_Servicio)";
            $query=$this->conexion->prepare($citaServicioSQL);
            $query->bindParam(':id_Cita', $citaID);
            $query->bindParam(':id_Servicio', $id_servicio);
            $query->execute();


            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->conexion->rollBack();
            return false;
        }
    }
}

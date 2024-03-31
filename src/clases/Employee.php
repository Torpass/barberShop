<?php
class Employee extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function createEmployee($firstName, $lastName, $Cedula, $Telefono, $Gmail, $descripcion, $horarios) {
        $role = 1; // Employee role
    
        // Insert contact information
        $contactSql = "INSERT INTO contacto (Id_Contacto, Telefono, Gmail, role) VALUES (NULL, :Telefono, :Gmail, :role)";
        $contactQuery = $this->conexion->prepare($contactSql);
        $contactQuery->bindParam(':Telefono', $Telefono);
        $contactQuery->bindParam(':Gmail', $Gmail);
        $contactQuery->bindParam(':role', $role);
        $contactQuery->execute();
        $contactID = $this->conexion->lastInsertId(); // Get the contact ID
    
        // Insert employee information
        $promedioPuntuacion = rand(1, 5);
        $infoSql = "INSERT INTO info_empleado (Id_infoEmpleado, descripcion, promedio_Puntuacion) VALUES (NULL, :descripcion, :promedio_Puntuacion)";
        $infoQuery = $this->conexion->prepare($infoSql);
        $infoQuery->bindParam(':descripcion', $descripcion);
        $infoQuery->bindParam(':promedio_Puntuacion', $promedioPuntuacion);
        $infoQuery->execute();
        $infoId = $this->conexion->lastInsertId();
    
        // Insert employee details into "empleado" table
        $employeeSQL = "INSERT INTO empleado (id_Empleado, Nombre, Apellido, Cedula, id_Contacto, id_infoEmpleado) VALUES (NULL, :Nombre, :Apellido, :Cedula, :id_Contacto, :id_infoEmpleado)";
        $query = $this->conexion->prepare($employeeSQL);
        $query->bindParam(':Nombre', $firstName);
        $query->bindParam(':Apellido', $lastName);
        $query->bindParam(':Cedula', $Cedula);
        $query->bindParam(':id_Contacto', $contactID);
        $query->bindParam(':id_infoEmpleado', $infoId);
        $query->execute();
        $employeeID = $this->conexion->lastInsertId();
    
        // Insert employee schedules into "agenda_empleados" table
        foreach ($horarios as $horario) {
            $agendaSql = "INSERT INTO agenda_empleados (id_Agenda, id_Empleado, id_Horario) VALUES (NULL, :id_Empleado, :id_Horario)";
            $agendaQuery = $this->conexion->prepare($agendaSql);
            $agendaQuery->bindParam(':id_Empleado', $employeeID);
            $agendaQuery->bindParam(':id_Horario', $horario);
            $agendaQuery->execute();
        }
    
        // Return true if insertion successful, false otherwise
        return ($query->rowCount() > 0);
    }
    public function getEmployeesWithDetails() {
        $sql= "SELECT empleado.*, info_empleado.*, contacto.*
        FROM empleado
        LEFT JOIN agenda_empleados ON empleado.Id_Empleado = agenda_empleados.Id_Empleado
        LEFT JOIN info_empleado ON empleado.Id_Empleado = info_empleado.Id_infoEmpleado
        LEFT JOIN contacto ON empleado.id_Contacto = contacto.id_Contacto
        GROUP BY empleado.Id_Empleado";
    
        $query = $this->conexion->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function deleteEmployee($deleteID){
        $sql = "DELETE FROM tbl_employees WHERE id=$deleteID";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return true;
        }else {return false; }
    }

    public function updateEmployee($idEdit, $firstName, $lastName, $photo, $cv, $cvName,$roleID, $dateEntry ){
        $sql = "UPDATE tbl_employees SET firstName=:firstName, lastName =:lastName, photo=:photo, cv=:cv, cvName=:cvName, idJob=:idJob, startedAt=:startedAt WHERE id = $idEdit";

        $query=$this->conexion->prepare($sql);
        $query->bindParam(':firstName', $firstName);
        $query->bindParam(':lastName', $lastName);
        $query->bindParam(':photo', $photo, PDO::PARAM_LOB);
        $query->bindParam(':cv', $cv, PDO::PARAM_LOB);
        $query->bindParam(':cvName', $cvName);
        $query->bindParam(':idJob', $roleID);
        $query->bindParam(':startedAt', $dateEntry);

        if($query->execute()){
            return true;
        }else {  
            $error = $query->errorInfo();
            return $error[2];
        }
    }

}

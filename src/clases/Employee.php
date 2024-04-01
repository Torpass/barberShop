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
        $infoSql = "INSERT INTO info_empleado (id_infoEmpleado, descripcion, promedio_Puntuacion) VALUES (NULL, :descripcion, :promedio_Puntuacion)";
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
        LEFT JOIN info_empleado ON empleado.Id_Empleado = info_empleado.id_infoEmpleado
        LEFT JOIN contacto ON empleado.id_Contacto = contacto.id_Contacto
        GROUP BY empleado.Id_Empleado";
    
        $query = $this->conexion->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEmployeeById($id){
        $employeeSQL= "SELECT empleado.*, info_empleado.*, contacto.*
        FROM empleado
        LEFT JOIN agenda_empleados ON empleado.Id_Empleado = agenda_empleados.Id_Empleado
        LEFT JOIN info_empleado ON empleado.Id_Empleado = info_empleado.Id_infoEmpleado
        LEFT JOIN contacto ON empleado.id_Contacto = contacto.id_Contacto
        WHERE empleado.Id_Empleado = :id_empleado
        Limit 1";

        $employeeQuery = $this->conexion->prepare($employeeSQL);
        $employeeQuery->bindParam(':id_empleado', $id);
        $employeeQuery->execute();
        return $employeeQuery->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEmployee($id, $nombre, $apellido, $descripcion, $cedula, $horarios ,$Telefono ,$Gmail ,$idContacto, $infoId, $agendaEmpleadosId) {
        try {
            // Start transaction
            $this->conexion->beginTransaction();
    
            // Update contact information
            $contactSql = "UPDATE contacto 
            SET Telefono = :Telefono, Gmail = :Gmail 
            WHERE Id_Contacto = :idContacto";
            $contactQuery = $this->conexion->prepare($contactSql);
            $contactQuery->bindParam(':Telefono', $Telefono);
            $contactQuery->bindParam(':Gmail', $Gmail);
            $contactQuery->bindParam(':idContacto', $idContacto);
            $contactQuery->execute();


            // Update info employee description
            $sql = "UPDATE info_empleado
                    SET descripcion = :descripcion
                    WHERE Id_infoEmpleado = :id
                    ";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id', $infoId);
            $stmt->execute();
    
            // Update employee
            $sql = "
                UPDATE empleado
                SET Nombre = :nombre, Apellido = :apellido, Cedula = :cedula, id_Contacto = :idContacto, 
                id_infoEmpleado = :idInfoEmpleado
                WHERE Id_Empleado = :id
            ";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':idContacto', $idContacto);
            $stmt->bindParam(':idInfoEmpleado', $infoId);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            // Delete existing employee schedules
            $deleteAgendaSql = "DELETE FROM agenda_empleados WHERE id_Empleado = :id";
            $deleteAgendaQuery = $this->conexion->prepare($deleteAgendaSql);
            $deleteAgendaQuery->bindParam(':id', $id);
            $deleteAgendaQuery->execute();
    
            // Insert updated employee schedules
            foreach ($horarios as $horario) {
                $agendaSql = "INSERT INTO agenda_empleados (id_Agenda, id_Empleado, id_Horario) VALUES (NULL, :id, :id_Horario)";
                $agendaQuery = $this->conexion->prepare($agendaSql);
                $agendaQuery->bindParam(':id', $id);
                $agendaQuery->bindParam(':id_Horario', $horario);
                $agendaQuery->execute();
            }
    
            // Commit transaction
            $this->conexion->commit();
    
            // Return true if update successful
            return true;
        } catch (PDOException $e) {
            // Roll back transaction if there was an error
            $this->conexion->rollBack();
            echo 'Error al actualizar el empleado: ' . $e->getMessage();
            throw $e;
        }
    }
}

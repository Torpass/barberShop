<?php
class Employee extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function createEmployee($firstName, $lastName, $Cedula ,$Telefono, $Gmail, $descripcion, $promedio){
        //set the role of the user to client (remenber that 0 is for clients, 1 is for employees and 2 is for admins)
        $role = 1;

        //insert contact information into "contacto" table first
        $contactSql = "INSERT INTO contacto
                        (Id_Contacto, Telefono, Gmail, role) 
                        Values (NULL, :Telefono, :Gmail, :role)";

        $contactQuery = $this->conexion->prepare($contactSql);
        $contactQuery->bindParam(':Telefono', $Telefono);
        $contactQuery->bindParam(':Gmail', $Gmail);
        $contactQuery->bindParam(':role', $role);
        $contactQuery->execute();

        //insert information into "info_empleado"
        $infoSql = "INSERT INTO info_empleado
                        (Id_infoEmpleado, descripcion, promedio_Puntuación) 
                        Values (NULL, :descripcion, :promedio_puntuacin";

        $infoQuery = $this->conexion->prepare($infoSql);
        $infoQuery->bindParam(':Telefono', $descripcion);
        $infoQuery->bindParam(':promedio_puntuacion', $promedio);
        $infoQuery->execute();

        //get the id of the last contact inserted
        $infoId = $this->conexion->lastInsertId();


        //insert client information into "clientes" table using the contact id
        $employeeSQL = "INSERT INTO empleado 
        (id_Empleado, Nombre, Apellido, Cedula, id_Contacto, id_infoEmpleado) 
        VALUES (NULL, :Nombre, :Apellido, :Cedula, :id_Contacto, :id_infoEmpleado)";
        $query=$this->conexion->prepare($employeeSQL);
        $query->bindParam(':Nombre', $firstName);
        $query->bindParam(':Apellido', $lastName);
        $query->bindParam(':Cedula', $Cedula);
        $query->bindParam(':id_Contacto', $contactID);
        $query->bindParam(':id_infoEmpleado', $infoId);

        if ($query->execute()){
            //get the id of the last client inserted and return it as an array
            $clientId = $this->conexion->lastInsertId();
            return true;
            } else{
                return false;
            } 
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

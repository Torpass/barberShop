<?php
class Client extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function loginClient($name, $cedula){
        $sql = "SELECT *, count(*) as num_users
        FROM clientes 
        WHERE Nombre = :Nombre AND Cedula = :Cedula";

        $query = $this->conexion->prepare($sql);
        $query->bindParam(':Nombre', $name);
        $query->bindParam(':Cedula', $cedula);

        if($query->execute()){
            $user = $query->fetch(PDO::FETCH_ASSOC);
            if($user){
                return $user;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }

    public function signUpClient($firstName, $lastName, $Cedula ,$Telefono, $Gmail){
        //insert contact information into "contacto" table first
        $contactSql = "INSERT INTO contacto (Id_Contacto, Telefono, Gmail) Values (NULL, :Telefono, :Gmail)";
        $contactQuery = $this->conexion->prepare($contactSql);
        $contactQuery->bindParam(':Telefono', $Telefono);
        $contactQuery->bindParam(':Gmail', $Gmail);
        $contactQuery->execute();

        //get the id of the last contact inserted
        $contactID = $this->conexion->lastInsertId();


        //insert client information into "clientes" table using the contact id
        $clientSQL = "INSERT INTO clientes (id_Cliente, Nombre, Apellido, Cedula, id_Contacto) VALUES (NULL, :Nombre, :Apellido, :Cedula, :id_Contacto)";
        $query=$this->conexion->prepare($clientSQL);
        $query->bindParam(':Nombre', $firstName);
        $query->bindParam(':Apellido', $lastName);
        $query->bindParam(':Cedula', $Cedula);
        $query->bindParam(':id_Contacto', $contactID);

        if ($query->execute()){
            //get the id of the last client inserted
            $clientId = $this->conexion->lastInsertId();
            return [
                'id' => $clientId,
                'name' => $firstName
            ];
            } else{
                return false;
            } 
    }

    public function createEmployee($firstName, $lastName, $photo, $cv, $cvName,$roleID, $dateEntry){
        $sql = "INSERT INTO tbl_employees (id, firstName, lastName, photo, cv, cvName, idJob, startedAt) VALUES (NULL, :firstName, :lastName, :photo, :cv, :cvName, :idJob, :startedAt)";

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

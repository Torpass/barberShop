<?php
class Service extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }
    

    public function getAllCategoryServices() {
        $sql = "SELECT * FROM servicios_categoria";
        $query = $this->conexion->prepare($sql);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else {return false;}
    }


    public function createService($precio, $duracion, $detalles,$idCategoria,$foto){
        // query to get the client information from the database and the contact information associented to the client 
        $serviciosSQL= "INSERT INTO servicios (Id_Servicio, Precio, Duracion, Id_Categoria)
        VALUES (NULL, :Precio, :Duracion, :Id_Categoria)";
        $serviceQuery = $this->conexion->prepare($serviciosSQL);
        $serviceQuery->bindParam(':Precio', $precio);
        $serviceQuery->bindParam(':Duracion', $duracion);
        $serviceQuery->bindParam(':Id_Categoria', $idCategoria);
        
        if($serviceQuery->execute()){
            $serviceID = $this->conexion->lastInsertId();
            $detallesSQL = "INSERT INTO detalles_servicio 
            (Id_Detalle, Id_Servicio, Detalle, img) 
            VALUES (NULL, :Id_Servicio, :Detalle, :img)";
            $detailsServiceQuery = $this->conexion->prepare($detallesSQL);
            $detailsServiceQuery->bindParam(':Id_Servicio', $serviceID);
            $detailsServiceQuery->bindParam(':Detalle', $detalles);
            $detailsServiceQuery->bindParam(':img', $foto);

            if($detailsServiceQuery->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function signUpClient($firstName, $lastName, $Cedula ,$Telefono, $Gmail){
        //set the role of the user to client (remenber that 0 is for clients, 1 is for employees and 2 is for admins)
        $role = 0;

        //insert contact information into "contacto" table first
        $contactSql = "INSERT INTO contacto 
                        (Id_Contacto, Telefono, Gmail, role) 
                        Values (NULL, :Telefono, :Gmail, :role)";

        $contactQuery = $this->conexion->prepare($contactSql);
        $contactQuery->bindParam(':Telefono', $Telefono);
        $contactQuery->bindParam(':Gmail', $Gmail);
        $contactQuery->bindParam(':role', $role);
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
            //get the id of the last client inserted and return it as an array
            $clientId = $this->conexion->lastInsertId();
            return [
                'id' => $clientId,
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
}
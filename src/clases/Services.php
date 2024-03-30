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

    public function getAllServices(){
        $sql = "SELECT 
        s.id_Servicio,
        s.Precio,
        s.Duracion,
        c.nombre AS Nombre_Categoria,
        ds.Detalle,
        ds.img AS Ruta_Imagen
        FROM 
        Servicios s
        INNER JOIN 
        servicios_categoria c ON s.Id_Categoria = c.Id_Categoria
        INNER JOIN 
        detalles_servicio ds ON s.id_Servicio = ds.Id_Servicio;";

        $query= $this->conexion->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateService($id, $precio, $duracion, $categoryId, $detalle, $imgName){
        // Actualizar la tabla Servicios
        $serviceSQL = "UPDATE Servicios SET 
        Precio = :precio, 
        Duracion = :duracion ,
        Id_Categoria = :catrgoryId 
        WHERE id_Servicio = :id";
    
        $serviceQuery = $this->conexion->prepare($serviceSQL);
        $serviceQuery->bindParam(':precio', $precio);
        $serviceQuery->bindParam(':duracion', $duracion);
        $serviceQuery->bindParam(':id', $id);
        $serviceQuery->bindParam(':catrgoryId', $categoryId);
        $serviceQuery->execute();
    
        // Actualizar la tabla detalles_servicio
        $detailsSQL = "UPDATE detalles_servicio SET Detalle = :detalle, img = :rutaImagen WHERE Id_Servicio = :id";
        $detailsQuery = $this->conexion->prepare($detailsSQL);
        $detailsQuery->bindParam(':detalle', $detalle);
        $detailsQuery->bindParam(':rutaImagen', $imgName);
        $detailsQuery->bindParam(':id', $id);
        $detailsQuery->execute();

        return true;
    }

    public function getServiceById($id){
        $sql = "SELECT 
        s.id_Servicio,
        s.Precio,
        s.Duracion,
        c.nombre AS Nombre_Categoria,
        ds.Detalle,
        ds.img AS Ruta_Imagen
        FROM 
        Servicios s
        INNER JOIN 
        servicios_categoria c ON s.Id_Categoria = c.Id_Categoria
        INNER JOIN 
        detalles_servicio ds ON s.id_Servicio = ds.Id_Servicio
        WHERE s.id_Servicio = :id;";
    

        $query= $this->conexion->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function createCateogry($nombre){
        $categorySQL= "INSERT INTO servicios_categoria 
        (Id_Categoria, nombre)
        VALUES (NULL, :Nombre)";
        $categoryQuery = $this->conexion->prepare($categorySQL);
        $categoryQuery->bindParam(':Nombre', $nombre);
        
        if($categoryQuery->execute()){
            return true;
        }else{
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
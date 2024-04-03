<?php

class Review extends ConexionSQL{

    public function __construct() {
        parent::__construct();
    }

    public function createReview($idEmpleado, $idCliente, $puntuacion, $descripcion){
        $sql = "INSERT INTO resenas_empleados 
        (Id_Resena_Empleado, Id_Cliente, Id_Empleado, Puntuacion, Descripcion) 
        VALUES (NULL, :Id_Cliente, :Id_Empleado, :Puntuacion, :Descripcion)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':Id_Empleado', $idEmpleado);
        $query->bindParam(':Id_Cliente', $idCliente);
        $query->bindParam(':Puntuacion', $puntuacion);
        $query->bindParam(':Descripcion', $descripcion);
        $query->execute();
        return ($query->rowCount() > 0);
    }

    public function getReviewsByEmployee($idEmpleado){
        $sql = "SELECT * FROM resenas_empleados WHERE Id_Empleado = :Id_Empleado";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':Id_Empleado', $idEmpleado);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createBarberReview($idCliente, $puntuacion, $descripcion){
        $status = "Activo";
        $sql = "INSERT INTO resenas_barberia 
        (Id_Resena_Barberia, Id_Cliente, Puntuacion, Descripcion, status) 
        VALUES (NULL, :Id_Cliente, :Puntuacion, :Descripcion, :status)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':Id_Cliente', $idCliente);
        $query->bindParam(':status', $status);
        $query->bindParam(':Puntuacion', $puntuacion);
        $query->bindParam(':Descripcion', $descripcion);
        $query->execute();
        return ($query->rowCount() > 0);
    }

    public function getBarberReviews(){
        $sql = "SELECT resenas_barberia.*, clientes.Nombre, clientes.Apellido
                FROM resenas_barberia
                INNER JOIN clientes ON resenas_barberia.id_Cliente = clientes.id_Cliente
                WHERE resenas_barberia.status = 'Activo'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteReview($id){
        $sql = "UPDATE resenas_barberia
        SET status = 'Inactivo'
        WHERE id_Resena_Barberia = :id;";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return ($query->rowCount() > 0);
    }
}
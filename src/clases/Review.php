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
}
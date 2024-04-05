<?php 
    class Horarios extends ConexionSQL{

        public function __construct() {
            parent::__construct();
        }
    
        public function createHorario($dia, $hora_inicio, $hora_fin){
            $status = "Activo";
            $sql = "INSERT INTO horarios 
            (id_Horario, dia, hora_inicio, hora_Finalizacion, status) 
            VALUES (NULL, :dia, :horaInit, :horaFinish, :status	)";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(':dia', $dia);
            $query->bindParam(':horaInit', $hora_inicio);
            $query->bindParam(':horaFinish', $hora_fin);
            $query->bindParam(':status', $status);
            $query->execute();
            return ($query->rowCount() > 0);
        }

        public function getHorarioByID($id){
            $sql = "SELECT * FROM horarios WHERE id_Horario = :id";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(':id', $id);
            if($query->execute()){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
        }

        public function updateHorario($id, $dia, $hora_inicio, $hora_Finalizacion){
            $sql = "UPDATE horarios SET dia = :dia, hora_inicio = :hora_inicio, hora_Finalizacion = :hora_Finalizacion WHERE id_Horario = :id";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':dia', $dia);
            $query->bindParam(':hora_inicio', $hora_inicio);
            $query->bindParam(':hora_Finalizacion', $hora_Finalizacion);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deleteHorario($id){
            $sql = "UPDATE horarios SET status = 'Inactivo' WHERE id_Horario = :id";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(':id', $id);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }  
    
        public function getHorarios(){
            $sql = "SELECT * FROM horarios where status = 'Activo'";
            $query = $this->conexion->prepare($sql);
            if($query->execute()){
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
            
        }
    }    
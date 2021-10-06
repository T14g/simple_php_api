<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ComentarioModel extends Database
{
    public function getComentarios($idPendencia = null)
    {

        if($idPendencia){
            $query = "SELECT * FROM comentario WHERE id_pendencia = " . $idPendencia . "";
            return $this->select($query);
        }else{
            return [];
        }

    }

    public function createComentario($idUsuario, $idPendencia, $date, $nome, $comentario)
    {
        
        $query = "INSERT INTO comentario (id_usuario, id_pendencia, `data`, nome_usuario, comentario)
        VALUES(" . $idUsuario . ", " . $idPendencia . ", '" . $date ."', '" . $nome . "', '" . $comentario ."')";

        return $this->execute($query);

    }
}

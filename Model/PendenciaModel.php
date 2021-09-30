<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class PendenciaModel extends Database
{
    public function getPendencias($usuario = null, $setor = null, $limit = null)
    {
        $query = "SELECT * FROM itens_ata ";
        $where = "";

        if($usuario){
            $where .= " WHERE responsavel = '" . $usuario . "'";
        }

        if($setor && $where == ""){
            $where .= " WHERE setoratacapa = '" . $setor . "'";
        }else if($setor){
            $where .= " AND setoratacapa = '" . $setor . "'";
        }

        $query .= $where . " ORDER BY iditens";

        if($limit){
            $query .= " LIMIT " . $limit . "";
        }

        return $this->select($query);

    }
}
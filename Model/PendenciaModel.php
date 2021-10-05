<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class PendenciaModel extends Database
{
    public function getPendencias($usuario = null, $areaId = null, $status = null,  $limit = null)
    {
        $query = "SELECT * FROM pendencia ";
        $where = "";

        if($usuario){
            $where .= " WHERE responsavel = '" . $usuario . "'";
        }

        if($areaId && $where == ""){
            $where .= " WHERE id_reuniao = '" . $areaId . "'";
        }else if($areaId){
            $where .= " AND id_reuniao = '" . $areaId . "'";
        }

        if($status && $where == ""){
            $where .= " WHERE `status` = '" . $status . "'";
        }else if($status){
            $where .= " AND `status` = '" . $status . "'";
        }

        $query .= $where . " ORDER BY id_pendencia";

        if($limit){
            $query .= " LIMIT " . $limit . "";
        }

        return $this->select($query);

    }

    public function updatePendencia($id, $responsavel, $prazo, $pendencia)
    {
        $query = "UPDATE itens_ata a set a.responsavel = " . $responsavel . ", 
        a.prazo = " . $prazo . ", a.pendencia = " . $pendencia . " WHERE a.iditens = " .$id. "";

        return $this->executeStatement($query);
        
    }
}
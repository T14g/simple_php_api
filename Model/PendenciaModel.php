<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class PendenciaModel extends Database
{
    public function getPendencias($limit)
    {
        return $this->select("SELECT * FROM itens_ata ORDER BY iditens ASC LIMIT ". $limit. "");
    }
}
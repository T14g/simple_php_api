<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class AtaModel extends Database
{
    public function getLastAtaFromArea($area)
    {
        return $this->select("SELECT max(numero_ata) as maior FROM ata WHERE  ata.id_reuniao = $area LIMIT 1");
    }
}
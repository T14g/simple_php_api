<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class SetorModel extends Database
{
    public function getSetores()
    {
        return $this->select("SELECT * FROM setores");
    }
}
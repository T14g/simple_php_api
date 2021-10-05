<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class AreaModel extends Database
{
    public function getAreas()
    {
        return $this->select("SELECT * FROM area");
    }
}
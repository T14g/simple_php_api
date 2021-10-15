<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    public function getUsers()
    {
        return $this->select("SELECT * FROM responsavel");
    }

    public function loginUser($user, $senha)
    {
        $query = "SELECT nome, nivel_acesso FROM usuario WHERE nome = '" .$user. "' AND senha = '" .$senha. "'";
        return $this->select($query);
    }
   
}
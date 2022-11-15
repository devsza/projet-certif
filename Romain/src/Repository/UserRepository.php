<?php

require_once dirname(__DIR__, 2) . "/lib/Repository/AbstractRepository.php";
require_once dirname(__DIR__) . "/Model/User.php";

class UserRepository extends AbstractRepository
{
    public function findOneByPseudo(string $pseudo): mixed
    {
        $query = "SELECT * 
                FROM user 
                WHERE pseudo = :pseudo LIMIT 1";
        $params = [":pseudo" => $pseudo];
        $result = $this->executeQuery($query, "User", $params);
        if(!empty($result)) {
                    return $result;
                }
                return null;
            }

   public function add(User $user): mixed
    {
        $query = "INSERT INTO user (pseudo, password, mail)
        VALUES (:pseudo, :password, :mail);";
        $params = [
            ":pseudo" => $user->getPseudo(),
            ":password" => $user->getPassword(),
            ":mail" => $user->getMail(),


        ];
        return $this->executeQuery($query, "User", $params);
    }
    
    public function find(int $id)
    {
        $query = "SELECT * FROM user WHERE id = :id ;";
        $params = [":id" => $id];

        return $this->executeQuery($query, 'User', $params);
    }

}
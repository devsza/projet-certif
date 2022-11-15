<?php

use LDAP\Result;

abstract class AbstractRepository
{

    private const DATABASE_NAME = "mysql:host=db.3wa.io;port=3306;dbname=romainscotto_DBD";
    private const DATABASE_USERNAME = "romainscotto";
    private const DATABASE_PASSWORD = "7cf06f2289ad30fc37bb61ac2dce784b";

    /**
     * Initialise PDO connection with database
     */
    private function connect()
    {
        return new PDO(self::DATABASE_NAME, self::DATABASE_USERNAME, self::DATABASE_PASSWORD);
    }

    /**
     * @param string $query Request in SQL
     * @param array $params Params [":variableSQL" => "valeur",...]
     * @return query result
     */
    public function executeQuery(string $query, string $class, array $params = []): mixed
    {
        $result = null;
        $conn = $this->connect();
        $stm = $conn->prepare($query);
        foreach ($params as $key => $param) $stm->bindValue($key, $param);
        if ($stm->execute()) {
            strlen($class) && $stm->setFetchMode(PDO::FETCH_CLASS, $class);
            
            if ($stm->rowCount() === 1) $result = $stm->fetch();
            if ($stm->rowCount() > 1) $result = $stm->fetchAll();
        }
        
        $conn = null;
        return $result;
    }
    
    /**
     * @param string $query Request in SQL
     * @param array $params Params [":variableSQL" => "valeur",...]
     * @return query result
     */
    public function executeQuery2(string $query, string $class, array $params = []): mixed
    {
        $result = null;
        $conn = $this->connect();
        $stm = $conn->prepare($query);
        foreach ($params as $key => $param) $stm->bindValue($key, $param);
        if ($stm->execute()) {
            strlen($class) && $stm->setFetchMode(PDO::FETCH_CLASS, $class);
            $result = $stm->fetchAll();
        }
        
        $conn = null;
        return $result;
    }
}

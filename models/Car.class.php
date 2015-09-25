<?php

class db extends \PDO
{

    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost; dbname=sample', 'toor');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insertUser(Array $params = null)
    {
        $placeholders = array(
            ':username',
            ':password'
        );
        
        foreach ($placeholders as $value) {
            if (! array_key_exists($value, $params)) {
                throw new Exception("Missing parameter, '$value'");
            }
        }
        
        $sql = <<<SQL
        INSERT INTO users
          ( username, password, fname, lname )
        VALUES
          ( :username, :password, :fname, :lname );
SQL;
        
        $stmt = $this->pdo->prepare($sql);
        // return $params;
        $stmt->execute($params);
        
        if ($stmt->rowCount() == 1)
            return true;
        else
            return false;
    }

    public function getVehicleById($id)
    {
        if (! filter_var($id, FILTER_VALIDATE_INT))
            throw new Exception("ID is not numeric");
        
        $sql = <<<SQL
           SELECT * FROM 
            vehicles
           WHERE 
            vehicle_id = :id
SQL;
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        
        if ($stmt->rowCount() == 1) {
            $id = $stmt->fetchAll();
            return $id[0];
        } else {
            return false;
        }
    }
}

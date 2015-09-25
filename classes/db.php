<?php

class db extends \PDO
{

    public $pdo = null;
    
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost; dbname=sample', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         echo "<p><b>Connection created</b></p>";
    }
    
    public function getConnection(){
        if ( $this->pdo !== null )
          return $this->pdo;
        else 
            echo "Problem";
    }
    
    public function insertUser( Array $params = null){
        $placeholders = array(
            ':username', 
            ':password', 
        );
        
        foreach ( $placeholders as $value ) {
          if ( !array_key_exists($value, $params) ) {
              throw new Exception("Missing parameter, '$value'");
          }
        }
        
        $sql = <<<SQL
        INSERT INTO users
          ( username, password, fname, lname )
        VALUES
          ( :username, :password, :fname, :lname );
SQL;

        $stmt = $this->pdo->prepare( $sql );
//         return $params;
        $stmt->execute( $params );
        
        if ( $stmt->rowCount() == 1 ) 
            return true;
        else
            return false;
        
    }
    
    public function getUserById( $id ){
        
        if ( !filter_var( $id, FILTER_VALIDATE_INT))
            throw new Exception("ID is not numeric");
        
        $sql = <<<SQL
        SELECT 
          fname,
          lname,
          username 
        FROM 
          users
        WHERE
          id = :id;    
SQL;
    
        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute( array(':id' => $id ) );
    
        if ( $stmt->rowCount() == 1 ) {
            $id = $stmt->fetchAll();
            return $id[0];
        } else {
            return false;
        }
    }
    
}

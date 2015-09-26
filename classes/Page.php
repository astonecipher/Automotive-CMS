<?php

class Page extends \db
{

    public $pdo;
    
    public function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getConnection();
    }
    
    public function getPage( $id ) {
        if ( !filter_var( $id, FILTER_VALIDATE_INT))
            throw new Exception('Page not found!');
        
        $sql = <<<SQL
        SELECT content FROM page where pageID = :id
SQL;

       $stmt = $this->pdo->prepare( $sql );
        $stmt->execute( array( ':id' => $id ));
        
        if ( $stmt->rowCount() > 0 ) {
        $content = $stmt->fetch();
        return $content[0];
        } else {
            return "Page not found!";
        }
    }    
    
    public function getContactForm(){
        
        return file_get_contents('./views/contact_form.html');
    }
    
}

?>
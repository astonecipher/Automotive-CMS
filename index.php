<?php
require_once './classes/db.php';
require_once './classes/Page.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';

$db = new db();

$values = array(
    ':username' => 'jsmith',
    ':password' => hash('whirlpool', 'password'),
    ':fname' => 'James',
    ':lname' => 'Smith'
);
try {
    
    $row = $db->getUserById(1);
    
//     print_r( $row );
    
    if ($row != false)
        $params = $row;
    else
        $params['fname'] = 'Sorry, nothing found';
    
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}

switch (strtolower($action)) {
    case 'display':
        // testing
        $imgs = array(
            'IMAG0485',
            'IMAG0486',
            'IMAG0487',
            'IMAG0488',
        );
        
        for( $i = 0; $i < 4; $i++ ){
            $file = file_get_contents( './views/product_layout.html' );
            $replaced = str_replace('{img}', $imgs[ $i ] , $file );
            echo $replaced;
        }
        
        break;
    case 'viewpage':
        $page = new Page();
//         test();
//         echo "test";
        echo $page->getPage( $_GET['pageID']);
//         echo "</pre>";
        break;
    default:
        main($params);
}

function test(){
    print_r( $_REQUEST );
}

function main($params)
{
    
    // if ( isset( $params['username']))
    $username = 'astonecipher'; // $params['username'];
    $firstname = 'Andrew'; // $params['firstname'];
    $lastname = 'Stonecipher'; // $params['lastname'];
    require_once './views/Welcome.html';
}

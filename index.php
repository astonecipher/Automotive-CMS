<?php
require_once './classes/db.php';
require_once './classes/Page.php';
require_once './classes/Product.php';

// getAllProducts()

$action = isset($_GET['action']) ? $_GET['action'] : '';

$db = new db();
$product = new Product();
$page = new Page();

try {
    
    $row = $db->getUserById(1);
    
    // print_r( $row );
    
    if ($row != false)
        $params = $row;
    else
        $params['fname'] = 'Sorry, nothing found';
} catch (Exception $ex) {
    echo $ex->getMessage();
}

switch (strtolower($action)) {
    case 'getContactForm':
        echo $page->getContactForm();
        break;
    case 'display':
        display( $product );
        break;
    case 'viewpage':
        // test();
        // echo "test";
        echo $page->getPage($_GET['pageID']);
        // echo "</pre>";
        break;
    default:
        main($params);
//         display($product);
}

function test()
{
    print_r($_REQUEST);
}

function main($params)
{
    
    // if ( isset( $params['username']))
    $username = 'astonecipher'; // $params['username'];
    $firstname = 'Andrew'; // $params['firstname'];
    $lastname = 'Stonecipher'; // $params['lastname'];
    require_once './views/Welcome.html';
}

function display( $product ){
    $products = $product->getAllProducts();
    
    //         echo "<pre>";
    //         print_r($products);
    //         echo "Count: " . count( $products );
    //         echo "</pre>";
    
    for($index = 0; $index < count( $products); $index++) {
        $replace = array();
        $values = array();
        foreach ($products[ $index ] as $key => $value) {
            //                 echo "<p>$key : $value</p>";
    
            array_push($values, $value);
            array_push($replace, "{{$key}}");
        }
        //             echo "<pre>";
        //             print_r($replace);
        //             echo "</pre>";
        $file = file_get_contents('./views/product_layout.html');
        $replaced = str_replace($replace, $values, $file);
        echo $replaced;
    }
}
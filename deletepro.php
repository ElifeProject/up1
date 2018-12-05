<?php

if($_POST){
	include_once 'config/database.php';
	include_once 'object/product.php';

	$database = new Database();
    $db = $database->getConnection();
 
    $product = new Product($db);
    $product->Pro_id = $POST('object_id');

    if ($product->delete())
    {
    	echo "Product has been deleted";
    }

    else
    {
    	echo "unable to delete product";
    }
}

?>
<?php
$page_title = "Read Products";
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'config/database.php';
include_once 'object/product.php';
include_once 'object/category.php';
 
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
$category = new Category($db);
 
// query products
//$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $product->CountAll();
//echo "$num";
$stmt = $product->readAll($from_record_num, $records_per_page);
//$try = $product->readOne();
// set page header
//include_once "layout_header.php";


// display the products if there are any
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Price</th>";
            echo "<th>Category</th>";
            echo "<th>Action</th>";
        echo "</tr>";
        $row = $product->readOne();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "helo";
            extract($row);
 
            echo "<tr>";
                echo "<td>{$Pro_name}</td>";
                echo "<td>{$price}</td>";
                //echo "<td>{$description}</td>";
                echo "<td>";
                    $category->Category_id = $cat_id;
                    $category->readName();
                    echo $category->Catagory_title;
                echo "</td>";
 
                echo "<td>";
                    // read one, edit and delete button will be here
                    // read, edit and delete buttons
                echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>
                        <span class='glyphicon glyphicon-list'></span> Read
                    </a>
 
                    <a href='update_product.php?id={$id}' class='btn btn-info left-margin'>
                        <span class='glyphicon glyphicon-edit'></span> Edit
                    </a>
 
                    <a delete-id='{$id}' class='btn btn-danger delete-object'>
                        <span class='glyphicon glyphicon-remove'></span> Delete
                    </a> ";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons will be here
    $page_url = "Product_Index.php?";
    $t_rows = $product->countAll();
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}
 
// set page footer
include_once "layout_footer.php";
?>
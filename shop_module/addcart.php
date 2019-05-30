<?php
// Get the current list of products
session_start();
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
} else{ 	// No products currently in list.  Create a list.
	$productList = array();
}

$quantity;
// Add new product selected
// Get product information
if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price'])){
	$id = $_GET['id'];
	$name = $_GET['name'];
	$price = $_GET['price'];
    $quantity=1;
} 

if(isset($_GET["quantity"])&&isset($_GET['id'])){
    $quantity=$_GET["quantity"];
    $id=$_GET['id'];
}

$delete=false;
if(isset($_GET["delete"])&&isset($_GET['id'])){
    $delete=$_GET["delete"];
    $id=$_GET['id'];
}

$update=false;
if(isset($_GET["update"])&&isset($_GET['id'])){
    $update=$_GET["update"];
    $id=$_GET['id'];
    if($update<1)
        $update=1;
}



// Update quantity if add same item to order again
if (isset($productList[$id])){
    if($delete)
        unset($productList[$id]);
    if($update)
        $productList[$id]['quantity']=$update;
	$productList[$id]['quantity'] = $productList[$id]['quantity'] +$quantity;
    if($productList[$id]['quantity']<1){
        unset($productList[$id]);
    }
    
} else {
	$productList[$id] = array( "id"=>$id, "name"=>$name, "price"=>$price, "quantity"=>1 );
}

$_SESSION['productList'] = $productList;
header('Location: cartcheckout.php');
?>
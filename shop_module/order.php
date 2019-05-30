<!DOCTYPE html>
<!--
当用户checkout的时候，先检查session里的购物车里有没有产品，如果有，则先计算总值，然后存order进数据库，然后遍历productLIst，一个一个把具体order的信息存进数据库，并且更新每个商品的剩余存储量,若更新成功，则自动跳回customerpage，否则留在该页面并提示错误。


-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>YOUR NAME Grocery Order Processing</title>
</head>
<body>

<?php
include "dbconnection.php";
/** Get customer id **/
session_start();
if(!isset($_SESSION["username"])){
    header("location:LogIn.php"); 
}
$productList = null;
if (isset($_SESSION['productList'])&&isset($_SESSION["username"])){
	$productList = $_SESSION['productList'];
    $username=$_SESSION["username"];
}
    
$hasproduct=false;
$total =0;
$maxorderid;
$status="A Step packaing";
    
if(isset($_POST["cardname"])&&(trim($_POST["cardname"])!="")&&isset($_POST["cardnumber"])&&(trim($_POST["cardnumber"])!="")){
        $cardname=trim($_POST["cardname"]);
        $cardnumber=trim($_POST["cardnumber"]);
}
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else{
    //good connection
    if(sizeof($productList)>0)
        $hasproduct=true;
   
    if($hasproduct){
        //find max orderid
    $selectorderid="select oID from orders where uname='".$username."' order by oID desc limit 1";
    $hascustomer=false;
    if($resultofselectorderid=mysqli_query($connection,$selectorderid)){
        while($row=mysqli_fetch_assoc($resultofselectorderid)){
            $hascustomer=true;
            $maxorderid=$row["oID"]+1;     
        }//end of while
         if(!$hascustomer){
             $maxorderid=1;
         }
//        echo "current order id shoudl be ".$maxorderid;
    }//end of if
    else{
        echo die(mysqli_error($connection));
        $maxorderid=1;
    }
            
        //insert items
        
	foreach ($productList as $id => $prod) {
		$price = $prod['price'];
		$total = $total +$prod['quantity']*$price;
	}
        
        
        //insert order
        $sqlinsertorder=mysqli_prepare($connection,"INSERT INTO orders VALUES(?,?,?,?,?,?)");
        $sqlinsertorder->bind_param('ssssss', $maxorderid,$username,$status,$cardnumber,$cardname,$total); 
        $sqlinsertorder->execute();
        $sqlinsertorder->close();
        
        	foreach ($productList as $id => $prod) {
//        echo"order prodcut name".$prod["name"].$prod["id"]."\n";
        $insertitems=mysqli_prepare($connection,"INSERT INTO orderedproduct VALUES(?,?,?,?,?)");
        $insertitems->bind_param('sssss', $prod["id"],$maxorderid,$username,$prod["quantity"],$prod["price"]); 
        echo $prod["id"].$maxorderid.$username.$prod["quantity"].$prod["price"];
        if(!$insertitems->execute()){
            echo"Fail to insert!!!!!!!!!!!!";
            throw new Exception($insertitems->error);
        }
        $insertitems->close();
        $updateitems=mysqli_prepare($connection,"update product set alreadysold=alreadysold+?,inventory=inventory-? where pID=?");
        $updateitems->bind_param('sss', $prod["quantity"],$prod["quantity"],$prod["id"]); 
        if(!$updateitems->execute()){
            echo"Fail to update!!!!!!!!!!!!";
            throw new Exception($updateitems->error);
        }
        $updateitems->close();
	}

/** Clear session/cart **/
         mysqli_close($connection);
        $_SESSION["productList"]=array();
        
        header("location:customerPage.php"); 
    }else{
        mysqli_close($connection);
        $_SESSION["fail"]="fail";
        header("location:cartcheckout.php");
    }
}


?>
<h2><a href="BrowsingPage.php">Continue Shopping</a></h2>
</body>
</html>


<!--
每次用户退出的时候把cart的内容一个一个存到productincart数据库中，以便exchange information between session
-->
<?php
session_start();
include "dbconnection.php";
if(!isset($_SESSION["username"])){
            header("location:LogIn.php");
}

if(isset($_SESSION["username"])&&isset($_SESSION["productList"])){
    $username=$_SESSION["username"];
    $productList=$_SESSION["productList"];
    $insertitems=mysqli_prepare($connection,"INSERT INTO productincart VALUES(?,?,?,?,?)");
    $hasproduct=false;
    foreach ($productList as $id => $prod) {
        $hasproduct=true;
        $insertitems->bind_param('sssss', $prod["id"],$username,$prod["name"],$prod["quantity"],$prod["price"]);
        echo $prod["id"].$username.$prod["name"].$prod["quantity"].$prod["price"];
    if(!$insertitems->execute()){
        echo"Fail to insert!!!!!!!!!!!!";
        session_destroy();
        header("location:mainpage.php");
        throw new Exception($insertitems->error);
        }
    }
    $insertitems->close();
    session_destroy();
   header("location:mainpage.php");
}
else{
    echo die(mysqli_error($connection));
    session_destroy();
    header("location:mainpage.php");
}
?>

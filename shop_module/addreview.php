<!DOCTYPE html>
<?php

include "dbconnection.php";
session_start();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else{
  if(isset($_SESSION["productid"]) && isset($_SESSION["username"]) && isset($_POST["comment"]) && isset($_POST["rating"])){

    $reviewtime = date('Y-m-d', time());
    $sqladdreview = mysqli_prepare($connection, "INSERT INTO Comment VALUES (?,?,?,?,?)");
    $sqladdreview->bind_param('sisis', $reviewtime, $_POST["rating"], $_POST["comment"], $_SESSION["productid"], $_SESSION["username"]);
    $sqladdreview->execute();
    //$sqladdreview->close();

    $sqlupdaterate = mysqli_prepare($connection, "UPDATE product SET ovrate=(SELECT AVG(rate) FROM comment WHERE pID=?) where pID=?");
    $sqlupdaterate->bind_param('ss', $_SESSION["productid"], $_SESSION["productid"]);
    $sqlupdaterate->execute();
    //$sqlupdaterate->close();

    header("Location: ProductPage.php?productid=".$_SESSION["productid"]);
  }
}

 ?>

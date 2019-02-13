<?php 

//登录验证文件，如果已经登录，直接转到主页，否则，如果勾了administer就从manager table里找数据，没勾就从customer里去验证（44行），登陆成功就转到主页(但主页面中的my account的超链接，根据customer和administer来改变,through $_session["administer"] 67row)，登录失败则有红字提醒（通过session【fail】,72行），同时，会把productincart数据库中的购物车信息存储到当前session【‘productlist’】中，读取完毕后，清除该用户的在数据库中的购物车信息。

session_start();

if(isset($_SESSION["username"])){
    header("location:mainpage.php"); 
}

$username;
$password;

$isValid=false;

//check whther request method is expected
if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["username"])&&(trim($_POST["username"])!="")&&isset($_POST["password"])&&(trim($_POST["password"])!="")){
        $username=trim($_POST["username"]);
        $password=trim($_POST["password"]);
            
        $isValid=true;
}//end of check whethter the firstname and key is empty
    else{
        echo "<p>some input contents are empy</p>";
    }
    }//end of check whtether send method is post
else{
        echo "<p>request method is wrong</p>";
}

//connecting to db;
include "dbconnection.php";

if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else{
    //good connection
    $whethervaliduser=false;
    $isadminister=false;
    //is checkbox is selected,which means the user is a administer;
    if(isset($_POST["administer"])){
        $stmtcheckuserpassword = mysqli_prepare($connection,"select * from manager where mname=? and password=?");
        $isadminister=true;
    }else{
        $stmtcheckuserpassword = mysqli_prepare($connection,"select * from customer where uname=? and password=?");
    }
    
//    echo "user:".$username." hashed password ".$hashedpassword." password ".$password;
    $stmtcheckuserpassword->bind_param('ss', $username, $password);
    $stmtcheckuserpassword->execute();
    while(mysqli_stmt_fetch($stmtcheckuserpassword)){
            $whethervaliduser=true;
            break;
        }//end of query for submitted username and password
    $stmtcheckuserpassword->close();
   
    //if user exist
    if($whethervaliduser){
         $_SESSION["username"]=$username;
        $productList = array();
        $stmtgetcart = mysqli_prepare($connection,"select * from productincart where uname=?");
        $stmtgetcart->bind_param('s', $username);
        mysqli_stmt_bind_result($stmtgetcart,$productid,$uname,$pname,$quantity,$price);
        $stmtgetcart->execute();
        while(mysqli_stmt_fetch($stmtgetcart)){
            $id=$productid;
            $productList[$id] = array( "id"=>$productid, "name"=>$pname, "price"=>$price, "quantity"=>$quantity);  
        }
        $stmtgetcart->close();
        $stmtremovecart = mysqli_prepare($connection,"delete from productincart where uname=?");
        $stmtremovecart->bind_param('s', $username);
        $stmtremovecart->execute();
        $stmtremovecart->close();
        $_SESSION['productList'] = $productList;
        if($isadminister){
            echo "operating administer";
            $_SESSION["administer"]=$username;
        }
        echo "sss:".$isadminister.$_SESSION["administer"];
         mysqli_close($connection);
        header("location:mainpage.php");
    }
    else{
        $_SESSION["fail"]="fail";
         mysqli_close($connection);
        header("location:LogIn.php");

    }
}

?>




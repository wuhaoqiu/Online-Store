<?php
//更新用户，如果用户名或者邮箱已经存在，跳回customerpage并且提示用户名或邮箱已经存在，如果用户名没用过，则成功更新，然后依然跳转回customerpage
session_start();

if(!isset($_SESSION["username"])){
    header("location:LogIn.php"); 
}

//check the request method and store values
$security_question;
$answer;
$mailing_address;
$username;
$email;
$password;

$isValid=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["security_question"])&&isset($_POST["answer"])&&(trim($_POST["security_question"])!="")&&(trim($_POST["answer"])!="")&&isset($_POST["username"])&&isset($_POST["email"])&&(trim($_POST["username"])!="")&&(trim($_POST["email"])!="")&&isset($_POST["password"])&&(trim($_POST["password"])!="")&&isset($_POST["mailing_address"])&&(trim($_POST["mailing_address"])!="")){
        $security_question=trim($_POST["security_question"]);
        $answer=trim($_POST["answer"]);
        $mailing_address=trim($_POST["mailing_address"]);
        $username=trim($_POST["username"]);
        $email=trim($_POST["email"]);
        $password=trim($_POST["password"]);
            
        $isValid=true;
}//end of check whethter the security_question and key is empty
    else{
        echo "<p>some input contents are empy</p>";
    }
    }//end of check whtether send method is post
else{
        echo "<p>request method is wrong</p>";
}

//connecting to db;
include_once "dbconnection.php";

if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{
    //good connection, so do you thing
    $whetherexistuser=false;
    $sqlcheckuser = "SELECT uname,email FROM customer where uname=? or email=?;";
    if($stmtcheckuser=mysqli_prepare($connection,$sqlcheckuser)){
        $stmtcheckuser->bind_param("ss",$username,$email);
        mysqli_stmt_execute($stmtcheckuser);
        //traver the result returned by sql to chekc whtether exist the user
        while(mysqli_stmt_fetch($stmtcheckuser)){
            $whetherexistuser=true;
            break;
        }
        $stmtcheckuser->close();
        //if not exist user
        $rowname=$_SESSION["username"];
        if(!$whetherexistuser){
            $stmtupdateuser = mysqli_prepare($connection,"update customer set uname=?,password=?,email=?,securityQ=?,securityA=?,address=? where uname='".$rowname."'");
            $stmtupdateuser->bind_param('ssssss',$username,$password,$email,$security_question, $answer, $mailing_address);
            if (!$stmtupdateuser->execute()) { throw new Exception($stmtupdateuser->error);}
            //$stmtupdateuser->execute();
            echo "an account for ".$username." has benn updated.";
            unset($_SESSION["username"]);
            $_SESSION["username"]=$username;
            $stmtupdateuser->close();
            mysqli_close($connection);
            header("location:customerPage.php");
        }
        //if exit the current user
        else{
            $_SESSION["fail"]="fail";
            header("location:customerPage.php");
        }
    }  
    else
        echo die(mysqli_error($connection));

}

?>



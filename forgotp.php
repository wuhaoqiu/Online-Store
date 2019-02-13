<?php

session_start();

$username;
$email;

//check whther request method is expected
if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["username"])&&(trim($_POST["username"])!="")&&isset($_POST["email"])&&(trim($_POST["email"])!="")){
        $username=trim($_POST["username"]);
        $email=trim($_POST["email"]);    
            
        include"dbconnection.php";

        $sql="select uname,password,securityA from customer where email='".$email."' and uname='".$username."'";
        $isvalid=false;
        $query=mysqli_query($connection,$sql);
        while($row=mysqli_fetch_assoc($query)){
            echo "correct";
            $isvalid=true;
            $time=time();
            $token="Dear Customer,Your uname, security answer,passwrod are:".$row["uname"]." ".$row["securityA"]." ".$row["password"];
            
            include"smtp.class.php";
            $smtpserver="smtp.163.com";
            $smtpserverport=25;
            $smtpusermail="wuhaoqiu360@163.com";
            $smtpuser="wuhaoqiu360@163.com";
            $smtppass="whq123456";
            //login password is whq12345, autetication password is whq123456
            $smtp=new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
            $emailtype="HTML";
            $smtpemailto=$email;
            $smtpemailfrom=$smtpusermail;
            $emailsubject="forgot password";
            $emailbody=$token;
            $rs=$smtp->sendmail($smtpemailto,$smtpemailfrom,$emailsubject,$emailbody,$emailtype);

            if($rs==1){
                echo "send successfully";
                $_SESSION["success"]="success";
                header("location:forgotpform.php");
            }
            else{
                echo "your email address is not valid";
                $_SESSION["fail"]="success";
                header("location:forgotpform.php");
            }
        }
            if(!$isvalid){
                echo "fail";
                  $_SESSION["fail"]=fail;
         header("location:forgotpform.php");
            }
                               
}//end of check whethter the firstname and key is empty
    else{
        echo "<p>some input contents are empy</p>";
        $_SESSION["fail"]=fail;
         header("location:forgotpform.php");
    }
    }//end of check whtether send method is post
else{
        echo "<p>request method is wrong</p>";
}






?>
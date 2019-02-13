<?php
    $pid;
    $pname;
    $price;
    $alreadysold = 0;
    $category;
    $inventory;
    $pdes;
    
    $isValid = true;
    
    $target_dir = "images/product/";
$finalpath;
$uploadOk=1;

    session_start();
    //start of check files
if(($_FILES["userImage"]["error"]==UPLOAD_ERR_OK)){
    $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
        $finalpath=$target_file;
        echo "The file ". basename( $_FILES["userImage"]["name"]). " has been uploaded to ".$finalpath;
        //echo "<figure><img src=\"".$finalpath."\"/><br>";
    } else {
                          $_SESSION["fail"]="fail";
        echo "Sorry, there was an error uploading your file.";
    }
}
}//end of check uploaded file image
    
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $pid = $_POST["pid"];
        $pname = $_POST["pname"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $pdes = $_POST["pdes"];
        $inventory = $_POST["inven"];
        
    }else{
        $isValid = false;
    }
    
    if(empty($pid) || empty($pname)|| empty($price)||empty($category) ||empty($pdes) || empty($inventory)){
        $isValid = false;
    }else{
       if(!isset($pid) || !isset($pname)||!isset($price)||!isset($category)||!isset($pdes)|| !isset($inventory)){
        $isValid = false;
       }else{
           $isValid = true;
       } 
    } // end of validation
    
    if($isValid ){
        //upload file
        
        
       //connecting to db;
        include_once "dbconnection.php";
        
        if($error != null){
          $output = "<p>Unable to connect to database!</p>";
          exit($output);
                     $_SESSION["fail"]="fail";
         mysqli_close($connection);
        header("location:addProduct.php");
        }else{
            //good connection, then do check duplicate
            $exist=false;
            $sqlcheck = "SELECT pID, pname FROM product where pID=? or pname=?;";
             if($stmtcheck=mysqli_prepare($connection,$sqlcheck)){
                $stmtcheck->bind_param("ss",$pid,$pname);
                mysqli_stmt_execute($stmtcheck);
                //traver the result returned by sql to check whtether exist the product
                while(mysqli_stmt_fetch($stmtcheck)){
                    $exist=true;
                    break;
                }
                $stmtcheck->close();
              }
            if(!$exist && $uploadOk){
                // if not exist and upload success, insert the new product.
                $stmt = mysqli_prepare($connection,"INSERT INTO product (pID, pname, price, alreadysold, category, inventory, description, image) VALUES (?,?,?,?,?,?,?,?)");
                $stmt->bind_param('ssssssss',$pid, $pname,$price,$alreadysold,$category,$inventory,$pdes,$finalpath);
                $stmt->execute() or die("insert fail");
                echo "<p id='warn'>A new product ".$pname." is successfully added</p>";
                $stmt->close();
                  $_SESSION["success"]="success";
         mysqli_close($connection);
        header("location:addProduct.php");
            }
            else{
                echo '<p id="warn">The product already exists or fail to upload</p>';
                  $_SESSION["fail"]="fail";
         mysqli_close($connection);
        header("location:addProduct.php");
            }
        
        }
    }else{
        $_SESSION["fail"]="fail";
    }
?>
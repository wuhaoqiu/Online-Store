<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List All Customers</title>
    <link rel="stylesheet" type="text/css" href="css/whq.css">
    <script type="text/javascript" src="js/Manager.js"></script>
    <link rel="stylesheet" href="css/managerTables.css">
</head>
<body>
  <!--header-->
  <div class="navigation">
        <a class="brand">
            <img src="images/logo.png" alt="">
        </a>
<?php
        session_start();
        if(!isset($_SESSION["username"])){
            header("location:LogIn.php");
}
        if(isset($_SESSION["username"])){
            $username=$_SESSION["username"];
            $productList = null;
            $amount="";
        if (isset($_SESSION['productList'])){
            $productList = $_SESSION['productList'];
            $num=0;
            foreach ($productList as $id => $prod) {
                $num+=1;
            }
            $amount=$num;
        }
            echo"
        <a href=\"logout.php\">Logout</a>
        <div class=\"verticalline\"></div>
        <a href=\"cartcheckout.php\">".$username."'s Cart:".$amount."</a>";
            if(isset($_SESSION["administer"])){
                echo"<a href=\"manager.php\">Manager:".$username."</a>";
            }else{
                echo"<a href=\"customerPage.php\">Customer:".$username."</a>";
            }
        }else{
            //if not login,display login,sign up
            echo"<a href=\"SignIn.php\">Sign Up</a>
        <a href=\"LogIn.php\">Log In</a>
        <div class=\"verticalline\"></div>
        <a href=\"LogIn.php\">My Cart</a>";
        }
        //if not login, display login form
?>
        <div class="verticalline"></div>
        <div class="dropdown">
            <button class="dbutton">
                Pages&#9660;
            </button>
            <div class="dcontent">
                <a href="#">Contact Us</a>
                <a href="#">About Us</a>
                <a href="#">Blogs</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dbutton">
                Products&#9660;
            </button>
            <div class="dcontent">
                <a href="BrowsingPage.php?category=woman">Woman</a>
                <a href="BrowsingPage.php?category=woman">Man</a>
            </div>
        </div>
        <a href="mainpage.php">Home</a>
        <a href="BrowsingPage.php">Shop</a>
    </div>
  
  
  <!--form-->
  <div class="center">
   <?php
    //connect to database
    include_once "dbconnection.php";
    //bad connection
    if($error != null){
        echo "failed";
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    }else{
    //good connection
        $sql = "SELECT uname,email FROM customer";
        $result = $connection->query($sql);
    //out put data
        if($result->num_rows > 0){
            echo "<table><tr><th>Customer Name</th><th>Email</th></tr>";
            while($row = $result->fetch_assoc()){
                echo "<tr><td>".$row["uname"]."</td><td>".$row["email"]."</td></tr>";
            }
            echo "</table>";
        }else{
            echo "0 results";
        }
    //close the connection
    mysqli_close($connection);
    }
    ?>
    </div>
    <!--footer-->
<footer>
  <div class="footer">
      <div class="left1">
          <a class="brand">
              <img src="images/logo.png" alt="">
          </a>
          <p>18368497512</p>
          <p>whq672437089@outlook.com</p>
          <p>320 Mccurdy Road</p>
      </div>
      <div class="left2">
          <p>CATEGORIE</p>
          <a href="BrowsingPage.php?category=woman">Woman</a>
          <a href="BrowsingPage.php?category=man">Man</a>
          <a href="BrowsingPage.php">All</a>
      </div>
      <div class="left3">
          <p>INFORMATION</p>
          <a href="#footer">Contact Us</a>
          <a href="#footer">About Us</a>
          <a href="#footer">Blogs</a>
      </div>
      <div class="left4">
          <p>MY ACCOUNT</p>
     <a href="#footer">Contact Us</a>
                <a href="#footer">About Us</a>
                <a href="#footer">Blogs</a>
      </div>
      <div class="left5">
          <p>You can search products here</p>
          <form class="searchproduct" action="">
              <input type="text" placeholder="Search..." name="search_keyword" class="searchinput">
              <button type="submit">Search</button>
          </form>
      </div>
      <h2>footer</h2>
  </div>
</footer>
    
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Glass Store</title>
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/whq.css">
    <script src="js/whq.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />

</head>

<body>
    <!--   create the header-->
    <div class="header">
        <div class="headertext">
            <h1>Glass Store</h1>
            <span>A great collection of 600+ stylish and trendy</span>
            <!--        if later want to add button, can add here-->
        </div>
    </div>

    <!--    create navigation bar-->
    <div class="navigation">
        <a class="brand">
            <img src="images/logo.png" alt="">
        </a>
<?php
        session_start();
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
                <a href="#footer">Contact Us</a>
                <a href="#footer">About Us</a>
                <a href="#footer">Blogs</a>
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

    <!--    create the slideshow-->
    <div class="slideshow">
        <div class="slidepicture">
            <img style="max-width: 100%;max-height: 100%" src="images/main_banner1.jpg" alt="">
            <div class="text">Picture 1</div>
        </div>
        <div class="slidepicture">
            <img style="max-width: 100%;max-height: 100%" src="images/main_banner2.jpg" alt="">
            <div class="text">Picture 2</div>
        </div>

        <a href="#" class="prev">&#10094;</a>
        <a href="#" class="next">&#10095;</a>

        <div class="dots" style="text-align: center">
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>

    <!--        create content-->
    <div class="middlehead">
        <h2>Top Three Treanding Products</h2>
    </div>


    <div class="content">

<?php

include "dbconnection.php";
    //check whether connect successfully
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
    //if connect successfully then do
else
{
    $selectproduct="select * from product order by alreadysold desc, pname asc limit 3";
    if($resultofselectproduct=mysqli_query($connection,$selectproduct)){
        while($row=mysqli_fetch_assoc($resultofselectproduct)){
            //read each row by row
        echo " <div class=\"contentleft\">
        <img src=".$row["image"]." alt=\"\" class=\"image\">
        <div class=\"overlay overlayleft\">
            <div class=\"text\">Description:<br><br><a href='ProductPage.php?productid=".$row["pID"]."&pname=".$row["pname"]."&price=".$row["price"]."&ovrate=".$row["ovrate"]."&description=".$row["description"]."&image=".$row["image"]."&inventory=".$row["inventory"]."&alreadysold=".$row["alreadysold"]."'>".$row["description"]."</a></div>
        </div>
    </div>";
        }//end of while
    }//end of if not die
    else
        echo die(mysqli_error($connection));
    mysqli_close($connection);
}
?>
    </div>

        <div class="brandrow">
            <div class="item">
                <a href=""><img src="images/brand/brand1.png" alt=""></a>
            </div>
            <div class="item">
                <a href=""><img src="images/brand/brand2.png" alt=""></a>
            </div>
            <div class="item">
                <a href=""><img src="images/brand/brand3.png" alt=""></a>
            </div>
            <div class="item">
                <a href=""><img src="images/brand/brand4.png" alt=""></a>
            </div>
            <div class="item">
                <a href=""><img src="images/brand/brand5.png" alt=""></a>
            </div>

        </div>
        <!--create a footer-->
        <div class="footer">
            <div class="left1">
                <a class="brand">
                    <img src="images/logo.png" alt="">
                </a>
                <p>xxxxxxxx</p>
                <p>xxxxxx@outlook.com</p>
                <p>320 xxxxx Road</p>
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
                <a href="#">Check Out</a>
                <a href="#">Cart</a>
                <a href="#">My Account</a>
            </div>
            <div class="left5">
                <p>You can search products here</p>
                <form class="searchproduct" action="BrowsingPage.php">
                    <input type="text" placeholder="Search..." name="search_keyword" class="searchinput">
                    <button type="submit">Search</button>
                </form>
            </div>
            <h2>footer</h2>
        </div>
</body>
<script src="js/less.min.js" type="text/javascript"></script>

</html>

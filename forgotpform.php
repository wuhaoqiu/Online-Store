<!DOCTYPE html>
<!--




-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/customerpage.css">
    <script src="js/customerpage.js" type="text/javascript"></script>

</head>

<body>

    <div class="navigation">
        <a class="brand">
            <img src="images/logo.png" alt="">
        </a>
        <?php
        session_start();
        if(isset($_SESSION["username"])){
            header("location:mainpage.php");
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
                <a href="BrowsingPage.php?category=man">Man</a>
            </div>
        </div>
        <a href="mainpage.php">Home</a>
        <a href="BrowsingPage.php">Shop</a>
    </div>

    <div class="forgotp">
        <div id="forgotpform">
            <form name="forgotp" action="forgotp.php" method="post">
                <table>

                    <tr>
                        <th colspan="2">Input Your Email and Name</th>
                    </tr>

                    <tr id="user_name">
                        <td colspan="2">
                            <input type="text" name="username" placeholder="Username">
                        </td>
                    </tr>

                    <tr id="email">
                        <td colspan="2">
                            <input type="email" name="email" placeholder="Email (has to be a valid email address!)">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" value="get back password">
                        </td>
                    </tr>
                                    <?php

                    if(isset($_SESSION["fail"])){
                        echo"  <tr style=\" background-color: red;\">
                        <td colspan=\"2\">
                            UserName and Email Donot Match!
                        </td>
                    </tr>";
                        unset($_SESSION["fail"]);
                    }
                        if(isset($_SESSION["success"])){
                        echo"  <tr style=\" background-color: red;\">
                        <td colspan=\"2\">
                            Send successfully!
                        </td>
                    </tr>";
                        unset($_SESSION["success"]);
                    }
                    ?>
                     <tr>
                        <td>
                            <a href="mainpage.php">Return to MainPage</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>




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


    <!--    footer-->

</body>

</html>

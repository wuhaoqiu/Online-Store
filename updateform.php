<!DOCTYPE html>
<!--
update form



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
                <a href=BrowsingPage.php>Male</a>
                <a href="BrowsingPage.php">Female</a>
            </div>
        </div>
        <a href="mainpage.php">Home</a>
        <a href="BrowsingPage.php">Shop</a>
    </div>

    <div class="changeinformation">
        <div id="Signin">
            <form name="update information" action="Update.php" method="post">
                <table>

                    <tr>
                        <th colspan="2">Modify/Update Your Information</th>
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

                    <tr id="mailing_address">
                        <td colspan="2">
                            <input type="text" name="mailing_address" placeholder="Mailing Address">
                        </td>
                    </tr>

                    <tr id="security_question">
                        <td colspan="2">
                            <input type="text" name="security_question" placeholder="Security question?">
                        </td>
                    </tr>

                    <tr id="answer">
                        <td colspan="2">
                            <input type="text" name="answer" placeholder="Answer of Security question?">
                        </td>
                    </tr>

                    <tr id="pass_word">
                        <td colspan="2">
                            <input type="password" placeholder="Password (minimium 5 characters)" name="password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="password" placeholder="Please enter your passsword again" name="passwordB">
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <input type="submit" value="Update">
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <a href="customerPage.php">Return to Customer Page</a>
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
            <a href="#">Women</a>
            <a href="#">Men</a>
            <a href="#">General</a>
        </div>
        <div class="left3">
            <p>INFORMATION</p>
            <a href="#">Contact Us</a>
            <a href="#">About Us</a>
            <a href="#">Blogs</a>
        </div>
        <div class="left4">
            <p>MY ACCOUNT</p>
            <a href="#">Check Out</a>
            <a href="#">Cart</a>
            <a href="#">My Account</a>
        </div>
        <div class="left5">
            <p>You can search products here</p>
            <form class="searchproduct" action="">
                <input type="text" placeholder="Search..." name="search" class="searchinput">
                <button type="submit">Search</button>
            </form>
        </div>
        <h2>footer</h2>
    </div>


    <!--    footer-->

</body>

</html>

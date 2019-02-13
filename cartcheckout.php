<!DOCTYPE html>
<html lang="en">
<!--
该页面是购物车页面，用户可以增加减少商品，点击checkout会跳转到checkout.php页面进行付款
-->
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/cartCheckout.css">

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


    <div class="cartcheckout">
        <div class="container">
            <?php
// Get the current list of products
echo("<h1>Your Shopping Cart</h1>");
echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
echo("<th>Price</th><th>Subtotal</th><th></th><th></th><th></th></tr>");
if (isset($_SESSION['productList'])){
	$total =0;
    $amount=0;
	foreach ($productList as $id => $prod) {
		echo("<tr><td>". $prod['id'] . "</td>");
		echo("<td>" . $prod['name'] . "</td>");

		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
		$price = $prod['price'];

		echo("<td align=\"right\">".$price."</td>");
		echo("<td align=\"right\">" . $prod['quantity']*$price . "</td><td align=\"right\"><a href='addcart.php?id=".$prod["id"]."&quantity=1'>+</a></td><td align=\"right\"><a href='addcart.php?id=".$prod["id"]."&quantity=-1'>-</a></td><td align=\"right\"><a href='addcart.php?id=".$prod["id"]."&delete=1'>remove</a></td><td align=\"right\"><form method=\"get\" action=\"addcart.php\"><input type='hidden' name='id' value=".$prod['id']."><input type='number' min=1 name='update' value='update'><input type='submit' value='update'></td></form></tr>");
		echo("</tr>");
		$total = $total +$prod['quantity']*$price;
        $amount+=1;
	}
	echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"right\">".$total."</td></tr>");
}
else{
    echo("<tr><td colspan=\"5\" align=\"right\"><b>Your Cart Is Empty</b></td><td align=\"right\"></td></tr>");
}
    echo("<tr><td colspan=\"5\"><a href=\"checkout.php\">Check Out</a></td></tr>");echo("<tr><td colspan=\"5\"><a href=\"BrowsingPage.php\">Back to shopping</a></td></tr>");
    echo("</table>");
?>

                    <?php
                    if(isset($_SESSION["fail"])){
                        echo"  <table><tr style=\" background-color: red;\">
                        <td colspan=\"2\">
                            No Product!
                        </td>
                    </tr></table>";
                        unset($_SESSION["fail"]);
                    }
                    ?>
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
            <form class="searchproduct" action="BrowsingPage.php">
                <input type="text" placeholder="Search..." name="search_keyword" class="searchinput">
                <button type="submit">Search</button>
            </form>
        </div>
        <h2>footer</h2>
    </div>
</body>

</html>

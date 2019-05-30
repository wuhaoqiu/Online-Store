<!DOCTYPE html>
<html lang="en">
<!--
该页面会显示用户当前chekout的summary，包括每个商品和税收以及shipment费用，点击checkout把payment数据发送到order.php进行后续操作
-->
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/cartCheckout.css">
    <script src="js/cartCheckout.js" type="text/javascript"></script>

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
if(!isset($_SESSION["username"])){
            header("location:LogIn.php");
}
// Get the current list of products
if (isset($_SESSION['productList'])){
	echo("<div style='text-align:center;'><h1 style='font-size:32px;'>Your Summary</h1></div>");
	echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
	echo("<th>Price</th><th>Tax</th><th>Subtotal</th><th></th><th></th><th></th></tr>");

	$total =0;
    $amount=0;
	foreach ($productList as $id => $prod) {
		echo("<tr><td>". $prod['id'] . "</td>");
		echo("<td>" . $prod['name'] . "</td>");

		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
		$price = $prod['price'];

		echo("<td align=\"right\">".$price."</td>");
        echo("<td align=\"right\">".$price*0.1."</td>");
		echo("<td align=\"right\">" . $prod['quantity']*$price . "</td></tr>");
		echo("</tr>");
		$total = $total +$prod['quantity']*$price+$price*0.1;
        $amount+=1;
	}
    echo("<tr><td>  </td></tr><tr><td colspan=\"6\">  </td></tr><tr><td colspan=\"5\" align=\"right\"><b>Order Total</b></td><td align=\"right\">".$total."</td></tr>");
    echo("<tr><td colspan=\"5\" align=\"right\"><b>Shipping Cost</b></td><td align=\"right\">".$amount*1.2."</td></tr>");
	echo("</table>");

}
?>

        </div>





        <div class="container">
            <form action="order.php" method="post">

                <div class="row">

                    <h3>Payment</h3>
                    <label for="cname">Name on Card</label>
                    <input type="text" id="cname" name="cardname" placeholder="whq">
                    <label for="ccnum">Credit card number</label>
                    <input type="number" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                    <label for="expmonth">Exp Month</label>
                    <input type="number" id="expmonth" name="expmonth" min="1" max="12" placeholder="xx">
                    <label for="expyear">Exp Year</label>
                    <input type="number" id="expyear" name="expyear" min="2018" max="2100" placeholder="xxxx">
                    <label for="cvv">CVV</label>
                    <input type="number" id="cvv" name="cvv" min="0" max="999" placeholder="xxx">
                </div>
                <input type="submit" value="Continue to checkout" class="btn">
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
            <form class="searchproduct" action="BrowsingPage.php">
                <input type="text" placeholder="Search..." name="search_keyword" class="searchinput">
                <button type="submit">Search</button>
            </form>
        </div>
        <h2>footer</h2>
    </div>
</body>

</html>

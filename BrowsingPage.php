<!DOCTYPE html>
<html>
<head lang = "en">
  <meta charset = "utf-8" />
  <link rel = "stylesheet" href = "css/BrowsingPage.css" />
  <script type = "text/javascript" src = "js/BrowsingPage.js"> </script>
  <script type = "text/javascript" src = "js/ProductPage.js"></script>
  <title>Glass Shop</title>
</head>

<body>
  <header>
     <div class="navigation">
        <a class="brand">
            <img src="images/logo.png" alt="">
        </a>
<?php
// Checking user log in
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
                <a href="BrowsingPage.php?category=man">Man</a>
                <a href="BrowsingPage.php?category=woman">Woman</a>
            </div>
        </div>
        <a href="mainpage.php">Home</a>
        <a href="BrowsingPage.php">Shop</a>
    </div>
  </header>

  <?php
  // Connect to database and search for products by keyword / category
  include "dbconnection.php";
  if($error != null){
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }
  else{
    //Good connection to databse.
    $keyword = "";
    $category = "";
    $hasKeyword = false;
    $hasCategory = false;

    $sql = "";

    //Check which parameter is set
    if(isset($_GET['search_keyword'])){
      $hasKeyword = true;
      $keyword = $_GET['search_keyword'];
      $keyword = "%".$keyword."%";
      if(isset($_GET['category'])){
        // Both keyword and category are set
        $hasCategory = true;
        $category = $_GET['category'];
        $sql = "SELECT * FROM product WHERE pname LIKE ? AND category = ?";
        $sqlBrowsing = mysqli_prepare($connection, $sql);
        $sqlBrowsing->bind_param('ss', $keyword, $category);
      }
      else{
        // Only keyword is set
        $sql = "SELECT * FROM product WHERE pname LIKE ?";
        $sqlBrowsing = mysqli_prepare($connection, $sql);
        $sqlBrowsing->bind_param('s', $keyword);
      }
    }
    else{
      if(isset($_GET['category'])){
        // Only category is set
        $hasCategory = true;
        $category = $_GET['category'];
        $sql = "SELECT * FROM PRODUCT WHERE category = ?";
        $sqlBrowsing = mysqli_prepare($connection, $sql);
        $sqlBrowsing->bind_param('s', $category);
      }
      else{
        // None of the parameters is set
        $sql = "SELECT * FROM product";
        $sqlBrowsing = mysqli_prepare($connection, $sql);
      }
    }

    // Execute sql Query
    mysqli_stmt_bind_result($sqlBrowsing, $productID, $pname, $price, $alreadySold, $ovrate, $category, $inventory, $description, $image);
    $sqlBrowsing->execute();

   ?>

  <main>
    <div class = "category">
      <a href = "BrowsingPage.php">All Products</a>
      <span> / </span>
      <a href = "BrowsingPage.php?category=woman">Woman</a>
      <span> / </span>
      <a href = "BrowsingPage.php?category=man">Man</a>
    </div>

    <div class = "products-list">
      <table class = "products">

        <?php
        $count = 0;
      $hasproduct=false;
        while(mysqli_stmt_fetch($sqlBrowsing)){
          // List products
            $hasproduct=true;
          $count = $count + 1;
          if($count == 1) echo "<tr>";
          echo "<td><div>";
          echo "<div class = \"product-image\"><a href = \"ProductPage.php?productid=".$productID."\"><img class = \"product".$productID."\" alt = \"product ".$productID."\" src = \"".$image."\" /></a></div>";
          echo "<p class = \"product-name\"><a class = \"product".$productID."\" href = \"ProductPage.php?productid=".$productID."\">".$pname."</a></p>";
          echo "<p class = \"price\">$".$price."<p>";
          echo "</div></td>";

          if($count == 3){
            echo "</tr>";
            $count = 0;
          }
        }
        if($count != 3) echo "</tr>";
      if(!$hasproduct){
          echo "Not Found Related products";
      }
        ?>

      </table>
    </div>
  </main>
  <?php
$sqlBrowsing->close();
}
   ?>

  <footer id = "footer" >
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
              <a href="#">Check Out</a>
              <a href="#">Cart</a>
              <a href="#">My Account</a>
          </div>
          <div class="left5">
              <p>You can search products here</p>
              <form class="searchproduct" method = "GET" action="BrowsingPage.php">
                  <input type="text" placeholder="Search..." name="search_keyword" class="searchinput">
                  <button type="submit">Search</button>
              </form>
          </div>
          <h2>footer</h2>
      </div>
  </footer>

</body>
</html>

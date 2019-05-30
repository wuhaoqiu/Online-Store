<!DOCTYPE html>
<html>
<head lang = "en">
  <meta charset = "utf-8" />
  <link rel = "stylesheet" href = "css/ProductPage.css" />
  <!-- <script type = "text/javascript" src = "js/BrowsingPage.js"> </script>
  <script type = "text/javascript" src = "js/ProductPage.js"></script> -->
  <title>Gucci White Sunglasses Gold Cat Eye</title>
</head>

<body>
<header>
    <!--    create navigation bar-->
    <div class="navigation">
        <a class="brand">
            <img src="images/logo.png" alt="">
        </a>
<?php
//check if user logged in and show cart / logging in link.
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


<?php
// Read product info from database.
include "dbconnection.php";//here connection
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else{
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["productid"])){
      $id = (int) $_GET["productid"];   //Get product id
      $_SESSION["productid"] = $id;
    }
  }
  //Query for product
  $stmtproductquery = mysqli_prepare($connection,"select * from product where pid=?");
  $stmtproductquery->bind_param('s', $id);
  mysqli_stmt_bind_result($stmtproductquery,$productID, $pname, $price, $alreadySold, $ovrate, $category, $inventory, $description, $image);
  $stmtproductquery->execute();
  while(mysqli_stmt_fetch($stmtproductquery)){


// Read product info from txt file
// if($_SERVER["REQUEST_METHOD"] == "GET"){
//      if(isset($_GET["productid"])){
//        $id = $_GET["productid"];   //Get product id
//      }
//    }
//
// $file = file("Products.txt") or die('ERROR: Cannot find file');
// $delimiter = ',';
//
// foreach($file as $product){
//   $productFields = explode($delimiter, $product);
//
//   $id = $productFields[0];
//
//   if($id == $id){
//     $_curname = $productFields[1];
//     $_curprice = $productFields[2];
//     $_picture1 = $productFields[3];
//     $_picture2 = $productFields[4];
//     $_curintro = $productFields[5];
//     break;
//   }
// }
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
<main>
  <div class = "product">
  <div id = "ProductImage">
    <div class = "largeImage">
      <?php
      // echo "<img alt = \"".$_curname."\" src = \"".$_picture1 ."\" />";
      echo "<img alt = \"".$pname."\" src = \"".$image ."\" />";
      ?>
    </div>
</div>

<div class = "ProductInfo">
  <div id = "ProductTitle">
    <?php
    // echo "<p>".$_curname."</p>";
    echo "<p>".$pname."</p>";
    ?>
  </div>
  <div id = "ProductPrice">
    <?php
    // echo "<p>".$_curprice."</p>";
    echo "<p>$".$price."</p>";
    echo "<p>Rating: ".$ovrate." / 5</p>";
    echo "<p>".$alreadySold." sold, ".$inventory." left.</p>";
    ?>
  </div>
  <div id = "AddToCart">

<!--  别用button，用下面这个超链接的形式
同时，在该页面开头，用session【username】判断是否登录，若登录，则超链接如下，若没登录，则下面超链接换成登录页面的地址login.php
-->
    <?php
    if(isset($_SESSION["username"])){
      echo "<a href='addcart.php?id=".$productID."&name=".urlencode($pname)."&price=".$price."'>Add To Cart</a>";
    }else{
      echo "<a href=\"LogIn.php\">Add To Cart</a>";
    }
      ?>
  </div>
  <div id = "ProductIntro">
    <?php
    // echo "<p>".$_curintro."</p>";
    echo "<p>".$description."</p>" ;
    ?>
  </div>

  <?php
 }//end of while loop
     $stmtproductquery->close(); ?>

</div>
</div>

<div id = "all-reviews">
  <p id = "review-title">Customer Reviews

    <?php
    // Go to write review section if useer is logged in, otherwise go to log in page.
    if(isset($_SESSION["username"])){
      echo "<a id = \"new-review\" href = \"#write-review\">Review this product (Login required)</a>";
    }else{
      echo "<a id = \"new-review\" href = \"LogIn.php\">Review this product (Login required)</a>";
    }
    ?>
  </p>

<!--  Query for reviews on this product -->
<?php
   $stmtreviewquery = mysqli_prepare($connection,"select * from comment where pid=?");
   $stmtreviewquery->bind_param('s', $id);
   mysqli_stmt_bind_result($stmtreviewquery,$date, $rating, $comment, $pid, $uname);
   $stmtreviewquery->execute();
   while(mysqli_stmt_fetch($stmtreviewquery)){
 ?>
 <!-- One div for each review -->
  <div class = "customer-review">
    <p class = "customer-info">
      <img class = "customer-picture" alt = "user" src = "images/user.jpg" />
      <!-- <span class = "User-name"><span>A User</span></span> -->
      <?php
      echo "<span class = \"User-name\"><span>".$uname."</span></span>";
      ?>
    </p>
    <div class = "review-content">
      <p class = "review-overview">
        <?php
        echo "<span class = \"review-time\">".$date."</span>";
        echo "<span class = \"rating\">Rating: ".$rating." / 5</span>";
        ?>
      </p>
        <?php
        echo "<p class = \"review\">".$comment."</p>";
        ?>
    </div>
    <?php
  } // end of while
         $stmtreviewquery->close();
     ?>
  </div>

  <div id="write-review">
    <form id ="write-review-form" method = "POST" action = "addreview.php"  >
    <p>
      <input id ="write-review-input" name = "comment" type="text" />
    </p>
    <p>Rate this product (0-5):
      <input id = "write-review-rating" name = "rating" type = "number" min = "0" max = "5" />
    </p>
      <!-- <button type = "submit" id = "write-review-submit">Submit Review</button> -->
      <?php
      // Submit review if useer is logged in, otherwise go to log in page.
      if(isset($_SESSION["username"])){
        // Check if user has purchased this product
        $uname = $_SESSION["username"];
        $productID = $_SESSION["productid"];
        $purchased = false;
        $sqlpurchased = mysqli_prepare($connection, "SELECT pID FROM orderedproduct WHERE uname = ? AND pID = ?");
        $sqlpurchased->bind_param('ss', $uname, $productID);
        $sqlpurchased->execute();
        while(mysqli_stmt_fetch($sqlpurchased)){
            $purchased = true;
            break;
        }

        $sqlpurchased->close();
        if($purchased){
          // Check if user has already submitted a review
          $reviewed = false;
          $sqlreviewed = mysqli_prepare($connection, "SELECT pid FROM comment WHERE uname=? AND pid=?");
          $sqlreviewed->bind_param('ss', $uname, $productID);
          $sqlreviewed->execute();
          while(mysqli_stmt_fetch($sqlreviewed)){
            $reviewed = true;
          }
          if(!$reviewed){
            // Allow user to submit the review
            echo "<button type = \"submit\" class = \"write-review-submit\">Submit Review</button>";
          }
          else{
            // User has reviewed this product
            echo "<p class = \"write-review-submit\">You have already reviewed this product.</p>";
          }
          $sqlreviewed->close();
        }
        else{
          // User has not purchased this product before.
          echo "<p class = \"write-review-submit\">You have to purchase this product before you can write a review.</p>";
        }
      }
      else{
        // Not logged in.
        echo "<a class = \"write-review-submit\" href = \"LogIn.php\">Login before reviewing product</a>";
      }

      ?>
    </form>
  </div>
</div>
</main>

<?php
}// end of else; close database connection.
 ?>

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
</footer>
</body>

</html>

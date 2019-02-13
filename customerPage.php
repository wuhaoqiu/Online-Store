<!DOCTYPE html>
<!--
先显示个人信息和order信息，80~183 数据库是开启状态。 然后security question把input 再传给自己，然后验证是否是正确答案，如果是正确答案，则出现update表格，发给update.php 去 update数据库， 若uodate的数据不符合要求，则通过session【‘fail’】来显示提示信息“update fail”



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
                <a href="BrowsingPage.php?category=woman">Woman</a>
                <a href="BrowsingPage.php?category=man">Man</a>
            </div>
        </div>
        <a href="mainpage.php">Home</a>
        <a href="BrowsingPage.php">Shop</a>
    </div>
    <!--    customer content-->
    <?php

    //connecting to db;
include "dbconnection.php";//here connection
if(!isset($_SESSION["username"])){
            header("location:LogIn.php");
}

if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else{
    //good connection
    $whethervaliduser=false;
    $stmtcheckusername = mysqli_prepare($connection,"select * from customer where uname=?");
    $stmtcheckusername->bind_param('s', $username);
    mysqli_stmt_bind_result($stmtcheckusername,$username,$password,$email,$securityq,$securitya,$address);
    $stmtcheckusername->execute();
    while(mysqli_stmt_fetch($stmtcheckusername)){

?>
    <div class="customercontent">
        <div class="basicinformation">
            <table>
                <tr>
                    <th colspan="6">Profile Information</th>
                </tr>
                <tr class="uname">
                    <th colspan="5">UserName:
                        <?php echo $username; ?>
                    </th>
                </tr>
                <tr class="email">
                    <td colspan="4">Email:</td>
                    <td>
                        <?php echo $email; ?>
                    </td>
                </tr>
                <tr class="address">
                    <td colspan="4">Address:</td>
                    <td>
                        <?php echo $address; ?>
                    </td>
                </tr>
            </table>
            <?php
                                }//end of query for submitted username and password
                    $stmtcheckusername->close();
}
                    if(isset($_SESSION["fail"])){
                        echo"  <table><tr style=\" background-color: red;\">
                        <td colspan=\"2\">
                            UserName or email has existed!Update Fail!
                        </td>
                    </tr></table>";
                        unset($_SESSION["fail"]);
                    }
?>

        </div>
        <!--        end of basic information div-->

        <div class="orderhistory">

            <table>
                <?php

    //check whether connect successfully
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
    //if connect successfully then do
else
{
    $selectorderid="select oID,uname,orderstatus,totalamount from orders where uname='".$username."' order by orderstatus asc, oID asc";
    if($resultofselectorderid=mysqli_query($connection,$selectorderid)){
        //if there there reeturns some results
        echo "<table border=\"1\">";
?>
                <tr>
                    <td>oid</td>
                    <td>uname</td>
                    <td>status</td>
                    <td>amount</td>
                </tr>
                <?php
        while($row=mysqli_fetch_assoc($resultofselectorderid)){
            //read each row by row
        echo"<tr><td>".$row["oID"]."</td><td>".$row["uname"]."</td><td>".$row["orderstatus"]."</td><td>".$row["totalamount"]."</td></tr>";
        $selectproducts=mysqli_prepare($connection,"select * from orderedproduct where oID=? and uname='".$username."'");
        $selectproducts->bind_param('s', $row["oID"]);
        mysqli_stmt_bind_result($selectproducts,$productId,$orderId,$uname,$quantity,$price);
        $selectproducts->execute();
        echo "<tr align=\"right\">
        <td colspan=\"4\">
        <table border=\"1\">
        <tr><td>productID</td>
        <td>quantity</td>
        <td>price</td></tr>";
        while(mysqli_stmt_fetch($selectproducts)){
        echo "
        <tr><td>".$productId."</td>
        <td>".$quantity."</td>
        <td>".$price."</td></tr>";

    }//end of while
            echo" </table>
       </td>
    </tr>";
        }//end of while
        echo "</table>";
    }//end of ifdie
    else
        echo die(mysqli_error($connection));

    mysqli_close($connection);

}//end of else


?>
            </table>

        </div>

        <!--        security question to read more informaiton-->
        <div class="securesection">
            <table>
                <form name="securityquestion" action="customerPage.php" method="post">
                    <tr>
                        <td>Answer Question to Update Information and Check Order History</td>
                    </tr>
                    <tr>
                        <td>
                            Question:
                            <?php echo $securityq; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="securityquestionanswer" placeholder="answer">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="submit answer">
                        </td>
                    </tr>


                </form>
            </table>
        </div>

    </div>

    <?php
    if(isset($_POST["securityquestionanswer"]))
        $correctanswer=$_POST["securityquestionanswer"];
    else
        $correctanswer=null;
    if($correctanswer==$securitya)
        {
    ?>
    <div class="changeinformation">

        <table>
            <tr>
                <td><a href="updateform.php">UpdateForm</a></td>
            </tr>
        </table>

    </div>



    <?php

    }
    else{
        echo $correctanswer."error";
    }

    ?>

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


    <!--    footer-->

</body>

</html>

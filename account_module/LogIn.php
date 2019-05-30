<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="css/LogIn.css">
</head>

<body>
    <img src="images/LogIn.jpg" alt="LogIn photo">


    <div id="LogIn">


        <form action="processlogin.php" method="post">
            <table>
                <tr>
                    <th>Log In</th>
                </tr>

                <tr id="user_name">
                    <td colspan="2">
                        <input type="text" name="username" placeholder="User name">
                    </td>
                </tr>

                <tr id="pass_word">
                    <td colspan="2">
                        <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="checkbox" name="administer" value="administer">
                    </td>
                    <td>Administer</td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Log In">
                    </td>
                </tr>

                <?php
                    session_start();
                       
        if(isset($_SESSION["username"])){
            header("location:mainpage.php"); 
}
                    if(isset($_SESSION["fail"])){
                        echo"  <tr style=\" background-color: red;\">
                        <td colspan=\"2\">
                            UserName and Password Donot Match!
                        </td>
                    </tr>";
                        unset($_SESSION["fail"]);
                    }
                    ?>



                <tr>
                    <td>
                        <p>or create an account </p>
                    </td>
                    <td>
                        <a href="SignIn.php">sign in</a>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <p>or forgot password </p>
                    </td>
                    <td>
                        <a href="forgotpform.php">Get back password</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <a href="mainpage.php" id="back">Back to mainpage</a>

    <script type="text/javascript" src="js/LogIn.js"></script>

</body>

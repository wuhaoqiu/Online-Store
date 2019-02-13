<!DOCTYPE html>
<!--
注册用户界面，如果用户名或者邮箱已经存在，则根据session【fail】出现错误提示信息
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/SignIn.css">
</head>
    <body>
       <img src="images/Sign%20UP.jpeg" alt="Signup">
        <div id="Signin">
            <form action="newuser.php" method="post">
                <table>
                  
                   <tr>
                      <th>Sign In</th> 
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
                            <input type="password" placeholder="Password (minimium 5 characters)"
                            name="password">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="password" placeholder="Please enter your passsword again"
                            name="passwordB">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input type="submit" value="Sign In">
                        </td>
                    </tr>
                    
                    <?php
                    session_start();
                    if(isset($_SESSION["fail"])){
                        echo"  <tr style=\" background-color: red;\">
                        <td colspan=\"2\">
                            UserName or email has existed!
                        </td>
                    </tr>";
                        unset($_SESSION["fail"]);
                    }
                    ?>
                    
                    <tr>
                        <td>
                            <p>Already have an account? </p>
                        </td>
                        <td>
                            <a href="LogIn.php">Log in</a>
                        </td>
                    </tr>
                </table>
            </form>  
        </div>
        
        <a href="mainpage.php" id="back">Back to mainpage</a>
    
        <script type="text/javascript" src="js/Sign.js"></script>
    </body>
    
</html>
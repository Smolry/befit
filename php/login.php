<?php
include 'dbconn.php';
if($conn=true)
{
    echo "Connected successfully";


}
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconn.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
     
    $sql = "SELECT `username`, `password` FROM `users` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: home.php");

    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/personalization/cl2/freeform/WebsiteDetect?source=wwwhead&amp;fetchType=css&amp;modalView=nmLanding" data-uia="botLink">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="background">
        <img scr="bg.png">
    </div>
    <div class="story_card">
        <h1 class="h1">Login</h1>
        
       
        <form method="post" class="search_form" >
            <div class="search">
                <ul>
                    <li><h3 class="h2">Username</h3></li>
                    <li>
                        <input type="text"  class="search_box"name="username" placeholder="Enter username" value tabindex="0" maxlength="50" id="username" required></input>
                    </li>
                    <li>
                        <h3 class="h3">Password</h3>
                    </li>
                    <li>
                        <input type="password" class="search_box" name="password" placeholder="Enter password" value tabindex="0" maxlength="50" id="password" required></input>
                    </li>
                    <li><div class="search_btn_content">
                        <span class="search_btn_content"><button type="submit">Submit</button></span>
                        <i class="ri-send-plane-2-line"></i>
                        </div>
                    </li>
                    <li><div class="not_a_member?">
                        <h2 class="h2" ><a href="register.php">not a member?</a></h2>
                    </div>
                    </li>
                </ul>
                
            </div>
        </form>
    </div>
</body>
</html>
<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconn.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists=false;
    // Check if username is empty
    if(empty(trim($username))or empty($password)){
        $showError=true;
    }
    if((trim($password) == trim($cpassword)) && $exists==false){
        $sql = "INSERT INTO `users`( `username`, `password`, `created_at`) VALUES ('$username', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
            header("location: login.php");
            exit;
        }
    }
    else{
        $showError = "Passwords do not match";
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
    <title>Registration</title>
</head>
<body>
    <?php
    if($showAlert){
        echo" your account has been created.
    ";
    }
    if($showError){
        echo"error!.$showError
        ";
    }
    ?>
    <div class="background">
        <img scr="bg.png">
    </div>
    <div class="story_card">
        <h1 class="h1">Signup</h1>
        <h2 class="h2">Username</h2>
       
        <form method="POST" class="search_form" >
            <div class="search">
                <ul>
                    <li>
                        <input type="text"  class="search_box"name="username" placeholder="Enter username" value tabindex="0" maxlength="50"></input>
                    </li>
                    <li>
                        <h3 class="h3">Password</h3>
                    </li>
                    <li>
                        <input type="password" class="search_box" name="password" placeholder="Enter password" value tabindex="0" maxlength="50"></input>
                    </li>
                    <li>
                        <h3 class="h3">Confirm password</h3>
                    </li>
                    <li>
                        <input type="password" class="search_box" name="cpassword" placeholder="Confirm password" value tabindex="0" maxlength="50"></input>
                    </li>
                    <li><div class="search_btn_content">
                        <span class="search_btn_content"><button type="submit">Submit</button></span>
                        <i class="ri-send-plane-2-line"></i>
                        </div>
                    </li>
                </ul>
                
            </div>
        </form>
    </div>
</body>
</html>
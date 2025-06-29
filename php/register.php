<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        die("Username and password cannot be empty.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        // Redirect without output before
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
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

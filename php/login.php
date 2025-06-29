<?php
/* --------  CONFIG & SESSION  -------- */
require_once 'dbconn.php';          // your improved connector
session_start();

/* --------  HANDLE POST  -------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. sanitize
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. quick validation
    if ($username === '' || $password === '') {
        $error = 'Username and password are required.';       // shown later
    } else {
        // 3. prepared statement
        $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            // 4. username found?
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($uid, $hashedPwd);
                $stmt->fetch();

                // 5. verify hash
                if (password_verify($password, $hashedPwd)) {
                    /* ---- SUCCESS ---- */
                    session_regenerate_id(true);              // session‑fixation defence
                    $_SESSION['loggedin'] = true;
                    $_SESSION['uid']      = $uid;
                    $_SESSION['username'] = $username;
                    header('Location: home.php');
                    exit;
                }
            }
            /* --- Either username not found or hash failed --- */
            $error = 'Incorrect username or password.';
        } else {
            // dev‑time message only
            error_log('Login prepare failed: ' . $conn->error);
            $error = 'Server error. Try again later.';
        }
    }
}
?>
<!-- ----------  SIMPLE FORM  ---------- -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login – BeFit</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="story_card">
    <h1 class="h1">Sign in</h1>

    <?php if (isset($error)) echo "<p style='color:#e50914'>$error</p>"; ?>

    <form method="post">
      <input class="search_box" name="username" placeholder="Username" required>
      <br><br>
      <input type="password" class="search_box" name="password" placeholder="Password" required>
      <br><br>
      <button class="search_btn_content" type="submit">Log in</button>
    </form>

    <p style="margin-top:1rem;">No account?
       <a href="register.php" class="search_btn_content" style="text-decoration:none;">Sign up →</a>
    </p>
  </div>
</body>
</html>

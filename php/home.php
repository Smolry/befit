<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$plan = "Not Selected";
$successMessage = "";

// Handle plan update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_plan'])) {
    $newPlan = trim($_POST['new_plan']);

    // Optional: validate against allowed plans
    $allowedPlans = ['Basic', 'Premium', 'Pro'];
    if (in_array($newPlan, $allowedPlans)) {
        $stmt = $conn->prepare("UPDATE users SET plan = ? WHERE username = ?");
        $stmt->bind_param("ss", $newPlan, $username);
        if ($stmt->execute()) {
            $successMessage = "Plan updated successfully!";
            $plan = $newPlan; // update local value too
        }
        $stmt->close();
    }
}

// Fetch current plan
$stmt = $conn->prepare("SELECT plan FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($fetchedPlan);
if ($stmt->fetch() && !empty($fetchedPlan)) {
    $plan = $fetchedPlan;
}
$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fitness Gym Website</title>

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />

    <!-- bootstrap cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style_home.css" />
  </head>
  <body>
    <!-- header section starts  -->

    <header class="header fixed-top">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <a href="#" class="logo"><span>BE</span>FIT,<?php echo "Welcome ". $_SESSION['username']?></a>

          <nav class="nav">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#courses">courses</a>
            <a href="#pricing">pricing</a>
            <a href="#team">team</a>
            <a href="#blogs">blogs</a>
            <a href="logout.php">logout</a>

          </nav>

          <div id="menu-btn" class="fas fa-bars"></div>
        </div>
      </div>
    </header>

    <!-- header section ends -->

    <!-- home section starts  -->
    <section class="home" id="home">
  <div class="container">
    <div class="row align-items-center min-vh-100">
      <div class="col-md-6">
        <img src="images/home-img.png" class="w-100" alt="" />
      </div>
      <div class="col-md-6 text-center text-md-left">
        <span>back to the gym</span>
        <h3>start your fitness journey today</h3>
        <div class="story_card" style="background:rgba(255,255,255,0.05);padding:2rem;border-radius:1rem;margin-top:2rem;">
          <h1 class="h1">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
          <p>Your current plan: <strong><?php echo htmlspecialchars($plan); ?></strong></p>
          <p>Change your membership plan:</p>
          <form method="post">
            <select name="new_plan" class="search_box" required>
              <option value="">-- Select Plan --</option>
              <option value="Basic" <?php if ($plan == 'Basic') echo 'selected'; ?>>Basic</option>
              <option value="Premium" <?php if ($plan == 'Premium') echo 'selected'; ?>>Premium</option>
              <option value="Pro" <?php if ($plan == 'Pro') echo 'selected'; ?>>Pro</option>
            </select>
            <br><br>
            <button type="submit" class="search_btn_content">Update Plan</button>
          </form>
          <?php if (!empty($successMessage)) : ?>
            <p class="success-message"><?php echo htmlspecialchars($successMessage); ?></p>
          <?php endif; ?>
          <form method="post" action="logout.php">
            <button class="search_btn_content" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- home section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">
      <div class="container">
        <div class="row align-items-center flex-wrap-reverse">
          <div class="col-md-6">
            <span>about us</span>
            <h3>Daily Workout and Stay Active at Home</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus
              quae inventore molestiae accusamus facere ducimus, magni quidem
              cumque debitis sed beatae totam, culpa dolore voluptatum incidunt
              hic quia, mollitia fugit?
            </p>
            <ul>
              <li>
                <i class="far fa-check-square"></i> How to Support your Immume
                System
              </li>
              <li>
                <i class="far fa-check-square"></i>A Guide to 30 Day Fitness &
                Workout Challenges
              </li>
              <li>
                <i class="far fa-check-square"></i>Guide To Ease Your Back In
                The Gym
              </li>
              <li>
                <i class="far fa-check-square"></i>The Mental Health Benefits of
                Exercise in Home
              </li>
            </ul>
          </div>

          <div class="col-md-6">
            <img src="images/about-img.png" class="w-100" alt="" />
          </div>
        </div>
      </div>
    </section>

    <!-- about section ends -->

    <!-- counter section starts  -->

    <section class="counter">
      <div class="container box-container">
        <div class="box">
          <h3>40+</h3>
          <p>online courses</p>
        </div>

        <div class="box">
          <h3>320+</h3>
          <p>gym equipments</p>
        </div>

        <div class="box">
          <h3>180+</h3>
          <p>online instructors</p>
        </div>

        <div class="box">
          <h3>560+</h3>
          <p>satiesfied clients</p>
        </div>
      </div>
    </section>

    <!-- counter section ends -->

    <!-- courses section starts  -->

    <section class="courses" id="courses">
      <div class="heading">
        <span>our courses</span>
        <h3>our latest courses</h3>
      </div>

      <div class="box-container container">
        <div class="box">
          <div class="image">
            <img src="images/img-1.jpg" alt="" />
          </div>
          <div class="content">
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> mon - sat </span>
              <span> <i class="fas fa-clock"></i> 1 hours </span>
            </div>
            <h3>weight lifting and diet planing classes</h3>
            <a href="#" class="link-btn">read more</a>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-2.jpg" alt="" />
          </div>
          <div class="content">
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> mon - sat </span>
              <span> <i class="fas fa-clock"></i> 1 hours </span>
            </div>
            <h3>weight lifting and diet planing classes</h3>
            <a href="#" class="link-btn">read more</a>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-3.jpg" alt="" />
          </div>
          <div class="content">
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> mon - sat </span>
              <span> <i class="fas fa-clock"></i> 1 hours </span>
            </div>
            <h3>weight lifting and diet planing classes</h3>
            <a href="#" class="link-btn">read more</a>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-4.jpg" alt="" />
          </div>
          <div class="content">
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> mon - sat </span>
              <span> <i class="fas fa-clock"></i> 1 hours </span>
            </div>
            <h3>weight lifting and diet planing classes</h3>
            <a href="#" class="link-btn">read more</a>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-5.jpg" alt="" />
          </div>
          <div class="content">
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> mon - sat </span>
              <span> <i class="fas fa-clock"></i> 1 hours </span>
            </div>
            <h3>weight lifting and diet planing classes</h3>
            <a href="#" class="link-btn">read more</a>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-6.jpg" alt="" />
          </div>
          <div class="content">
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> mon - sat </span>
              <span> <i class="fas fa-clock"></i> 1 hours </span>
            </div>
            <h3>weight lifting and diet planing classes</h3>
            <a href="#" class="link-btn">read more</a>
          </div>
        </div>
      </div>
    </section>

    <!-- courses section ends -->

    <!-- pricint section starts  -->

    <section class="pricing" id="pricing">
      <div class="heading">
        <?php
        $username=$_SESSION['username'];
        $sql="SELECT `plan` FROM `users` WHERE username='$username'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        #echo $row['plan'];
        if ($row['plan']==0){
          echo
          '
          <span>choose a plane</span>
        <h3>find a perfect plan</h3>
          
          ';
        }
        elseif($row['plan']==1){
          echo'
          <span>Your current plan</span>
          <h3>Basic</h3>
          ';
        }
        elseif($row['plan']==2){
          echo'
          <span>Your current plan</span>
          <h3>premium</h3>
          ';
        }
        elseif($row['plan']==3){
          echo'
          <span>Your current plan</span>
          <h3>Ultimate</h3>
          ';
        }
        ?>
        
      </div>
      <?php
      
      if($row['plan']==0){
        
        echo'

      <div class="box-container container">
        <div class="box">
          <h3>basic plan</h3>
          <div class="price"><span>Rs</span>1500<span>/mo</span></div><form method="post" value="submit1">
          <button class="link-btn" name="action" value="submit">choose the plan</button></form>
          <div class="list">
            <p><i class="fas fa-check"></i> personal training</p>
            <p><i class="fas fa-check"></i> classes per week</p>
            <p><i class="fas fa-check"></i> access to gym</p>
            <p><i class="fas fa-times"></i> protien powder</p>
            <p><i class="fas fa-times"></i> membership</p>
          </div>
        </div>

        <div class="box">
          <h3>premium plan</h3>
          <div class="price"><span>Rs</span>2500<span>/mo</span></div>
          <button class="link-btn" onclick="plan_subscribe(2)">choose the plan</button>
          <div class="list">
            <p><i class="fas fa-check"></i> personal training</p>
            <p><i class="fas fa-check"></i> classes per week</p>
            <p><i class="fas fa-check"></i> access to gym</p>
            <p><i class="fas fa-check"></i> protien powder</p>
            <p><i class="fas fa-times"></i> membership</p>
          </div>
        </div>

        <div class="box">
          <h3>ultimate plan</h3>
          <div class="price"><span>Rs</span>3500<span>/mo</span></div>
          <button class="link-btn" onclick="plan_subscribe(3)">choose the plan</button>
          <div class="list">
            <p><i class="fas fa-check"></i> personal training</p>
            <p><i class="fas fa-check"></i> classes per week</p>
            <p><i class="fas fa-check"></i> access to gym</p>
            <p><i class="fas fa-check"></i> protien powder</p>
            <p><i class="fas fa-check"></i> membership</p>
          </div>
        </div>
      </div>
      ';}
      if ($row['plan']==1){
        echo'
        <div class="box-container container">
        <div class="box">
          <h3>basic plan</h3>
          <a href="#" class="link-btn">Activate</a>
          <div class="list">
            <p><i class="fas fa-check"></i> personal training</p>
            <p><i class="fas fa-check"></i> classes per week</p>
            <p><i class="fas fa-check"></i> access to gym</p>
            <p><i class="fas fa-times"></i> protien powder</p>
            <p><i class="fas fa-times"></i> membership</p>
          </div>
        </div>
        </div>
        ';

      }
      if ($row['plan']==2){
        echo'
        <div class="box-container container">
        <div class="box">
          <h3>premium plan</h3>
          <div class="price"><span>Rs</span>2500<span>/mo</span></div>
          <a href="#" class="link-btn">choose the plan</a>
          <div class="list">
            <p><i class="fas fa-check"></i> personal training</p>
            <p><i class="fas fa-check"></i> classes per week</p>
            <p><i class="fas fa-check"></i> access to gym</p>
            <p><i class="fas fa-check"></i> protien powder</p>
            <p><i class="fas fa-times"></i> membership</p>
          </div>
        </div>
        </div>
        ';
      }
      if ($row['plan']==3){
        echo'
        <div class="box-container container">
        <div class="box">
          <h3>ultimate plan</h3>
          <div class="price"><span>Rs</span>3500<span>/mo</span></div>
          <a href="#" class="link-btn">choose the plan</a>
          <div class="list">
            <p><i class="fas fa-check"></i> personal training</p>
            <p><i class="fas fa-check"></i> classes per week</p>
            <p><i class="fas fa-check"></i> access to gym</p>
            <p><i class="fas fa-check"></i> protien powder</p>
            <p><i class="fas fa-check"></i> membership</p>
          </div>
        </div>
        </div>
        ';
      }
      ?>
    </section>

    <!-- pricint section ends -->

    <!-- join us section starts  -->

    <section class="join">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7">
            <img src="images/join-us-image.png" class="w-100" alt="" />
          </div>
          <div class="col-md-5 text-center text-md-left">
            <span>join us now</span>
            <h3>join us & get upto 50% off</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error
              sint aut alias eligendi odit repudiandae laudantium voluptates
              quos officia quis?
            </p>
            <button class="link-btn"  id="open-btn" >
              join now
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- join us section ends -->

    <!-- team section starts  -->

    <section class="team" id="team">
      <div class="heading">
        <span>our team</span>
        <h3>meet the expert team</h3>
      </div>

      <div class="box-container container">
        <div class="box">
          <img src="images/Trainer1.jpg" alt="" />
          <div class="content">
            <span>gym trainer</span>
            <h3>Sonam</h3>
          </div>
          <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a
              href="#"
              class="fab fa-instagram"
            ></a>
            <a
              href="#"
              class="fab fa-linkedin"
            ></a>
          </div>
        </div>

        <div class="box">
          <img src="images/trainer2.jpg" alt="" />
          <div class="content">
            <span>gym trainer</span>
            <h3>Sunil</h3>
          </div>
          <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a
              href="#"
              class="fab fa-instagram"
            ></a>
            <a
              href="#"
              class="fab fa-linkedin"
            ></a>
          </div>
        </div>

        <div class="box">
          <img src="images/trainer3.jpg" alt="" />
          <div class="content">
            <span>gym trainer</span>
            <h3>Prashant</h3>
          </div>
          <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="fab fa-instagram" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
          </div>
        </div>
      </div>
    </section>

    <!-- team section ends -->

    <!-- blogs section starts  -->

    <section class="blogs" id="blogs">
      <div class="heading">
        <span>our blogs</span>
        <h3>our daily posts</h3>
      </div>

      <div class="box-container container">
        <div class="box">
          <div class="image">
            <img src="images/img-1.jpg" alt="" />
          </div>
          <div class="content">
            <a href="#" class="link"
              >Make yourself stronger than your excuses.</a
            >
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-2.jpg" alt="" />
          </div>
          <div class="content">
            <a href="#" class="link"
              >Make yourself stronger than your excuses.</a
            >
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/img-3.jpg" alt="" />
          </div>
          <div class="content">
            <a href="#" class="link"
              >Make yourself stronger than your excuses.</a
            >
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- blogs section ends -->

    <!-- footer section starts  -->

    <section class="footer">
      <div class="box-container container">
        <div class="box">
          <h3>quick links</h3>
          <a href="#home"> <i class="fas fa-angle-right"></i> home</a>
          <a href="#about"> <i class="fas fa-angle-right"></i> about</a>
          <a href="#courses"> <i class="fas fa-angle-right"></i> courses</a>
          <a href="#pricing"> <i class="fas fa-angle-right"></i> pricing</a>
          <a href="#team"> <i class="fas fa-angle-right"></i> team</a>
          <a href="#blogs"> <i class="fas fa-angle-right"></i> blogs</a>
        </div>

        <div class="box">
          <h3>contact info</h3>
          <a href="tel:XXXXXXXXXX"> <i class="fas fa-phone"></i> XXXXXXXXXX </a>
          <a href="tel:XXXXXXXXXX"> <i class="fas fa-phone"></i> XXXXXXXXXX </a>
          <a href="mailto:aniket.0301@gmail.com">
            <i class="fas fa-envelope"></i> aniket.behera.0301@gmail.com
          </a>
          <a href="#"> <i class="fas fa-map"></i> Pune, India - 411011 </a>
        </div>

        <div class="box">
          <h3>follow us</h3>
          <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
          <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
          <a
            href="#"
          >
            <i class="fab fa-instagram"></i> instagram
          </a>
          <a href="#">
            <i class="fab fa-linkedin"></i> linkedin
          </a>
        </div>

        <div class="box">
          <h3>newsletter</h3>
          <p>subscribe for latest updates</p>
          <form action="">
            <input
              type="email"
              name=""
              placeholder="enter your email"
              id=""
              class="email"
            />
            <input type="submit" value="subscribe" class="link-btn" />
          </form>
        </div>
      </div>

      <p class="credit">created by <span>BE FIT</span></p>
    </section>

    <!-- footer section ends -->

    <!-- custom js file link     -->
    <script src="js/script.js">
      function openPopup() {pform.style.display = "block";}
 
 // Close popup function
     function closePopup() {pform.style.display = "none";}
   
    </script>
  </body>
</html>


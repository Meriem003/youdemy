<?php
session_start();
include('../../model/config/conn.php');
include("../../model/class/class.php");
$newObjLogin = new User($pdo, null,null, null, null, null, null, null);

if (isset($_POST['submit'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    try {
        $newObjLogin->loginFunc($email, $password);
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo">skillshare.</a>

      <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun" style="display: none;"></div>
      </div>

      <div class="profile">

         <div class="flex-btn">
            <a href="../../auth/login.php" class="option-btn">login</a>
            <a href="../../auth/register.php" class="option-btn">register</a>
         </div>
      </div>

   </section>

</header>  

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="../../public/images/pic-1.jpg" class="image" alt="">
      <h3 class="name">user</h3>
   </div>

   <nav class="navbar">
      <a href="../user/pages/about.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="../User/pages/courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="../user/pages/mescourses.php"><i class="fa-solid fa-book-open"></i><span>mes Courses</span></a>
      <a href="../user/pages/contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>
   
</div>

<section class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>login</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" required maxlength="20" class="box">
      <input type="submit" value="login" name="submit" class="btn">
      <a href="./register.php">register<a>
   </form>
</section>

<script src="js/script.js"></script>

</body>
</html>
<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
session_start();
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $user = new Student($pdo, $_SESSION['id'], $_SESSION['name'], $_SESSION['email'], null, 'null', 'null', null);
} else {
   header("location:.../../../../auth/login.php");
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="../../../public/css/style.css">

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
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
      <div class="profile">
      <h3>please login or register</h3>
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
      <img src="../../../public/images/pic-1.jpg" class="image" alt="">
      <h3 class="name">user</h3>
      <p class="role">Étudiant</p>
      <a href="../../auth/register.php" class="btn">create account</a>
   </div>

   <nav class="navbar">
      <a href="about.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="mescourses.php"><i class="fa-solid fa-book-open"></i><span>mes Courses</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>
</div>
<br>
<h1 class="heading">mes courses</h1>

<script src="../../../public/js/script.js"></script>

   
</body>
</html>
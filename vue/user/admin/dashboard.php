<?php
include '../../../model/config/conn.php';
include '../../../model/class/class.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact us</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <link rel="stylesheet" href="../../../public/css/style.css">

</head>
<body>
<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin.</a>

      <form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="search here..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user" style="display: none;"></div>
         <div id="toggle-btn" class="fas fa-sun" style="display: none;"></div>
      </div>
   </section>

</header>


<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>
   <div class="profile">
      <img src="../../../public/images/pic-7.jpg" class="image" alt="">
      <h3 class="name">meryam salhi</h3>
      <a href="../pages/about.php"  onclick="return confirm('logout from this website?');"class="btn">logout</a>
   </div>
   <nav class="navbar">
   <a href="dashboard.php"><i class="fa-solid fa-chart-pie"></i><span>statistiques globales</span></a>
      <a href="ensiegnants.php"><i class="fa-solid fa-check"></i><span>validation users </span></a>
      <a href="tags.php"><i class="fa-solid fa-bars"></i><span>gestion content</span></a>
      <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

</div>

</div>
<script src="../../../public/js/admin.js"></script>

   
</body>
</html>
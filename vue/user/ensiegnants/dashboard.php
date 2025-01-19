<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../../public/css/style.css">

</head>
<body>
<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">ensiegnants.</a>

      <form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="search here..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>


   </section>

</header>


<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>
   <div class="profile">
      <img src="../../../public/images/pic-7.jpg" class="image" alt="">
      <h3 class="name">ensiegnants</h3>
      <a href="../pages/about.php" class="btn">logout</a>
   </div>
   <nav class="navbar">
      <a href="statistiques.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="mesCours.php"><i class="fa-solid fa-book"></i><span>Mes cours</span></a>
      <a href="gestionCours.php"><i class="fa-solid fa-list"></i><span>gestion cours</span></a>
      <a href="statistiques.php"><i class="fa-solid fa-chart-pie"></i><span>statistiques</span></a>
      <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>
</div>
</div>
<script src="../../../public/css/admin.css"></script>
</body>
</html>
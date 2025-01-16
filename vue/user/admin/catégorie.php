<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
?>
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
 <style>
   :root{
   --main-color:#8e44ad;
   --red:#e74c3c;
   --orange:#f39c12;
   --light-color:#888;
   --light-bg:#eee;
   --black:#2c3e50;
   --white:#fff;
   --border:.1rem solid rgba(0,0,0,.2);
}

 </style>
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
      <h3 class="name">meryam salhi</h3>
      <a href="../pages/about.php" class="btn">logout</a>
   </div>
   <nav class="navbar">
      <a href="./dashboard.php"><i class="fa-solid fa-house"></i><span>home</span></a>
      <a href="tags.php"><i class="fa-solid fa-check"></i><span>gestion tags</span></a>
      <a href="catégorie.php"><i class="fa-solid fa-chart-pie"></i><span>gestion catégorie</span></a>
      <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

</div>
<section class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>add catégorie</h3>
      <p> name <span>*</span></p>
      <input type="text" name="name" placeholder="enter your name" required maxlength="50" class="box">
      <input type="submit" value="add" name="submit" class="btn">
   </form>
<?php
if (isset($_POST["submit"])) {
   $name = htmlspecialchars($_POST["name"]);
   $catégorie = new Category($pdo,$name);
   $catégorie->addCategory();
}
?>
<div class="table-responsive">
   <table>
      <thead>
         <tr>
            <th>name</th>
            <th>modifier</th>
            <th>supprimer</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $Category = new Category($pdo,null);
         $Categories = $Category->viewCATE();
         foreach($Categories as $row) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td><a href='./catégorie.php.?id={$row['id']}'><i class='fa-solid fa-file-pen'></i></a></td>";
            echo "<td><a href='./catégorie.php?id={$row['id']}'><i class='fa-solid fa-trash'></i></a></td>";
            echo "</tr>";
         }
         
         ?>
      </tbody>
   </table>
   </div>
   </section>
<script src="../../../public/js/admin.js"></script>
</body>
</html>
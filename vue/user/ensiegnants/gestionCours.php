<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
session_start();
if (!isset($_SESSION['id'])) {
    echo "Erreur : Vous devez être connecté en tant qu'enseignant pour accéder à cette page.";
    exit;
}
// var_dump($_SESSION['id']);
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
      <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="mesCours.php"><i class="fa-solid fa-book"></i><span>Mes cours</span></a>
      <a href="gestionCours.php"><i class="fa-solid fa-list"></i><span>gestion cours</span></a>
      <a href="statistiques.php"><i class="fa-solid fa-chart-pie"></i><span>statistiques</span></a>
      <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <label for="title">Titre du cours :</label>
    <input type="text" id="title" name="title" placeholder="Titre du cours" required class="box">

    <label for="description">Description :</label>
    <textarea id="description" name="description" placeholder="Entrez une description..." required class="box"></textarea>

    <label for="content">Contenu du cours :</label>
    <textarea id="content" name="content" placeholder="Entrez le contenu du cours..." required class="box"></textarea>

    <label for="category">Catégorie :</label>
    <select id="category" name="category_id" required class="box">
        <option value="" disabled selected>-- Sélectionnez une catégorie --</option>
        <?php
        $category = new Category($pdo, null, null);
        foreach ($category->viewCATE() as $cat) {
            echo '<option value="' . htmlspecialchars($cat['id']) . '">' . htmlspecialchars($cat['name']) . '</option>';
        }
        ?>
    </select>

    <label for="tags">Tags :</label>
    <div class="tags-container">
        <?php
        $tag = new Tag($pdo, null, null);
        foreach ($tag->viewTAG() as $tagItem) {
            echo '<label>';
            echo '<input type="checkbox" name="tags[]" value="' . htmlspecialchars($tagItem['id']) . '"> ' . htmlspecialchars($tagItem['name']);
            echo '</label><br>';
        }
        ?>
    </div>
    <input type="submit" value="Ajouter le cours" name="submit_course" class="btn">
</form>
<?php
if (isset($_POST['submit_course'])) {
   $title = $_POST['title'];
   $description = $_POST['description'];
   $content = $_POST['content'];
   $categoryId = $_POST['category_id'];
   $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

   $teacher = new Teacher($pdo, $_SESSION['id'], $_SESSION['name'], $_SESSION['email'], null, 'teacher', 'active', null);

   $result = $teacher->createCourse($title, $description, $content, $categoryId, $tags);
   echo $result;
}

?>

<script src="../../../public/css/admin.css"></script>
</body>
</html>
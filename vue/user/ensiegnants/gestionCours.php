<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "activer" || !isset($_SESSION['id'])) {
   header("Location: .../../../../auth/login.php");
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="../../../public/css/style.css">
<style>
   :root {
    --main-color: #8e44ad;
    --red: #e74c3c;
    --orange: #f39c12;
    --light-color: #888;
    --light-bg: #eee;
    --black: #2c3e50;
    --white: #fff;
    --border: .1rem solid rgba(0, 0, 0, .2);
}
#ajouté {
   max-width: 600px;
   margin: 2rem auto;
   padding: 1.5rem;
   border: var(--border); 
   border-radius: 10px;
   background-color: var(--light-bg); 
   box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
   font-size: 1.2rem;

}

#ajouté label {
   font-weight: bold;
   margin-top: 1rem;
   display: block;
   color: var(--black);
}

#ajouté .box {
   width: 100%;
   padding: 0.8rem;
   margin-top: 0.5rem;
   margin-bottom: 1rem;
   border: var(--border); 
   border-radius: 4px;
   font-size: 1rem;
   box-sizing: border-box;
   background-color: var(--white);
   color: var(--black);
   font-size: 1.1rem; 

}

#ajouté select, #ajouté textarea {
   width: 100%;
   padding: 1rem; 
   margin-top: 0.5rem;
   margin-bottom: 1rem;
   border: var(--border);
   border-radius: 4px;
   font-size: 1rem;
   box-sizing: border-box;
   background-color: var(--white);
   color: var(--black);
}

#ajouté input[type="submit"] {
   background-color: var(--main-color); 
   color: var(--white); 
   padding: 0.8rem 1.5rem;
   border: none;
   border-radius: 4px;
   cursor: pointer;
   font-size: 1.2rem;
   transition: background-color 0.3s ease, transform 0.2s ease;
}

#ajouté input[type="submit"]:hover {
   background-color: var(--orange); 
   transform: scale(1.05); 
}

#ajouté .tags-container {
   display: flex;
   flex-wrap: wrap;
   gap: 10px;
   margin-top: 1rem;
}

#ajouté .tags-container label {
   display: flex;
   align-items: center;
   font-size: 1.2rem; 
   color: var(--light-color); 
   padding: 5px 10px;
   border: var(--border); 
   border-radius: 4px;
   background-color: var(--white);
   cursor: pointer;
   transition: background-color 0.3s ease, border-color 0.3s ease;
}

#ajouté .tags-container label:hover {
   background-color: var(--light-bg);
   border-color: var(--main-color); 
}

#ajouté .tags-container input[type="checkbox"] {
   margin-right: 5px;
   cursor: pointer;
}


</style>
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
      <h3 class="name">ensiegnants</h3>
      <a href="../pages/about.php"  onclick="return confirm('logout from this website?');"class="btn">logout</a>
   </div>
   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="mesCours.php"><i class="fa-solid fa-book"></i><span>Mes cours</span></a>
      <a href="gestionCours.php"><i class="fa-solid fa-list"></i><span>gestion cours</span></a>
      <a href="dashboard.php"><i class="fa-solid fa-chart-pie"></i><span>statistiques</span></a>
      <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>
</div>

<div class="container">

<form id="ajouté" action="" method="post" enctype="multipart/form-data">
<h1>Ajouter un cours</h1>
<p>Remplissez le formulaire ci-dessous pour ajouter un cours.</p>
    <label for="title">Titre du cours :</label>
    <input type="text" id="title" name="title" placeholder="Titre du cours" required class="box">

    <label for="description">Description :</label>
    <textarea id="description" name="description" placeholder="Entrez une description..." required class="box"></textarea>

    <label for="content">Contenu du cours :</label>
    <input id="content" type="url" name="content" placeholder="Entrez le contenu du cours..." required class="box">

    <label for="type">Type de contenu :</label>
    <select name="type" id="type" required>
        <option value="" disabled selected>-- Sélectionnez type --</option>
        <option value="pdf">PDF</option>
        <option value="video">Vidéo</option>
    </select>

    <label for="img">image de cours</label>
      <input type="url" name="img" id="img" required class="box">

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
</div>
<?php
if (isset($_POST['submit_course'])) {
   $title = $_POST['title'];
   $description = $_POST['description'];
   $content = $_POST['content'];
   $type = $_POST['type'];
   $img = $_POST['img'];
   $categoryId = $_POST['category_id'];
   $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
   $teacher = new Teacher($pdo, $_SESSION['id'], $_SESSION['name'], $_SESSION['email'], null, 'teacher', 'active', null);
   $result = $teacher->createCourse($title, $description, $content, $type, $categoryId, $tags, $img);
   echo $result;
}
?>

<script src="../../../public/css/admin.css"></script>
</body>
</html>
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
<style>
/* .container {
    background-color: var(--white);
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    margin: 50px auto;
    font-family: 'Arial', sans-serif;
    transition: all 0.3s ease;
}
.container h1 {
    color: var(--main-color);
    font-size: 32px;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
}
.container p {
    color: var(--light-color);
    text-align: center;
    margin-bottom: 30px;
    font-size: 16px;
}
label {
    display: block;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--black);
    font-size: 14px;
    transition: color 0.3s ease;
}
input[type="text"],
input[type="url"],
textarea,
select {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
    border: var(--border);
    border-radius: 8px;
    background-color: var(--light-bg);
    font-size: 16px;
    color: var(--black);
    outline: none;
    transition: all 0.3s ease;
}
input[type="text"]:focus,
input[type="url"]:focus,
textarea:focus,
select:focus {
    border-color: var(--main-color);
    box-shadow: 0 0 5px rgba(142, 68, 173, 0.3);
}
textarea {
    resize: vertical;
    height: 160px;
}
select {
    appearance: none;
    background-color: var(--white);
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M10 12l-6-6h12l-6 6z' fill='%23888'/%3E%3C/svg%3E");
    background-position: right 10px center;
    background-repeat: no-repeat;
    background-size: 12px 12px;
    padding-right: 30px;
    font-size: 16px;
}
.tags-container {
    margin-bottom: 25px;
}
.tags-container label {
    display: inline-block;
    margin-right: 15px;
    font-size: 14px;
    color: var(--black);
    cursor: pointer;
    transition: color 0.3s ease;
}
.tags-container label:hover {
    color: var(--main-color);
}
input[type="checkbox"] {
    margin-right: 8px;
    cursor: pointer;
}
input[type="submit"] {
    width: 100%;
    padding: 16px;
    font-size: 18px;
    font-weight: bold;
    background-color: var(--main-color);
    color: var(--white);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}
input[type="submit"]:hover {
    background-color: var(--orange);
    transform: translateY(-2px);
}
input[type="submit"]:active {
    transform: translateY(1px);
}
::placeholder {
    color: var(--light-color);
    font-style: italic;
}
label:focus-within {
    color: var(--main-color);
} */
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

<div class="container">
    <h1>Ajouter un cours</h1>
    <p>Remplissez le formulaire ci-dessous pour ajouter un cours.</p>
<form action="" method="post" enctype="multipart/form-data">
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
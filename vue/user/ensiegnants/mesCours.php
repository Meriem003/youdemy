<?php
require '../../../model/class/class.php';
require '../../../model/config/conn.php';
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "activer" || !isset($_SESSION['id'])) {
   header("Location: ../../../auth/login.php");
   exit;
}
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
.courses-container {
   display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Augmentation de l'espacement entre les cartes */
    justify-content: center; /* Centrage des cartes */
    margin: 40px auto; /* Plus de marge */
    max-width: 1200px;
}
.course-card {
    background-color: var(--white);
    border: var(--border);
    border-radius: 15px; /* Coins plus arrondis */
    width: 350px; /* Largeur de carte augmentée */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombrage modifié */
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center; /* Centrage du texte */
    margin: 0 auto; /* Centre chaque carte dans son conteneur */
}
.course-card:hover {
    transform: scale(1.05); /* Zoom lors du survol */
}

.course-img {
    width: 100%;
    height: 170px; /* Légèrement plus petit */
    object-fit: cover;
}
.course-info {
   padding: 10px; /* Plus de padding */
}

.course-title {
    font-size: 2rem; /* Taille de police augmentée */
    font-weight: 800; /* Poids de police augmenté */
    color: var(--main-color); /* Couleur du titre inchangée */
    margin-bottom: 15px;
}

.course-description {
    font-size: 1.4rem;
    color: var(--light-color);
    margin: 0;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 10px; /* Ajout d'une marge en bas */
}

.btn-container {
    padding: 10px; /* Plus de padding */
    text-align: center;
    border-top: var(--border);
    display: flex;
    justify-content: center;
    gap: 10px; /* Plus d'espacement entre les boutons */
}

.voir-plus , .delete-btn, .modify-btn{
    display: inline-block;
    background-color: var(--main-color); /* Couleur du bouton inchangée */
    color: var(--white);
    text-align: center;
    padding: 10px 10px; /* Boutons plus grands */
    text-decoration: none;
    border-radius: 8px; /* Plus d'arrondi sur les boutons */
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin-bottom: 6px;
    width: 130px;
}

.modify-btn {
   background-color: #27ae60;
   color: var(--white);
}

.modify-btn:hover {
    background-color:rgb(190, 190, 190);
    color: #27ae60;
}

.delete-btn {
   background-color: #c0392b;
   color: var(--white);
}
.voir-plus{
   background-color:rgb(198, 132, 28);
   color: var(--white);
}
.voir-plus:hover{
   background-color:rgb(197, 191, 182);
   color: rgb(198, 132, 28);
}



.delete-btn:hover {
    background-color:rgb(190, 190, 190);
    color: #c0392b;
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
<div>
<?php 
$teacher = new Teacher($pdo, $_SESSION['id'], $_SESSION['name'], $_SESSION['email'], null, 'teacher', 'active', null);
$courses = $teacher->viewAll();
?>
<div class="courses-container">
    <?php foreach ($courses as $course): ?>
        <div class="course-card">
            <img src="<?php echo htmlspecialchars($course['img']); ?>" alt="Course Image" class="course-img">
            <div class="course-info">
                <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                <p class="course-description"><?php echo htmlspecialchars($course['description']); ?></p>
                <div class="button-container">
               <a href="mesCours.php?id=<?php echo $course['id']; ?>" class="btn modify-btn">Modifier</a>
               <a href="mesCours.php?id=<?php echo $course['id']; ?>" class="btn delete-btn">Supprimer</a>
               <a href="mesCours.php?id=<?php echo $course['id']; ?>" class="btn voir-plus">Voir le cours</a>
            </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
if (isset($_GET['id'])) {
   $courseId = $_GET['id'];
   $result = $teacher->deleteCourseTeacher($courseId);
}
?>
</div>
<script src="../../../public/css/admin.css"></script>
</body>
</html>
<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "activer") {
    header("Location: ../../auth/login.php");
    exit;
}
$student = new Student($pdo, $_SESSION['id'], $_SESSION['name'], $_SESSION['email'], null, null, null, null);
if (isset($_GET['id']) && isset($_SESSION['id'])) {
    $courseId = intval($_GET['id']);
    $userId = $_SESSION['id'];
    $response = $student->addCourse($userId, $courseId);
}
$courses = $student->viewAllCourses();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../../public/css/style.css">
   <style>
    :root {
    --main-color: #8e44ad; /* Couleur principale inchangée */
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

.info {
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

.btn {
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

.btn:hover {
    background-color:  #f39c12;;
    transform: translateY(-3px);
}


</style>
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
   </div>
   <nav class="navbar">
      <a href="about.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="mescourses.php"><i class="fa-solid fa-book-open"></i><span>mes Courses</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>
</div>
<br>
<h1 class="heading">our courses</h1>
<div class="courses-container">
    <?php foreach ($courses as $row): ?>
        <div class="course-card">
            <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="course-img">
            <div class="info">
                <h3 class="course-title"><?= htmlspecialchars($row['title']) ?></h3>
                <p class="course-description"><?= htmlspecialchars($row['description']) ?></p>
                <p><strong>Catégorie :</strong> <?= htmlspecialchars($row['category']) ?></p>
                <p><strong>Enseignant :</strong> <?= htmlspecialchars($row['teacher_name']) ?></p>
            </div>
            <div class="btn-container">
            <a href="?idView=<?= $row['id'] ?>" class="btn">View Details</a>
            <a href="courses.php?id=<?= $row['id']?>&iduser=<?=$_SESSION["id"]?>" class="btn">Subscribe</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script src="../../../public/js/script.js"></script>
</body>
</html>
<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
$student = new Student($pdo, null, null, null, null, null, null, null); // Dummy values for the constructor
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
/* Root Variables */
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

/* Container for the course cards */
.courses-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: space-around;
    margin: 20px auto;
    max-width: 1200px;
}

/* Individual course card */
.course-card {
    background-color: var(--white);
    border: var(--border);
    border-radius: 8px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* On hover, the course card will slightly lift */
.course-card:hover {
    transform: translateY(-10px);
}

/* Image styling */
.course-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Info container - for the title and description */
.info {
    padding: 15px;
    text-align: center;
}

/* Title of the course */
.course-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--black);
    margin-bottom: 10px;
}

/* Description styling */
.course-description {
    font-size: 1rem;
    color: var(--light-color);
    margin: 0;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limit description to 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Button container */
.btn-container {
    padding: 5px;
    text-align: center;
    border-top: var(--border);
    display: flex;
    justify-content: center; 
    gap: 10px;
}

/* Button styling */
.btn {
    display: inline-block;
    background-color: var(--main-color);
    color: var(--white);
    text-align: center;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: var(--black);
}
@media (max-width: 768px) {
    .courses-container {
        justify-content: center;
    }

    .course-card {
        width: 100%;
        max-width: 350px;
    }
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
<h1 class="heading">our courses</h1>
<div class="courses-container">
    <?php foreach ($courses as $course): ?>
        <div class="course-card">
            <img src="<?= $course['img'] ?>" alt="<?= $course['title'] ?>" class="course-img">
            <div class="info">
            <h3 class="course-title"><?= $course['title'] ?></h3>
            <p class="course-description"><?= $course['description']?></p>
            </div>
            <div class="btn-container">
            <a href="?id=<?= $course['id'] ?>" class="btn">View Details</a>
            <a href="?id=<?= $course['id'] ?>" class="btn">Ajouté</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>



<script src="../../../public/js/script.js"></script>
</body>
</html>
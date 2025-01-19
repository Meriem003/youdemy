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
/* Container for the courses */
.courses-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-between;
  margin: 20px;
}

/* Individual course card styling */
.course-card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 300px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.course-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

/* Image styling */
.course-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-bottom: 2px solid #f1f1f1;
}

/* Course info section */
.course-info {
  padding: 20px;
}

.course-title {
  font-size: 20px;
  font-weight: bold;
  color: #333;
  margin-bottom: 10px;
}

.course-description {
  font-size: 14px;
  color: #555;
  margin-bottom: 15px;
  line-height: 1.5;
  height: 80px;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Button styling */
.course-info .btn {
  display: inline-block;
  background-color: #007BFF;
  color: #fff;
  padding: 10px 20px;
  font-size: 14px;
  border-radius: 5px;
  text-decoration: none;
  text-align: center;
  transition: background-color 0.3s ease;
}

.course-info .btn:hover {
  background-color: #0056b3;
}

/* Responsiveness */
@media (max-width: 768px) {
  .courses-container {
    justify-content: center;
  }
  .course-card {
    width: 250px;
  }
}

@media (max-width: 480px) {
  .course-card {
    width: 100%;
  }
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
<div>
<?php
session_start(); 
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
                <a href="course_details.php?id=<?php echo $course['id']; ?>" class="btn">Voir le cours</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>
<script src="../../../public/css/admin.css"></script>
</body>
</html>
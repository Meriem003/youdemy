<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';
session_start();
$admin = new Admin($pdo, null, null, null, null, null, null, null);
$courses = $admin->manageContent();
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
<style>
.table-responsive {
    margin: 20px auto; 
    width: 90%; 
    max-width: 1200px; 
}


table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    background-color: var(--light-bg);
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 18px;
    text-align: center; 
    vertical-align: middle; 
    border: var(--border);
    font-weight: 500;
}

thead tr {
    background: linear-gradient(135deg, var(--main-color), var(--orange));
    color: var(--white);
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color:rgba(221, 204, 204, 0.79);
    color: #2c3e50; 
    cursor: pointer;
}


.delete-btn {
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 4px;
    display: inline-flex; 
    justify-content: center;
    align-items: center;
}

.delete-btn {
    color: #e74c3c;
    background-color: #fce4e4;
}

.delete-btn:hover {
    background-color: #c0392b;
    color: var(--white);
}

.delete-btn {
    transition: transform 0.2s ease-in-out;
    font-size: 18px;
}

.delete-btn:hover i{
    transform: scale(1.2);
}
</style>
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
      <a href="../pages/about.php"  onclick="return confirm('logout from this website?');"class="btn">logout</a>
   </div>
   <nav class="navbar">
      <a href="./dashboard.php"><i class="fa-solid fa-house"></i><span>home</span></a>
      <a href="tags.php"><i class="fa-solid fa-check"></i><span>gestion tags</span></a>
      <a href="catégorie.php"><i class="fa-solid fa-chart-pie"></i><span>gestion catégorie</span></a>
      <a href="cours.php"><i class="fa-solid fa-book-open"></i><span>gestion cours</span></a>
      <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>
</div>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Category</th>
                <th>Description</th>
                <th>Teacher</th>
                <th>CreatedAt</th>
                <th>Delete Course</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($courses as $course) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($course['title']) . "</td>";
            echo "<td>" . htmlspecialchars($course['category']) . "</td>";
            echo "<td>" . htmlspecialchars($course['description']) . "</td>";
            echo "<td>" . htmlspecialchars($course['teacher_name']) . "</td>";
            echo "<td>" . htmlspecialchars($course['createdAt']) . "</td>";
            echo "<td><a href='delete_course.php?id=" . $course['id'] . "' class='delete-btn'><i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="../../../public/js/admin.js"></script>
</body>
</html>
<?php
require '../../../model/config/conn.php';
require '../../../model/class/class.php';


if (isset($_POST["add"])) {
   $name = htmlspecialchars($_POST["name"]);
   $Category = new Category($pdo, $name, null);
   $Category->addCategory();
}
if (isset($_GET["id"])) {
  $editID = $_GET["id"];
  $editCat = new Category($pdo, null, $editID);
  $editCat = $editCat->getCategoryById();
  
}
if (isset($_POST["edit"])) {
   $editId = $_POST["editID"];
   $editName = $_POST["name"];
   $editCat = new Category($pdo, $editName, $editId);
   $editCat->editCate();
   header("location: ./catégorie.php");
   exit();
}
if (isset($_GET['delete_id'])) {
   $tagIdDelete = $_GET['delete_id'];
   $cate = new Category($pdo, null, null);
   $cate->deleteCate($tagIdDelete);
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
    --light-bg: #f9f9f9;
    --black: #2c3e50;
    --white: #fff;
    --border: .1rem solid rgba(0, 0, 0, .2);
}


.form-style {
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
    border: var(--border);
    border-radius: 8px;
    background-color: var(--white);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-style h3 {
    margin-bottom: 15px;
    color: var(--main-color);
    font-size: 24px;
    text-align: center;
}

.form-style p {
    font-size: 16px;
    margin-bottom: 8px;
    color: var(--black);
}

.form-style p span {
    color: var(--red);
}

.form-style .box {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: var(--border);
    border-radius: 4px;
    font-size: 16px;
    color: var(--black);
}

.form-style .btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    color: var(--white);
    background-color: var(--main-color);
    cursor: pointer;
    transition: background 0.3s ease;
}

.form-style .btn:hover {
    background-color: var(--orange);
}

.table-responsive {
    margin: 20px auto; 
    width: 60%; 
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


.edit, .delete-btn {
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 4px;
    display: inline-flex; 
    justify-content: center;
    align-items: center;
}

.edit {
    color: #2ecc71;
    background-color: #e0f7e9;
    width: 100%;
}

.delete-btn {
    color: #e74c3c;
    background-color: #fce4e4;
}


.edit:hover {
    background-color: #27ae60;
    color: var(--white);
}

.delete-btn:hover {
    background-color: #c0392b;
    color: var(--white);
}

.delete-btn, .edit i{
    transition: transform 0.2s ease-in-out;
    font-size: 18px;
}

.edit:hover i, .delete-btn:hover i{
    transform: scale(1.2);
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

<form action="" method="post" enctype="multipart/form-data" class="form-style">
    <h3>Ajouter une catégorie</h3>
    <p>Nom <span>*</span></p>
    <input type="hidden" name="editID" 
    value="<?php if (isset($editCat['id'])) {echo $editCat['id'];} else {echo '';}?>">
    <input type="text" name="name" 
    value="<?php if (isset($editCat['name'])) {echo $editCat['name'];} else {echo '';}?>" 
    placeholder="Entrez le nom" required maxlength="50" class="box">
    <input type="submit" 
    value="<?php if (isset($editCat['id'])) {echo 'Éditer';} else {echo 'Ajouter';}?>" 
    name="<?php if (isset($editCat['id'])) {echo 'edit';} else {echo 'add';}?>" class="btn">
</form>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $Category = new Category($pdo, null, null);
            $Categories = $Category->viewCATE();

            foreach ($Categories as $row) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td><a href='./catégorie.php?id={$row['id']}' class='edit'><i class='fa-solid fa-file-pen'></i></a></td>";
                echo "<td><a href='./catégorie.php?delete_id={$row['id']}' class='delete-btn'><i class='fa-solid fa-trash'></i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<script src="../../../public/js/admin.js"></script>
</body>
</html>
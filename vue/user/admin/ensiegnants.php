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
    text-align: left;
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

.edit {
    color: var(--main-color);
    text-decoration: none;
    margin-right: 10px;
}

.edit:hover {
    text-decoration: underline;
    color: var(--orange);
}

.delete-btn {
    color: var(--red);
    text-decoration: none;
}

.delete-btn:hover {
    text-decoration: underline;
    color: var(--orange);
}

.border {
    text-align: center;
}
.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.pagination a {
    text-decoration: none;
    padding: 8px 16px;
    background-color: var(--main-color);
    color: var(--white);
    border-radius: 4px;
    transition: background 0.3s ease;
}

.pagination a:hover {
    background-color: var(--orange);
}

.pagination .prev, .pagination .next {
    font-weight: bold;
}

.active, .inactive, .baned {
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 4px;
    display: inline-flex; 
    justify-content: center;
    align-items: center;
}

.active {
    color: #2ecc71;
    background-color: #e0f7e9;
}

.inactive {
    color: #e74c3c;
    background-color: #fce4e4;
}

.baned {
    color: #e67e22;
    background-color: #fff3e0;
}

.active:hover {
    background-color: #27ae60;
    color: var(--white);
}

.inactive:hover {
    background-color: #c0392b;
    color: var(--white);
}

.baned:hover {
    background-color: #d35400;
    color: var(--white);
}

.active i, .inactive i, .baned i {
    transition: transform 0.2s ease-in-out;
    font-size: 18px;
}

.active:hover i, .inactive:hover i, .baned:hover i {
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
    <a href="dashboard.php"><i class="fa-solid fa-chart-pie"></i><span>statistiques globales</span></a>
    <a href="ensiegnants.php"><i class="fa-solid fa-check"></i><span>validation ensiegnants </span></a>
    <a href="tags.php"><i class="fa-solid fa-bars"></i><span>gestion content</span></a>
    <a href="../pages/about.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>
</div>
<div class="table-responsive">
   <table>
      <thead>
         <tr>
            <th>name</th>
            <th>email</th>
            <th>role</th>
            <th>status</th>
            <th>active</th>
            <th>inactive</th>
            <th>baned</th>
         </tr>
      </thead>
      <tbody>
        <?php
        include '../../../model/config/conn.php';
        include '../../../model/class/class.php';

        $admin = new Admin($pdo,null,null,null,null,null,null );
        if (isset($_GET['action']) && isset($_GET['users_id'])) {
            $action = $_GET['action'];
            $users =$_GET['users_id'];
                if ($users > 0) {
                switch ($action) {
                    case 'activate':
                        $admin->validateUsers ($users, 'active');
                        break;
                    case 'deactivate':
                        $admin->validateUsers ($users, 'inactive');
                        break;
                    case 'ban':
                        $admin->validateUsers ($users, 'banned');
                        break;
                    default:
                        break;
                }
            }
        }

        $users = $admin->manageUsers();
        foreach ($users as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td><a href='./ensiegnants.php?action=activate&users_id=" . $row['id'] . "' class='active'><i class='fa-solid fa-check'></i></a></td>";
            echo "<td><a href='./ensiegnants.php?action=deactivate&users_id=" . $row['id'] . "' class='inactive'><i class='fa-regular fa-circle-xmark'></i></a></td>";
            echo "<td><a href='./ensiegnants.php?action=ban&users_id=" . $row['id'] . "' class='baned'><i class='fa-solid fa-user-xmark'></i></a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
        </table>
        <div class="pagination">
            <a href="#" class="prev">Prev</a>
            <a href="#" class="page-number">1</a>
            <a href="#" class="page-number">2</a>
            <a href="#" class="page-number">3</a>
            <a href="#" class="next">Next</a>
        </div>
</div>


<script src="../../../public/js/admin.js"></script>

</body>
</html>
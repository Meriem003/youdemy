<?php
class User {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    protected $status;
    protected $createdAT ;
    private $pdo;

    public function __construct($pdo, $id, $name, $email, $password, $role, $status, $createdAT) {
        $this->pdo = $pdo;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->createdAT  = $createdAT ;
        $this->id = $id;
    }

    public function loginFunc($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $myuser = $stmt->fetch();
    
        if ($myuser && password_verify($password, $myuser["password"])) {
            $_SESSION["id"] = $myuser["id"];     
            $_SESSION["name"] = $myuser["name"];
            $_SESSION["email"] = $myuser["email"];
            $_SESSION["role"] = $myuser["role"];
            $_SESSION["status"]=$myuser["status"];
                if ($myuser["role"] === "admin") {
                header("Location: .../../../../vue/user/admin/dashboard.php");
                exit();
            } elseif ($myuser["role"] === "teacher") {
                header(header: "Location: .../../../../vue/user/ensiegnants/dashboard.php");
                exit();
            } else {
                header("Location: .../../../../vue/user/pages/about.php");
                exit();
            }
        } else {
            throw new Exception("Invalid email or password");
        }
    }
    
    

    public function register($name, $email, $password, $role){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $myuser = $stmt->fetch();
        if ($myuser) {
            throw new Exception("the user is already registreed");
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $role]);
    }
}

class Student extends User {
    private $pdo;

    public function __construct($pdo, $id, $name, $email, $password, $role, $status, $createdAT) {
        parent::__construct($pdo, $id, $name, $email, $password, $role, $status, $createdAT );
        $this->pdo = $pdo;
    }

    public function getCoursesBySubs($userId) {
        $stmt = $this->pdo->prepare("SELECT courses.id AS course_id, courses.title AS course_title, courses.description AS course_description, courses.img AS course_image
        FROM subscriptions 
        INNER JOIN courses ON subscriptions.courseId = courses.id
        WHERE subscriptions.studentId = :user_id;");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addCourse($userId, $id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM subscriptions WHERE studentId = :student_id AND courseId = :course_id");
        $stmt->execute([':student_id' => $userId,':course_id' => $id]);
        $isSubscribed = $stmt->fetchColumn();
        if ($isSubscribed) {
        return ['success' => false, 'message' => 'You are already subscribed to this course.'];
        }
        $stmt = $this->pdo->prepare("INSERT INTO subscriptions (studentId, courseId) VALUES (:student_id, :course_id)");
        $stmt->execute([':student_id' => $userId,':course_id' => $id]);
        return ['success' => true];
    }

    public function viewAllCourses() {
        $sql = "SELECT Courses.id,Courses.title,Courses.description,Courses.img,Categories.name AS category,Users.name AS teacher_name FROM Courses
                JOIN Categories ON Courses.categoryId = Categories.id
                JOIN Users ON Courses.teacherId = Users.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $courses = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $courses[] = $row;
        }
        return $courses;
    }
}


class Teacher extends User {
    protected $pdo;
    protected $id;
    public function __construct($pdo, $id, $name, $email, $password, $role, $status, $createdAT ) {
        parent::__construct($pdo, $id, $name, $email, $password, $role, $status, $createdAT );
        $this->pdo = $pdo;
        $this->id = $id;
    }
    public function createCourse($title, $description, $content, $type, $categoryId, $tags, $img) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Courses (title, description, content, type, categoryId, teacherId, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $content, $type, $categoryId, $this->id, $img]);
            $courseId = $this->pdo->lastInsertId();
            if (!empty($tags)) {
                $stmtTags = $this->pdo->prepare("INSERT INTO CourseTags (courseId, tagId) VALUES (?, ?)");
                foreach ($tags as $tagId) {
                $stmtTags->execute([$courseId, $tagId]);
                }
            }
            return "Le cours a été ajouté avec succès.";
        } catch (Exception $e) {
            return "Erreur lors de la création du cours : " . $e->getMessage();
        }
    }
    public function viewAll() {
        $sql = "SELECT * FROM Courses WHERE teacherId = :teacherId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':teacherId', $this->id);
        $stmt->execute();
        $courses = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $courses[] = $row;
        }
        return $courses;
    }
    
    public function updateCourse($course) {
        
    }
public function deleteCourseTeacher($courseId) {
    if (isset($courseId)) {
        try {
            $sql = "DELETE FROM Courses WHERE id = :courseId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':courseId', $courseId);
            $stmt->execute();
        } catch (Exception $e) {
            return "Erreur lors de la suppression du cours : " . $e->getMessage();
        }
    }
}
    public function viewCourseStatistics() {
    }
}

class Admin extends User {
    protected $pdo;
    public function __construct($pdo, $id, $name, $email, $password, $role, $status, $createdAT){
    parent::__construct($pdo, $id ,$name,$email,$password,$role,$status,$createdAT );
        $this->pdo = $pdo;
    }
    public function setpdo()  {
        return $this->pdo;
    }

    public function getpdo($pdo){
        $this->pdo=$pdo;
    }


    public function validateUsers ($users, $status) {
        $sql = "UPDATE users SET status = :status WHERE id = :users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':users', $users);
        return $stmt->execute();
    }

    public function manageUsers() {
        $sql = "SELECT * FROM users ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
        return $users;
    }
    public function manageContent() {
        $sql = "SELECT Courses.id,Courses.title,Courses.description,Categories.name AS category,Users.name AS teacher_name,Courses.createdAt FROM Courses
                JOIN Categories ON Courses.categoryId = Categories.id JOIN Users ON Courses.teacherId = Users.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCourseAdmin($courseId) {
        if (isset($courseId)) {
            try {
                $sql = "DELETE FROM Courses WHERE id = :courseId";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':courseId', $courseId);
                $stmt->execute();
            } catch (Exception $e) {
                return "Erreur lors de la suppression du cours : " . $e->getMessage();
            }
        }
    }
    
    public function viewGlobalStatistics() {

    }
}

abstract class Course {
    private $id;
    private $title;
    private $description;
    private $content;
    private $category;
    private $teacher;
    private $createdAt;
    private $pdo;

    public function __construct($pdo, $content) {
        $this->content = $content;
        $this->pdo = $pdo;

    }

    abstract public function display();

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }
}

class Video extends Course {
    public function display() {

    }
}

class Pdf extends Course {
    public function display() {

    }
}

class Category {
    private $id;
    private $name;
    private $pdo;

    public function __construct($pdo,$name,$id) {
        $this->pdo = $pdo;
        $this->name = $name;
        $this->id= $id;
    }
    public function addCategory(){
         $sql = "INSERT INTO Categories(name) VALUES(?)";
         $stmt = $this->pdo->prepare($sql);
         $stmt->execute([$this->name]);
    }
    public function viewCATE()  {
        $sql ="SELECT * FROM Categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $Cate = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $Cate[]=$row;
        }
        return $Cate;
    }
    public function deleteCate($id) {
        $sql = "DELETE FROM Categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function editCate() {
        $sql = "UPDATE Categories SET name = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->name, $this->id]); 
    }
    
    
    public function getCategoryById() {
        $sql = "SELECT * FROM Categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function addCourse($course) {

    }

    public function removeCourse($course) {

    }

    public function getCourses() {

    }
}

class Tag {
    private $id;
    private $name;
    private $pdo;
    public function __construct($pdo,$name,$id) {
        $this->pdo = $pdo;
        $this->name = $name;
        $this->id = $id;
    }
    public function addtag()  {
        $sql = "INSERT INTO Tags (name) Value(?)";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$this->name]);
    }

    public function viewTAG(){
        $sql = "SELECT * FROM tags";
        $stmt = $this->pdo->prepare($sql);
        $stmt ->execute();
        $tag=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tag[]=$row;
        }
        return $tag;
    }

    public function deleteTag($id){
        $sql = "DELETE FROM tags WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function edittag() {
        $sql = "UPDATE tags SET name = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->name, $this->id]); 
    }
    
    
    public function getTagById() {
        $sql = "SELECT * FROM tags WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function addToCourse($course) {

    }

    public function removeFromCourse($course) {

    }
}
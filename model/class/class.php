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

    public function __construct($pdo, $name, $email, $password, $role, $status, $createdAT ) {
        $this->pdo = $pdo;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->createdAT  = $createdAT ;
    }
    

    public function getname()  {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getemail()  {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getpassword()  {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getrole()  {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getcreatedAT ()  {
        return $this->createdAT  ;
    }
    public function setcreatedAT ($createdAT ) {
        $this->createdAT  = $createdAT ;
    }

    public function loginFunc($email,$password){
        $stmt = $this->pdo->prepare("SELECT * FROM  users WHERE email=?");
        $stmt->execute([$email]);
        $myuser = $stmt->fetch();
        if($myuser && password_verify($password,$myuser["password"])){
           $_SESSION["name"]=$myuser["name"];
           $_SESSION["email"]=$myuser["email"];
           $_SESSION["role"]=$myuser["role"];
           if ($myuser["role"]==="teacher") {
            header("location:.../../../../vue/user/ensiegnants/dashboard.php");
            exit();
           }else{
            header("location:.../../../../vue/user/pages/about.php");
            exit();
           }
        }
    }

    public function register($name, $email, $password, $role){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $myuser = $stmt->fetch();
        if ($myuser) {
            throw new Exception("the user is already registreed");
        }
        $hashedpassord = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO  users (name, email, password, role, status) VALUES (?,?,?,?,'inactive')");
        $stmt->execute([$name, $email, $hashedpassord, $role]);
    }


}

class Student extends User {
    private $coursesList;

    public function __construct($pdo,$name,$email,$password,$role,$status,$createdAT ) {
        parent::__construct($pdo,$name,$email,$password,$role,$status,$createdAT );
    }

    public function addCourse($course) {

    }

    public function viewCourse($course) {

    }

    public function removeCourse($course) {

    }
}


class Teacher extends User {
    private $createdCourses;

    public function __construct($pdo,$name,$email,$password,$role,$status,$createdAT ) {
        parent::__construct($pdo,$name,$email,$password,$role,$status,$createdAT );
    }

    public function createCourse($course) {

    }

    public function updateCourse($course) {

    }

    public function deleteCourse($course) {

    }

    public function viewCourseStatistics() {

    }
}

class Admin extends User {
    private $pdo;

     public function __construct($pdo,$name,$email,$password,$role,$status,$createdAT ) {
        parent::__construct($pdo,$name,$email,$password,$role,$status,$createdAT );
        $this->pdo = $pdo;
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

    }
    public function viewGlobalStatistics() {

    }
}


class Course {
    private $id;
    private $title;
    private $description;
    private $content;
    private $category;
    private $teacher;
    private $createdAt;
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setTeacher($teacher) {
        $this->teacher = $teacher;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function addContent($content) {

    }

    public function updateContent($content) {

    }

    public function deleteContent($content) {

    }
}


class Category {
    private $name;
    private $pdo;

    public function __construct($pdo,$name) {
        $this->pdo = $pdo;
        $this->name = $name;
    }

    public function FunctionName()  {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
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
    public function addCourse($course) {

    }

    public function removeCourse($course) {

    }

    public function getCourses() {

    }
}

class Tag {
    private $name;
    private $pdo;

    public function __construct($pdo,$name) {
        $this->pdo = $pdo;
        $this->name = $name;
    }
    public function getname(){
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
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
    public function addToCourse($course) {

    }

    public function removeFromCourse($course) {

    }
}


class Subscription {
    private $id;
    private $studentId;
    private $courseId;
    private $status;
    private $enrollmentDate;

    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setStudentId($studentId) {
        $this->studentId = $studentId;
    }

    public function setCourseId($courseId) {
        $this->courseId = $courseId;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setEnrollmentDate($enrollmentDate) {
        $this->enrollmentDate = $enrollmentDate;
    }
}

?>

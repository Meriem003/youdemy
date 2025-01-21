CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher','admin') NOT NULL,
    status ENUM('activer', 'inactive', 'banned') NOT NULL DEFAULT 'activer',
    dataCourse DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    categoryId INT NOT NULL,
    teacherId INT NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    type ENUM('pdf', 'video') NOT NULL,
    img VARCHAR(255),
    FOREIGN KEY (categoryId) REFERENCES Categories(id),
    FOREIGN KEY (teacherId) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
);

CREATE TABLE Tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE CourseTags (
    courseId INT NOT NULL,
    tagId INT NOT NULL,
    PRIMARY KEY (courseId, tagId),
    FOREIGN KEY (courseId) REFERENCES Courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tagId) REFERENCES Tags(id) ON DELETE CASCADE
);

CREATE TABLE Subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentId INT NOT NULL,
    courseId INT NOT NULL,
    FOREIGN KEY (studentId) REFERENCES Students(id) ON DELETE CASCADE,
    FOREIGN KEY (courseId) REFERENCES Courses(id) ON DELETE CASCADE
);


DELIMITER //

CREATE TRIGGER before_user_insert
BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
    IF NEW.role = 'student' AND NEW.status != 'activer' THEN
        SET NEW.status = 'activer';
    END IF;

    IF NEW.role = 'teacher' AND NEW.status != 'inactive' THEN
        SET NEW.status = 'inactive';
    END IF;
END //

DELIMITER ;

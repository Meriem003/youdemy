CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher') NOT NULL,
    status ENUM('activer', 'inactive', 'banned') NOT NULL DEFAULT 'inactive',
    dataCourse DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Student(
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Teacher(
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Admin(
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    categoryId INT NOT NULL,
    teacherId INT NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoryId) REFERENCES Categories(id),
    FOREIGN KEY (teacherId) REFERENCES Teachers(id) ON DELETE CASCADE
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
    status ENUM('in_progress', 'completed') DEFAULT 'in_progress',
    enrollmentDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (studentId) REFERENCES Students(id) ON DELETE CASCADE,
    FOREIGN KEY (courseId) REFERENCES Courses(id) ON DELETE CASCADE
);
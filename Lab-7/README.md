Commands:

ALTER TABLE students 
  ADD COLUMN street VARCHAR(255) NOT NULL,
  ADD COLUMN city VARCHAR(255) NOT NULL,
  ADD COLUMN state CHAR(2) NOT NULL,
  ADD COLUMN zip VARCHAR(5) NOT NULL;

ALTER TABLE courses
  ADD COLUMN section VARCHAR(2) NOT NULL,
  ADD COLUMN year CHAR(4) NOT NULL;

CREATE TABLE grades (
  id INT NOT NULL AUTO_INCREMENT,
  crn INT NOT NULL,
  RIN INT NOT NULL,
  grade INT(3) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (crn) REFERENCES courses(crn),
  FOREIGN KEY (RIN) REFERENCES students(RIN)
);

INSERT INTO courses (crn, prefix, number, title, section, year)
VALUES
(10001, 'CSCI', 1200, 'Data Structures', 2, 2025),
(10002, 'CSCI', 2200, 'Foundations of Computer Science', 5, 2025),
(10003, 'ASTR', 2120, 'Earth and Sky', 1, 2025),
(10004, 'ITWS', 2110, 'Web Systems Development', 9, 2025);

ALTER TABLE students MODIFY phone BIGINT(10);

INSERT INTO students (RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip)
VALUES
(660000001, 'smithj', 'John', 'Smith', 'jsmith', 5185551111, '12 Oak St', 'Troy', 'NY', '12180'),
(660000002, 'doej', 'Jane', 'Doe', 'jdoe', 5185552222, '45 Pine Ave', 'Albany', 'NY', '12207'),
(660000003, 'brownm', 'Michael', 'Brown', 'mbrown', 5185553333, '78 Maple Rd', 'Schenectady', 'NY', '12305'),
(660000004, 'leew', 'Wendy', 'Lee', 'wlee', 5185554444, '90 Elm Blvd', 'Saratoga', 'NY', '12866');

INSERT INTO grades (crn, RIN, grade)
VALUES
(10001, 660000001, 92),
(10001, 660000002, 85),
(10002, 660000003, 88),
(10002, 660000004, 91),
(10003, 660000001, 79),
(10003, 660000002, 83),
(10004, 660000003, 95),
(10004, 660000004, 87),
(10001, 660000003, 90),
(10002, 660000001, 84);

SELECT * FROM students
ORDER BY RIN;

SELECT * FROM students
ORDER BY last_name;

SELECT * FROM students
ORDER BY RCSID;

SELECT * FROM students
ORDER BY first_name;

SELECT DISTINCT
    s.RIN,
    s.first_name,
    s.last_name,
    s.street,
    s.city,
    s.state,
    s.zip
FROM 
    students s
JOIN 
    grades g ON s.RIN = g.rin
WHERE 
    g.grade > 90;

SELECT 
    c.crn,
    c.prefix,
    c.number,
    c.title,
    AVG(g.grade) AS avg_grade
FROM 
    courses c
JOIN 
    grades g ON c.crn = g.crn
GROUP BY 
    c.crn, c.prefix, c.number, c.title;

SELECT 
    c.crn,
    c.prefix,
    c.number,
    c.title,
    COUNT(g.rin) AS num_students
FROM 
    courses c
JOIN 
    grades g ON c.crn = g.crn
GROUP BY 
    c.crn, c.prefix, c.number, c.title;


JSON object:

{
  "Websys_course": {
    "Lectures": {
      "Lecture 1": {
        "Title": "The Basics",
        "Description": "Introduction to web systems and general overview."
      },
      "Lecture 2": {
        "Title": "CSS Part 1",
        "Description": "Basics of styling web pages with CSS."
      },
      "Lecture 3": {
        "Title": "CSS Part 2",
        "Description": "Advanced CSS techniques and layouts."
      },
      "Lecture 4": {
        "Title": "JavaScript",
        "Description": "Client-side scripting with JavaScript."
      },
      "Lecture 5": {
        "Title": "AJAX and JSON",
        "Description": "Asynchronous requests and working with JSON data."
      },
      "Lecture 6": {
        "Title": "APIs",
        "Description": "Using external APIs to fetch and manipulate data."
      },
      "Lecture 7": {
        "Title": "Front End Optimization",
        "Description": "Improving website performance and user experience."
      },
      "Lecture 8": {
        "Title": "PHP",
        "Description": "Server-side scripting basics with PHP."
      },
      "Lecture 9": {
        "Title": "MySQL",
        "Description": "Introduction to relational databases and MySQL."
      },
      "Lecture 10": {
        "Title": "More PHP",
        "Description": "Advanced PHP features and integration with MySQL."
      },
      "Lecture 11": {
        "Title": "Authorization and Authentication",
        "Description": "User login, sessions, and access control."
      }
    },
    "Labs": {
      "Lab 1": {
        "Title": "Setup Development Environment",
        "Description": "Install VS Code, Node.js, and browser dev tools."
      },
      "Lab 2": {
        "Title": "Build First Web Page",
        "Description": "Create a simple HTML page with CSS styling."
      },
      "Lab 3": {
        "Title": "JavaScript Interaction",
        "Description": "Add interactive elements with JavaScript."
      },
      "Lab 4": {
        "Title": "PHP and MySQL Integration",
        "Description": "Connect a PHP application to a MySQL database."
      }
    }
  }
}

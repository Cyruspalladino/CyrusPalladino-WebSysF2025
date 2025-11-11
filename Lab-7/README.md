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
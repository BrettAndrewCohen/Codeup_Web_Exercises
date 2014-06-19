CREATE TABLE albums (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    artist VARCHAR(240) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO albums (artist, name, year) 
VALUES ('Michael Jackson', 'Thriller', 1982),
        ('Pink Floyd', 'The Dark Side of the Moon', 1973),
        ('Eagles', 'Their Greatest Hits', 1976),
        ('AC/DC', 'Back in Black', 1976),
        ('Bee Gees', 'Saturday Night Fever', 1977),
        ('Fleetwood Mac', 'Rumours', 1977),
        ('Whitney Houston', 'The Bodyguard', 1992),
        ('Shania Twain', 'Come On Over', 1997),
        ('Led Zeppelin', 'Led Zeppelin IV', 1971),
        ('Meat Loaf', 'Bat Out of Hell', 1977);

SELECT users.name AS user_name, roles.name AS role_name
FROM users
JOIN roles ON users.role_id = roles.id;

SELECT roles.name AS role_name, COUNT(users.id) AS number_of_users
FROM users
RIGHT JOIN roles ON users.role_id = roles.id
GROUP BY roles.name;

Using the example in the "Associative Table Joins" section as a guide, 
write a query that shows each department along with the name of the current manager for that department.

/* Using the example in the "Associative Table Joins" section as a guide, write a query that shows each department along with the name of the current manager for that department. */
-- MY SOLUTION

SELECT departments.dept_name AS department, dept_manager.dept_no AS manager
FROM departments
JOIN dept_manager
ON dept_manager.dept_no = departments.dept_no
JOIN employees
ON employees.emp_no = dept_manager.emp_no;

/* WHERE dept_manager.to_date = '9999-01-01'; */
-- Bens Solution

SELECT d.dept_name, e.first_name, e.last_name
FROM departments d
LEFT JOIN dept_manager dm 
ON d.dept_no = dm.dept_no
LEFT JOIN employees e 
ON dm.emp_no = e.emp_no
WHERE dm.to_date = '9999-01-01';

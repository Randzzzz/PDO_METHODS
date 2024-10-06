# PDO METHODS ACTIVITY

1.	SCHEMA + DATABASE RECORDS <br>
https://github.com/Randzzzz/PDO_METHODS/blob/main/schema.sql
https://github.com/Randzzzz/PDO_METHODS/blob/main/data.sql

  	
2.	SHOW CODE OF YOUR DBCONFIG.PHP FILE
```php
<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "cornita"; //database name
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn, $user, $password);
$pdo->exec("SET time_zone = '+08:00';");

?>
```

3.	SHOW CODE DEMONSTRATING FETCH_ALL(). USE PRINT_R(). WITH <'pre'> TAG IN BETWEEN. 
```php
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $query = "SELECT * FROM students"; //sql stmt
  
  $stmt = $pdo->prepare($query); //prepare sql
  
  if ($stmt->execute()) { //execute sql
  
    echo "<pre>";
    print_r($stmt->fetchAll()); //to fetch all data
    echo "<pre>";
  }

  ?>

</body>

</html>
```
4.	SHOW CODE DEMONSTRATING HOW FETCH() IS USED. USE PRINT_R(). WITH <'pre'> TAG IN BETWEEN. 
```php
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $query = "SELECT * FROM students
            WHERE students.student_id = 20"; //sql stmt
  
  $stmt = $pdo->prepare($query); //prepare sql
  
  if ($stmt->execute()) { //execute sql
  
    echo "<pre>";
    print_r($stmt->fetch()); //to fetch all data
    echo "<pre>";
  }

  ?>

</body>

</html>
```
5.	SHOW CODE DEMONSTRATING INSERTION OF RECORD TO YOUR DATABASE
```php
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $query = "INSERT INTO students (student_id, first_name, last_name, student_number, year_level) VALUES (?, ?, ?, ?, ?)"; //sql stmt
  
  $stmt = $pdo->prepare($query); //prepare sql
//parameters
  $student_id = 21;
  $first_name = 'Ronnette';
  $last_name = 'Navacruz';
  $student_number = 690;
  $year_level = 3;

  $executeQuery = $stmt->execute(
    [$student_id, $first_name, $last_name, $student_number, $year_level]
  );//insert new data in student table
  
  if ($executeQuery) {
    echo "Query Successful!<br>";
    echo "Inserted data in students table:<br>";

    echo "Student id:" . $student_id . "<br>";
    echo "First name:" . $first_name . "<br>";
    echo "Last name:" . $last_name . "<br>";
    echo "Student number:" . $student_number . "<br>";
    echo "Year level:" . $year_level . "<br>";
  } else {
    echo "Query failed";
  }

  ?>

</body>

</html>
```
6.	SHOW CODE DEMONSTRATING DELETION OF RECORD TO YOUR DATABASE
```php
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $query = "DELETE FROM students WHERE student_id = ?"; //sql stmt
  
  $stmt = $pdo->prepare($query); //prepare sql
  
  //parameters
  $student_id = 21;

  $executeQuery = $stmt->execute([$student_id]);//delete previous data from student table
  
  if ($executeQuery) {
    echo "Delete Successful!<br>";
    echo "Deleted data in students table:" . $student_id . "<br>";
  } else {
    echo "Delete failed";
  }
  ?>

</body>

</html>
```
7.	SHOW CODE DEMONSTRATING UPDATING OF RECORD FROM YOUR DATABASE
```php
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $query = "UPDATE booksellers SET first_name = ?, last_name = ? WHERE bookseller_id = 5"; //sql stmt
  
  $stmt = $pdo->prepare($query); //prepare sql
  
  //parameters
  $first_name = 'Rochelle';
  $last_name = 'Abacruz';

  $executeQuery = $stmt->execute([$first_name, $last_name]);//update data from booksellers table
  
  if ($executeQuery) {
    echo "Update Successful!<br>";
    echo "Updated data in booksellers table:<br>";
    echo "First name:" . $first_name . "<br>";
    echo "Last name:" . $last_name . "<br>";
  } else {
    echo "Update failed";
  }
  ?>

</body>

</html>
```
8.	SHOW CODE DEMONSTRATING AN SQL QUERY’S RESULT SET IS RENDERED ON AN HTML TABLE
```php
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table,
    th,
    td {
      border: 2px solid black;
      font-family: Arial;
    }

    th {
      font-size: 20px;
      padding: 5px;
    }

    td {
      text-align: center;
      padding: 5px;
    }
  </style>
</head>

<body>
  <?php
  $query = "SELECT
              Books.book_id AS book_id,
              Books.title AS book_title,
              COUNT(Sales.book_id) AS sales_count
            FROM Sales
            INNER JOIN Books ON
              Sales.book_id = Books.book_id
            GROUP BY Books.book_id;"; //sql stmt
  
  $stmt = $pdo->prepare($query); //prepare sql
  

  if ($stmt->execute()) {
    $books = $stmt->fetchAll();// Fetch all results
  } else {
    echo "Query failed";
  }
  ?>
  <table>
    <tr>
      <th>Book ID</th>
      <th> Title</th>
      <th>Sales Count</th>
    </tr>
    <?php foreach ($books as $row) { ?>
      <tr>
        <td><?php echo $row['book_id']; ?></td>
        <td><?php echo $row['book_title']; ?></td>
        <td><?php echo $row['sales_count']; ?></td>
      </tr>
    <?php } ?>

  </table>
</body>

</html>
```






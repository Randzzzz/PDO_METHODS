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
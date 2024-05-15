<?php

include 'dbconn.php'; // Includes the database connection file.

$query = "SELECT * FROM user"; // SQL query to select all records from the 'user' table.
$result = mysqli_query($conn, $query); // Executes the SQL query using the established database connection.

$totalAllTotals = 0; // Initializes a variable to store the sum of all totals.
$individualTotals = []; // Initializes an array to store individual totals.

// The while loop fetches each row from the result set as an associative array.
while ($row = mysqli_fetch_assoc($result)) {
  $name = $row['name']; // Retrieves the 'name' from the current row.
  $count = $row['count']; // Retrieves the 'count' from the current row.
  $price = $row['price']; // Retrieves the 'price' from the current row.
  $total = $count * $price; // Calculates the total price for the current row.
  $totalAllTotals += $total; // Adds the total price to the overall total.
  
  // Adds an associative array with the name, count, price, and total for the current row to the $individualTotals array.
  $individualTotals[] = [
      'name' => $name,
      'count' => $count,
      'price' => $price,
      'total' => $total
  ];
}

mysqli_close($conn); // Closes the database connection.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tfoot th {
            background-color: #e9e9e9;
            text-align: right;
            font-weight: bold;
            font-size: 18px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Medicine Report</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($individualTotals as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['count']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['total']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th><?php echo $totalAllTotals; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

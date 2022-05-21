<?php
session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit cars</title>

<head>
    <title>edit car</title>
    <link rel="stylesheet" href="car.css">
</head>

<body>
    <div>
    <nav>
        <a href="homepage.php">HOME</a>
        <a href="admin_index.php">RETURN</a>
        <a href="admin_logout.php">LOGOUT</a>
    </nav><br>
    
    </div>

    <?php

    $query = "SELECT
        
        ca.car_id,
        ca.plate_id,
        ca.model,
        ca.color,
        ca.country,
        ca.city,
        ca.year,
        ca.cost_per_day,
        ca.status
        
        
    FROM car as ca ;";
    $result = mysqli_query($con, $query);

    echo "<table border = '1px'>";

    if ($result->num_rows > 0) {

        echo "<tr>";
        echo "<th>Car ID</th>";
        echo "<th>Plate ID</th>";
        echo "<th>Model</th>";
        echo "<th>Color</th>";
        echo "<th>Country</th>";
        echo "<th>City</th>";
        echo "<th>Year</th>";
        echo "<th>Cost</th>";
        echo "<th>Status</th>";
        echo "<th>Edit</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo '<form method = "GET" action = "edit_car_view.php">';
            echo "<tr>";
            echo "<td>{$row['car_id']}</td>";
            echo "<td>{$row['plate_id']}</td>";
            echo "<td>{$row['model']}</td>";
            echo "<td>{$row['color']}</td>";
            echo "<td>{$row['country']}</td>";
            echo "<td>{$row['city']}</td>";
            echo "<td>{$row['year']}</td>";
            echo "<td>{$row['cost_per_day']}</td>";
            echo "<td>{$row['status']}</td>";
            echo '<td><input type = "submit" name = "status"  value = "Update"/></td>';
            echo "</tr>";
            echo '<input type="hidden" name="car_id" id="car_id" value="' . $row['car_id'] . '">';
            echo '</form>';
        }
        echo "</table>";
    } else {
        echo "no search results";
    }
    mysqli_close($con); 
    ?>

</html>
<?php

echo '<title>Change Car Status</title>';

session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something got posted

    $car_id = $_POST['car_id'];
    $status = $_POST['status'];


    if (strcmp($status, "Active") == 0) {

        $query = "Update car
            set status = 'Out of Service'
            where car_id = '" . $car_id . "'";
    } else {
        $query = "Update car
            set status = 'Active'
            where car_id = '" . $car_id . "'";
    }
    // run the query 
    if (!mysqli_query($con, $query))
        echo "Error updating record: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>Change Car status</title>
    <link rel="stylesheet" href="car.css">
</head>

<body>
<div>
    <nav>
        <a href="homepage.php">HOME</a>
        <a href="admin_index.php">RETURN</a>
        <a href="admin_logout.php">LOGOUT</a>
    </nav>
    </div>
    <p>  &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; Change Car status</p>
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
        echo "<th>Cost_per_day</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo '<form method = "POST" action = "">';
            echo "<tr>";
            echo "<td>{$row['car_id']}</td>";
            echo "<td>{$row['plate_id']}</td>";
            echo "<td>{$row['model']}</td>";
            echo "<td>{$row['color']}</td>";
            echo "<td>{$row['country']}</td>";
            echo "<td>{$row['city']}</td>";
            echo "<td>{$row['year']}</td>";
            echo "<td>{$row['cost_per_day']}</td>";
            echo '<td><input type = "submit" name = "status"  value = "' . $row['status'] . '"/></td>';
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
<?php

echo '<title>Status Report</title>';

session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something got posted
    $Date = $_POST['Date'];

    //read from database
    $query = "SELECT *
        from car 
        NATURAL JOIN reservation r
        WHERE '" . $Date . "' BETWEEN r.pick_up_date AND r.return_date";
    $result = mysqli_query($con, $query);
    echo "<table border='1px'>";

    // TODO CSS 
    if ($result->num_rows > 0) {
        echo "<h2 style='color:white;text-align:center;font-size:40px;'>Reserved Cars</h2>";
        echo "<tr>";
        echo "<td>Car ID</td>";
        echo "<td>Plate ID</td>";
        echo "<td>Model</td>";
        echo "<td>Country</td>";
        echo "<td>City</td>";
        echo "<td>Year</td>";
        echo "<td>Cost per day</td>";
        echo "<td>Pickup date</td>";
        echo "<td>Return date</td>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            $car_id = $row['car_id'];
            $plate_id = $row['plate_id'];
            $model = $row['model'];
            $country = $row['country'];
            $city = $row['city'];
            $year = $row['year'];
            $cost_per_day = $row['cost_per_day'];
            $pick_up_date = $row['pick_up_date'];
            $return_date = $row['return_date'];
            echo "<tr>";
            echo "<td>{$car_id}</td>";
            echo "<td>{$plate_id}</td>";
            echo "<td>{$model}</td>";
            echo "<td>{$country}</td>";
            echo "<td>{$city}</td>";
            echo "<td>{$year}</td>";
            echo "<td>{$cost_per_day}</td>";
            echo "<td>{$pick_up_date}</td>";
            echo "<td>{$return_date}</td>";
            echo "</tr>";
        }
        echo "</table>";


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    }




    $query = "SELECT *
        FROM car c1
        WHERE c1.car_id not IN (SELECT car_id
                                    from car 
                                    NATURAL JOIN reservation r
                                    WHERE '" . $Date . "' BETWEEN r.pick_up_date AND r.return_date);";
    $result = mysqli_query($con, $query);
    echo "<table border='1px'>";

    // TODO CSS 
    if ($result->num_rows > 0) {
        echo "<h2 style='color:white;text-align:center;font-size:40px;'>Not Reserved Cars</h2>";
        echo "<tr>";
        echo "<th>Car ID</th>";
        echo "<th>Plate ID</th>";
        echo "<th>Model</th>";
        echo "<th>Country</th>";
        echo "<th>City</th>";
        echo "<th>Year</th>";
        echo "<th>Cost per day</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {

            $car_id = $row['car_id'];
            $plate_id = $row['plate_id'];
            $model = $row['model'];
            $country = $row['country'];
            $city = $row['city'];
            $year = $row['year'];
            $cost_per_day = $row['cost_per_day'];
            echo "<tr>";
            echo "<td>{$car_id}</td>";
            echo "<td>{$plate_id}</td>";
            echo "<td>{$model}</td>";
            echo "<td>{$country}</td>";
            echo "<td>{$city}</td>";
            echo "<td>{$year}</td>";
            echo "<td>{$cost_per_day}</td>";
            echo "</tr>";
        }
        echo "</table>";


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    }
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>view status </title>
    <link rel="stylesheet" href="car.css">
</head>


</html>
<?php

echo '<title>Car Search</title>';

session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something got posted
    $icar_id = $_POST['car_id'];
    $iplate_id = $_POST['plate_id'];
    $imodel = $_POST['model'];
    $iyear = $_POST['year'];
    $icolor = $_POST['color'];
    $icountry = $_POST['country'];
    $icity = $_POST['city'];
    $icostperday = $_POST['costperday'];
    $istatus = $_POST['status'];

    $car_id = '\'';
    $plate_id = '\'';
    $model = '\'';
    $year = '\'';
    $color = '\'';
    $country = '\'';
    $city = '\'';
    $costperday = '\'';
    $status = '\'';

    if ($icar_id == "") {
        $car_id = 'ca.car_id';
    } else {
        $car_id .= $icar_id;
        $car_id .= '\'';
    }

    if ($iplate_id == "") {
        $plate_id = 'ca.plate_id';
    } else {
        $plate_id .= $iplate_id;
        $plate_id .= '\'';
    }

    if ($imodel == "") {
        $model = 'ca.model';
    } else {
        $model .= $imodel;
        $model .= '\'';
    }

    if ($iyear == "") {
        $year = 'ca.year';
    } else {
        $year .= $iyear;
        $year .= '\'';
    }

    if ($icolor == "") {
        $color = 'ca.color';
    } else {
        $color .= $icolor;
        $color .= '\'';
    }

    if ($icountry == "") {
        $country = 'ca.country';
    } else {
        $country .= $icountry;
        $country .= '\'';
    }

    if ($icity == "") {
        $city = 'ca.city';
    } else {
        $city .= $icity;
        $city .= '\'';
    }

    if ($icostperday == "") {
        $costperday = 'ca.cost_per_day';
    } else {
        $costperday .= $icostperday;
        $costperday .= '\'';
    }

    if ($istatus == "") {
        $status = 'ca.status';
    } else {
        $status .= $istatus;
        $status .= '\'';
    }

    //read from database
    $query = "SELECT
                    ca.car_id,
                    ca.plate_id,
                    ca.model,
                    ca.country,
                    ca.city,
                    ca.color,
                    ca.year,
                    ca.cost_per_day,
                    ca.status
                FROM
                    car AS ca
                WHERE
                    " . $car_id . " = ca.car_id 
                        AND 
                    " . $plate_id . " = ca.plate_id 
                        AND 
                    " . $model . " = ca.model
                        AND 
                    " . $country . " = ca.country
                        AND 
                    " . $city . " = ca.city
                        AND 
                    " . $color . " = ca.color
                        AND 
                    " . $year . " = ca.year
                        AND 
                    " . $costperday . " = ca.cost_per_day
                        AND 
                    " . $status . " = ca.status";

    $result = mysqli_query($con, $query);
    echo "<table border='1px'>";

    // TODO CSS 
    if ($result->num_rows > 0) {
        echo "<tr>";
        echo "<th>Car ID</th>";
        echo "<th>Plate ID</th>";
        echo "<th>Model</th>";
        echo "<th>Country</th>";
        echo "<th>City</th>";
        echo "<th>Year</th>";
        echo "<th>Color</th>";
        echo "<th>Cost per day</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            $car_id = $row['car_id'];
            $plate_id = $row['plate_id'];
            $model = $row['model'];
            $year = $row['year'];
            $color = $row['color'];
            $country = $row['country'];
            $city = $row['city'];
            $costperday = $row['cost_per_day'];
            $status = $row['status'];
            echo "<tr>";
            echo "<td>{$car_id}</td>";
            echo "<td>{$plate_id}</td>";
            echo "<td>{$model}</td>";
            echo "<td>{$country}</td>";
            echo "<td>{$city}</td>";
            echo "<td>{$year}</td>";
            echo "<td>{$color}</td>";
            echo "<td>{$costperday}</td>";
            echo "<td>{$status}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "no search results";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>car search</title>
    <link rel="stylesheet" href="car.css">
</head>

</html>
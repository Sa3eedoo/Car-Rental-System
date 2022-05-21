<?php

echo '<title>View Reservations</title>';

session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

//read from database
$query = "SELECT
                cu.customer_id,
                cu.license_id,
                cu.email,
                cu.fname,
                cu.lname,
                cu.pnumber,
                ca.car_id,
                ca.plate_id,
                ca.model,
                ca.country,
                ca.city,
                ca.year,
                ca.cost_per_day,
                r.pick_up_date,
                r.return_date,
                r.paid,
                DATEDIFF(return_date, pick_up_date) AS Rental_Duration,
                DATEDIFF(return_date, pick_up_date) * cost_per_day AS COST
            FROM
                    customer AS cu
                        NATURAL JOIN
                    car AS ca
                        NATURAL JOIN
                    reservation AS r
            WHERE
                    CURDATE() between r.pick_up_date AND r.return_date";

$result = mysqli_query($con, $query);
echo "<table border='1px'>";

// TODO CSS 
if ($result->num_rows > 0) {
    echo "<tr>";
    echo "<th>Customer ID</th>";
    echo "<th>License ID</th>";
    echo "<th>Email</th>";
    echo "<th>Customer first name</th>";
    echo "<th>Customer last name</th>";
    echo "<th>Phone number</th>";
    echo "<th>Car ID</th>";
    echo "<th>Plate ID</th>";
    echo "<th>Model</th>";
    echo "<th>Country</th>";
    echo "<th>City</th>";
    echo "<th>Year</th>";
    echo "<th>Cost per day</th>";
    echo "<th>Pickup date</th>";
    echo "<th>Return date</th>";
    echo "<th>Paid</th>";
    echo "<th>Rental duration</th>";
    echo "<th>Total cost</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_array($result)) {
        $customer_id = $row['customer_id'];
        $license_id = $row['license_id'];
        $email = $row['email'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $pnumber = $row['pnumber'];
        $car_id = $row['car_id'];
        $plate_id = $row['plate_id'];
        $model = $row['model'];
        $country = $row['country'];
        $city = $row['city'];
        $year = $row['year'];
        $cost_per_day = $row['cost_per_day'];
        $pick_up_date = $row['pick_up_date'];
        $return_date = $row['return_date'];
        $paid = $row['paid'];
        $Rental_Duration = $row['Rental_Duration'];
        $COST = $row['COST'];
        echo "<tr>";
        echo "<td>{$customer_id}</td>";
        echo "<td>{$license_id}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$fname}</td>";
        echo "<td>{$lname}</td>";
        echo "<td>{$pnumber}</td>";
        echo "<td>{$car_id}</td>";
        echo "<td>{$plate_id}</td>";
        echo "<td>{$model}</td>";
        echo "<td>{$country}</td>";
        echo "<td>{$city}</td>";
        echo "<td>{$year}</td>";
        echo "<td>{$cost_per_day}</td>";
        echo "<td>{$pick_up_date}</td>";
        echo "<td>{$return_date}</td>";
        echo "<td>{$paid}</td>";
        echo "<td>{$Rental_Duration}</td>";
        echo "<td>{$COST}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no search results";
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>view reservations</title>
    <link rel="stylesheet" href="car.css">
</head>

</html>
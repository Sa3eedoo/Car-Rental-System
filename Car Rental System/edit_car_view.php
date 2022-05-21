<?php
session_start();

echo '<title>Edit Car</title>';

include("connection.php");
include("admin_function.php");
$admin_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something got posted

    //something got posted
    $car_id = $_POST['car_id'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $cost_per_day = $_POST['costperday'];


    //$query="insert into car (model,city,country,color,year,cost_per_day) values ('$model','$city','$country','$color','$year','$cost_per_day')";

    $query = "Update car
    set model = '" . $model . "' ,year = '" . $year . "' ,color = '" . $color . "' ,country = '" . $country . "' ,city = '" . $city . "' ,cost_per_day = '" . $cost_per_day . "'
    where car_id = '" . $car_id . "'";

    // run the query 
    if (!mysqli_query($con, $query))
        echo "Error updating record: " . mysqli_error($conn);

    header("Location:edit_car.php");
    die;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit car</title>
    <script>
        //information validation
        function validateForm() {
            var plate_id = document.forms["myForm"]["plate_id"].value;
            if (plate_id == "") {
                alert("plate Id must be filled out");
                return false;
            }
            var model = document.forms["myForm"]["model"].value;
            if (model == "") {
                alert("Car model must be filled out");
                return false;
            }
            var year = document.forms["myForm"]["year"].value;
            if (year == "") {
                alert("model year must be filled out");
                return false;
            }
            if (year < 1886 || year > 2022) {
                alert("wrong year!!");
                return false;
            }
            var color = document.forms["myForm"]["color"].value;
            if (color == "") {
                alert("car color must be filled out");
                return false;
            }
            var country = document.forms["myForm"]["country"].value;
            if (country == "") {
                alert("country must be filled out");
                return false;
            }
            var city = document.forms["myForm"]["city"].value;
            if (city == "") {
                alert("city must be filled out");
                return false;
            }
            var cost_per_day = document.forms["myForm"]["costperday"].value;
            if (cost_per_day == "") {
                alert("car cost per day must be filled out");
                return false;
            }
            var status = document.forms["myForm"]["status"].value;
            if (status == "") {
                alert("car status must be filled out");
                return false;
            }
            if (status != "Active" && status != "Out of service") {
                alert("invalid car status!!");
                return false;
            }
           
        }
    </script>

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

    $car_id = $_GET['car_id'];

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
    FROM car as ca
    WHERE ca.car_id = '" . $car_id . "'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    echo "<main>";
    echo "<div class='edit'>";
    echo '<form method = "POST" onsubmit="return validateForm()" action = "">';
    echo "<p>Model</p>";
    echo "<input type='text' name='model' value={$row['model']}>";
    echo "<p>Year</p>";
    echo "<input type='text' name='year' value={$row['year']}>";
    echo "<p>Color</p>";
    echo "<input type='text' name='color' value={$row['color']}>";
    echo "<p>Country</p>";
    echo "<input type='text' name='country' value={$row['country']}>";
    echo "<p>City</p>";
    echo "<input type='text' name='city' value={$row['city']}>";
    echo "<p>Cost per day</p>";
    echo "<input type='text' name='costperday' value={$row['cost_per_day']}>";
    echo "<input type='submit' value='Update car'><br>";
    echo '<input type="hidden" name="car_id" id="car_id" value="' . $row['car_id'] . '">';
    echo '</form>';
    echo "</div>";
    echo "</main>";



    ?>
    </< /body>>

</html>




<!-- <p>Year</p>
             <input type="number" name="year" id="" placeholder="Enter model year">
             <p>Color</p>
             <input type="text" name="color" placeholder="Enter car color"><br>
             <p>Country</p>
             <input type="text" name="country" placeholder="Enter country"><br>
             <p>City</p>
             <input type="text" name="city" placeholder="Enter city"><br>
             <p>Cost per day</p>
             <input type="number" name="costperday" placeholder="Enter car cost per day"><br>
             <p>Car status</p>
             <input type="text" name="status" placeholder="Active/Out of service"><br>
             <input type="submit" name="" value="Add car"><br> -->
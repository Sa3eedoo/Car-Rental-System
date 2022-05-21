<?php
session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced search</title>
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
    <main>
    <div class= "index">
    
    <header>
        <img src="wheel.png" alt="logo">
     </header>

     <h1>The Wheel Deal</h1>
    
        <a href="advanced_car_search.php">Car search</a>
        <a href="advanced_customer_search.php">Customer search</a>
        <a href="advanced_reservation_search.php">Reservation search</a>
    
    </div>
    </main>
</body>
</html>
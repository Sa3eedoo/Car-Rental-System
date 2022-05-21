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
    <title>admin index</title>
    <link rel="stylesheet" href="car.css">
</head>

<body>
    <div class="admin_index">

        <header>
            <img src="wheel.png" alt="logo">
        </header>

        <h1>The Wheel Deal</h1>
        <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Hello , <?php echo $admin_data['fname']; ?></p>

        <!-- <a href="homepage.php">Home</a> -->
        <a href="admin_signup.php">Register new admin</a>
        <a href="add_car.php">Add new car</a>
        <a href="edit_car.php">Edit car</a>
        <a href="change_car_status.php">Change Car Status</a>
        <a href="view_reports.php">View reports</a>
        <a href="view_view_reservations.php">View reservations</a>
        <a href="advanced_search_index.php">Advanced search</a>
        <a href="admin_logout.php">LOGOUT</a>

    </div>

</body>

</html>
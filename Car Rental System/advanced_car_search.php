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
    <title>Car Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();
                var icar_id = $("#car_id").val;
                var iplate_id = $("#plate_id").val;
                var imodel = $("#model").val;
                var iyear = $("#year").val;
                var icolor = $("#color").val;
                var icountry = $("#country").val;
                var icity = $("#city").val;
                var icostperday = $("#costperday").val;
                var istatus = $("#status").val;
                $(.form - message).load("view_car_search.php", {
                    car_id: icar_id,
                    plate_id: iplate_id,
                    model: imodel,
                    year: iyear,
                    color: icolor,
                    country: icountry,
                    city: icity,
                    costperday: icostperday,
                    status: istatus
                })
            });
        });
    </script>
    <script>
        //information validation
        function validateForm() {

        }
    </script>

    <link rel="stylesheet" href="car.css">
</head>

<body>
    <div>
    <nav>
        <a href="homepage.php">HOME</a>
        <a href="advanced_search_index.php">RETURN</a>
        <a href="admin_logout.php">LOGOUT</a>
        
    </nav>
    </div>
    <main>
        <div class="add_car">
            <form action="view_car_search.php" name="myForm" onsubmit="return validateForm()" method="post">
                <form name="myForm" onsubmit="return validateForm()" method="post">
                    <p>Car ID</p>
                    <input type="text" name="car_id" id="" placeholder="Enter car Id">
                    <p>Plate ID</p>
                    <input type="text" name="plate_id" id="" placeholder="Enter plate Id">
                    <p>Model</p>
                    <input type="text" name="model" id="" placeholder="Enter car model">
                    <p>Year</p>
                    <input type="text" name="year" id="" placeholder="Enter model year">
                    <p>Color</p>
                    <input type="text" name="color" placeholder="Enter car color"><br>
                    <p>Country</p>
                    <input type="text" name="country" placeholder="Enter country"><br>
                    <p>City</p>
                    <input type="text" name="city" placeholder="Enter city"><br>
                    <p>Cost per day</p>
                    <input type="text" name="costperday" placeholder="Enter car cost per day"><br>
                    <p>Car status</p>
                    <input type="text" name="status" placeholder="Active/Out of service"><br>

                    <input type="submit" name="" value="Search"><br>
                </form>
            </form>
        </div>
    </main>
</body>

</html>
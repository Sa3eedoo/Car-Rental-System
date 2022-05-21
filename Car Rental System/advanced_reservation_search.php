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
    <title>Reservation Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();
                var iDate = $("#Date").val;
                $(.form - message).load("view_reservation_search.php", {
                    Date: iDate
                })
            });
        });
    </script>
    <script>
        //information validation
        function validateForm() {
            var start_date = document.forms["myForm"]["date"].value;
            if (start_date == "") {
                alert("Start date must be filled out");
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
        <a href="advanced_search_index.php">RETURN</a>
        <a href="admin_logout.php">LOGOUT</a>
        
    </nav>
    </div>
    <main>
        <div class="view3">
            <form action="view_reservation_search.php" name="myForm" onsubmit="return validateForm()" method="post">
                <p>Date</p>
                <input type="date" name="Date" id="" placeholder="YYYY-MM-DD">

                <input type="submit" name="" value="submit"><br>
            </form>
        </div>
    </main>
</body>

</html>
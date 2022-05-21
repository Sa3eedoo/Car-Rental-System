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
    <title>Customer Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();
                var icustomer_id = $("#customer_id").val;
                var ilicense_id = $("#license_id").val;
                var iemail = $("#email").val;
                var ifname = $("#fname").val;
                var ilname = $("#lname").val;
                var ipnumber = $("#pnumber").val;
                $(.form - message).load("view_customer_search.php", {
                    customer_id: icustomer_id,
                    license_id: ilicense_id,
                    email: iemail,
                    fname: ifname,
                    lname: ilname,
                    pnumber: ipnumber
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
            <form action="view_customer_search.php" name="myForm" onsubmit="return validateForm()" method="post">
                <form name="myForm" onsubmit="return validateForm()" method="post">
                    <p>Customer ID</p>
                    <input type="text" name="customer_id" id="" placeholder="Enter Customer Id">
                    <p>License ID</p>
                    <input type="text" name="license_id" id="" placeholder="Enter License Id">
                    <p>Email</p>
                    <input type="text" name="email" id="" placeholder="Enter email">
                    <p>First name</p>
                    <input type="text" name="fname" id="" placeholder="Enter First Name">
                    <p>Last name</p>
                    <input type="text" name="lname" placeholder="Enter Last Name"><br>
                    <p>Phone number</p>
                    <input type="text" name="pnumber" placeholder="Enter Phone Number"><br>

                    <input type="submit" name="" value="Search"><br>
                </form>
            </form>
        </div>
    </main>
</body>

</html>
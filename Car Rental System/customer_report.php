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
    <title>Customer Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("form").submit(function(event){
                event.preventDefault();
                var icustomer_email = $("#customer_email").val;
                $(.form-message).load("view_customer_report.php",{
                    customer_email: icustomer_email
                })
            });
        });
    </script>
    <script>
     
        //information validation
        function validateForm(){
            var start_date=document.forms["myForm"]["customer_email"].value;
            if(start_date==""){
                alert("customer_email must be filled out");
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
        <a href="view_reports.php">RETURN</a>
        <a href="admin_logout.php">LOGOUT</a>
    </nav>
    </div>
    <main>
     <div class="view3">
         <form action="view_customer_report.php" name ="myForm" onsubmit="return validateForm()"  method="post">
             <p>Customer Email</p>
             <input type="text" name="customer_email" id="" placeholder="Enter Customer Email">
             
             <input type="submit" name="" value="submit"><br>
         </form>
     </div>      
    </main>
</body>
</html>
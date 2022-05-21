<?php
session_start();
include("connection.php");
include("customer_function.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer index</title>
    <script>
        // validation
        function validatesearch(){
            var country=document.forms["searchform"]["country"].value;
            if(country==""){
                alert("country must be filled out");
                return false;
            }
            var city=document.forms["searchform"]["city"].value;
            if(city==""){
                alert("city must be filled out");
                return false;
            }
            var pickupdate=document.forms["searchform"]["pickupdate"].value;
            if(pickupdate==""){
                alert("pickupdate must be filled out");
                return false;
            }
            var reterndate=document.forms["searchform"]["returndate"].value;
            if(returndate==""){
                alert("returndate must be filled out");
                return false;
            }
            if(pickupdate>=returndate){
                alert("incorrect return date")
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
        <a href="customer_logout.php">LOGOUT</a>
        
    </nav><br>
    </div>

   <div class="customer_index">
        <p>Hello , <?php echo $user_data['fname']; ?></p><br><hr>
        
         <form action="customer_view_car.php" name ="searchform" onsubmit="return validatesearch()" method="post" id="searchform">
             <p>country</p>
             <input id="country" type="text" name="country" placeholder="Enter country">
             <p>city</p>
             <input id="city" type="text" name="city" placeholder="Enter city">
             <p>pick up date</p>
             <input id="pickupdate" type="date" name="pickupdate">
             <p>return date</p>
             <input id="returndate" type="date" name="returndate">
             <input id="submit" type="submit" value="find a car"><br>
             
         </form>
   </div>
</body>
</html>
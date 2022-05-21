<?php
session_start();
include("connection.php");
include("customer_function.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD']=="POST")
{  
    
    $country=$_POST['country'];
    $city=$_POST['city'];
    $pickup_date=$_POST['pickupdate'];
    $return_date=$_POST['returndate'];
    $reservePlateid = $_POST['reservePlateid'];
    
    $customer_id = $user_data["customer_id"];
    

    
    $query="UPDATE reservation SET paid = 'yes'
        WHERE car_id = (SELECT car_id from reservation As r
        Natural join car As c
        where c.plate_id = '$reservePlateid'
        And r.pick_up_date = '$pickup_date'
        And r.return_date = '$return_date'
        And r.customer_id = '$customer_id'
    );";
    $result=mysqli_query($con ,$query);
   

}
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>thank you page</title>
        <link rel="stylesheet" href="car.css">
    </head>

    <body>
    <div>
       <nav>
        <a href="homepage.php">HOME</a>
        <a href="customer_index.php">RESERVE ANOTHER CAR</a>
        <a href="customer_logout.php">LOGOUT</a>
        
       </nav><br>
    </div>
      <H1>We thank you for paying</H1>
    </body>
</html>
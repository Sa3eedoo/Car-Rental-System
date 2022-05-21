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
    $reservePlateid = $_POST['plate_id'];

}
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>Reserve Car</title>
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
<?php
    //read from database
    $query_new="SELECT * from car AS c
    where plate_id = '$reservePlateid'
    and c.country= '$country' 
    and c.city = '$city' 
    and c.status='Active'
    and Not Exists(
        SELECT * FROM reservation AS r
        WHERE r.car_id =c.car_id
        and ((r.pick_up_date BETWEEN '$pickup_date' AND '$return_date')
        OR (r.return_date BETWEEN '$pickup_date' AND ' $return_date'))
    );";

    $result_new = mysqli_query($con ,$query_new);

    $customer_id = $user_data["customer_id"];
    if($result_new && mysqli_num_rows($result_new) >0)
    {
        $car_data = mysqli_fetch_assoc($result_new);
        $customer_id = $user_data['customer_id'];
        $car_id = $car_data['car_id'];
        $query_new_new = "insert into reservation values ('$customer_id','$car_id','$pickup_date','$return_date','no')";
        mysqli_query($con ,$query_new_new);
        $query = "SELECT DATEDIFF(return_date, pick_up_date) AS Rental_Duration,
                    (DATEDIFF(return_date, pick_up_date)+1) * cost_per_day AS COST
                    FROM car NATURAL JOIN reservation
                    WHERE plate_id = '$reservePlateid' 
                    and pick_up_date = '$pickup_date'
                    and return_date = '$return_date';";
        $result = mysqli_query($con ,$query);
        $reservation_info = mysqli_fetch_assoc($result);
    }
    else
    {
        echo"No such a car in the database with this plate id Or Enter the same date entered before";
    }
?>
        
       
        <?php if($result_new && mysqli_num_rows($result_new) >0)
        { ?>
            <div class="customer_specs">
            <form action="customer_pay.php" name ="searchform" method="post" id="searchform">
                   <p> Plate ID:  <?php echo $car_data['plate_id']; ?> <br>
                    Model:  <?php echo $car_data['model']; ?> <br>
                    City:  <?php echo $car_data['city']; ?> <br>
                    Country:  <?php echo $car_data['country']; ?> <br>
                    Colour:  <?php echo $car_data['color']; ?> <br>
                    Year:  <?php echo $car_data['year']; ?> <br>
                    Cost Per Day:  <?php echo $car_data['cost_per_day']; ?> <br>
                    Total Cost: <?php echo $reservation_info['COST']; ?> <br><hr></p>
                    <?php echo '<input type="hidden" name="city" id="city" value="'.$city.'">';
                        echo '<input type="hidden" name="country" id="country" value="'.$country.'">';
                        echo '<input type="hidden" name="pickupdate" id="pickupdate" value="'.$pickup_date.'">';
                        echo '<input type="hidden" name="returndate" id="returndate" value="'.$return_date.'">';
                        echo ' <input type="hidden" name="reservePlateid" id="reservePlateid" value="'.$car_data['plate_id'].'">';?>
                    <input type = "submit" name = "reservePlateidsubmit" class = "reservePlateidsubmit" value = "Proceed"/> <br>
            </form>
            </div>
        <?php } ?>
    </body>
</html>
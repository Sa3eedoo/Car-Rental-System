<?php
session_start();
include("connection.php");
include("customer_function.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD']=="POST")
{
        //something got posted
        
        $country=$_POST['country'];
        $city=$_POST['city'];
        $pickup_date=$_POST['pickupdate'];
        $return_date=$_POST['returndate'];

        $imodel=$_POST['model'];
        $iyear=$_POST['year'];
        $icolor=$_POST['color'];
        $icostperday=$_POST['costperday'];

        $model='\'';
        $year='\'';
        $color='\'';
        $costperday='\'';

        if($imodel==""){
            $model = 'c.model';
        }
        else {
            $model .= $imodel;
            $model .= '\'';
        }

        if($iyear==""){
            $year = 'c.year';
        }
        else {
            $year .= $iyear;
            $year .= '\'';
        }

        if($icolor==""){
            $color = 'c.color';
        }
        else {
            $color .= $icolor;
            $color .= '\'';
        }

        if($icostperday==""){
            $costperday = 'c.cost_per_day';
        }
        else {
            $costperday .= $icostperday;
            $costperday .= '\'';
        }
        

            $query="SELECT * from car AS c
            where c.country= '$country' 
            and c.city = '$city' 
            and c.status='Active'
            and ".$model." = c.model
                        AND 
                    ".$color." = c.color
                        AND 
                    ".$year." = c.year
                        AND 
                    ".$costperday." = c.cost_per_day
            and Not Exists(
                SELECT * FROM reservation AS r
                WHERE r.car_id =c.car_id
                and ((r.pick_up_date BETWEEN '$pickup_date' AND '$return_date')
                OR (r.return_date BETWEEN '$pickup_date' AND ' $return_date'))
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
        <title>customer view cars</title>
        <link rel="stylesheet" href="car.css">
    </head>
    <body>
    <div>
<nav>
        <a href="homepage.php">HOME</a>
        <a href="customer_index.php">RETURN</a>
        <a href="customer_logout.php">LOGOUT</a>
        
    </nav><br>
</div>
<?php 
if($result->num_rows >0){
    echo "<table border='1px'>";
    echo "<tr>";
        echo "<th>Plate Id</th>";
        echo "<th>Model</th>";
        echo "<th>Year</th>";
        echo "<th>Color</th>";
        echo "<th>Cost Per Day</th>";
        echo "<th>Reserve</th>";
    echo "</tr>";
while($row=mysqli_fetch_array($result))
{
    echo '<form method = "POST" action = "customer_reserve_car.php">';
    echo "<tr>";
    echo "<td>{$row['plate_id']}</td>";
    echo "<td>{$row['model']}</td>";
    echo "<td>{$row['color']}</td>";
    echo "<td>{$row['year']}</td>";
    echo "<td>{$row['cost_per_day']}</td>";
    echo '<td><input type = "submit" name = "status"  value = "Reserve Car"/></td>';
    echo "</tr>";
    echo '<input type="hidden" name="plate_id" id="plate_id" value="'.$row['plate_id'].'">';
    echo '<input type="hidden" name="city" id="city" value="'.$city.'">';
    echo '<input type="hidden" name="country" id="country" value="'.$country.'">';
    echo '<input type="hidden" name="pickupdate" id="pickupdate" value="'.$pickup_date.'">';
    echo '<input type="hidden" name="returndate" id="returndate" value="'.$return_date.'">';
    echo '</form>';
    
}
echo"</table>";
}
else
{
echo"no search results";
}
mysqli_close($con); //Make sure to close out the database connection
?>
   <br>
   <div class="customer_advanced_search">
   <form action="customer_view_car_advanced_search.php" name ="searchform" method="post" id="searchform">
        <p>Advanced search if you need</p><hr>
        <p>Model</p>
        <input type="text" name="model" id="model" placeholder="Enter car model">
        <p>Year</p>
        <input type="text" name="year" id="year" placeholder="Enter model year">
        <p>Color</p>
        <input type="text" name="color" id="color" placeholder="Enter car color"><br>
        <p>Cost per day</p>
        <input type="text" name="costperday" id="costperday" placeholder="Enter car cost per day">
        <?php echo '<input type="hidden" name="city" id="city" value="'.$city.'">';
    echo '<input type="hidden" name="country" id="country" value="'.$country.'">';
    echo '<input type="hidden" name="pickupdate" id="pickupdate" value="'.$pickup_date.'">';
    echo '<input type="hidden" name="returndate" id="returndate" value="'.$return_date.'">';?>
        <input type="submit" value="Search"><br>
    </form>
   </div>
</html>
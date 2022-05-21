<?php
session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);


if($_SERVER['REQUEST_METHOD']=="POST")
{
    //something got posted
    $plate_id=$_POST['plate_id'];
    $model=$_POST['model'];
    $year=$_POST['year'];
    $color=$_POST['color'];
    $country=$_POST['country'];
    $city=$_POST['city'];
    $cost_per_day=$_POST['costperday'];
    $status=$_POST['status'];
    
   

    if(!empty($plate_id)&& !empty($model) && !empty($year) && !empty($color) && !empty($country) && !empty($city) && !empty($cost_per_day) && !empty($status))
    {
        
        $sql=mysqli_query($con,"select *from car where plate_id ='".$plate_id."'");
        $fetch=mysqli_num_rows($sql);
        if($fetch>0){
            echo"plate_id already exists";
        }
        else{
            //save to database
           
             $query="insert into car (plate_id,model,city,country,color,year,cost_per_day,status) values ('$plate_id','$model','$city','$country','$color','$year','$cost_per_day','$status')";
             mysqli_query($con ,$query);
             
        }

    }else
    {
        
        echo "please enter valid information!!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add car page</title>
    <script>
     
        //information validation
        function validateForm(){
            var plate_id=document.forms["myForm"]["plate_id"].value;
            if(plate_id==""){
                alert("Plate Id must be filled out");
                return false;
            }
            var model=document.forms["myForm"]["model"].value;
            if(model==""){
                alert("Car model must be filled out");
                return false;
            }
            var year=document.forms["myForm"]["year"].value;
            if(year==""){
                alert("Model year must be filled out");
                return false;
            }
            if (year < 1886 || year > 2022) {
                alert("wrong year!!");
                return false;
            }
            var color=document.forms["myForm"]["color"].value;
            if(color==""){
                alert("Car color must be filled out");
                return false;
            }
            var country=document.forms["myForm"]["country"].value;
            if(country==""){
                alert("Country must be filled out");
                return false;
            }
            var city=document.forms["myForm"]["city"].value;
            if(city==""){
                alert("City must be filled out");
                return false;
            }
            var cost_per_day=document.forms["myForm"]["costperday"].value;
            if(cost_per_day=="" || cost_per_day <= 0 ){
                alert("Please check car cost again");
                return false;
            }
            var status=document.forms["myForm"]["status"].value;
            if(status==""){
                alert("Car status must be filled out");
                return false;
            }
            if (status != "Active" && status != "Out of service") {
                alert("Invalid car status!!");
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
        <a href="admin_index.php">RETURN</a>
        <a href="admin_logout.php">LOGOUT</a>
        
    </nav>
    </div>
    <main>
     <div class="add_car">
         <p>Add car</p><br><hr>
         <form name ="myForm" onsubmit="return validateForm()"  method="post">
             <p>Plate ID</p>
             <input type="text" name="plate_id" id="" placeholder="Enter plate Id">
             <p>Model</p>
             <input type="text" name="model" id="" placeholder="Enter car model">
             <p>Year</p>
             <input type="number" name="year" id="" placeholder="Enter model year">
             <p>Color</p>
             <input type="text" name="color" placeholder="Enter car color"><br>
             <p>Country</p>
             <input type="text" name="country" placeholder="Enter country"><br>
             <p>City</p>
             <input type="text" name="city" placeholder="Enter city"><br>
             <p>Cost per day</p>
             <input type="number" name="costperday" placeholder="Enter car cost per day"><br>
             <p>Car status</p>
             <input type="text" name="status" placeholder="Active/Out of service"><br>
             <input type="submit" name="" value="Add car"><br>

         </form>
     </div>      
    </main>
</body>
</html>
<?php
session_start();
include("connection.php");
include("customer_function.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
    //something got posted
    $first_name=$_POST['fname'];
    $last_name=$_POST['lname'];
    $phone_number=$_POST['Phone'];
    $license_number=$_POST['license'];
    $email=$_POST['email'];
    $password=$_POST['password'];
   

    if(!empty($first_name)&& !empty($last_name)&& !empty($phone_number)&& !empty($license_number) && !empty($password) && !empty($email))
    {
        //to verify email already exist or not(we already changed email to unique in the database)
        $sql_email=mysqli_query($con,"select *from customer where email ='".$email."'");
        $fetch_email=mysqli_num_rows($sql_email);

        $sql_pnumber=mysqli_query($con,"select *from customer where pnumber ='".$phone_number."'");
        $fetch_pnumber=mysqli_num_rows($sql_pnumber);

        $sql_license=mysqli_query($con,"select *from customer where license_id ='".$license_number."'");
        $fetch_licence=mysqli_num_rows($sql_license);

        if($fetch_email>0){
            echo"email already exists!!";
        }
        elseif($fetch_pnumber>0){
            echo"phone number already exists!!";
        }
        elseif($fetch_licence>0){
            echo"license already exists!!";
        }
        else{
            //save to database
             $password=md5($password);
             $query="insert into customer (fname,lname,pnumber,license_id,email,password) values ('$first_name','$last_name','$phone_number','$license_number','$email','$password')";
             mysqli_query($con ,$query);
        
             header("Location:customer_login.php");
             die;

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
    <title>customer signup </title>
    <script>
        function validateEmail(email) {
           const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
           return re.test(String(email).toLowerCase());
        }

        //information validation
        function validateForm(){
            var first_name=document.forms["myForm"]["fname"].value;
            if(first_name==""){
                alert("First Name must be filled out");
                return false;
            }
            var last_name=document.forms["myForm"]["lname"].value;
            if(last_name==""){
                alert("Last Name must be filled out");
                return false;
            }
            var phone_number=document.forms["myForm"]["Phone"].value;
            if(phone_number==""){
                alert("Phone number must be filled out");
                return false;
            }
            var license_number=document.forms["myForm"]["license"].value;
            if(license_number==""){
                alert("License number must be filled out");
                return false;
            }
            var useremail=document.forms["myForm"]["email"].value;
            if(useremail==""){
                alert("email must be filled out");
                return false;
            }
            else{
                if(!validateEmail(useremail)){
                    alert("invalid email format!!");
                    return false;
                }
            }

            var userpassword=document.forms["myForm"]["password"].value;
            if(userpassword==""){
                alert("password must be filled out");
                return false;
            }
            var userconfirmpassword=document.forms["myForm"]["confirmpassword"].value;
            if(userconfirmpassword==""){
                alert("password must be filled out");
                return false;
            }
            if(userpassword!=userconfirmpassword){
                alert("password doesnt match please re-enter your password!! ")
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
        <a href="customer_login.php">LOGIN</a>
        <a href="customer_signup.php">REGISTER</a>
    </nav>
    </div>
    <main>
        
     <div class="customer_signup">
    
     <p>Customer Signup</p> 
     <br><hr>
         <form name ="myForm" onsubmit="return validateForm()"  method="post">
        
             <p>First Name</p>
             <input type="text" name="fname" id="" placeholder="Enter First Name">
             <p>Last Name</p>
             <input type="text" name="lname" id="" placeholder="Enter Last Name">
             <p>Phone Number</p>
             <input type="tel" name="Phone" id="Phone" placeholder="Enter Phone Number" pattern="[0-9]{11}">
             <p>License</p>
             <input type="text" name="license" id="" placeholder="Enter License number">
             <p>Email</p>
             <input type="email" name="email" id="" placeholder="Enter Email">
             <p>Password</p>
             <input type="password" name="password" placeholder="Enter Password"><br>
             <p>Confirm Password</p>
             <input type="password" name="confirmpassword" placeholder="Confirm Password"><br>
             <input type="submit" name="" value="Create"><br>

         </form>
        
     </div>      
    </main>
</body>
</html>
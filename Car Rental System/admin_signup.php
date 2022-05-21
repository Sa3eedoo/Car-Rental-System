<?php
session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);


if($_SERVER['REQUEST_METHOD']=="POST")
{
    //something got posted
    $first_name=$_POST['fname'];
    $last_name=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
   

    if(!empty($first_name)&& !empty($last_name) && !empty($password) && !empty($email))
    {
        //to verify email already exist or not(we already changed email to unique in the database)
        $sql=mysqli_query($con,"select *from admin where email ='".$email."'");
        $fetch=mysqli_num_rows($sql);
        if($fetch>0){
            echo"email already exists";
        }
        else{
            //save to database
             $password=md5($password);
             $query="insert into admin (fname,lname,email,password) values ('$first_name','$last_name','$email','$password')";
             mysqli_query($con ,$query);
        
             header("Location:admin_index.php");
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
    <title>admin signup page</title>
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
        <a href="admin_login.php">LOGIN</a>
        <a href="admin_logout.php">LOGOUT</a>
    </nav>
    </div>
    
    <main>
     <div class="admin_signup">
         <form name ="myForm" onsubmit="return validateForm()"  method="post">
             <p>First Name</p>
             <input type="text" name="fname" id="" placeholder="Enter First Name">
             <p>Last Name</p>
             <input type="text" name="lname" id="" placeholder="Enter Last Name">
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
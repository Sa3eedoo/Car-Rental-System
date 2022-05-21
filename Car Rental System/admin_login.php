<?php
session_start();
include("connection.php");
include("admin_function.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
    //something got posted
    $admin_email=$_POST['email'];
    $password=$_POST['password'];
    

    if(!empty($admin_email) && !empty($password))
    {
        //read from database
       
        $query="select * from admin where email= '$admin_email' limit 1";
        $result=mysqli_query($con ,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) >0)

              {
                $admin_data=mysqli_fetch_assoc($result);
                if ($admin_data['password']==md5($password))
                {
                    $_SESSION['admin_id']=$admin_data['admin_id'];
                    header("Location:admin_index.php");
                    die;
                }
              }
        }
        
        echo"wrong email or password!!";


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
    <title>admin login page</title>
    <script>
        //login validation
        function validateLogin(){
            var email=document.forms["LoginForm"]["email"].value;
            if(email==""){
                alert("email must be filled out");
                return false;
            }
            var adminpassword=document.forms["LoginForm"]["password"].value;
            if(adminpassword==""){
                alert("password must be filled out");
                return false;
            }
        }

    </script>
    <link rel="stylesheet" href="car.css">
</head>
<body>
    <main>
     <div class="admin_loginBox">
         <P>Admin login</P><br><hr>
         <form name ="LoginForm" onsubmit="return validateLogin()" method="post">
             <p>Email</p>
             <input type="text" name="email" placeholder="Enter Email">
             <p>Password</p>
             <input type="password" name="password" placeholder="Enter Password"><br>
             <input type="submit" value="Login"><br>
             

         </form>
     </div>      
    </main>

    
</body>
</html>
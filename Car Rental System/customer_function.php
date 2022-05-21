<?php
function check_login($con)
{
   if(isset( $_SESSION['customer_id']))
   {
       $id=$_SESSION['customer_id'];
       $query="select * from customer where customer_id ='$id' limit 1";

       $result=mysqli_query($con,$query);
       if($result && mysqli_num_rows($result) >0)
       {
           $user_data=mysqli_fetch_assoc($result);
           return $user_data;
       }
   }

   //redirect to login

   header("Location:customer_login.php");
   die;

}


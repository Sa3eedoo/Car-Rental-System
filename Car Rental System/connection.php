<?php
$dbhost="localhost";
$dbuser="root";
$dbpassword="";
$dbname="car_rental_system";

if(!$con=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
{
    die("failed to connect!!");
}
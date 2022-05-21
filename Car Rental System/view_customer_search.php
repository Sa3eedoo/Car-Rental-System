<?php

echo '<title>Customer Search</title>';

session_start();
include("connection.php");
include("admin_function.php");

$admin_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something got posted
    $icustomer_id = $_POST['customer_id'];
    $ilicense_id = $_POST['license_id'];
    $iemail = $_POST['email'];
    $ifname = $_POST['fname'];
    $ilname = $_POST['lname'];
    $ipnumber = $_POST['pnumber'];

    $customer_id = '\'';
    $license_id = '\'';
    $email = '\'';
    $fname = '\'';
    $lname = '\'';
    $pnumber = '\'';

    if ($icustomer_id == "") {
        $customer_id = 'cu.customer_id';
    } else {
        $customer_id .= $icustomer_id;
        $customer_id .= '\'';
    }

    if ($ilicense_id == "") {
        $license_id = 'cu.license_id';
    } else {
        $license_id .= $ilicense_id;
        $license_id .= '\'';
    }

    if ($iemail == "") {
        $email = 'cu.email';
    } else {
        $email .= $iemail;
        $email .= '\'';
    }

    if ($ifname == "") {
        $fname = 'cu.fname';
    } else {
        $fname .= $ifname;
        $fname .= '\'';
    }

    if ($ilname == "") {
        $lname = 'cu.lname';
    } else {
        $lname .= $ilname;
        $lname .= '\'';
    }

    if ($ipnumber == "") {
        $pnumber = 'cu.pnumber';
    } else {
        $pnumber .= $ipnumber;
        $pnumber .= '\'';
    }

    //read from database
    $query = "SELECT
                    cu.customer_id,
                    cu.license_id,
                    cu.email,
                    cu.fname,
                    cu.lname,
                    cu.pnumber
                FROM
                    customer AS cu
                WHERE
                    " . $customer_id . " = cu.customer_id 
                        AND 
                    " . $license_id . " = cu.license_id 
                        AND 
                    " . $email . " = cu.email
                        AND 
                    " . $fname . " = cu.fname
                        AND 
                    " . $lname . " = cu.lname
                        AND 
                    " . $pnumber . " = cu.pnumber";

    $result = mysqli_query($con, $query);
    echo "<table border='1px'>";

    // TODO CSS 
    if ($result->num_rows > 0) {
        echo "<tr>";
        echo "<th>Customer ID</th>";
        echo "<th>License ID</th>";
        echo "<th>Email</th>";
        echo "<th>First name</th>";
        echo "<th>Last name</th>";
        echo "<th>Phone number</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            $customer_id = $row['customer_id'];
            $license_id = $row['license_id'];
            $email = $row['email'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $pnumber = $row['pnumber'];
            echo "<tr>";
            echo "<td>{$customer_id}</td>";
            echo "<td>{$license_id}</td>";
            echo "<td>{$email}</td>";
            echo "<td>{$fname}</td>";
            echo "<td>{$lname}</td>";
            echo "<td>{$pnumber}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "no search results";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>customer search</title>
    <link rel="stylesheet" href="car.css">
</head>

</html>
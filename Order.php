
<?php
include("config/db_connect.php");
session_start();


if(isset($_POST['placeorder'])){
    $sql = "insert into shippping (s_product, s_quantity, s_date) Values ('" . implode(',', array_keys($_SESSION['cart'])) . "','" . implode(",", array_values($_SESSION['cart'])) . "', NOW())";
   
   if (mysqli_query($conn,$sql)) {
       session_destroy();

   }  
   else{
       echo 'Query Error : ' . mysqli_error($conn);
  
   }
}




?>








<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 class = "center">Your Order Has Been Placed</h1>
    <p class = "center">Thank you for ordering with us, we'll contact you by email with your order details.</p>
</body>
<?php include("templates/footer.php"); ?>

</html>
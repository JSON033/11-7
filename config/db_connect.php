<?php 

//connecting to database using Mysqli
$conn = mysqli_connect('localhost', 'Jason', 'Test1234', 'eleven-7');
if(!$conn){
    echo "NO COnnection" . mysqli_connect_error();
}

?>
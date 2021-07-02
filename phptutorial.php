<?php   
/*
// define is used for constants
define('NAME', 'Jason')    ;
// variables start with $ and can only start with letter or underscore


$loser = 'Jason';
$kos = 'jason';

// we can join/concatenate strings with the . operator
// echo $loser . $kos;
// or echo ' hello ' . $loser;

//echo 'hello ';

// with double quotes we can just input variables ie : echo "hello $loser";
// it is called variable interpolation

// escape character for php is a backslash \

// searching a variable ie echo $loser[2];
// strlen() find the string length
// strtoupper() turns the string to upper case, strtolower() does the opposire
// str_replace(x,y,z) swithces x with y from z  

// basic operators  - * + /  **

//floor() and ceil() does what you think

// to print arrays on screen youd have to do print_r()

// we can alsk use array_push(x,y) x is the array y is the value

// associative arrays(key and value pairs)
// $jasonarr = ['loser' => 'jason' , 'chad' => 'andy']


//$errors = array('email'=>'', 'name'=>'' , 'company' =>'');


// multidimensional arrays : $marr = [
                               [1,2,3],
                                  [2,3,4]
                                 ] ;

for true and false , true = "1" and false = ""

if you compare strings it would compare the alphabetical order of the first character

upper case letters less than lowercase letters, should use === instead  

loose vs strict comparison
== vs === 
5 = '5' loose is true , strict is false

Conditional Statements: just if else stuff

break lets us break out of the loop

continue skips the current iteration

FUnction ex. function helo(){}
can set default just by helo($var ='')

Global variables are set as $_NAME 


htmlspecialchars() is a php function that should be used before we extract or render data
    it looks at the data we have and turns any special characters such as brackets and quotes into html elements
    that look the same but safe for us

Front end and server side validation: Front end would be with html5 required attribute and other

Server side validation is with php

To validate for emails and others we can use php filter validation for stuff like url, email, and others
    EX: filter_var($email,FILTER_VALIDATE_EMAIL)

THe things we can not use filters for we would use regex expressions
REGEX expressions means regulate expressions where there is another tutorial on that

 EX: preg_match('/^[a-zA-Z\s]+/', $name) is used for regex where only letters and spaces are allowed
 
 TO show the errors of the submit we had echoed the associative array for its values in a div tag made below where the input is     

 TO CONNECT to database for now we will use mysqli 
 $conn = mysqli_connect('host/ip address', 'user', 'password', 'database');
 
 To meake a query we would do 
 $result = mysqli_query($conn, $query);
 
 To format the columns into an associative array
 $associative_arry = mysqli_fetch_all($result, Mysqli_ASSOC);

 then we would free the memory
 mysqli_free_result($result);
 
 close the connection
 mysqli_close($conn);

Display and render the database info with php

we would first iterate through the data in a container which is a materialize class
<div class = 'container' > 
    div class = 'row>

<?php foreach ($associative_arry as $single_row) { ?>

    After we have like divs and other formats to how we want to display the thing like
    <div class = "col s4 md3> this adjusts the container row thing for for how many grid space it takes in the materialize class
        div class = 'card z-depth-0' > whcih gets rid of box shadow it has
         
        then we have a header which will contain php
        <h6> <?php echo htmlspecialchars($single_row["member"]) ?> </h6>
        we cna do this for other members of the associative array we have

        after we can just end the other divs in order and at the right time we do 
 <?php }?> so thaat we have finished the foreach iteration at the beginning 

 Explode function php
    -allows you to separate a string into array cells when given string and character
    <ul>
        <?php foreach(explode(',', $result['member with string separated by comma']) as $listing) : ?>
            <li> <?php echo htmlspecialchars($ing) ?> <\li>
        <?php endforeach; ?>
    </ul>
 Implode function php
        -this is about the inverse of explode and will actually turn an array of data into a string while including a value between each 
        index 
        EX: implode(" ", {HI,There,World});

 TO avoid any sql attacks we would try to use
            mysqli_real_esacpe_string() witht eh $conn and the $string to esacpe any malicious characters


PHP sessions this is how you start a session which is how you can transfer and hold data for uses like a shopping cart
session_start();

















*/
?>
<!DOCTYPE html>
<html>

<head>

<title>php file </title>

</head>
<body>

    <h1>  <?php echo 'User Profile Page'; ?> </h1>
    <div>
        <?php echo $loser; ?>
        <?php echo $NAME; ?>
    </div>

</body>


</html>
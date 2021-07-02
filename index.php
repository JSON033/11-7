<?php
session_start();
include('config/db_connect.php');
// creating the sql query
$sql = 'SELECT p_productkey, p_name, p_price, p_file FROM product';
if (isset($_GET['typ'])){
    $typ  = mysqli_real_escape_string($conn,$_GET['typ']);
    $sql = "SELECT p_productkey, p_name, p_price, p_file FROM product where p_type = '$typ'";

}
else if( isset($_POST['search'])){
    
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $sql = "SELECT p_productkey, p_name, p_price, p_file FROM product where p_name like '$search%' or p_type like '$search%'";
    
 }
 
//now using the query and getting results/data from db
$result = mysqli_query($conn, $sql);

// fetching data and format into associative array
$product = mysqli_fetch_all($result, MYSQLI_ASSOC);

// freeing up memory and closing connection
mysqli_free_result($result);
mysqli_close($conn);



?>

<!DOCTYPE html>
<html>
<?php include("templates/header.php"); ?>

<h4 class="center grey-text">Products</h4>
    <div class="container">
        <div class="row">
         <?php foreach ($product as $item) : ?>
            <div class="col s4 md3 l3 ">
                <div class="card z-depth-0">
                    <div class ="card-image responsive-img circle">
                        <img  src="<?php echo $item['p_file']; ?> " class="circle" height="250" width="150">
                    </div>
                    <div class="card-content center green">
                            <h6><?php echo htmlspecialchars($item['p_name']); ?></h6>
                            <div><?php echo htmlspecialchars($item['p_price']); ?>
                        </div>
                    </div>
                    <div class="card-action right-align red">
                        <a class="waves-effect waves-light btn" href="info.php? id=<?php echo $item['p_productkey'] ?> " > More info </a>
                    </div>
                </div>

            </div>

         <?php endforeach; ?>
        </div>

    </div>



<?php include("templates/footer.php"); ?>

    

</html>
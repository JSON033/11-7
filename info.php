<?php
session_start();
include('config/db_connect.php');

if (isset($_POST['delete'])) {
    $idToDelete =   mysqli_real_escape_string($conn, $_POST['idToDelete']);

    $sql = "DELETE FROM product where p_productkey = $idToDelete";

    if (mysqli_query($conn, $sql)) {
        header('Location : index.php');
    } else {
        echo 'query error' . mysqli_error($conn);
    }
}



// checking get request for product key then setting
if (isset($_GET['id'])) {


    $productkey = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM product WHERE p_productkey = $productkey";

    $result = mysqli_query($conn, $sql);

    $product = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
}
if (isset($_POST['cart'])) {

    if (isset($_POST['s_product'], $_POST['s_quantity']) && is_numeric($_POST['s_product']) && is_numeric($_POST['s_quantity'])) {
     
        //variables that contain the post variables 
        $productc = $_POST['s_product'];
        $quantity = (int) $_POST['s_quantity'];

        //sql statement
        $sqlcart = "SELECT * from product WHERE  p_id = $productc";
        $resultscart = mysqli_query($conn, $sql);

        $cart = mysqli_fetch_assoc($resultscart);

        //checking if quantity is greater thean 0 and there is a product id
        if ($productc && $quantity > 0) {

            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($productc, $_SESSION['cart'])) {
                    $_SESSION['cart'][$productc] += $quantity;
                } else {
                    $_SESSION['cart'][$productc] = $quantity;
                }
            } else {
                $_SESSION['cart'] = array($productc => $quantity);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<?php include("templates/header.php"); ?>

<div class=" container center">
    <?php if ($product) :  ?>
        <div class="row">
            <div class="col s6">
                <div class="card z-depth-0">
                    <div class="card-image responsive-img circle">
                        <img src="<?php echo $product['p_file']; ?>" class="center">
                    </div>
                </div>
            </div>


            <div class="col s6">
                <h4> Product Name : <?php echo htmlspecialchars($product['p_name']); ?></h4>
                <p>Manufacturer/Company : <?php echo htmlspecialchars($product['p_company']); ?></p>
                <p> Price : $ <?php echo htmlspecialchars($product['p_price']); ?> </p>
                <p>Type : <?php echo htmlspecialchars($product['p_type']); ?></p>
                <h5> Description : <?php echo htmlspecialchars($product['p_description']); ?></h5>

                <!-- option to delete -->
                <form action="info.php" method="POST">
                    <input type="hidden" name="idToDelete" value=" <?php echo $product['p_productkey']; ?>">
                    <input type="submit" name="delete" value="DELETE" class="btn brand z-depth-0">

                </form>

                <!-- option to add to cart and quantity -->
                <form action="info.php? id=<?php echo $_GET["id"] ?>" method="POST">
                    <div>
                        <input type="number" name="s_quantity" value="1" min="1" placeholder="Quantity" required>
                        <label for="quantity">Quantity</label>
                    </div>
                    <input type="hidden" name="s_product" value="<?= $_GET["id"] ?>">
                    <input type="submit" name="cart" value="Add to Cart"  >
                    

                </form>
            <?php if (isset($_POST['cart'])) {

            if (isset($_POST['s_product'], $_POST['s_quantity']) && is_numeric($_POST['s_product']) && is_numeric($_POST['s_quantity'])) { ?>
         <script    > M.toast({html: 'Shopping Cart Updated', displayLength: 1000, classes: "green"    })</script>
        

            <?php }} ?>


            </div>
        </div>
    <?php else : ?>
        <h4>NO INFORMATION AVAILABLE!</h4>
    <?php endif; ?>

</div>

<?php include("templates/footer.php"); ?>

</html>
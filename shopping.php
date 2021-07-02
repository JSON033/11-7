<?php
session_start();
include("config/db_connect.php");



$productcart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// print_r($_SESSION['cart']) ;

if (isset($_POST['remove'])) {
    echo $_POST['rvalue'];
    
    unset($_SESSION['cart'][$_POST['rvalue']]);
    echo "<meta http-equiv='refresh' content='0'>";
}

// If there are products in cart    
if ($productcart) {
    //  select products from database
    // making an array with the format (?,?,?,...?) which will allow us to prepare and execute an array

    $array_fillin = implode(',', array_fill(0, count($productcart), '?'));

    $sql = 'SELECT * FROM product WHERE p_productkey IN (' . $array_fillin . ')';
    //types variable which will show that we are binding integers 
    $types = str_repeat('i', count($productcart));
    //preparing the sql statement so that we can bind param
    $prep = mysqli_prepare($conn, $sql);

    // We only need the array keys, not the values, the keys are the id's of the products
    $prep->bind_param($types, ...array_keys($productcart));
    $prep->execute();
    // Fetch the products from the database and return the result as an Array
    $result = $prep->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    // Calculate the subtotal
    foreach ($data as $productr) {
        $subtotal += (float)$productr['p_price'] * (int)$productcart[$productr['p_productkey']];
    }
}








?>









<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>
<?php include("templates/footer.php"); ?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div >
        <h1 class="center">Shopping Cart</h1>
        <form action="shopping.php" method="post">
            <table>
                <thead>
                    <tr>
                        <td colspan="3">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody style="position: relative; bottom: 0px" >
                    <?php if (empty($data)) : ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data as $product) : ?>
                            <tr >
                                <td >
                                    <a href="info.php?id=<?= $product['p_productkey'] ?>">
                                        <img src="<?= $product['p_file'] ?>" width="50" height="50"  ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="info.php?id=<?= $product['p_productkey'] ?>"><?= $product['p_name'] ?></a>
                                </td>
                                <td>
                                    <form action="shopping.php" method="POST">
                                        <input type="hidden" name="rvalue" value="<?= $product['p_productkey'] ?>">
                                        <input type="submit" name="remove" value="Remove">
                                    </form>
                                </td>
                                <td class="flex">&dollar;<?= $product['p_price'] ?></td>
                                <td class="flex">
                                    <?= $productcart[$product['p_productkey']] ?>

                                </td>
                                <td class="flex">&dollar;<?= $product['p_price'] * $productcart[$product['p_productkey']] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="subtotal">
                <span class="text">Total</span>
                <span class="price">&dollar;<?= $subtotal ?></span>
            </div>
            <form action="Order.php" method = "POST">
                <input type="submit" value="Place Order" name="placeorder">
            </form>
        </form>
    </div>


</body>

</html>
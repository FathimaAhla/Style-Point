<?php

include 'components/connect.php';
 
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:login.php');
};

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE cart_ID = ?");
    $delete_cart_item->execute([$cart_id]);
    $message[] = 'cart item deleted!';
}

if(isset($_POST['delete_all'])){
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart.php');
    $message[] = 'deleted all from cart!';
}

if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE cart_ID = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'cart quantity updated';
}

$super_sub =0;
$shippingfee =0;
$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="TE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="images/logo-1.png">

        <!----- swiper css ----->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">

        <!----- css ----->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" class="js-color-style" href="css/colors/color-1.css">

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="/website/css/uicons-bold-rounded.css" rel="stylesheet">

        <link rel="stylesheet" href="">
        <title>Clothing Store > Account</title>
    </head>
    <body>

        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>

        <!------ main ------>
        <main class="main">

            <!------- cart ------->
            <section class="cart section container">
                <h2 class="breadcrumb__title">Cart Page</h2>
                <h3 class="breadcrumb__subtitle">Home > <span> Cart</span></h3>

                <div class="cart__container">

                        <table class="cart__table">
                            
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Update</th>
                                <th>Remove</th>
                            </tr>

                            <tr>
                            <?php
                                $grand_total = 0;
                                $super_sub =0;
                                $shippingfee =0;
                                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                                $select_cart->execute([$user_id]);
                                if($select_cart->rowCount() > 0){
                                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            
                            <form action="" method="post">

                                <input type="hidden" name="cart_id" value="<?= $fetch_cart['cart_ID']; ?>">
                                
                                <td><img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="" class="cart__img"></td>
                                <td>
                                    <h3 class="cart__table-title"><?= $fetch_cart['pro_Name']; ?></h3>
                                    <p class="cart__table-description">Color : <?= $fetch_cart['color']; ?></p>
                                    <p class="cart__table-description">Size : <?= $fetch_cart['size']; ?></p>
                                </td>
                                <td>
                                    <span class="cart__table-price">Rs: <?= $fetch_cart['price']; ?></span>
                                </td>
                                <td>
                                    <input type="number" name="qty" min="1" max="99" class="cart__table-quantity" value="<?= $fetch_cart['quantity']; ?>">
                                </td>
                                <td>
                                    <span class="cart__table-subtotal">Rs: <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
                                </td>
                                <td>  
                                    <button type="submit" name="update_qty" class="ri-pencil-fill cart__amount-trash"></button>
                                </td>
                                <td>
                                    <button type="submit" class="ri-delete-bin-line cart__amount-trash" name="delete" onclick="return confirm('delete this item?');"></button>
                                </td> 

                            </tr>
                            
                            </form>
                            <?php
                                    $super_sub += $sub_total;
                                    $shippingfee = ($super_sub *0.01);
                                    $grand_total = ($super_sub+$shippingfee);
                                    }
                                }else{
                                    echo '<p class="empty">your cart is empty</p>';
                                }
                                
                            ?>
                        </table>
                        
                    </div>

                    <div class="cart__actions">
                        <a href="details.php" class="btn flex btn-md">Continue Shopping</a>
                        <button type="submit" class="btn flex btn-md" name="delete all">Delete All</button>
                    </div>
                    
                    <?php
                       
                    ?>
                    

                    <div class="divider">
                        <i class="ri-fingerprint-line"></i>
                    </div>

                <div class="cart__group grid">
                    <div>
                        
                    </div>

                    <div class="cart__shipping">
                        <h3 class="cart__total">Cart Totals</h3>

                        <table class="cart__total-table">
                            <tr>
                                <td><span class="cart__total-title">Cart Subtotal</span></td>
                                <td><span class="cart__total-price">Rs: <?=$super_sub; ?></span></td>
                            </tr>

                            <tr>
                                <td><span class="cart__total-title">Shipping</span></td>
                                <td><span class="cart__total-price">Rs: <?= $shippingfee ?></span></td>
                            </tr>

                            <tr>
                                <td><span class="cart__total-title">Total</span></td>
                                <td><span class="cart__total-price">Rs: <?= $grand_total?></span></td>
                            </tr>
                        </table>

                        <a href="checkout.php" class="btn flex btn-md <?= ($grand_total > 1)?'':'disabled'; ?>">
                            Procees To Checkout
                        </a>
                    </div>
                </div>
            </section>

        </main>

        <?php include 'components/user_footer.php'; ?>  
        
        <!----- swiper js----->
        <script src="js/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="js/main.js"></script>
    </body>
</html>
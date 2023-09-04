<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:index.php');
};

if(isset($_POST['placed_order'])){

    $fname = $_POST['fname'];
    $fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname = $_POST['lname'];
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $brand_name = $_POST['brand_name'];
    $brand_name = filter_var($brand_name, FILTER_SANITIZE_STRING);
    $color = $_POST['color'];
    $color = filter_var($color, FILTER_SANITIZE_STRING);
    $material = $_POST['material'];
    $material = filter_var($material, FILTER_SANITIZE_STRING);
    $size = $_POST['size'];
    $size = filter_var($size, FILTER_SANITIZE_STRING);
    $image = $_POST['image-1'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];
    $pay_method = $_POST['pay_method'];
    $pay_method = filter_var($pay_method, FILTER_SANITIZE_STRING);
    $placed_on = $_POST['placed_on'];
    $placed_on = filter_var($placed_on, FILTER_SANITIZE_STRING);
 
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);
 
    if($check_cart->rowCount() > 0){
         
        if($pay_method == ''){
            $message_error[] = 'select Payment method!!';
        }else {

        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, first_Name, last_Name, number, email, address, brand_name, color, material, size, image, total_products, total_price, pay_Method, placed_On) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $fname, $lname, $number, $email, $address, $brand_name, $color, $material, $size, $image, $total_products, $total_price, $pay_method, $placed_on]);
    
        
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);
    
            $message[] = 'order placed successfully!';
                header('location:index.php');     
        }
       
    
       
    }else{
       $message_error[] = 'your cart is empty';
    }


    $shippingfee = 0;
    $grand_total = 0;
 
}

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

            <!------- checkout ------->
            <section class="checkout section container">
                <h2 class="breadcrumb__title">Checkout Page</h2>
                <h3 class="breadcrumb__subtitle">Home > <span> Checkout</span></h3>

                    <div class="checkout__container grid">
                        <div class="billing__details">
                            <h3 class="checkout__table-title">Billing Details</h3>

                            <form action="" method="post">

                                <?php
                                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                                    $select_profile->execute([$user_id]);
                                    if($select_profile->rowCount() > 0){
                                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <input type="hidden" name="fname" value="<?= $fetch_profile['first_Name'] ?>">
                                <input type="hidden" name="lname" value="<?= $fetch_profile['last_Name'] ?>">
                                <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
                                <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
                                <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

                                <div class="checkout__user-details">

                                    <p class="checkout__user"><i class="ri-user-line checkout__icon"></i><?= $fetch_profile['first_Name']; ?>  <?= $fetch_profile['last_Name']; ?></p>
                                    <p class="checkout__user"><i class="ri-phone-line checkout__icon"></i><?= $fetch_profile['number']; ?></p>
                                    <p class="checkout__user"><i class="ri-mail-line checkout__icon"></i><?= $fetch_profile['email']; ?></p>
                                    <a href="account.php" class="btn flex btn-md">Update Profile</a><br>

                                    <p class="checkout__user"><i class="ri-map-pin-line checkout__icon"></i><?= $fetch_profile['address']; ?></p>
                                    <a href="account.php" class="btn flex btn-md">Update Address</a>
                                </div> 
                                <?php
                                    }
                                ?>
                        </div>
                        <div class="checkout__title">
                            <h3 class="checkout__table-title">Cart Totals</h3>

                            
                                <table class="checkout__table">
                                    <tr>
                                        <th colspan="2">Products</th>
                                        <th>Total</th>
                                    </tr>
                                <?php
                                    $super_sub = 0;
                                    $cart_items = []; // Initialize an empty array

                                    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                                    $select_cart->execute([$user_id]);

                                    if ($select_cart->rowCount() > 0) {
                                        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                            $cart_items[] = $fetch_cart['pro_Name'] . ':  (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ')';
                                            $total_products = implode($cart_items);
                                ?>
                                                           
                                
                                <input type="hidden" name="color" value="<?= $fetch_cart['color']; ?>">
                                <input type="hidden" name="material" value="<?= $fetch_cart['material']; ?>">
                                <input type="hidden" name="brand_name" value="<?= $fetch_cart['brand_name']; ?>">
                                <input type="hidden" name="size" value="<?= $fetch_cart['size']; ?>">
                                <input type="hidden" name="image-1" value="<?= $fetch_cart['image']; ?>">
                                

                                    <tr> 
                                        <td><img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="" class="checkout__img"></td>
                                        <td>
                                            <h3 class="checkout__table-protitle"><?= $fetch_cart['pro_Name']; ?></h3>
                                            <p class="checkout__table-quantity">x <?= $fetch_cart['quantity']; ?></p>
                                        </td>
                                        <td>
                                            <span class="checkout__table-price">Rs: <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
                                        </td>     
                                    </tr>

                                <?php
                                    $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);


                                    $super_sub += $sub_total;
                                    $shippingfee = $super_sub * 0.01; // Calculate shipping fee as 1% of super sub
                                        
                                        }
                                        
                                    $grand_total = $super_sub + $shippingfee; // Add shipping fee to grand total
                                    ?>


                                <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                                <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
                                <input type="hidden" name="placed_on" value="<?= date('Y-m-d'); ?>">
                                <input type="hidden" name="pay_method">

                                    <?php
                                        } else {
                                                echo '<p class="empty">Your cart is empty!</p>';
                                            }
                                    ?>


                                    <tr>
                                        <td><span class="checkout__subtitle">SubTotal</span></td>
                                        <td colspan="2"><span class="checkout__table-price">Rs: <?=$super_sub; ?></span></td>
                                    </tr>

                                    <tr>
                                        <td><span class="checkout__subtitle">Shipping</span></td>
                                        <td colspan="2"><span class="checkout__table-price">Rs: <?= $shippingfee; ?></span></td>
                                    </tr>

                                    <tr>
                                        <td><span class="checkout__subtitle">Total</span></td>
                                        <td colspan="2"><span class="checkout__grand-total">Rs: <?= $grand_total; ?></span></td>
                                    </tr>
                                </table>
                            

                                <div class="checkout__payment-methods">
                                    <h3 class="checkout__payment-title">Payment</h3>

                                        <div class="payment__option flex">
                                            <input type="radio" name="pay_method" class="payment__input" value="Direct Bank Transfer">
                                            <label for="" class="payment__label">Direct Bank Transfer</label>
                                        </div>

                                        <div class="payment__option flex">
                                            <input type="radio" name="pay_method" class="payment__input" value="Cash On Delivery">
                                            <label for="" class="payment__label">Cash On Delivery</label>
                                        </div>

                                        <br>
                                        <input type="submit" value="Placed Order" class="btn flex btn-md" name="placed_order">

                                </div>
                                
                            </form>
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
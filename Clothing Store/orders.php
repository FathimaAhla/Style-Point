<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
   header('location:home.php');
};

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
            
            <!------- order ------->
            <section class="order section container">
                

                <div class="order__form">
                    <h2 class="Order__title">Order Details</Details></h2> 
                    <?php
                        if($user_id == ''){
                            echo '<p class="empty">please login to see your orders</p>';
                        }else{
                            if(isset($_GET['order_id'])) {
                            $update_id = $_GET['order_id'];
                            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE orders_ID = ?");
                            $select_orders->execute([$update_id]);
                            if($select_orders->rowCount() > 0){
                                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <div class="order__box">
                            <p>First Name : <span><?= $fetch_orders['first_Name']; ?></span></p>
                            <p>Last Name : <span><?= $fetch_orders['last_Name']; ?></span></p>
                            <p>email : <span><?= $fetch_orders['email']; ?></span></p>
                            <p>number : <span><?= $fetch_orders['number']; ?></span></p>
                            <p>address : <span><?= $fetch_orders['address']; ?></span></p>
                            <p>payment method : <span><?= $fetch_orders['pay_Method']; ?></span></p>
                            <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                            <p>Product Color : <span><?= $fetch_orders['color']; ?></span></p>
                            <p>Product Material : <span><?= $fetch_orders['material']; ?></span></p>
                            <p>Product size : <span><?= $fetch_orders['size']; ?></span></p>
                            <p>total price : <span>Rs: <?= $fetch_orders['total_price']; ?></span></p>
                            <p>Order Date : <span><?= $fetch_orders['placed_On']; ?></span></p>
                            <p> payment status : <span style="color:<?php if($fetch_orders['payment_Status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_Status']; ?></span> </p>
                        </div>
                    <?php
                                }
                        }
                        }else{
                            echo '<p class="empty">no orders placed yet!</p>';
                        }
                        }
                ?>
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
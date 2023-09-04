<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="TE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

        <!----- css ----->
        <link rel="stylesheet" href="../css/admin_style.css">

        <!----- js ----->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="/website/css/uicons-bold-rounded.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <title>Order Detail</title>
    </head>
    <body>

    <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>
            <h3 class="main_heading">Order</h3>

            <div class="profile__page">
                <h3 class="heading">Order Details</h3>
        
                <div class="profile__details">
                    <?php
                            if(isset($_GET['order_id'])) {
                            $update_id = $_GET['order_id'];
                            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE orders_ID = ?");
                            $select_orders->execute([$update_id]);
                            if($select_orders->rowCount() > 0){
                                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                    ?>

                            <div class="profile__info">
                                <p>Order ID : <span><?= $fetch_orders['orders_ID']; ?></span></p>
                                <p>First Name : <span><?= $fetch_orders['first_Name']; ?></span></p>
                                <p>Last Name : <span><?= $fetch_orders['last_Name']; ?></span></p>
                                <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                                <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                                <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                                <p>Payment method : <span><?= $fetch_orders['pay_Method']; ?></span></p>
                                <p>Orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                                <p>Brand Name : <span><?= $fetch_orders['brand_name']; ?></span></p>
                                <p>Product Color : <span><?= $fetch_orders['color']; ?></span></p>
                                <p>Product Material : <span><?= $fetch_orders['material']; ?></span></p>
                                <p>Product size : <span><?= $fetch_orders['size']; ?></span></p>
                                <p>total price : <span>Rs: <?= $fetch_orders['total_price']; ?></span></p>
                                <p>Order Date : <span><?= $fetch_orders['placed_On']; ?></span></p>
                                <p>payment status : <span style="color:<?php if($fetch_orders['payment_Status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_Status']; ?></span> </p>
                            </div>

                            <?php
                        }
                        }else{
                            echo '<p class="empty">no orders placed yet!</p>';
                        }
                        }
                ?>
                </div>
            
            </div>
        <section>
        
        <!----- js ------>
        <script src="../js/admin.js"></script>
    </body>
</html>
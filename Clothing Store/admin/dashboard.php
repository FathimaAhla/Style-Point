<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>


    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">


    <!--Remix Icon-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
    <?php include '../components/admin_menu.php';?>

    <section id="interface">

        <?php include '../components/admin_nav.php';?>

        <h3 class="main_heading">Dashboard</h3>

        <div>
            <div class="values">
                <div class="val-box">
                
                    <i class="fa-solid fa-users"></i>
                    <div>
                    <?php
                        $select_users = $conn->prepare("SELECT * FROM `users`");
                        $select_users->execute();
                        $numbers_of_users = $select_users->rowCount();
                    ?>
                        <h3><?= $numbers_of_users; ?></h3>
                        <span>Total Users</span>
                    </div>
                </div>
                <div class="val-box">
                <i class="fa-solid fa-cart-shopping"></i>
                    <div>
                    <?php
                        $select_products = $conn->prepare("SELECT * FROM `products`");
                        $select_products->execute();
                        $numbers_of_products = $select_products->rowCount();
                    ?>
                        <h3><?= $numbers_of_products; ?></h3>
                        <span>Total Products</span>
                    </div>
                </div> 
                
                <div class="val-box">
                    <i class="ri-truck-fill"></i>
                    <div>
                    <?php
                        $select_orders = $conn->prepare("SELECT * FROM `orders`");
                        $select_orders->execute();
                        $numbers_of_orders = $select_orders->rowCount();
                    ?>
                        <h3><?= $numbers_of_orders; ?></h3>
                        <span>Total Orders</span>
                    </div>
                </div> 
                
        </div>

        <div>
            <div class="values">
                
                
            <div class="val-box">
            <i class="fa-solid fa-message"></i>
                    <div>
                    <?php
                        $select_messages = $conn->prepare("SELECT * FROM `messages`");
                        $select_messages->execute();
                        $numbers_of_messages = $select_messages->rowCount();
                    ?>
                        <h3><?= $numbers_of_messages; ?></h3>
                        <span>Total Messages</span>
                    </div>
                </div> 
                <div class="val-box">
                    <i class="fa-solid fa-chart-line"></i>
                    <div>
                    <?php
                        $total_completes = 0;
                        $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_completes->execute(['completed']);
                        while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                            $total_completes += $fetch_completes['total_price'];
                        }
                    ?>
                        <h3>Rs : <?= $total_completes; ?></h3>
                        <span>Total Earning</span>
                    </div>
                </div>
                
                
                <div class="val-box">
                <i class="ri-truck-line"></i>
                    <div>
                    <?php
                        $select_pen_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_pen_orders->execute(['pending']);
                        $numbers_of_pen_orders = $select_pen_orders->rowCount();
                        
                    ?>
                        <h3><?= $numbers_of_pen_orders; ?></h3>
                        <span>Pending Orders</span>
                    </div>
                </div>        
                
        </div>

        <div>
            <div class="values">
                
                

                <div class="val-box">
                    <i class="fa-solid fa-users"></i>
                    <div>
                    <?php
                        $select_admins = $conn->prepare("SELECT * FROM `admin`");
                        $select_admins->execute();
                        $numbers_of_admins = $select_admins->rowCount();
                    ?>
                        <h3><?= $numbers_of_admins; ?></h3>
                        <span>Total Admins</span>
                    </div>
                </div>   

            <div class="val-box">
                
                <i class="fa-solid fa-hourglass-end"></i>
                <div>
                <?php
                    $total_pendings = 0;
                    $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_pendings->execute(['pending']);
                    while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                ?>
                    <h3>Rs : <?= $total_pendings; ?></h3>
                    <span>Pending Payment</span>
                </div>
            </div>
                <div class="val-box">
                    <i class="ri-truck-fill"></i>
                    <div>
                    <?php
                        $select_com_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_com_orders->execute(['completed']);
                        $numbers_of_com_orders = $select_com_orders->rowCount();
                        
                    ?>
                        <h3><?= $numbers_of_com_orders; ?></h3>
                        <span>Complete orders</span>
                    </div>
                </div>

                      
                
        </div>

            <h3 class="heading">Recent Orders</h3>
                <div class="recent-orders">
                    
                    <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Customer Name</th>
                                    <th>Payment</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY `orders_ID` DESC LIMIT 6");
                                $select_orders->execute();
                                if($select_orders->rowCount() > 0){
                                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $fetch_orders['orders_ID']; ?></td>
                                    <td class="products">
                                        <?= $fetch_orders['total_products']; ?>
                                    </td>
                                    <td>
                                        <img src="../uploaded_img/<?= $fetch_orders['image']; ?>" alt="">
                                    </td>
                                    <td><?= $fetch_orders['last_Name']; ?></td>
                                    <td><?= $fetch_orders['pay_Method']; ?></td>
                                    <td><?= $fetch_orders['total_price']; ?></td>
                                    <td class="warning"><?= $fetch_orders['payment_Status']; ?></td>
                                    <td>
                                        <a href="order_details.php?order_id=<?= $fetch_orders['orders_ID']; ?>" class="pro_view">View</a>
                                    </td>
                                </tr>
                                <?php   
                                        }
                                    }else{
                                        echo '<p class="empty">no Orders available</p>';
                                    }
                                ?>

                            </tbody>
                    </table>

                    
                </div>
        </div>
    </section>

    <!----- js ------>
    <script src="../js/admin.js"></script>
</body>
</html>
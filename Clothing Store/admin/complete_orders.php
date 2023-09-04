<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){

    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $update_status = $conn->prepare("UPDATE `orders` SET payment_Status = ? WHERE orders_ID = ?");
    $update_status->execute([$payment_status, $order_id]);
    $message[] = 'payment status updated!';
 
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE orders_ID = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin accounts</title>


    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <!----- js ----->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    <!--Remix Icon-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>
<body>
    <?php include '../components/admin_menu.php';?>

    <section id="interface">

        <?php include '../components/admin_nav.php';?>

        <h3 class="main_heading">Products Orders</h3>

        <div>

            <h3 class="heading">Complete Orders</h3>
                <div class="recent-orders">
                    
                    <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th>Pay Method</th>
                                    <th>Pay Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                                $select_orders->execute();
                                if($select_orders->rowCount() > 0){
                                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                            ?>

                                <input type="hidden" name="payment_status" value="<?= $fetch_orders['payment_Status']; ?>">

                                <?php
                                    if($fetch_orders['payment_Status'] == "completed" ){
                                ?> 

                                <tr>
                                    <td><?= $fetch_orders['orders_ID']; ?></td>
                                    <td class="products"><?= $fetch_orders['total_products']; ?></td>
                                    <td>Rs: <?= $fetch_orders['total_price']; ?></td>
                                    <td>
                                        <?= $fetch_orders['pay_Method']; ?>
                                    </td>
                                    <form action="" method="POST">
                                    <td>
                                        <input type="hidden" name="order_id" value="<?= $fetch_orders['orders_ID']; ?>">
                                            
                                            <select name="payment_status" class="drop-down">
                                                <option value="" selected disabled><?= $fetch_orders['payment_Status']; ?></option>
                                                <option value="pending">pending</option>
                                                <option value="completed">completed</option>
                                            </select>
                                    </td>
                                    <td>
                                        <button name="update_payment" class="ri-pencil-fill action__icon edit"></button>
                                        <a href="placed_orders.php?delete=<?= $fetch_orders['orders_ID']; ?>" class="ri-delete-bin-line action__icon delete" onclick="return confirm('delete this order?');"></a>
                                    </td>
                                    <td>
                                        <a href="order_details.php?order_id=<?= $fetch_orders['orders_ID']; ?>" class="pro_view">View</a>
                                    <td>
                                    </form>
                                </tr>

                                <?php       
                                            }
                                        }
                                    }else{
                                        echo '<p class="empty"> No Products Added Yet!</p>';
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
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE pro_ID = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/'.$fetch_delete_image['img_1']);
    unlink('../uploaded_img/'.$fetch_delete_image['img_2']);
    unlink('../uploaded_img/'.$fetch_delete_image['img_3']);
    unlink('../uploaded_img/'.$fetch_delete_image['img_4']);

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE pro_ID = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pro_id = ?");
    $delete_cart->execute([$delete_id]);
    //header('location:products.php');
 
}

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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <title>Add products</title>
    </head>

    <body>

        <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>

                <h3 class="main_heading">Products</h3>

            <!----- Update product section ------>

                <div class="product__tabs">

                    <div class="product__tabs-content active__tab">

                        <h3 class="heading">Show Products</h3>

                            <div class="show__product-details">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Images</th>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            <?php
                                                $show__products = $conn->prepare("SELECT * FROM `products`");
                                                $show__products->execute();
                                                if($show__products->rowCount() > 0){
                                                    while($fetch_products = $show__products->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <tr>
                                                    <td>
                                                        Pro No: <?= $fetch_products['pro_ID']; ?>
                                                    </td>
                                                    <td>
                                                        <img src="../uploaded_img/<?= $fetch_products['img_1']; ?>" alt="">
                                                    </td>
                                                    <td>
                                                    <?= $fetch_products['pro_Name']; ?> <br><?= $fetch_products['brand_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $fetch_products['category']; ?>
                                                    </td>
                                                    <td><?= $fetch_products['price']; ?></td>
                                                    
                                                    <td>
                                                        <a href="update_products.php?update_products=<?= $fetch_products['pro_ID']; ?>" class="ri-pencil-fill action__icon edit" ></a>
                                                    </td>
                                                    <td>
                                                        <a href="edit_products.php?delete=<?= $fetch_products['pro_ID']; ?>" class="ri-delete-bin-line action__icon delete"  onclick="return confirm('delete this product?');"></a>
                                                    </td>
                                                        
                                                </tr>
                                                <?php
                                                        }
                                                    }else{
                                                        echo '<p class="empty"> No Products Added Yet!</p>';
                                                    }
                                                ?>
                                    </tbody>  

                                </table>

                            </div>
                    </div>
                </div>
                    
        </section>
        
        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
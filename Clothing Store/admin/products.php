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
        <meta http-equiv="X-UA-Compatible" content="TE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

        <!----- swiper css ----->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

        <!----- css ----->
        <link rel="stylesheet" href="../css/admin_style.css">

         <!----- js ----->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <title>show products</title>
    </head>

    <body>

        <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>

                <h3 class="main_heading">Products</h3>
                
                <!------- products ------->
                    
                    <div class="product__tabs">

                        <!---- show product details ------>
                        <div class="product__tabs-content  active__tab">

                            <h3 class="heading">Products Details</h3>

                                <div class="show__product-details">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Image</th>
                                                <th>Product</th>           
                                                <th>Category</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>Size</th>
                                                <th>Reviews</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $show__products = $conn->prepare("SELECT * FROM `products`");
                                                $show__products->execute();
                                                if($show__products->rowCount() > 0){
                                                    while($fetch_products = $show__products->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                                <input type="hidden" name="pro_id" value="<?= $fetch_orders['pro_ID']; ?>">

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
                                                <td>
                                                    <?= $fetch_products['color']; ?>
                                                </td>
                                                <td>
                                                    Rs: <?= $fetch_products['price']; ?>
                                                </td>
                                                <td>
                                                    <a href="add_size.php?pro_id=<?= $fetch_products['pro_ID'];?>" class="pro_view"><i class="ri-pencil-fill"></i>Add Size</a>
                                                </td>
                                                <td>
                                                    <a href="manage_review.php?pro_id=<?= $fetch_products['pro_ID'];?>" class="pro_view">See Review</a>
                                                </td>
                                                <td>
                                                    <a href="product_details.php?pro_id=<?= $fetch_products['pro_ID'];?>" class="pro_view">View</a>

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

                                    <?php
                                        
                                    ?>
                                </div>
                        </div>
                    </div>
        </section>
           
    <!----- js ------>
    <script src="../js/admin.js"></script>

    </body>
</html>
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

        <h3 class="main_heading">Products</h3>


                <?php
                    if(isset($_GET['pro_id'])) {
                    $update_id = $_GET['pro_id'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE pro_ID = ?");
                    $select_products->execute([$update_id]);
                    if($select_products->rowCount() > 0){
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <input type="hidden" name="pro_id" value="<?= $fetch_products['pro_ID']; ?>">

                        <div class="details__container">
                            <div class="product__images">
                                <div class="product__img">
                                    <img src="../uploaded_img/<?= $fetch_products['img_1']; ?>" alt="">
                                </div>
                                <div class="product__img">
                                    
                                    <img src="../uploaded_img/<?= $fetch_products['img_2']; ?>" alt="">
                                </div>
                                <div class="product__img">
                                    
                                    <img src="../uploaded_img/<?= $fetch_products['img_3']; ?>" alt="">
                                </div>
                                <div class="product__img">
                                    
                                    <img src="../uploaded_img/<?= $fetch_products['img_4']; ?>" alt="">
                                </div>
                            </div>
                            <div class="product__info">
                                <div class="details__color">
                                    <span class="details__color-title">Product ID : </span>
                                    <h3 class="details__title"><?= $fetch_products['pro_ID']; ?></h3>
                                </div>
                                <div class="details__color">
                                    <span class="details__color-title">Product Name : </span>
                                    <h3 class="details__title"><?= $fetch_products['pro_Name']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Product Number : </span>
                                    <h3 class="details__title"><?= $fetch_products['pro_number']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Product category : </span>
                                    <h3 class="details__title"><?= $fetch_products['category']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Product Brand Name : </span>
                                    <h3 class="details__title"><?= $fetch_products['brand_name']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title"> Available Material : </span>

                                    <h3 class="details__title"><?= $fetch_products['material']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title"> Available Color : </span>

                                    <h3 class="details__title"><?= $fetch_products['color']; ?></h3>
                                </div>

                                <div class="details__size">
                                    <span class="details__size-title">Size : </span>

                                    <h3 class="details__title">
                                        <?php
                                        if(isset($_GET['pro_id'])) {
                                            $update_size_id = $_GET['pro_id'];
                                            $show_size = $conn->prepare("SELECT * FROM `size` WHERE pro_ID = ?");
                                            $show_size->execute([$update_size_id]);
                                            if ($show_size->rowCount() > 0) {
                                            while ($fetch_size = $show_size->fetch(PDO::FETCH_ASSOC)) {
                                                $optionValue = $fetch_size['size_ID']; // Replace 'value_column_name' with the actual column name in your table
                                                $optionName = $fetch_size['sizes']; // Replace 'name_column_name' with the actual column name in your table
    
                                                    echo $optionName .'&nbsp &nbsp &nbsp';
                                                }
                                            }
                                        }
                                        ?>
                                    </h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Product Price : </span>
                                    <h3 class="details__title">Rs: <?= $fetch_products['price']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Product Discount Price : </span>
                                    <h3 class="details__title">Rs: <?= $fetch_products['dis_Price']; ?></h3>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Product Discount Percentage : </span>
                                    <h3 class="details__title"><?= $fetch_products['dis_Percentage']; ?>% OFF</h3>
                                </div>

                                <div class="details__description">
                                    <span class="details__color-title">Product Details</span>
                                    <div class="description__details">
                                        <p><?= $fetch_products['description']; ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                </form>

                <?php
                        }
                    }else{
                        echo '<p class="empty">no products added yet!</p>';
                    }
                }else {
                    echo '<p class="empty">Product ID not specified!</p>';
                }
                ?>
            </section>  

        <!----- swiper js----->
        <script src="js/swiper-bundle.min.js"></script>
        
        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
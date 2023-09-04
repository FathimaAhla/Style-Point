<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};
 
include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="TE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="images/logo-1.png">

        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

        <!----- swiper css ----->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">

        <!----- css ----->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" class="js-color-style" href="css/colors/color-1.css">        

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link rel="stylesheet" href="">
        <title>Search Page</title>
    </head>

    <body>
        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>
        
        <!----- main ------>
        <main class="main">
            
            <!------- products ------->
            <section class="details section container">

                <form method="post" action="" class="search">
                    <input type="text" name="search_box" placeholder="search here..." class="search_box">
                    <button type="submit" name="search_btn" class="search_btn"><i class="ri-search-line"></i></button>
                </form>

            </section>

            <section class="shop section container" style="min-height: 80vh; padding-top:0;">

            <div class="shop__items grid">

                <?php
                    if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
                    $search_box = $_POST['search_box'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE pro_Name LIKE '%{$search_box}%' OR category LIKE '%{$search_box}%' OR brand_name LIKE '%{$search_box}%' OR color LIKE '%{$search_box}%'");
                    $select_products->execute();
                    if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                <div class="shop__content">
                    <input type="hidden" name="pid" value="<?= $fetch_products['pro_ID']; ?>">
                    <input type="hidden" name="pro_name" value="<?= $fetch_products['pro_Name']; ?>">
                    <input type="hidden" name="brand_name" value="<?= $fetch_products['brand_name']; ?>">
                    <input type="hidden" name="color" value="<?= $fetch_products['color']; ?>">
                    <input type="hidden" name="material" value="<?= $fetch_products['material']; ?>">
                    <input type="hidden" name="category" value="<?= $fetch_products['category']; ?>">
                    <input type="hidden" name="brand" value="<?= $fetch_products['brand_name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                    <input type="hidden" name="image-1" value="<?= $fetch_products['img_1']; ?>">
                    <input type="hidden" name="disprice" value="<?= $fetch_products['dis_Price']; ?>">
                    <input type="hidden" name="discount" value="<?= $fetch_products['dis_Percentage']; ?>">
                    <input type="hidden" name="color" value="Red">
                    <input type="hidden" name="size" value="M">
                    <input type="hidden" name="description" value="<?= $fetch_products['description']; ?>">
                    <input type="hidden" name="qty" value="1">


                        <div class="shop__tag">New</div>
                        <img src="uploaded_img/<?= $fetch_products['img_1']; ?>" alt="" class="shop__img">
                        <h3 class="shop__title"><?= $fetch_products['pro_Name']; ?></h3>
                        <span class="shop__subtitle"><?= $fetch_products['brand_name']; ?></span>

                        <div class="shop__prices">
                            <span class="shop__price">Rs: <?= $fetch_products['price']; ?></span>
                            <span class="shop__discounts">Rs: <?= $fetch_products['dis_Price']; ?></span>
                        </div>

                        <a href="pro_details.php?pid=<?= $fetch_products['pro_ID']; ?>" class="button shop__button-top">
                            <i class="ri-eye-fill shop__icon"></i>
                        </a>

                        <button type="submit" name="add_to_cart" class="button shop__button-right"> 
                            <i class="bx bx-cart-alt shop__icon"></i>
                        </button>
                    </div>
                </form>

                <?php
                    }
                    }else{
                        echo '<p class="empty">no products added yet!</p>';
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
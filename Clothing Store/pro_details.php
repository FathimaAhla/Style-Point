<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};
 
include 'components/add_cart.php';

if(isset($_POST['send_review'])){

    if($user_id == ''){
        header('location:login.php');
    }else{

        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $user_name = $_POST['lname'];
        $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
        $image = $_POST['image'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $review = $_POST['review'];
        $review = filter_var($review, FILTER_SANITIZE_STRING);
        $rate = $_POST['rate'];
        $rate = filter_var($rate, FILTER_SANITIZE_STRING);
        $placed_on = $_POST['placed_on'];
        $placed_on = filter_var($placed_on, FILTER_SANITIZE_STRING);
    
        $check_user = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
        $check_user->execute([$user_id]);
    
        $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE user_name = ? AND review = ?");
        $select_reviews->execute([$user_name, $review]);
    
        if($select_reviews->rowCount() > 0){
                $message[] = 'already sent review!';
        }else{
        
        $insert_reviews = $conn->prepare("INSERT INTO `reviews`(pro_ID, user_id, user_name, image, review, rate, placed_On) VALUES(?,?,?,?,?,?,?)");
        $insert_reviews->execute([$pid, $user_id, $user_name, $image, $review, $rate, $placed_on]);
    
        $message[] = 'Send review successfully!';
        }
    }
 
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

        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

        <!----- swiper css ----->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">

        <!----- css ----->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" class="js-color-style" href="css/colors/color-1.css">        

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!---Custom Icon Library Font awesome -->
        <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="">
        <title>Single Product Page</title>
    </head>

    <body>
        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>
        
        <!----- main ------>
        <main class="main">
            
            <!------- prodects ------->
            <section class="details section container">
                <h2 class="breadcrumb__title">Product Details Page</h2>
                <h3 class="breadcrumb__subtitle">Home > <span> Product Details</span></h3>

                <?php
                    if(isset($_GET['pid'])) {
                    $update_id = $_GET['pid'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE pro_ID = ?");
                    $select_products->execute([$update_id]);
                    if($select_products->rowCount() > 0){
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="pid" value="<?= $fetch_products['pro_ID']; ?>">
                    <input type="hidden" name="pro_name" value="<?= $fetch_products['pro_Name']; ?>">
                    <input type="hidden" name="brand_name" value="<?= $fetch_products['brand_name']; ?>">
                    <input type="hidden" name="color" value="<?= $fetch_products['color']; ?>">
                    <input type="hidden" name="material" value="<?= $fetch_products['material']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                    <input type="hidden" name="disprice" value="<?= $fetch_products['dis_Price']; ?>">
                    <input type="hidden" name="discount" value="<?= $fetch_products['dis_Percentage']; ?>">
                    <input type="hidden" name="description" value="<?= $fetch_products['description']; ?>">
                    <input type="hidden" name="image-1" value="<?= $fetch_products['img_1']; ?>">
                    <input type="hidden" name="image-2" value="<?= $fetch_products['img_2']; ?>">
                    <input type="hidden" name="image-3" value="<?= $fetch_products['img_3']; ?>">
                    <input type="hidden" name="image-4" value="<?= $fetch_products['img_4']; ?>">

                        <div class="details__container grid">
                            <div class="product__images grid">
                                <div class="product__img">
                                    <img src="uploaded_img/<?= $fetch_products['img_1']; ?>" alt="">
                                </div>
                                <div class="product__img">
                                    
                                    <img src="uploaded_img/<?= $fetch_products['img_2']; ?>" alt="">
                                </div>
                                <div class="product__img">
                                    
                                    <img src="uploaded_img/<?= $fetch_products['img_3']; ?>" alt="">
                                </div>
                                <div class="product__img">
                                    
                                    <img src="uploaded_img/<?= $fetch_products['img_4']; ?>" alt="">
                                </div>
                            </div>
                            <div class="product__info">
                                <p class="details__subtitle"><?= $fetch_products['category']; ?> Wear  >  <?= $fetch_products['brand_name']; ?> </p>
                                <h3 class="details__title"><?= $fetch_products['pro_Name']; ?></h3>

                                <div class="rating">                   
                                    <div class="stars">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                    </div>
                                </div>

                                <hr><br><br>

                                <div class="prodects__List">
                                    <ul>
                                        <li class="list__item">
                                            <i class='bx bx-crown'></i> 1 year <?= $fetch_products['brand_name']; ?> Brand Warranty
                                        </li>
                                        <li class="list__item flex">
                                            <i class='bx bx-refresh'></i> 30 Day Return Policy
                                        </li>
                                        <li class="list__item flex">
                                            <i class='bx bx-credit-card'></i>Cash on Delivery available
                                        </li>
                                    </ul>
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Color</span>

                                    <p class="detail__price"><?= $fetch_products['color']; ?></p>
                                    
                                </div>

                                <div class="details__color">
                                    <span class="details__color-title">Material</span>

                                    <p class="detail__price"><?= $fetch_products['material']; ?></p>
                                    
                                </div>

                                <div class="details__size">
                                    <span class="details__size-title">Size</span>

                                    <ul class="size__list">
                                    <?php
                                        if(isset($_GET['pid'])) {
                                        $update_size_id = $_GET['pid'];
                                        $show_size = $conn->prepare("SELECT * FROM `size` WHERE pro_ID = ?");
                                        $show_size->execute([$update_size_id]);
                                        if ($show_size->rowCount() > 0) {
                                            while ($fetch_size = $show_size->fetch(PDO::FETCH_ASSOC)) {
                                                $optionValue = $fetch_size['size_ID']; // Replace 'value_column_name' with the actual column name in your table
                                                $optionName = $fetch_size['sizes']; // Replace 'name_column_name' with the actual column name in your table
                                        
                                            echo '<li>';
                                            echo '<input type="radio" class="size__link" name="size" value="' . $optionName . '">'. $optionName;
                                            echo '</li>';
                                            }
                                        } 
                                    }
                                    ?>
                                    </ul>
                                </div>
                                <br>

                                <div class="details__prices">
                                    <span class="detail__price">Rs: <?= $fetch_products['price']; ?></span>
                                    <span class="details__discount">Rs: <?= $fetch_products['dis_Price']; ?></span>
                                    <span class="discount__percentage"><?= $fetch_products['dis_Percentage']; ?>% OFF</span>
                                </div>

                                    <ul class="color__list">
                                        <li>
                                            <a href="#" class="color__link color-1"></a>
                                        </li>

                                        <li>
                                            <a href="#" class="color__link color-2"></a>
                                        </li>

                                        <li>
                                            <a href="#" class="color__link color-3"></a>
                                        </li>

                                        <li>
                                            <a href="#" class="color__link color-4"></a>
                                        </li>

                                        <li>
                                            <a href="#" class="color__link color-5"></a>
                                        </li>
                                    </ul>

                                    <br><hr>

                                

                                <div class="details__description">
                                    <h3 class="description__title">Product Details</h3>
                                    <div class="description__details">
                                        <p><?= $fetch_products['description']; ?></p>
                                    </div>
                                </div>

                                <div class="cart__amount">
                                    <div class="cart__amount-content">
                                        <span class="cart__amount-number">
                                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                                        </span>
                                        <i class="bx bxs-heart cart__amount-heart"></i>     
                                    </div>

                                    
                                </div>

                                <button type="submit" name="add_to_cart" class="button">Add To Cart</button> 

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

            <!----- reviews tab ------->
            <section class="review__products section">
                <h2 class="review__heading">Review</h2>
                    <div class="reviews__container grid">
                        <div class="review_show">
                                <?php
                                    if(isset($_GET['pid'])) {
                                    $update_review_show_id = $_GET['pid'];
                                    $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE pro_ID = ?");
                                    $select_reviews->execute([$update_review_show_id]);
                                    if($select_reviews->rowCount() > 0){
                                    while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
                                ?>
                            <div class="review__single">
                                
                                <div class="review__user">
                                    <img src="uploaded_img/<?= $fetch_reviews['image']; ?>" class="review__img">
                                    <h3 class="review__title"><?= $fetch_reviews['user_name']; ?></h3>
                                </div>
                                <div class="review__data">
                                    <div class="review__rating">
                                    <?php 
                                    $rate = $fetch_reviews['rate'];
                                        if ($rate ==1  ){

                                            echo
                                            '<div class="review__rating"> 
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                            </div>';
                                    
                                        }
                                        elseif ($rate ==2) {

                                            echo 
                                            '<div class="review__rating">
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                            </div>
                                        ';
                                        }
                                        elseif($rate ==3){

                                            echo '
                                            <div class="review__rating">
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                            </div>';
                                        
                                        }
                                        elseif($rate ==4){

                                            echo '
                                        <div class="review__rating">
                                            <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                            <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                            <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                            <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                            <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                            </div>';
                                        
                                        }
                                        else {
                                            echo '
                                            <div class="review__rating">
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                            </div>';
                                        
                                        }
                                        ?>
                                    </div>
                                    <p class="review__description"><?= $fetch_reviews['review']; ?></p>

                                    <span class="review__date"><?= $fetch_reviews['placed_On']; ?></span>
                                </div>
                                
                            </div>
                            <?php
                                    }
                                    }else{
                                    echo '<p class="empty">No reviews Yet</p>';
                                    }
                                }

                            ?>
                        </div>

                        <div class="review__form">
                            <h3 class="review__form-title">Tell us Your Feedback about Product</h3>

                            

                            <form class="form grid" method="post" enctype="multipart/form-data">
                            <?php
                                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                                $select_profile->execute([$user_id]);
                                if($select_profile->rowCount() > 0){
                                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                            ?>
                            
                                <input type="hidden" name="lname" value="<?= $fetch_profile['last_Name']; ?>">
                                <input type="hidden" name="image" value="<?= $fetch_profile['image']; ?>">
                            
                            <?php
                             
                            }

                            ?>

                                <input type="number" name="rate" class="form__input" maxlength="5" minlength="1" value="1">
                                <input type="text" name="review" placeholder="Write Comment" class="form__input review">


                            <?php

                                if(isset($_GET['pid'])) {
                                $update_review_id = $_GET['pid'];
                                $select_products = $conn->prepare("SELECT * FROM `products` WHERE pro_ID = ?");
                                $select_products->execute([$update_review_id]);
                                if($select_products->rowCount() > 0){
                                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
          
                            ?>

                            
                                <input type="hidden" name="pid" value="<?= $fetch_products['pro_ID']; ?>">
                            <?php
                                           
                                        }
                                    }
                                }
                            ?> 
                            <input type="hidden" name="placed_on" value="<?= date('Y-m-d'); ?>">
                              
                                
                            
                                

                            <div class="form__btn">
                                <input type="submit" value="Send Review" name="send_review" class="success">
                            </div>

                            
                            </form>
                        </div>
                    </div>
            </section>

            <!----- related products ------>
            <section class="related__products section">
                <h2 class="section__title">Related Products</h2>

                <div class="new__container container">
                    <div class="swiper new-swiper">
                        <div class="swiper-wrapper">
                            <!-----new content 01---->
                            <?php
                                $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY `pro_ID` DESC LIMIT 5");
                                $select_products->execute();
                                if($select_products->rowCount() > 0){
                                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <!-----new content 01---->

                                <form action="" method="post">
                                    <input type="hidden" name="pid" value="<?= $fetch_products['pro_ID']; ?>">
                                    <input type="hidden" name="pro_name" value="<?= $fetch_products['pro_Name']; ?>">
                                    <input type="hidden" name="brand_name" value="<?= $fetch_products['brand_name']; ?>">
                                    <input type="hidden" name="color" value="<?= $fetch_products['color']; ?>">
                                    <input type="hidden" name="material" value="<?= $fetch_products['material']; ?>">
                                    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                                    <input type="hidden" name="image-1" value="<?= $fetch_products['img_1']; ?>">
                                    <input type="hidden" name="disprice" value="<?= $fetch_products['dis_Price']; ?>">
                                    <input type="hidden" name="discount" value="<?= $fetch_products['dis_Percentage']; ?>">
                                    <input type="hidden" name="color" value="Red">
                                    <input type="hidden" name="size" value="M">
                                    <input type="hidden" name="description" value="<?= $fetch_products['description']; ?>">
                                    <input type="hidden" name="qty" value="1">

                            <div class="new__content swiper-slide">
                                <div class="new__tag">New</div>
                                <img src="uploaded_img/<?= $fetch_products['img_1']; ?>" alt="" class="new__img">
                                <h3 class="new__title"><?= $fetch_products['pro_Name']; ?></h3>
                                <span class="new__subtitle"><?= $fetch_products['brand_name']; ?></span>

                                <div class="new__prices">
                                    <span class="new__price">Rs: <?= $fetch_products['price']; ?></span>
                                    <span class="new__discount">Rs: <?= $fetch_products['dis_Price']; ?></span>
                                </div>

                                <a href="pro_details.php?pid=<?= $fetch_products['pro_ID']; ?>" class="button new__button-top">
                                    <i class="ri-eye-fill new__icon"></i>
                                </a>

                                <a href="details.html" class="button new__button-right">
                                    <i class="bx bx-cart-alt new__icon"></i>
                                </a>
                            </div>

                            
                            </form>

                            <?php
                                    }
                                }else{
                                    echo '<p class="empty">no products added yet!</p>';
                                    }
                            ?> 
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!----- lightbox ------>
        <div class="lightbox">
            <div class="lightbox__content">
                <div class="lightbox__close">&times;</div>
                <img src="Photos/banner.png" alt="" class="lightbox__img">
                <div class="lightbox__caption">
                    <div class="caption__text">Style Point</div>
                    <div class="caption__counter"></div>
                </div>
            </div>

            <div class="lightbox__controls">
                <div class="prev__item" onclick="prevItem()"><i class="bx bx-chevron-left"></i></div>
                <div class="next__item" onclick="nextItem()"><i class="bx bx-chevron-right"></i></div>
            </div>
        </div>

        <?php include 'components/user_footer.php'; ?>  
        
        <!---- lightbox js ----->
        <script>
            const productItems = document.querySelectorAll(".product__img"),
                totalProductItems = productItems.length,
                lightbox = document.querySelector(".lightbox"),
                lightboxImg = lightbox.querySelector(".lightbox__img"),
                lightboxClose = lightbox.querySelector(".lightbox__close"),
                lightboxCounter = lightbox.querySelector(".caption__counter");
            let itemIndex = 0;

            for(let i=0; i<totalProductItems; i++){
                productItems[i].addEventListener("click", function() {
                    itemIndex=i;
                    changeItem();
                    toggleLightbox();
                })
            }

            function nextItem() {
                if(itemIndex === totalProductItems-1) {
                    itemIndex =0;
                }

                else{
                    itemIndex++;
                }
                changeItem()
            }

            function prevItem() {
                if(itemIndex === 0) {
                    itemIndex = totalProductItems-1;
                }

                else{
                    itemIndex--;
                }
                changeItem()
            }

            function toggleLightbox() {
                lightbox.classList.toggle("open")
            }

            function changeItem() {
                imgSrc = productItems[itemIndex].querySelector(".product__img img").getAttribute("src");
                lightboxImg.src = imgSrc;
                lightboxCounter.innerHTML = (itemIndex + 1) + " of " + totalProductItems;
                
            }

            //close item
            lightbox.addEventListener("click", function() {
                if(event.target === lightboxClose || event.target === lightbox) {
                    toggleLightbox()
                }
            })

        </script>

        <!----- swiper js----->
        <script src="js/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="js/main.js"></script>
            
    </body>
</html>
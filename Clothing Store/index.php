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
        <title>Clothing Store > Home</title>
    </head>
    <body>

        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>

        <!------ main ------>
        <main class="main">
        
            <!----- home ------>
            <section class="home container">
                <div class="swiper home-swiper">
                    <div class="swiper-wrapper">
                        <!-- home swiper 01 -->
                        <section class="swiper-slide">
                            <div class="home__content grid">
                                <div class="home__group">
                                    <img src="images/index/index-1.png" alt="" class="home__img">
                                    <div class="home__indicator"></div>

                                    <div class="home__details-img">
                                        <h4 class="home__details-title">The "Cardigan"</h4>
                                        <span class="home__details-subtitle">Wolen</span>
                                    </div>
                                </div>

                                <div class="home__data">
                                <h3 class="home__subtitle">#1 TRENDING ITEM</h3>
                                <h1 class="home__title">ORGINAL  <br> IS NEVER <br> FINSHED!!</h1>
                                <p class="home__description">A specialist label creating luxry essentials. Ethicallly crafted with an unwavering comitment to exceptional quality.</p>

                                <div class="home__button">
                                    <a href="details.php" class="button">Buy now</a>
                                </div>

                                </div>
                            </div>
                        </section>

                        <!-- home swiper 02 -->
                        <section class="swiper-slide">
                            <div class="home__content grid">
                                <div class="home__group">
                                    <img src="images/index/index-2.png" alt="" class="home__img">
                                    <div class="home__indicator"></div>

                                    <div class="home__details-img">
                                        <h4 class="home__details-title">The "Cardigan"</h4>
                                        <span class="home__details-subtitle">Wolen</span>
                                    </div>
                                </div>

                                <div class="home__data">
                                <h3 class="home__subtitle">#2 TOP BEST DUO</h3>
                                <h1 class="home__title">ORGINALITY  <br> KNOWS <br> NO BOUNDS!!</h1>
                                <p class="home__description">A specialist label creating luxry essentials. Ethicallly crafted with an unwavering comitment to exceptional quality.</p>

                                <div class="home__button">
                                    <a href="details.php" class="button">Buy now</a>
                                </div>

                                </div>
                            </div>
                        </section>

                        <!-- home swiper 03 -->
                        <section class="swiper-slide">
                            <div class="home__content grid">
                                <div class="home__group">
                                    <img src="images/index/index-3.png" alt="" class="home__img">
                                    <div class="home__indicator"></div>

                                    <div class="home__details-img">
                                        <h4 class="home__details-title">The "Cardigan"</h4>
                                        <span class="home__details-subtitle">Wolen</span>
                                    </div>
                                </div>

                                <div class="home__data">
                                <h3 class="home__subtitle">#3 TRENDING ITEM</h3>
                                <h1 class="home__title">SALE 20%  <br> OFF ON <br> EVERYTHING</h1>
                                <p class="home__description">A specialist label creating luxry essentials. Ethicallly crafted with an unwavering comitment to exceptional quality.</p>

                                <div class="home__button">
                                    <a href="details.php" class="button">Buy now</a>
                                </div>

                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </section>

            <!----- category ------>
            <section class="category section">
            <div class="category__home container">
                
                <div class="cat__home women">
                    <img src="images/index/cat-2.webp" alt="">
                    <button class="btn-css"><a href="men.php">Men</a></button>

                </div>
                <div class="cat__home men">
                    <img src="images/index/cat-1.jpg" alt="">
                    <button class="btn-css"><a href="women.php">Women</a></button>
                </div>
                    <div class="cat__home kids">
                        <img src="images/index/cat-3.webp" alt="">
                    <button class="btn-css"> <a href="kids.php" class="">Kids</a></button> 

                </div>
            </div>
            </section>

            <!----- discount ------>
            <section class="discount section">
                <div class="discount__container container grid">
                    <img src="images/index/dis-1.png" alt="" class="discount__img">

                    <div class="discount__data">
                        <h2 class="discount__title">50% Discount <br> On New Prodects</h2>
                        <a href="#" class="button">Go to new</a>
                    </div>
                </div>
            </section>

            <!----- new arriwal ------>
            <section class="new section">
                <h2 class="section__title">New Arrivals</h2>

                <div class="new__container container">
                    <div class="swiper new-swiper">
                        <div class="swiper-wrapper">
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
                                            <i class="ri-eye-fill"></i>
                                        </a>

                                        <button type="submit" name="add_to_cart" class="button new__button-right"> 
                                            <i class="bx bx-cart-alt shop__icon"></i>
                                        </button>
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

            <!----- feature ------>
            <section class="feature section container">
                <h2 class="section__title">Feature</h2> 

                    <div class="feature__container">

                    <div class="feature__row grid">
                        <div class="fe-box">
                            <img src="images/about_us/f1.png" alt="">
                            <h6>Free Shipping</h6>
                        </div>
                        <div class="fe-box">
                            <img src="images/about_us/f2.png" alt="">
                            <h6>Online Order</h6>
                        </div>
                        <div class="fe-box">
                            <img src="images/about_us/f4.png" alt="">
                            <h6>Promotions</h6>
                        </div>
                        <div class="fe-box">
                            <img src="images/about_us/f5.png" alt="">
                            <h6>Happy Sell</h6>
                        </div>
                        <div class="fe-box">
                            <img src="images/about_us/f6.png" alt="">
                            <h6>F24/7 Support</h6>
                        </div>
                    </div>
                </div>
            </section>

            <!----- steps ------>
            <section class="steps section container">
                <div class="steps__bg">
                    <h2 class="section__title">How to order products <br> from style-point</h2>

                    <div class="steps__container grid">
                        <!---- step card 01 ---->
                        <div class="steps__card">
                            <div class="steps__card-number">01</div>
                            <h3 class="steps__card-title">Choose products</h3>
                            <p class="steps__card-description">
                                We have several varieties products you can choose from.
                            </p>
                        </div>

                        <!---- step card 02 ---->
                        <div class="steps__card">
                            <div class="steps__card-number">02</div>
                            <h3 class="steps__card-title">Placed an order</h3>
                            <p class="steps__card-description">
                                Once your order is set, we move to the next to the next step which is the shipping.
                            </p>
                        </div>

                        <!---- step card 03 ---->
                        <div class="steps__card">
                            <div class="steps__card-number">03</div>
                            <h3 class="steps__card-title">Get order delivered</h3>
                            <p class="steps__card-description">
                                One delivery process is easy, you recive the order direct to your home.
                            </p>
                        </div>
                    </div>
                </div>

            </section>

            

        </main>

        <?php include 'components/user_footer.php'; ?>  

        <script>
            var newSwiper = new Swiper(".new-swiper", {
                spaceBetween: 10,
                /*centeredSlides: true,*/
                slidesPerView: "auto",
                loop: 'true',
                });

        </script>
        
        <!----- swiper js----->
        <script src="js/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="js/main.js"></script>
    </body>
</html>
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
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
            
            <!------- abot us ------->
            <section class="aboutus section container">
                <h2 class="breadcrumb__title">About Us Page</h2>
                <h3 class="breadcrumb__subtitle">Home > <span> About Us</span></h3>

                <div class="aboutus__container grid">
                    <img src="images\about_us/about-3.png" alt="" class="aboutus__img">

                    <div class="aboutus__data">
                        <h2 class="sectionus__title aboutus__title">Who we really are & <br> About Style Point</h2>

                        <p class="aboutus__description">
                            Style Point Clothing Store is a leading fashion retailer committed to providing the latest trends, exceptional quality, and outstanding customer service. We embrace inclusivity, sustainability, and community engagement, while constantly striving for excellence in the fashion industry.
                        </p>

                        <div class="aboutus__details">
                            <p class="aboutus__details-description">
                                <i class="bx bx-check-square aboutus__details-icon"></i>
                                We always delivery on time
                            </p>
                            <p class="aboutus__details-description">
                                <i class="bx bx-check-square aboutus__details-icon"></i>
                                We give you guides to protect and care for your products.
                            </p>
                            <p class="aboutus__details-description">
                                <i class="bx bx-check-square aboutus__details-icon"></i>
                                100% money back guaranted.
                            </p>
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

            <section class="feature section container">
                <h2 class="section__title">About Style Point...</h2>

                <div class="aboutus__container-box grid">
                    <div class="about__row grid">
                            <!------ misson ----->
                            <div class="about__item">
                                <i class="bx bxs-book about__icon"></i>
                                <h3 class="about__subtitle">MISSION</h3>
                                <p class="about__details">Our mission at Style Point Clothing Store is to provide the latest fashion trends, high-quality garments, and exceptional customer service. We are dedicated to inclusivity, affordability, sustainability, and empowering individuals to express themselves through fashion.</p>
                            </div>

                            <!------ visson ----->
                            <div class="about__item">
                                <i class='bx bx-globe about__icon'></i>
                                <h3 class="about__subtitle">VISSION</h3>
                                <p class="about__details">Our vision at Style Point Clothing Store is to be the ultimate fashion destination, inspiring and empowering individuals to confidently embrace their unique style and express themselves through high-quality, diverse, and sustainable fashion offerings.</p>
                            </div>

                            <!----- archivement ----->
                            <div class="about__item">
                                <i class='bx bxs-edit-alt about__icon'></i>
                                <h3 class="about__subtitle">ACHIVEEMENTS</h3>
                                <p class="about__details">Style Point Clothing Store has achieved success through exceptional customer satisfaction, trendsetting fashion offerings, commitment to inclusivity and sustainability, community engagement, and industry recognition. Our achievements inspire us to continue providing exceptional fashion experiences for our customers as we strive for even greater milestones</p>
                            </div>
                    </div>
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
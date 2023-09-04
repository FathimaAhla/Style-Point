<!----- HEADER ----->
<header class="header" id="header">
            <nav class="nav bar">

                <a href="index.php" class="nav_logo" width="300px">
                    <img src="images/logo-1.png">
                </a>

                <div class="nav_menu" id="nav_menu">
                    <ul class="nav__list">
                        <li class="nav_item">
                            <a href="index.php" class="nav__link">HOME</a>
                        </li>

                        <li class="nav_item">
                            <a href="men.php" class="nav__link">MEN</a>
                        </li>

                        <li class="nav_item">
                            <a href="women.php" class="nav__link">WOMEN</a>
                        </li>

                        <li class="nav_item">
                            <a href="kids.php" class="nav__link">KIDS</a>
                        </li>

                        <li class="nav_item">
                            <a href="about_us.php" class="nav__link">ABOUT</a>
                        </li>

                        <li class="nav_item">
                            <a href="contect.php" class="nav__link">CONTACT</a>
                        </li>
                    </ul>

                    <div class="nav__close" id="nav-close">
                        <i class="bx bx-x"></i>
                    </div>
                </div>
                <div class="nav_btns">
                    <a href="search.php" class="nav_shop">
                        <i class="bx bx-search"></i>
                    </a>
                    <a href="account.php" class="login_toggle" id="login-button">
                        <i class="bx bx-user"></i>
                    </a>
                    <a href="cart.php" class="nav_shop" id="cart-shop">
                        <i class="bx bx-shopping-bag"></i>
                    </a>
                    <a href="#" class="nav_shop">
                    <?php
                        $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $count_cart_items->execute([$user_id]);
                        $total_cart_items = $count_cart_items->rowCount();

                    ?>
                        <p>(<?= $total_cart_items; ?>)</p>

                    </a>
                    
                    <div class="nav_toggle" id="nav-toggle">
                        <i class="bx bx-grid-alt"></i>
                    </div>
                </div>
            </nav>
        </header>

        <?php
            if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="popup">
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="bx bx-time-five" onclick="this.parentElement.remove();"></i>
                    </div>
                </div>
                ';
            }
            }

            if(isset($message_error)){
                foreach($message_error as $message_error){
                echo '
                <div class="popup">
                    <div class="message__error">
                        <span>'.$message_error.'</span>
                        <i class="ri-alert-fill" onclick="this.parentElement.remove();"></i>
                    </div>
                </div>
                ';
                }
            }
        ?>

        

        

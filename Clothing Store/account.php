<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:login.php');
};

if(isset($_POST['update_profile'])){

    $fname = $_POST['title'].', ' .$_POST['fname'];
    $fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname = $_POST['lname'];
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $old_image = $_POST['old_Image'];
    $image = $_FILES['image-user']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image-user']['size'];
    $image_tmp_name = $_FILES['image-user']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $image_directory = 'uploaded_img/';
 
    if(!empty($fname)){
       $update_fname = $conn->prepare("UPDATE `users` SET first_Name = ? WHERE u_ID = ?");
       $update_fname->execute([$fname, $user_id]);
    }

    if(!empty($lname)){
        $update_lname = $conn->prepare("UPDATE `users` SET last_Name = ? WHERE u_ID = ?");
        $update_lname->execute([$lname, $user_id]);
    }
 
    if(!empty($email)){
          $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE u_ID = ?");
          $update_email->execute([$email, $user_id]);

    }
 
    if(!empty($number)){
          $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE u_ID = ?");
          $update_number->execute([$number, $user_id]);
       
    }

    function deleteFile($file) {
        global $image_directory;
        $file_path = $image_directory . $file;
    
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                $message[] = 'image updated!';
                //echo "File deleted: $file\n";
            } else {
                $message[] = 'Error deleting image!';
                //echo "Error deleting file: $file\n";
                $message[] = "Error: " . error_get_last()['message'] . "\n";
                //echo "Error: " . error_get_last()['message'] . "\n";  // Display the last error message
            }
        } 
    }

    if(!empty($image)) {
        if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE u_ID = ?");
            $update_image->execute([$image, $user_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            deleteFile($old_image);
         }
    }

    $message[] = 'profile Updated!';
}

if(isset($_POST['update_address'])){

    $address = $_POST['no'].', '.$_POST['line_1'].', ' .$_POST['line_2'].', ' .$_POST['zip_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    if(!empty($address)){
        $update_address = $conn->prepare("UPDATE `users` SET address = ? WHERE u_ID = ?");
        $update_address->execute([$address, $user_id]);

        $message[] = 'address saved!';
    }

}

if(isset($_POST['change_password'])){

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE u_ID = ?");
    $select_prev_pass->execute([$user_id]);
    $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
 
    if($old_pass != $empty_pass){
       if($old_pass != $prev_pass){
          $message_error[] = 'old password not matched!';
       }elseif($new_pass != $confirm_pass){
          $message_error[] = 'confirm password not matched!';
       }else{
          if($new_pass != $empty_pass){
             $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE u_ID = ?");
             $update_pass->execute([$confirm_pass, $user_id]);
             $message[] = 'password updated successfully!';
          }else{
             $message_error[] = 'please enter a new password!';
          }
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

        <!------- profile ------->
        <section class="accounts section container">
            <h2 class="breadcrumb__title">Account Page</h2>
            <h3 class="breadcrumb__subtitle">Home > <span> My Account</span></h3><br><br>

            <div class="accounts__container grid">
                <div class="accounts__tabs">
                    <p class="accounts__tab active__tab" data-target="#profile">
                        <i class='bx bxs-user'></i> Profile
                    </p>

                    <p class="accounts__tab" data-target="#orders">
                        <i class='bx bxs-shopping-bag'></i> Orders
                    </p>

                    <p class="accounts__tab" data-target="#update-profile">
                        <i class='bx bxs-user'></i> Update Profile
                    </p>

                    <p class="accounts__tab" data-target="#address">
                        <i class="ri-map-pin-fill"></i> Update Address
                    </p>

                    <p class="accounts__tab" data-target="#change-password">
                        <i class='bx bxs-user'></i> Change Password
                    </p>

                    <p class="accounts__tab log-out">
                        <i class="ri-logout-box-r-fill"></i><a href="components/user_logout.php" onclick="return confirm('logout from this website?');">Logout</a>
                    </p>
                </div>

                <div class="tabs__content">
                    <div class="tab__content active__tab" content id="profile">
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                            $select_profile->execute([$user_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <h3 class="tab__header">Hello <span><?= $fetch_profile['last_Name']; ?>!</h3>

                        <div class="tab__body">
                        
                            <p class="user__details">
                                <img src="uploaded_img/<?= $fetch_profile['image']; ?>" class="user__img" alt="">
                                <p class="user__detail"><i class="ri-user-line user__icon"></i><span><?= $fetch_profile['first_Name']; ?></span></p>
                                <p class="user__detail"><i class="ri-user-line user__icon"></i><span><?= $fetch_profile['last_Name']; ?></span></p>
                                <p class="user__detail"><i class="ri-phone-line user__icon"></i><span><?= $fetch_profile['number']; ?></span></p>
                                <p class="user__detail"><i class="ri-mail-line user__icon"></i><span><?= $fetch_profile['email']; ?></span></p>
                                <p class="user__detail"><i class="ri-map-pin-line user__icon"></i><span><?= $fetch_profile['address']; ?></span></p>
                            </p>
                        <?php
                            }
                        ?>
                        </div>
                    </div>

                    <div class="tab__content" content id="orders">
                        <h3 class="tab__header">Your Orders</h3>

                        <div class="tab__body">
                            <table class="placed__order-table">
                                <tr>
                                    <th>Orders</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>

                                <?php
                                    $show_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY `orders_ID` DESC LIMIT 8");
                                    $show_orders->execute();

                                    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                                    $select_orders->execute([$user_id]);
                                    if($select_orders->rowCount() > 0){
                                        while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                                ?>

                                <input type="hidden" name="order_id" value="<?= $fetch_orders['orders_ID']; ?>">

                                <tr>
                                    <td><?= $fetch_orders['total_products']; ?></td>
                                    <td><?= $fetch_orders['placed_On']; ?></td>
                                    <td style="color:<?php if($fetch_orders['payment_Status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_Status']; ?></td>
                                    <td>Rs: <?= $fetch_orders['total_price']; ?></td>
                                    <td>
                                        <a href="orders.php?order_id=<?= $fetch_orders['orders_ID']; ?>" class="">view</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    }else{
                                        echo '<p class="empty">no orders placed yet!</p>';
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab__content" content id="update-profile">
                        <h3 class="tab__header">Update Profile</h3>

                        <div class="tab__body">
                        
                            <form action="" class="form grid" method="post" enctype="multipart/form-data">

                            <?php
                                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                                $select_profile->execute([$user_id]);
                                if($select_profile->rowCount() > 0){
                                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                            ?>
                            
                            <input type="hidden" name="old_Image" value="<?= $fetch_profile['image']; ?>">

                                <select name="title" class="form__input">
                                    <option>-- Select your Title --</option>
                                    <option value="Mr. ">Mr.</option>
                                    <option value="Mrs. ">Mrs.</option>
                                    <option value="Miss. ">Miss.</option>
                                    <option value="Dr. ">Dr.</option>
                                    <option value="Ms. ">Ms.</option>
                                </select>
                                <input type="text" name="fname" placeholder="Your Name" class="form__input" maxlength="50" value="<?= $fetch_profile['first_Name']; ?>">
                                <input type="text" name="lname" placeholder="Your Name" class="form__input" maxlength="50" value="<?= $fetch_profile['last_Name']; ?>">
                                <input type="email" name="email" placeholder="Your Email" class="form__input" maxlength="50" value="<?= $fetch_profile['email']; ?>" oninput="this.value = this.value.replace(/\s/g, '')">
                                <input type="number" name="number" placeholder="Phone Number" class="form__input" min="0" max="9999999999" maxlength="10" value="<span><?= $fetch_profile['email']; ?>" oninput="enforceLength(this, 10)">
                                <input type="file" name="image-user" class="form__input" accept="image/jpg, image/jpeg, image/png, image/webp">
                                
                                <div class="form__btn">
                                    <button class="button success" name="update_profile">Save</button>
                                </div>
                                <?php
                                    }
                                ?>

                            </form>
                            
                        
                       
                        </div>
                    </div>

                    <div class="tab__content" content id="address">
                        <h3 class="tab__header">Update Address</h3>

                        <div class="tab__body">
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                            $select_profile->execute([$user_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                            <form action="" class="form grid" method="post">

                                <input type="text" name="zip_code" placeholder="Zip Code" class="form__input" maxlength="5" oninput="enforceLength(this, 5)">
                                <input type="text" name="no" placeholder="Address No" class="form__input" maxlength="50">
                                <input type="text" name="line_1" placeholder="Address Line 1" class="form__input" maxlength="50">
                                <input type="text" name="line_2" placeholder=" Address Line 2" class="form__input" maxlength="50">
                                
                                <div class="form__btn">
                                    <button class="button success" name="update_address">Save</button>
                                </div>
                            </form>
                        <?php
                            }
                        ?>
                        </div>
                    </div>

                    <div class="tab__content" content id="change-password">
                        <h3 class="tab__header">Change Password</h3>

                        <div class="tab__body">
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                            $select_profile->execute([$user_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                            <form action="" class="form grid" method="post">
                                <input type="password" name="old_pass" placeholder="Current Password" class="form__input" maxlength="8" oninput="enforceLength(this, 8)">
                                <input type="password" name="new_pass" placeholder="New Password" class="form__input" maxlength="8" oninput="enforceLength(this, 8)">
                                <input type="password" name="confirm_pass" placeholder="Confirm Password" class="form__input" maxlength="8" oninput="enforceLength(this, 8)">

                                <div class="form__btn">
                                    <button class="button success" name="change_password">Save</button>
                                </div>
                            </form>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

        </section> 

        </main>

        <?php include 'components/user_footer.php'; ?>  

        <script>
                    
            function enforceLength(input, maxLength) {
                if (input.value.length > maxLength) {
                    input.value = input.value.slice(0, maxLength);
                }
            }  

        </script>
        
        <!----- swiper js----->
        <script src="js/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="js/main.js"></script>
    </body>
</html>
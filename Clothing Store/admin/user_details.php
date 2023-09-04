<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

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
        <link href="/website/css/uicons-bold-rounded.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <title>user Profile</title>
    </head>
    <body>

    <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>
            <h3 class="main_heading">User Profiles</h3>

            <div class="user-profile__page">
                <h3 class="heading">User Account Details</h3>
        
                <div class="user-profile__details">
                    <?php
                            if(isset($_GET['user_id'])) {
                            $update_id = $_GET['user_id'];
                            $select_user = $conn->prepare("SELECT * FROM `users` WHERE u_ID = ?");
                            $select_user->execute([$update_id]);
                            if($select_user->rowCount() > 0){
                                while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
                    ?>

                            <div class="user-profile__info">
                               
                                <img src="../uploaded_img/<?= $fetch_user['image']; ?>" alt="" class="user-profile">
                           
                                <p>User ID : <span><?= $fetch_user['u_ID']; ?></span></p>
                                <p>First Name : <span><?= $fetch_user['first_Name']; ?></span></p>
                                <p>Last Name : <span><?= $fetch_user['last_Name']; ?></span></p>
                                <p>Email : <span><?= $fetch_user['email']; ?></span></p>
                                <p>Number : <span><?= $fetch_user['number']; ?></span></p>
                                <p>Address : <span><?= $fetch_user['address']; ?></span></p>
                                
                            </div>

                            <?php
                        }
                        }
                        }else{
                            echo '<p class="empty">no  account available!</p>';
                        }
                ?>
                </div>
            
            </div>
        <section>
        
        <!----- js ------>
        <script src="../js/admin.js"></script>
    </body>
</html>
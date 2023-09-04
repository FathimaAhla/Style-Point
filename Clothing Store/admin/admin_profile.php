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

        <title>admin Profile</title>
    </head>
    <body>

    <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>
            <h3 class="main_heading">Profile</h3>

            <div class="profile__page">
                <h3 class="heading">My Account</h3>
        
                <div class="profile__details">
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
                            $select_profile->execute([$admin_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>

                            <div class="profile__pic">
                                
                                <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                                
                            </div>

                            <div class="profile__info">
                                <p><?= $fetch_profile['admin_Name']; ?><p>
                                <p><?= $fetch_profile['number']; ?><p>
                                <p><?= $fetch_profile['email']; ?><p>
                            </div>

                            <div class="btn">
                            <?php
                            if($fetch_profile['admin_ID'] == $admin_id){

                                echo '<a href="update_profile.php" class="btn-succes">Update Profile</a>';

                            }?>

                            </div>
                    <?php
                        }
                    ?>
                </div>
            
            </div>
        <section>
   
    <!----- js ------>
    <script src="../js/admin.js"></script>

    </body>
</html>
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
            <h3 class="main_heading">Message</h3>

            <div class="profile__page">
                <h3 class="heading">Message Details</h3>
        
                <div class="profile__details">
                    <?php
                            if(isset($_GET['msg_id'])) {
                            $update_id = $_GET['msg_id'];
                            $show_messages = $conn->prepare("SELECT * FROM `messages` WHERE msg_ID = ?");
                            $show_messages->execute([$update_id]);
                            if($show_messages->rowCount() > 0){
                                while($fetch_messages = $show_messages->fetch(PDO::FETCH_ASSOC)){ 
                    ?>
                            <div class="profile__info">
                                <p>Message ID : <span><?= $fetch_messages['msg_ID']; ?></span></p>
                                <p>User Name : <span><?= $fetch_messages['name']; ?></span></p>
                                <p>User Email : <span><?= $fetch_messages['email']; ?></span></p>
                                <p>User Number : <span><?= $fetch_messages['number']; ?></span></p>
                                <p>Message : <span><?= $fetch_messages['message']; ?></span></p>
                                <p>Message send date : <span><?= $fetch_messages['send_date']; ?></span></p>
                                <p>Reply : <span><?= $fetch_messages['reply']; ?></span></p>
                                <p>Reply Date : <span><?= $fetch_messages['reply_date']; ?></span></p>

                            </div>

                            <?php
                        }
                        }
                        }
                ?>
                </div>
            
            </div>
        <section>

    <!----- js ------>
    <script src="../js/admin.js"></script>

    </body>
</html>
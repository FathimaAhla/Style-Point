<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['replay_msg'])){

    $msg_id = $_POST['msg_id'];
    $msg_id = filter_var($msg_id, FILTER_SANITIZE_STRING);
    $reply = $_POST['reply'];
    $reply = filter_var($reply, FILTER_SANITIZE_STRING);
    $reply_date = $_POST['reply_date'];
    $reply_date = filter_var($reply_date, FILTER_SANITIZE_STRING);

    $update_messages = $conn->prepare("UPDATE `messages` SET reply = ?, reply_date = ? WHERE msg_ID = ?");
    $update_messages->execute([$reply, $reply_date, $msg_id]);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="TE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

        <!----- swiper css ----->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

        <!----- css ----->
        <link rel="stylesheet" href="../css/admin_style.css">
        
        <!----- js ----->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

        <!---- icons ----->
        <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <title>update products</title>
    </head>

    <body>
        <?php include '../components/admin_menu.php';?>

            <section id="interface">

                <?php include '../components/admin_nav.php';?>

                    <h3 class="main_heading">Messages</h3>

                    <!----- Update product section --->
                    <div class="reply_message">

                        <h3 class="message__heading">Reply Messages</h3>    

                        <form method="post">
                        
                            <div class="contact__reply">
                            <?php
                            $update_id = $_GET['submit'];
                            $show_messages = $conn->prepare("SELECT * FROM `messages` WHERE msg_ID = ?");
                            $show_messages->execute([$update_id]);
                            if($show_messages->rowCount() > 0){
                                while($fetch_messages = $show_messages->fetch(PDO::FETCH_ASSOC)){ 
                                
                            ?>
                                
                                <input type="hidden" name="msg_id" value="<?= $fetch_messages['msg_ID']; ?>">
                                <input type="hidden" name="reply_date" value="<?= date('Y-m-d'); ?>">
                        
                                    <div class="client_msg">
                                        <div class="msg">
                                            <?= $fetch_messages['message']; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="reply">
                                        <div class="ans">
                                            <input type="text" name="reply" class="ans_box" placeholder="Enter Reply" maxlength="100">
                                        </div>
                                        <Button type="submit" class="btn-succes" name="replay_msg">Send Reply</Button>
                                    </div>
                                </div>
                        </form>  
                                
                        <?php
                                }
                            }
                        ?>
                        
                        
                    </div>

                    <div>

                        <h3 class="message__heading">All Messages</h3>

                        <div class="show_msg">
                                <?php
                                    $select_messages = $conn->prepare("SELECT * FROM `messages`");
                                    $select_messages->execute();
                                    if($select_messages->rowCount() > 0){
                                        while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
                                ?>
                            <div class="msg_list">
                                

                                <div class="client_msg">
                                    <div class="msg">
                                        <?= $fetch_messages['message']; ?>
                                    </div>
                                </div>
                                </br>
                                <div class="reply">
                                    <div class="ans">
                                        <b><?= $fetch_messages['reply']; ?></b>
                                    </div>
                                </div>
                                
                            </div>
                            <?php
                                        }
                                    }else{
                                        echo '<p class="empty">you have no messages</p>';
                                    }
                                ?>
                        </div>
                    </div>

                    
            </section>

        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
   
</html>
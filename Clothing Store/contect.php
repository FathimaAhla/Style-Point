<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['message'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['msg'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);
    $send_date = $_POST['send_date'];
    $send_date = filter_var($send_date, FILTER_SANITIZE_STRING);
 
 
    $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_message->execute([$name, $email, $number, $msg]);
 
    if($select_message->rowCount() > 0){
       $message_error[] = 'already sent message!';
    }else{
 
       $insert_message = $conn->prepare("INSERT INTO `messages`(name, email, number, message, send_date) VALUES(?,?,?,?,?)");
       $insert_message->execute([$name, $email, $number, $msg, $send_date]);
 
       $message[] = 'sent message successfully!';
 
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
        <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="/website/css/uicons-bold-rounded.css" rel="stylesheet">

        <link rel="stylesheet" href="">
        <title>Clothing Store > Contact</title>
    </head>
    <body>

        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>

        <!------ main ------>
        <main class="main">

            <!------- contect us ------->
            <section class="contact section container">
                <h2 class="breadcrumb__title">Contact Us Page</h2>
                <h3 class="breadcrumb__subtitle">Home > <span> contact Us</span></h3>

                    <div class="contact__information grid">
                
                                <div class="information">
                                    <h3> Visit one of our agency locations or contact us Today</h3>
                                    <div>
                                        <li>
                                            <i class="bx bx-phone contact__icon"></i>
                                            <p>0772466033</p>
                                        </li>

                                        <li>
                                            <i class="bx bx-envelope contact__icon"></i>
                                            <p>stylepoint@oulook.lk</p>
                                        </li>

                                        <li>
                                            <i class="bx bx-map contact__icon"></i>
                                            <p>133 A/2 Kahatowita <br>Veyangoda</p>
                                        </li>

                                        <li>
                                            <i class='bx bx-time-five'></i>
                                            <p>Monday to Saturday: 9.00am to 16.00pm</p>
                                        </li>
                                    </div>
                                </div>

                                <div class="contact__img">
                                    <img src="images/about_us/contect-1.png">
                                </div>
                    </div><br><br>

                    <div class="contact__form-container grid">
                        <div class="contact__form">
                            <div class="contact__title">We love to hear from you</div>

                            <form action="" method="post" class="contact__form-form">
                                <input type="hidden" name="send_date" value="<?= date('Y-m-d'); ?>">
                                    
                                <input type="text" name="name" placeholder="Your Name" class="form__input" maxlength="50">
                                <input type="email" name="email" placeholder="Your Email" class="form__input" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                                <input type="number" name="number" min="0" max="9999999999" class="form__input" placeholder="enter your number" required maxlength="10" oninput="enforceLength(this, 10)">
                                <input type="text" name="msg" placeholder="Your Message" class="form__input-message">

                                <input type="submit" value="Submit" name="message" class="success">

                            </form> 
                        </div>

                        <div class="contact__reply">
                            <div class="message_title">Messages</div>

                            <div class="replys">
                            <?php
                                $select_messages = $conn->prepare("SELECT * FROM `messages` ORDER BY `msg_ID` DESC LIMIT 5");
                                $select_messages->execute();
                                if($select_messages->rowCount() > 0){
                                    while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <div class="messages">
                                    <div class="msg"><i class="fa-regular fa-message fa-flip-horizontal"></i><?= $fetch_messages['message']; ?></div>
                                </div>
                                <div class="reply">
                                    <div class="ans"><?= $fetch_messages['reply']; ?><i class="ri-reply-line"></i></div>
                                </div>
                            <?php
                                    }
                                }else{
                                    echo '<p class="empty">you have no messages</p>';
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="feature section container">
                            
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
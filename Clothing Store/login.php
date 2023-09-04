<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['login'])){

    $uname = $_POST['uname'];
    $uname = filter_var($uname, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$uname, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
        $_SESSION['user_id'] = $row['u_ID'];
        header('location:index.php');
    }else{
       $message_error[] = 'incorrect username or password!';
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
        <title>Clothing Store > login</title>
    </head>
    <body>

        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>

        <!------ main ------>
        <main class="main">

            <!---- login ------>
            <section class="log-in section container">
            <h2 class="breadcrumb__title">Login Page</h2>
            <h3 class="breadcrumb__subtitle">Home > <span> login</span></h3>

                <div class="login__container grid">
                    <div class="photo">
                        <img src="images/login-1.png">
                    </div>

                    <div class="login-form">
                        <div class="login__title">Let's Start Your Order</div>

                        <form action="" class="form grid" method="post" enctype="multipart/form-data">
                            <input type="email" name="uname" placeholder="Enter Username" class="form__input" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                            <input type="password" name="pass" placeholder="Enter Password" class="form__input" maxlength="8" oninput="enforceLength(this, 8)" oninput="this.value = this.value.replace(/\s/g, '')"><br>

                            <div class="form__btn">
                                <input type="submit" value="login with Style Point" name="login" class="success">
                            </div>
                            <div class="form__btn">
                                <a href="register.php" class="success"><i class="ri-user-add-line"></i>&nbsp &nbsp Create Account</a><br><br><br>
                            </div>  
                        </form>
                    </div>
                
                </div>

            </section>
                
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
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['register'])){

    $fname = $_POST['title'].', ' .$_POST['fname'];
    $fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname = $_POST['lname'];
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    $address = $_POST['no'].', '.$_POST['line_1'].', ' .$_POST['line_2'].', ' .$_POST['zip_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
    $select_user->execute([$email, $number]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
       $message_error[] = 'email or number already exists!';
    }else{
        if($pass != $cpass){
            $message_error[] = 'confirm password not matched!';
        }else{
            if($image_size > 2000000){
                $message_error[] = 'image size is too large';
            }
            else{
                move_uploaded_file($image_tmp_name, $image_folder);

                $insert_user = $conn->prepare("INSERT INTO `users`(first_Name, last_Name, email, number, password, address, image) VALUES(?,?,?,?,?,?,?)");
                $insert_user->execute([$fname, $lname, $email, $number, $cpass, $address, $image]);

                $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
                $select_user->execute([$email, $pass]);
                $row = $select_user->fetch(PDO::FETCH_ASSOC);
                if($select_user->rowCount() > 0){
                $_SESSION['user_id'] = $row['u_ID'];
                header('location:index.php');
            }
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
        <title>Clothing Store > Register</title>
    </head>
    <body>

        <!----- HEADER ----->
        <?php include 'components/user_header.php'; ?>

        <!------ main ------>
        <main class="main">

            <!---- register ------>
            <section class="register section container">
            <h2 class="breadcrumb__title">Register Page</h2>
            <h3 class="breadcrumb__subtitle">Home > <span> Register</span></h3>

                <div class="register__container grid">
                        
                    <div class="register-form">
                        <div class="register__title">Become a Member</div>

                        <form action="" class="form grid" method="post" enctype="multipart/form-data">
                            <select name="title" class="form__input">
                                <option>-- Select your Title --</option>
                                <option value="Mr. ">Mr.</option>
                                <option value="Mrs. ">Mrs.</option>
                                <option value="Miss. ">Miss.</option>
                                <option value="Dr. ">Dr.</option>
                                <option value="Ms. ">Ms.</option>
                            <select>
                            <input type="text" name="fname" placeholder="Your First Name" class="form__input" maxlength="50">
                            <input type="text" name="lname" placeholder="Your Last Name" class="form__input" maxlength="50">
                            <input type="email" name="email" placeholder="Your Email" class="form__input" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                            <input type="number" name="number" placeholder="Phone Number" class="form__input" min="0" max="9999999999" maxlength="10" oninput="enforceLength(this, 10)">
                            <input type="text" name="zip_code" placeholder="Zip Code" class="form__input" maxlength="5" oninput="enforceLength(this, 5)">
                            <input type="text" name="no" placeholder="Address No" class="form__input" maxlength="50">
                            <input type="text" name="line_1" placeholder="Address Line 1" class="form__input" maxlength="50">
                            <input type="text" name="line_2" placeholder=" Address Line 2" class="form__input" maxlength="50">
                            <input type="password" name="pass" placeholder="Your Password" class="form__input" maxlength="8" oninput="enforceLength(this, 8)" oninput="this.value = this.value.replace(/\s/g, '')">
                            <input type="password" name="cpass" placeholder="Confirm Password" class="form__input" maxlength="8" oninput="enforceLength(this, 8)" oninput="this.value = this.value.replace(/\s/g, '')">

                            <div class="form__inputs grid">
                                <p class="form__input-text">Your Photo</p>
                                <input type="file" name="image" class="form__input-text" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                            </div><br><br>

                            <div class="form__btn">
                                <input type="submit" value="Register now" name="register" class="success">
                            </div>
                            <p class="btn__pera">Already have an Account? <a href="login.php" class="btn__link">Login Now</a></p>    
                        </form>
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
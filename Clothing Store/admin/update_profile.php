<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_profile'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    
    $old_image = $_POST['old_Img'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/'.$image;

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE password = ?");
    $select_admin->execute([$pass]);

    if($select_admin->rowCount() > 0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['admin_ID'];
        header('location:update_profile.php');

        if(!empty($name)){
            $update_name = $conn->prepare("UPDATE `admin` SET admin_Name = ? WHERE admin_ID = ?");
            $update_name->execute([$name, $admin_id]);
        }
     
        if(!empty($email)){
           $select_email = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
           $select_email->execute([$email]);
           if($select_email->rowCount() > 0){
              $message[] = 'email already taken!';
           }else{
              $update_email = $conn->prepare("UPDATE `admin` SET email = ? WHERE admin_ID = ?");
              $update_email->execute([$email, $admin_id]);
           }
        }
     
        if(!empty($number)){
           $select_number = $conn->prepare("SELECT * FROM `admin` WHERE number = ?");
           $select_number->execute([$number]);
           if($select_number->rowCount() > 0){
              $message[] = 'number already taken!';
           }else{
              $update_number = $conn->prepare("UPDATE `admin` SET number = ? WHERE admin_ID = ?");
              $update_number->execute([$number, $admin_id]);
           }
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
                $message[] = 'images size is too large!';
             }else{
                $update_image = $conn->prepare("UPDATE `admin` SET image = ? WHERE admin_ID = ?");
                $update_image->execute([$image, $admin_id]);
                move_uploaded_file($image_tmp_name, $image_folder);
                deleteFile($old_image);
                $message[] = 'image updated!';
             }
        }

        }else {
            $message[] = 'incorrect password!';
        }
}

if(isset($_POST['update_password'])){

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_old_pass = $conn->prepare("SELECT password FROM `admin` WHERE admin_ID = ?");
    $select_old_pass->execute([$admin_id]);
    $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

        if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
            $message[] = 'old password not matched!';
        }elseif($new_pass != $confirm_pass){
            $message[] = 'confirm password not matched!';
        }else{
            if($new_pass != $empty_pass){
                $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE admin_ID = ?");
                $update_pass->execute([$confirm_pass, $admin_id]);
                $message[] = 'password updated successfully!';
            }else{
                $message[] = 'please enter a new password!';
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
        <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

        <!----- swiper css ----->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

        <!----- css ----->
        <link rel="stylesheet" href="../css/admin_style.css">
        
        <!----- js ----->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

        <!---- icons ----->
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

                    <h3 class="main_heading">Profile</h3>

                    <!----- Update product section --->
                    <div class="update">

                        <h3 class="update__heading">Update Profile</h3>

                            <form action="" method="POST" enctype="multipart/form-data">

                            <?php
                                $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
                                $select_profile->execute([$admin_id]);
                                if($select_profile->rowCount() > 0){
                                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                            ?>

                                <input type="hidden" name="old_Img" value="<?= $fetch_profile['image']; ?>">
                                <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">

                                <span>Update Name</span>
                                    <input type="text" required placeholder="User Name" name="name" maxlength="100" class="box" value="<?= $fetch_profile['admin_Name']; ?>">
                                <span>Update Email</span>
                                    <input type="email" required placeholder="Email" name="email" maxlength="100" class="box" value="<?= $fetch_profile['email']; ?>">
                                <span>Update Number</span>
                                    <input type="number" min="0" max="9999999999" required placeholder="Phone Number" name="number" value="<?= $fetch_profile['number']; ?>" onkeypress="if(this.value.length == 10) return false;" class="box" value="">
                                <span>Password</span>
                                    <input type="text" required placeholder="Password" name="pass" maxlength="100" class="box" value="">
                                <span>Add Profile Photo</span>
                                    <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
                                
                                 
                                    <div class="btns">
                                        <input type="submit" value="Update" name="update_profile" class="btn-succes">
                                        <a href="dashboard.php" class="btn-cencel">Cencel</a>
                                    </div>
                                    <?php
                                        }
                                    ?>
                            </form>
                        
                    </div>

                    <div class="update">

                        <h3 class="update__heading">Update Password</h3>

                            <form action="" method="POST" enctype="multipart/form-data">

                                <span>Old Password</span>
                                    <input type="text" required placeholder="Old Password" name="old_pass" maxlength="100" class="box" value="">
                                <span>New Password</span>
                                    <input type="text" required placeholder="New Password" name="new_pass" maxlength="100" class="box" value="">
                                <span>Retype Pasword</span>
                                    <input type="text" required placeholder="Retype Password" name="confirm_pass" maxlength="100" class="box" value="">

                                    <div class="btns">
                                        <input type="submit" value="Update" name="update_password" class="btn-succes">
                                        <a href="admin_profile.php" class="btn-cencel">Cencel</a>
                                    </div>
                            </form>
                        
                    </div>
            </section>

        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
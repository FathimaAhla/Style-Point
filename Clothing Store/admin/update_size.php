<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


if(isset($_POST['update_size'])){

    $size = $_POST['size'];
    $size = filter_var($size, FILTER_SANITIZE_STRING);
    $size_id = $_POST['size_id'];
    $size_id = filter_var($size_id, FILTER_SANITIZE_STRING);

        $insert_size = $conn->prepare("UPDATE `size` SET sizes = ? WHERE size_ID = ?");
        $insert_size->execute([$size, $size_id]);
        $message[] = 'size is updated!';

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

        <title>add products</title>
    </head>

    <body>

        <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>

                <h3 class="main_heading">Products</h3>

            <div class="update">

                <h3 class="update__heading">Update Size</h3>
                    <?php
                        $update_id = $_GET['update_size'];
                        $select_size = $conn->prepare("SELECT * FROM `size` WHERE size_ID = ?");
                        $select_size->execute([$update_id]);
                        if($select_size->rowCount() > 0){
                            while($fetch_size = $select_size->fetch(PDO::FETCH_ASSOC)){
                    ?>
                
                        <form action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="size_id" value="<?= $fetch_size['size_ID'];?>">

                
                            <input type="text" required placeholder="product Size" name="size" maxlength="100" class="box">
                                                          
                            <input type="submit" value="Update Size" name="update_size" class="btn-succes">                                    
                            <a href="product_details.php" class="btn-cencel">Cencel</a>

                        </form>
                    <?php
                            }
                        }
                    ?>
            </div>
            
        </section>
         
            
        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        
        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_brand'])){

    $brand = $_POST['brand'];
    $brand = filter_var($brand, FILTER_SANITIZE_STRING);
    $brand_id = $_POST['brand_id'];
    $brand_id = filter_var($brand_id, FILTER_SANITIZE_STRING);

       $insert_brand = $conn->prepare("UPDATE `brand` SET brand_name = ? WHERE brand_ID = ?");
       $insert_brand->execute([$brand, $brand_id]);
       $message[] = 'brand is updated!';
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

                <h3 class="update__heading">Update Brands</h3>

                <?php
                    $update_id = $_GET['update_brand'];
                    $select_brand = $conn->prepare("SELECT * FROM `brand` WHERE brand_ID = ?");
                    $select_brand->execute([$update_id]);
                    if($select_brand->rowCount() > 0){
                        while($fetch_brand = $select_brand->fetch(PDO::FETCH_ASSOC)){
                ?>
                        <form action="" method="POST">
                        
                        <input type="hidden" name="brand_id" value="<?= $fetch_brand['brand_ID'];?>">

                
                            <input type="text" required placeholder="product Brand" name="brand" maxlength="100" class="box">
                                                          
                            <input type="submit" value="Update Brand" name="update_brand" class="btn-succes">                                    
                            <a href="manage_produts.php" class="btn-cencel">Cencel</a>

                        </form>
            </div>
            <?php
                }
            }
            ?>
            
        </section>
         
            
        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        
        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
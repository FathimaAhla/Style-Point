<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


if(isset($_POST['update_category'])){

    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $category_id = $_POST['category_id'];
    $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);

    
        $update_category = $conn->prepare("UPDATE `category` SET category = ? WHERE cat_ID = ?");
        $update_category->execute([$category, $category_id]);
        $message[] = 'category updated!';
    
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

                <h3 class="update__heading">Update Category</h3>

                    <?php
                        $update_id = $_GET['update_category'];
                        $select_category = $conn->prepare("SELECT * FROM `category` WHERE cat_ID = ?");
                        $select_category->execute([$update_id]);
                        if($select_category->rowCount() > 0){
                           while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <form action="" method="POST" >

                    <input type="hidden" name="category_id" value="<?= $fetch_category['cat_ID'];?>">

                            <input type="text" required placeholder="product Category" name="category" maxlength="100" class="box">
                                                          
                            <input type="submit" value="Update Category" name="update_category" class="btn-succes">                                    
                            <a href="manage_produts.php" class="btn-cencel">Cencel</a>

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
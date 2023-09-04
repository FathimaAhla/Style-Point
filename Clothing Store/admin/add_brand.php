<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['add_brand'])){

    $brand = $_POST['brand'];
    $brand = filter_var($brand, FILTER_SANITIZE_STRING);

    $select_brand = $conn->prepare("SELECT * FROM `brand` WHERE brand_name = ?");
    $select_brand->execute([$brand]);

    if($select_brand->rowCount() > 0){
        $message[] = 'category already exists!';
    }else{
           $insert_brand = $conn->prepare("INSERT INTO `brand`(brand_name) VALUES(?)");
           $insert_brand->execute([$brand]);
           $message[] = 'new brand added!';
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

        <title>add products</title>
    </head>

    <body>

        <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>

                <h3 class="main_heading">Products</h3>

            <div class="update">

                <h3 class="update__heading">Add Product Brands</h3>

                        <form action="" method="POST" enctype="multipart/form-data">
                
                            <input type="text" required placeholder="product Brand" name="brand" maxlength="100" class="box">
                                                          
                            <input type="submit" value="Add Brand" name="add_brand" class="btn-succes">                                    
                            <a href="manage_produts.php" class="btn-cencel">Cencel</a>

                        </form>
            </div>
            
        </section>
         
            
        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        
        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
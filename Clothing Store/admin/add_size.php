<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['add_size'])){

    $pid = $_POST['pro_id'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $size = $_POST['size'];
    $size = filter_var($size, FILTER_SANITIZE_STRING);

    $select_size = $conn->prepare("SELECT * FROM `size` WHERE pro_ID = ? AND sizes = ?");
    $select_size->execute([$pid, $size]);

    if ($select_size->rowCount() > 0) {

        $message[] = 'Already color added!';

    } else{

            $insert_size = $conn->prepare("INSERT INTO `size`(pro_ID, sizes) VALUES (?,?)");
            $insert_size->execute([$pid, $size]);

            $message[] = 'New color added!';
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

        <title>add size</title>
    </head>

    <body>

        <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>

                <h3 class="main_heading">Products</h3>

            <div class="update">

                <h3 class="update__heading">Add Product Size</h3>

                        <?php
                            if(isset($_GET['pro_id'])) {
                            $update_id = $_GET['pro_id'];
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE pro_ID = ?");
                            $select_products->execute([$update_id]);
                            if($select_products->rowCount() > 0){
                            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                        ?>



                        <form action="" method="POST" enctype="multipart/form-data">
                
                        <input type="hidden" name="pro_id" value="<?= $fetch_products['pro_ID']; ?>">

                            <select name="size" class="box" required>
                                <option value="" disabled selected>select size --</option>
                                <option value="M">M</option>                                    
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>                                
                            </select>     

                            <input type="submit" value="Add Size" name="add_size" class="btn-succes">                                    <a href="products.php" class="btn-cencel">Cencel</a>

                        </form>

                        <?php
                            }
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
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product = $conn->prepare("DELETE FROM `category` WHERE cat_ID = ?");
    $delete_product->execute([$delete_id]);
    header('location:manage_produts.php');
 
 }

 if(isset($_GET['delete_brand'])){

    $delete_id = $_GET['delete'];
    $delete_product = $conn->prepare("DELETE FROM `brand` WHERE brand_ID = ?");
    $delete_product->execute([$delete_id]);
    header('location:manage_produts.php');
 
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


                <div class="category_list">

                <div class="cat">
                    <h3 class="heading">Category List</h3>
                    <div class="category">
                        
                        <table>
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $show__category = $conn->prepare("SELECT * FROM `category`");
                                    $show__category->execute();
                                    if($show__category->rowCount() > 0){
                                       while($fetch_category = $show__category->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                    <tr>
                                        <td><?= $fetch_category['category']; ?></td>
                                        <td>
                                            <a href="update_category.php?update_category=<?= $fetch_category['cat_ID'];?>" class="ri-pencil-fill action__icon edit"></a>
                                        </td>
                                        <td>
                                            <a href="manage_produts.php?delete=<?= $fetch_category['cat_ID']; ?>" class="ri-delete-bin-line action__icon delete" onclick="return confirm('delete this account?');"></a>
                                        </td>
                                    </tr> 

                                    <?php
                                        }
                                    }else{
                                        echo '<p class="empty"> No Products Added Yet!</p>';
                                    }
                                    ?>
                                </tbody>
                        </table>
                        

                    </div>
                    <div class="cat-btn">
                        <a href="add_category.php" name="add_category" class="btn-succes-cat">Add Category</a>
                    </div>
                    </div>

                <div class="cat">
                    <h3 class="heading">Brand List</h3>
                    <div class="category">
                        
                        <table>
                                <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $show__brand = $conn->prepare("SELECT * FROM `brand`");
                                    $show__brand->execute();
                                        if($show__brand->rowCount() > 0){
                                           while($fetch_brand = $show__brand->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                    <tr>
                                        <td><?= $fetch_brand['brand_name']; ?></td>
                                        <td>
                                            <a href="update_brand.php?update_brand=<?= $fetch_brand['brand_ID']; ?>" class="ri-pencil-fill action__icon edit"></a>
                                        </td>
                                        <td>
                                            <a href="manage_produts.php?delete_brand=<?= $fetch_brand['brand_ID']; ?>" class="ri-delete-bin-line action__icon delete" onclick="return confirm('delete this account?');"></a>
                                        </td>
                                    </tr> 
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty"> No Products Added Yet!</p>';
                                     }
                                ?>
                                </tbody>
                        </table>

                    </div>
                    <div class="cat-btn">
                        <a href="add_brand.php" name="add_brand" class="btn-succes-cat">Add Brand</a>
                    </div>
                    
                </div>
                </div>
                    
        </section>
         
            
        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
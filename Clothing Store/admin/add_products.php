<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['add_product'])){

    $pro_Name = $_POST['pro_name'];
    $pro_Name = filter_var($pro_Name, FILTER_SANITIZE_STRING);
    $pro_Num = $_POST['pro_num'];
    $pro_Num = filter_var($pro_Num, FILTER_SANITIZE_STRING);
    $color = $_POST['color'];
    $color = filter_var($color, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $material = $_POST['material'];
    $material = filter_var($material, FILTER_SANITIZE_STRING);
    $brand = $_POST['brand'];
    $brand = filter_var($brand, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $dis_Price = $_POST['disprice'];
    $dis_Price = filter_var($dis_Price, FILTER_SANITIZE_STRING);
    $dis_Percentage = $_POST['discount'];
    $dis_Percentage = filter_var($dis_Percentage, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    //image file 1
    $image_1 = $_FILES['image-1']['name'];
    $image_1 = filter_var($image_1, FILTER_SANITIZE_STRING);
    $image_size_1 = $_FILES['image-1']['size'];
    $image_tmp_name_1 = $_FILES['image-1']['tmp_name'];
    $image_folder_1 = '../uploaded_img/'.$image_1;

    //image file 2
    $image_2 = $_FILES['image-2']['name'];
    $image_2 = filter_var($image_2, FILTER_SANITIZE_STRING);
    $image_size_2 = $_FILES['image-2']['size'];
    $image_tmp_name_2 = $_FILES['image-2']['tmp_name'];
    $image_folder_2 = '../uploaded_img/'.$image_2;

    //image file 3
    $image_3 = $_FILES['image-3']['name'];
    $image_3 = filter_var($image_3, FILTER_SANITIZE_STRING);
    $image_size_3 = $_FILES['image-3']['size'];
    $image_tmp_name_3 = $_FILES['image-3']['tmp_name'];
    $image_folder_3 = '../uploaded_img/'.$image_3;

    //image file 4
    $image_4 = $_FILES['image-4']['name'];
    $image_4 = filter_var($image_4, FILTER_SANITIZE_STRING);
    $image_size_4 = $_FILES['image-4']['size'];
    $image_tmp_name_4 = $_FILES['image-4']['tmp_name'];
    $image_folder_4 = '../uploaded_img/'.$image_4;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE pro_Name = ? AND pro_number = ?");
    $select_products->execute([$pro_Name, $pro_Num]);

    if($select_products->rowCount() > 0) {
        $message[] = 'product name already exist!';
    }else{
        if($image_size_1 > 2000000 && $image_size_2 > 2000000 && $image_size_3 > 2000000 && $image_size_4 > 2000000){
            $message[] = 'image size is too large';
        }
        else{
            move_uploaded_file($image_tmp_name_1, $image_folder_1);
            move_uploaded_file($image_tmp_name_2, $image_folder_2);
            move_uploaded_file($image_tmp_name_3, $image_folder_3);
            move_uploaded_file($image_tmp_name_4, $image_folder_4);

            $insert_products = $conn->prepare("INSERT INTO `products` (pro_Name, pro_number, category, brand_name, material, color, price, dis_Price, dis_Percentage, description, img_1, img_2, img_3, img_4) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $insert_products->execute([$pro_Name, $pro_Num, $category, $brand, $material, $color, $price, $dis_Price, $dis_Percentage, $description, $image_1, $image_2, $image_3, $image_4]);

            $message[] = 'new product added!';
            header('location:add_products.php');


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

        <title>add products</title>
    </head>

    <body>

        <?php include '../components/admin_menu.php';?>

        <section id="interface">

            <?php include '../components/admin_nav.php';?>

                <h3 class="main_heading">Products</h3>

            <div class="update">

                <h3 class="update__heading">Add Products</h3>

                        <form action="" method="POST" enctype="multipart/form-data">

                            <input type="text" required placeholder="product name" name="pro_name" maxlength="100" class="box">
                            <input type="text" required placeholder="product number" name="pro_num" maxlength="100" class="box">
                            <select name="category" class="box">
                                <option value="">Select Category</option>
                                <?php
                                     $show_category = $conn->prepare("SELECT * FROM `category`");
                                     $show_category->execute();
                                     if ($show_category->rowCount() > 0) {
                                         while ($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)) {
                                             $optionValue = $fetch_category['cat_ID']; // Replace 'value_column_name' with the actual column name in your table
                                             $optionName = $fetch_category['category']; // Replace 'name_column_name' with the actual column name in your table
                                 
                                             echo '<option value="' . $optionName . '">' . $optionName . '</option>';
                                         }
                                     }
                                ?>
                            </select>                            
                            <select name="brand" class="box">
                                <option value="">Select Brand</option>
                                <?php
                                     $show_category = $conn->prepare("SELECT * FROM `brand`");
                                     $show_category->execute();
                                     if ($show_category->rowCount() > 0) {
                                         while ($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)) {
                                             $optionValue = $fetch_category['brand_ID']; // Replace 'value_column_name' with the actual column name in your table
                                             $optionName = $fetch_category['brand_name']; // Replace 'name_column_name' with the actual column name in your table
                                 
                                             echo '<option value="' . $optionName . '">' . $optionName . '</option>';
                                         }
                                     } 
                                ?>
                            </select>
                            <input type="text" required placeholder="product Material" name="material" maxlength="100" class="box">
                            <input type="text" required placeholder="product color" name="color" maxlength="100" class="box">
                            <input type="number" min="0" max="9999999999" required placeholder="product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
                            <input type="number" min="0" max="9999999999" required placeholder="Product Discount Price" name="disprice" onkeypress="if(this.value.length == 10) return false;" class="box">
                            <input type="number" min="0" max="9999999999" required placeholder="Discont Percentage" name="discount" class="box">
                            <input type="file" name="image-1" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                            <input type="file" name="image-2" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                            <input type="file" name="image-3" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                            <input type="file" name="image-4" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                            <input type="textarea" name="description" required placeholder="Description" class="box">                                
                            <input type="submit" value="Add Product" name="add_product" class="btn-succes">                                    
                            <a href="products.php" class="btn-cencel">Cencel</a>

                        </form>
            </div>
                    
        </section>
         
            
        <!----- swiper js----->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <!----- js ------>
        <script src="../js/admin.js"></script>
            
    </body>
</html>
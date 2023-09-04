<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_products'])){
    
    $pid = $_POST['pID'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $pro_Name = $_POST['pro_name'];
    $pro_Name = filter_var($pro_Name, FILTER_SANITIZE_STRING);
    $$category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $brand = $_POST['brand'];
    $brand = filter_var($brand, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $dis_Price = $_POST['disprice'];
    $dis_Price = filter_var($dis_Price, FILTER_SANITIZE_STRING);
    $dis_Percentage = $_POST['discount'];
    $dis_Percentage = filter_var($dis_Percentage, FILTER_SANITIZE_STRING);
    $color = $_POST['color'];
    $color = filter_var($color, FILTER_SANITIZE_STRING);
    $gender = $_POST['pro_gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $update_product = $conn->prepare("UPDATE `products` SET pro_name = ?, category = ?, brand_name = ?, price = ?, dis_Price = ?, dis_Percentage = ?, color = ?, size = ?, gender = ?, description = ? WHERE pro_ID = ?");
    $update_product->execute([$pro_Name, $category, $brand, $price, $dis_Price, $dis_Percentage, $color, $size, $gender, $description, $pid]);

    $message[] = 'product Updated..';

    //old images
    $old_image_1 = $_POST['old_Img-1'];
    $old_image_2 = $_POST['old_Img-2'];
    $old_image_3 = $_POST['old_Img-3'];
    $old_image_4 = $_POST['old_Img-4'];

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

    // Define the image directory
    $image_directory = '../uploaded_img/';

    // Function to handle file deletion with error handling

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
        } else {
            echo "File not found: $file\n";
        }
    }

    if(!empty($image_1) && ($image_2) && ($image_3) && ($image_4)){
        if($image_size_1 > 2000000){
           $message[] = 'images size is too large!';
        }else{
           $update_image_1 = $conn->prepare("UPDATE `products` SET img_1 = ? WHERE pro_ID = ?");
           $update_image_1->execute([$image_1, $pid]);
           move_uploaded_file($image_tmp_name_1, $image_folder_1);
           deleteFile($old_image_1);
           $message[] = 'image updated!';
        }

        if($image_size_2 > 2000000){
           $message[] = 'images size is too large!';
        }else{
           $update_image_2 = $conn->prepare("UPDATE `products` SET img_2 = ? WHERE pro_ID = ?");
           $update_image_2->execute([$image_2, $pid]);
           move_uploaded_file($image_tmp_name_2, $image_folder_2);
           deleteFile($old_image_2);
           $message[] = 'image updated!';
        }

        if($image_size_3 > 2000000){
           $message[] = 'images size is too large!';
        }else{
           $update_image_3 = $conn->prepare("UPDATE `products` SET img_3 = ? WHERE pro_ID = ?");
           $update_image_3->execute([$image_3, $pid]);
           move_uploaded_file($image_tmp_name_3, $image_folder_3);
           deleteFile($old_image_3);
           $message[] = 'image updated!';
        }

        if($image_size_4 > 2000000){
           $message[] = 'images size is too large!';
        }else{
           $update_image_4 = $conn->prepare("UPDATE `products` SET img_4 = ? WHERE pro_ID = ?");
           $update_image_4->execute([$image_4, $pid]);
           move_uploaded_file($image_tmp_name_4, $image_folder_4);
           deleteFile($old_image_4);
           $message[] = 'image updated!';
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

        <!---- icons ----->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <title>update products</title>
    </head>

    <body>
            <?php include '../components/admin_menu.php';?>

            <section id="interface">

                <?php include '../components/admin_nav.php';?>

                    <h3 class="main_heading">Products</h3>

                    <!----- Update product section --->
                    <div class="update">

                    <h3 class="update__heading">Update Products</h3>

                    <?php
                        $update_id = $_GET['update_products'];
                        $show_products = $conn->prepare("SELECT * FROM `products` WHERE pro_ID = ?");
                        $show_products->execute([$update_id]);
                        if($show_products->rowCount() > 0){
                            while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){ 
                             
                        ?>

                            <form action="" method="POST" enctype="multipart/form-data">

                                <h3>Update Product</h3>

                                <input type="hidden" name="pID" value="<?= $fetch_products['pro_ID']; ?>">
                                <input type="hidden" name="pro_name" value="<?= $fetch_products['pro_Name']; ?>">
                                <input type="hidden" name="old_Img-1" value="<?= $fetch_products['img_1']; ?>">
                                <input type="hidden" name="old_Img-2" value="<?= $fetch_products['img_2']; ?>">
                                <input type="hidden" name="old_Img-3" value="<?= $fetch_products['img_3']; ?>">
                                <input type="hidden" name="old_Img-4" value="<?= $fetch_products['img_4']; ?>">

                                <img src="../uploaded_img/<?= $fetch_products['img_1']; ?>" alt="">
                                <span>Update Name</span>
                                    <input type="text" required placeholder="product name" name="pro_name" maxlength="100" class="box" value="<?= $fetch_products['pro_Name']; ?>">
                                <span>Update Category</span>
                                <select name="category" class="box">
                                <option value=""><?= $fetch_products['category']; ?></option>
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
                                <span>Update Brand</span>
                                <select name="brand" class="box">
                                <option value=""><?= $fetch_products['brand_name']; ?></option>
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
                                <span>Update Color</span>
                                    <input type="text" required placeholder="product Color" name="color" maxlength="100" class="box" value="<?= $fetch_products['color']; ?>">
                                <span>Update Material</span>
                                    <input type="text" required placeholder="product Material" name="material" maxlength="100" class="box" value="<?= $fetch_products['material']; ?>">
                                <span>Update Price</span>
                                    <input type="number" min="0" max="9999999999" required placeholder="product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
                                <span>Update Discount Price</span>
                                    <input type="number" min="0" max="9999999999" required placeholder="Product Discount Price" name="disprice" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['dis_Price']; ?>">
                                <span>Update Discount Percentage</span>
                                    <input type="number" min="0" max="9999999999" required placeholder="Discont Percentage" name="discount" class="box" value="<?= $fetch_products['dis_Percentage']; ?>">
                                    
                                <span>Update Color</span>
                                <input type="text" required placeholder="product color" name="color" maxlength="100" class="box" value="<?= $fetch_products['color']; ?>">
                                <span>Update Image 1</span>
                                    <input type="file" name="image-1" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                <span>Update Image 2</span>
                                    <input type="file" name="image-2" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                <span>Update Image 3</span>
                                    <input type="file" name="image-3" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                <span>Update Image 4</span>
                                    <input type="file" name="image-4" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                <span>Update Description </span>
                                    <input type="textarea" name="description" class="box">
                                 
                                    <div class="btns">
                                        <input type="submit" value="Update" name="update_products" class="btn-succes">
                                        <a href="products.php" class="btn-cencel">Cencel</a>
                                    </div>
                            </form>
                        <?php
                            }
                        }else{
                            echo '<p class="empty">no products added yet!</p>';
                            }
                        ?>
                    </div>


                    <div class="update">
                    <div class="cat">

                            <h3 class="heading">Size Details</h3>

                                <div class="category">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                                <?php
                                                $update_size_id = $_GET['update_products'];
                                                $show_size = $conn->prepare("SELECT * FROM `size` WHERE pro_ID = ?");
                                                $show_size->execute([$update_size_id]);
                                                if($show_size->rowCount() > 0){
                                                    while($fetch_size = $show_size->fetch(PDO::FETCH_ASSOC)){ 
                                                
                                                    $optionValue = $fetch_size['size_ID']; // Replace 'value_column_name' with the actual column name in your table
                                                    $optionName = $fetch_size['sizes']; // Replace 'name_column_name' with the actual column name in your table

                                                    echo '<tr>';
                                                    echo '<td>'. $optionName .'</td>';
                                                    echo '<td>';
                                                    echo '<a href="update_size.php?update_size='.$fetch_size['size_ID'].'" class="ri-pencil-fill action__icon edit"></a>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<a href="product_details.php?delete='.$fetch_size['size_ID'].'" class="ri-delete-bin-line action__icon delete" onclick="return confirm(\'Delete this account?\');"></a>';echo '</td>';
                                                    echo '</tr>';
                                                    }
                                                } 
                                            ?>
                                        </tbody>
                                        
                                    </table>
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
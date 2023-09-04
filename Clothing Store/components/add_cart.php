<?php 

if(isset($_POST['add_to_cart'])){

    if($user_id == ''){
        header('location:login.php');
    }else{

        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $pro_name = $_POST['pro_name'];
        $pro_name = filter_var($pro_name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $brand_name = $_POST['brand_name'];
        $brand_name = filter_var($brand_name, FILTER_SANITIZE_STRING);
        $material = $_POST['material'];
        $material = filter_var($material, FILTER_SANITIZE_STRING);
        $color = $_POST['color'];
        $color = filter_var($color, FILTER_SANITIZE_STRING);
        $size = $_POST['size'];
        $size = filter_var($size, FILTER_SANITIZE_STRING);
        $image = $_POST['image-1'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE pro_Name = ? AND color = ? AND size = ? AND user_id = ?");
        $check_cart_numbers->execute([$pro_name, $color, $size, $user_id]);

        if($check_cart_numbers->rowCount() > 0){
            $message_error[] = 'already added to cart!';
        }else{
            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pro_ID, pro_Name, price, brand_name, material, color, size, quantity, image) VALUES(?,?,?,?,?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $pro_name, $price, $brand_name, $material, $color, $size, $qty, $image]);
            $message[] = 'added to cart!';
            
        }

    }

}

?>
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reviews</title>


    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <!----- js ----->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    <!--Remix Icon-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!---Custom Icon Library Font awesome -->
    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include '../components/admin_menu.php';?>

    <section id="interface">

        <?php include '../components/admin_nav.php';?>

        <h3 class="main_heading">Products Reviews</h3>

        <div>

            <h3 class="heading">Reviews </h3>
                <div class="review">
                    
                    <table>
                            <thead>
                                <tr>
                                    <th>Review ID</th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Rate</th>
                                    <th>Placed On</th>
                                    <th>Review</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($_GET['pro_id'])) {
                                $update_id = $_GET['pro_id'];
                                $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE pro_ID = ?");
                                $select_reviews->execute([$update_id]);
                                if($select_reviews->rowCount() > 0){
                                while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>

                                    <td><?= $fetch_reviews['review_ID']; ?></td>
                                    <td><?= $fetch_reviews['user_id']; ?></td>
                                    <td><?= $fetch_reviews['user_name']; ?></td>
                                    <?php 
                                        $rate = $fetch_reviews['rate'];
                                            if ($rate ==1  ){

                                                echo 
                                            
                                                '<td> 
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                </td>';
                                        
                                            }
                                            elseif ($rate ==2) {

                                                echo 
                                                '<td>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                </td>
                                            ';
                                            }
                                            elseif($rate ==3){

                                                echo '
                                                <td>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                </td>';
                                            
                                            }
                                            elseif($rate ==4){

                                                echo '
                                                <td
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                                </td>';
                                            
                                            }
                                            else {
                                                echo '
                                                <td>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                    <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                                </td>';
                                            
                                            }
                                        ?>
                                    <td><?= $fetch_reviews['placed_On']; ?></td>
                                    <td><?= $fetch_reviews['review']; ?></td>
                                    
                                </tr>

                                

                            </tbody>
                            <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No reviews Yet</p>';
                                    }
                                }
                                ?>
                    </table>
                    
                </div>
        </div>
    </section>

    <!----- js ------>
    <script src="../js/admin.js"></script>
</body>
</html>
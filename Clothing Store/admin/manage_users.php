<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product = $conn->prepare("DELETE FROM `users` WHERE u_ID = ?");
    $delete_product->execute([$delete_id]);
    header('location:manage_users.php');
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin accounts</title>


    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="../images/logo-1.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">


    <!--Remix Icon-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
    <?php include '../components/admin_menu.php';?>

    <section id="interface">

        <?php include '../components/admin_nav.php';?>

        <h3 class="main_heading">User Profiles</h3>

        <div>

            <h3 class="heading">Users</h3>
                <div class="recent-orders">
                    
                    <table>
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Number</th>
                                    <th>Email</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $select_account = $conn->prepare("SELECT * FROM `users`");
                                $select_account->execute();
                                if($select_account->rowCount() > 0){
                                    while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
                            ?>
                                <tr>
                                    <td><?= $fetch_accounts['u_ID']; ?></td>
                                    <td>
                                        <img src="../uploaded_img/<?= $fetch_accounts['image']; ?>" alt="">
                                    </td>
                                    <td><?= $fetch_accounts['last_Name']; ?></td>
                                    <td><?= $fetch_accounts['number']; ?></td>
                                    <td><?= $fetch_accounts['email']; ?></td>
                                    <td>
                                        <a href="manage_users.php?delete=<?= $fetch_accounts['u_ID']; ?>" class="ri-delete-bin-line action__icon delete" onclick="return confirm('delete this account?');"></a>
                                    </td>
                                    <td>
                                        <a href="user_details.php?user_id=<?= $fetch_accounts['u_ID']; ?>" class="pro_view">View</a>
                                    <td>
                                </tr>

                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">no accounts available</p>';
                                    }
                                ?>

                            </tbody>
                    </table>
                    
                </div>
        </div>
    </section>

    <!----- js ------>
    <script src="../js/admin.js"></script>
</body>
</html>
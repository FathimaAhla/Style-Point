<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE admin_ID = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
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

    <!----- js ----->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    <!--Remix Icon-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<body>
    <?php include '../components/admin_menu.php';?>

    <section id="interface">

        <?php include '../components/admin_nav.php';?>

        <h3 class="main_heading">Admin Profiles</h3>

        <div>

            <h3 class="heading">Admins</h3>
                <div class="recent-orders">
                    
                    <table>
                            <thead>
                                <tr>
                                    <th>Admin ID</th>
                                    <th>Image</th>
                                    <th>Admin Name</th>
                                    <th>Number</th>
                                    <th>Email</th>
                                    <!--<th>Update</th>-->
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $select_account = $conn->prepare("SELECT * FROM `admin`");
                                $select_account->execute();
                                if($select_account->rowCount() > 0){
                                    while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
                            ?>
                                <tr>
                                    <td><?= $fetch_accounts['admin_ID']; ?></td>
                                    <td>
                                        <img src="../uploaded_img/<?= $fetch_accounts['image']; ?>">
                                    </td>
                                    <td><?= $fetch_accounts['admin_Name']; ?></td>
                                    <td><?= $fetch_accounts['number']; ?></td>
                                    <td><?= $fetch_accounts['email']; ?></td>
                                    <!--<td>
                                    <?php
                                        //if($fetch_accounts['admin_ID'] == $admin_id){
                                            //echo '<a href="update_profile.php" class="ri-pencil-fill action__icon edit"></a>';
                                        //}
                                    ?>
                                    </td>-->
                                    <td>
                                        <a href="admin_accounts.php?delete=<?= $fetch_accounts['admin_ID']; ?>" class="ri-delete-bin-line action__icon delete" onclick="return confirm('delete this account?');"></a>
                                    </td>
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
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product = $conn->prepare("DELETE FROM `messages` WHERE msg_ID = ?");
    $delete_product->execute([$delete_id]);
    header('location:manage_messages.php');
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>


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

        <h3 class="main_heading">Messages</h3>

        <div>

            <h3 class="heading">Manage Message </h3>
                <div class="messages">
                    
                    <table>
                            <thead>
                                <tr>
                                    <th>Message ID</th>
                                    <th>Customer Name</th>
                                    <th>Number</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Reply</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $select_messages = $conn->prepare("SELECT * FROM `messages`");
                                $select_messages->execute();
                                if($select_messages->rowCount() > 0){
                                    while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <input type="hidden" name="msg_id" value="<?= $fetch_messages['msg_ID']; ?>">

                                <tr>

                                    <td><?= $fetch_messages['msg_ID']; ?></td>
                                    <td><?= $fetch_messages['name']; ?></td>
                                    <td><?= $fetch_messages['number']; ?></td>
                                    <td><?= $fetch_messages['email']; ?></td>
                                    <td><?= $fetch_messages['message']; ?></td>
                                    <td>
                                        <a href="reply_messages.php?submit=<?= $fetch_messages['msg_ID']; ?>" url=""  class="reply">Reply</a>
                                    </td>
                                    <td>
                                        <a href="manage_messages.php?delete=<?= $fetch_messages['msg_ID']; ?>" class="ri-delete-bin-line action__icon delete" onclick="return confirm('delete this account?');"></a>
                                    </td>
                                    <td>
                                        <a href="message_details.php?msg_id=<?= $fetch_messages['msg_ID']; ?>" class="pro_view">View</a>
                                    <td>
                                </tr>

                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">you have no messages</p>';
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
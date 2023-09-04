<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['admin_register'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? OR number = ?");
    $select_admin->execute([$email, $number]);
    
    if($select_admin->rowCount() > 0){
       $message[] = 'email or number already exists!';
    }else{
       if($pass != $cpass){
          $message[] = 'confirm passowrd not matched!';
       }else{
          $insert_admin = $conn->prepare("INSERT INTO `admin`(admin_Name, email, number, password) VALUES(?,?,?,?)");
          $insert_admin->execute([$name, $email, $number, $cpass]);
          $message[] = 'new admin registered!';
            header('location:dashboard.php');

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

        <!----- css ----->
        <link rel="stylesheet" href="../css/admin_profile.css">

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="/website/css/uicons-bold-rounded.css" rel="stylesheet">

        <title>admin register</title>
    </head>
    <body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post">
        <h3>Register New Admin</h3>

        <label for="username">Name</label>
        <input type="text" name="name" placeholder="Enter Name">

        <label for="username">Email</label>
        <input type="email" name="email" placeholder="Enter Email">

        <label for="username">Phone No</label>
        <input type="number" name="number" placeholder="Phone Phone">

        <label for="password">Password</label>
        <input type="password" name="pass" placeholder="Enter Password" id="password" oninput="this.value = this.value.replace(/\s/g, '')">
     
        <label for="password">Retype Password</label>
        <input type="password" name="cpass" placeholder="Retype Password" id="password" oninput="this.value = this.value.replace(/\s/g, '')">

        <button name="admin_register">Register Now</button>
    </form>
</body>
</html>
<?php

include '../components/connect.php';

session_start();

if(isset($_POST['login'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ?");
    $select_admin->execute([$name, $pass]);
    
    if($select_admin->rowCount() > 0){
       $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
       $_SESSION['admin_id'] = $fetch_admin_id['admin_ID'];
       header('location:dashboard.php');
    }else{
       $message[] = 'incorrect username or password!';
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

        <!----- css ----->
        <link rel="stylesheet" href="../css/admin_profile.css">

        <!---- icons ----->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="/website/css/uicons-bold-rounded.css" rel="stylesheet">

        <title>login</title>
    </head>
    <body>
    <div class="background">
        
    </div>
    <form  method="POST" action="">
        <h3>Login Here</h3>
        <p>Don't have an account? <a href="admin_register.php">Sign Up</a></p>

        <label for="username">Username</label>
        <input type="text" name="name" placeholder="Email" id="username" oninput="this.value = this.value.replace(/\s/g, '')">

        <label for="password">Password</label>
        <input type="password" name="pass" placeholder="Password" id="password" oninput="this.value = this.value.replace(/\s/g, '')">

        <button name="login">LogIn Now</button>
    </form>
</body>
</html>
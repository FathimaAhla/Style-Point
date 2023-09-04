<body>

<div class="menu-btn">
  <i class="fas fa-bars"></i>
</div>


<div class="side-bar">

 <header>
     <div class="close-btn">
         <i class="fas fa-times"></i>
     </div>

     <a href="dashboard.php">
        <img src="../images/admin-logo.png" class="logo" alt="">
      </a>
     
 </header>

     <div class="menu">
         <div class="item"><a href="dashboard.php"><i class="fas fa-desktop"></i>Dashboard</a></div>
         <div class="item">
             <a class="sub-btn"><i class='bx bxs-shopping-bags'></i>Products<i class="fas fa-angle-right dropdown"></i></a>
             <div class="sub-menu">
                 <a href="products.php" class="sub-item">Products Details</a>
                 <a href="add_products.php" class="sub-item">Add Products</a>
                 <a href="manage_produts.php" class="sub-item">Manage Products</a>
                 <a href="edit_products.php" class="sub-item">Products Updates</a>
             </div>
         </div>
         <div class="item"><a href="manage_users.php"><i class="ri-user-line"></i></i>Customers</a></div>
         <div class="item">
             <a class="sub-btn"><i class='bx bxs-food-menu'></i>Orders<i class="fas fa-angle-right dropdown"></i></a>
             <div class="sub-menu">
             <a href="placed_orders.php" class="sub-item">Placed Orders</a>
             <a href="pending_orders.php" class="sub-item">Pending Orders</a>
             <a href="Complete_orders.php" class="sub-item">Complete Orders</a>
             </div>
         </div>
         <div class="item"><a href="manage_messages.php"><i class="ri-message-2-line"></i>messages</a></div>
         <div class="item"><a href="admin_profile.php"><i class="ri-profile-line"></i>Profile</a></div>
         <div class="item"><a href="admin_accounts.php"><i class="ri-admin-line"></i>Admins</a></div>

         <div class="item">
             <a class="sub-btn"><i class="fas fa-th"></i>Forms<i class="fas fa-angle-right dropdown"></i></a>
             <div class="sub-menu">
             <a href="update_profile.php" class="sub-item">Update Profile</a>
             <a href="admin_register.php" class="sub-item">Register</a>
             <a href="admin_login.php" class="sub-item">login</a>
             </div>
         </div>
         <div class="item"><a href="../components/admin_logout.php"><i class="ri-logout-circle-r-line"></i>LogOut</a></div>
         </div>
     </div>

<script type="text/javascript">
$(document).ready(function(){
  //jquery for toggle sub menus
  $('.sub-btn').click(function(){
    $(this).next('.sub-menu').slideToggle();
    $(this).find('.dropdown').toggleClass('rotate');
  });

  //jquery for expand and collapse the sidebar
  $('.menu-btn').click(function(){
    $('.side-bar').addClass('active');
    $('.menu-btn').css("visibility", "visible");
  });

  $('.close-btn').click(function(){
    $('.side-bar').removeClass('active');
    $('.menu-btn').css("visibility", "hidden");
  });
});
</script>

</body>

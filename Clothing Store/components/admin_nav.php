
        <div class="navigation">
            <div class="n1">
                <di>
                    <i id ="menu-btn" class="ri-menu-line"></i>
                </di>
                <!--<div class="search">
                    <i class="ri-search-2-line"></i>
                    <input type="text" placeholder="Search">
                </div>-->
            </div>
            <div class="top">
                <?php
                    $admin_id = $_SESSION['admin_id'];
                    $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
                    $select_profile->execute([$admin_id]);
                    if($select_profile->rowCount() > 0){
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?= $fetch_profile['admin_Name']; ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
                <div class="profile-photo">
                    <img src="../uploaded_img/<?= $fetch_profile['image']; ?>">
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
        if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="popup">
                <div class="popup__message">
                    <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            </div>
            ';
        }
        }
        ?>
        
        

        <!----- js ------>
        <script src="../js/admin.js"></script>
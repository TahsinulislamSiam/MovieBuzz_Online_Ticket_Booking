<header>
    <div class="logo">
        <img src="../image/logo.png" alt="">
    </div>
    <div class="right">
        <div class="bx bxs-user" id="user-btn"></div>
        <div class="toggle-btn"><i class="bx bx-menu"></i></div>
    </div>
    <div class="profile" id="header-profile">
        <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id=?");
            $select_profile->execute([$admin_id]);


            if($select_profile->rowCount()>0){
                while($fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC)){
            
        ?>
        <img src="../uploaded_files/<?=$fetch_profile['image']; ?>" alt="">
        <h3 style="margin-bottom:.5rem"><?=$fetch_profile['name']; ?></h3>
        <div class="flex-btn">
            <a href="profile.php" class="btn">View Profile</a>
            <a href="../components/admin_logout.php" onclick="return confirm('logout from this website');" class="btn">Logout</a>
        </div>

        <?php
                }
            } else{

            
        ?>
        <img src="../image/user.png" alt="">
        <h3 style="margin-bottom:.5rem">please login first</h3>
        <div class="flex-btn">
            <a href="login.php" class="btn">login</a>
            <a href="register.php" class="btn">register</a>
        </div>
        <?php } ?>
    </div>
</header>

<div class="sidebar">
    <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id=?");
            $select_profile->execute([$admin_id]);


            if($select_profile->rowCount()>0){
                while($fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC)){
            
        ?>
       <div class="profile">
         <img src="../uploaded_files/<?=$fetch_profile['image']; ?>" alt="" class="logo-img">
        <h3 style="margin-bottom:.5rem"><?=$fetch_profile['name']; ?></h3>
        
       </div>

        <?php
                }
            } 

            
        ?>
        <h5>menu</h5>
        <div class="navbar">
            <ul>
                <li><a href="dashboard.php"><i class="bx bxs-home-smile"></i>dashboard</a></li>
                <li><a href="view_movie.php"><i class="bx bxs-food-menu"></i>view menu</a></li>
                <li><a href="view_actor.php"><i class="bx bxs-user"></i>view actor</a></li>
                <li><a href="view_crew.php"><i class="bx bxs-user"></i>View crew</a></li>
                <li><a href="view_hall.php"><i class="bx bxs-home-smile"></i>View hall</a></li>
                <li><a href="message.php"><i class="bx bxs-envelope"></i>View message</a></li>
                <li><a href="reserved_seat.php"><i class="bx bxs-user"></i>reserved seat</a></li>
                <li> <a href="../components/admin_logout.php" onclick="return confirm('logout from this website');"><i class="bx bxs-log-out "></i>Logout</a></li>
            </ul>
        </div>
        <h5>find us</h5>
<div class="social-links">
    <i class="bx bxl-facebook"></i>
    <i class="bx bxl-instagram-alt"></i>
    <i class="bx bxl-linkedin"></i>
    <i class="bx bxl-twitter"></i>
    <i class="bx bxl-pinterest-alt"></i>
</div>
</div>


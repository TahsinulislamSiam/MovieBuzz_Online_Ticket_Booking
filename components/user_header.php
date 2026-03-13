<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><img src="image/logo.png"></a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">about</a>
            <a href="fetch_movie.php">Movies</a>
            <a href="my_booking.php">Bookings</a>
            <a href="contact.php">Contact</a>
        </nav>
        <form action="search_movie.php" method="post" class="search_form">
            <input type="text" name="search_movie" placeholder="search movies....." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" name="search_movie_btn"></button>

        </form>
        <div class="icons">
            <div id="menu-btn" class="bx bx-list-plus"></div>
            <div id="search-id" class="bx bx-search-alt-2"></div>
            <a href="wishlist.php"><i class="bx bx-heart"></i><sup>0</sup></a>
            <div id="user-btn" class="bx bxs-user"></div>
        </div>
        <div class="profile">
            <?php 
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);

            if( $select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <img src="uploaded_files/<?=$fetch_profile['image']; ?>">
                <h3 style="margin-bottom: 1rem;"><?=$fetch_profile['name']; ?></h3>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">View Profile</a>
                    <a href="component.user_logout.php" onclick="return confirm('logout from this website');">logout</a>
                </div>
                <?php } else{ ?>
                 <img src="image/user.png">
                <h3 style="margin-bottom: 1rem;">Please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">login</a>
                    <a href="register.php">register</a>
                </div>
            <?php } ?>
        </div>
    </section>

</header>
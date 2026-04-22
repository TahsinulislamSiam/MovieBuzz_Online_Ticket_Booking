<section class="reviews-container">
    <div class="heading">
        <h1>user's reviews</h1>
    </div>

    <div class="box-container">
        <?php
            $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE movie_id = ?");
            $select_reviews->execute([$pid]);

            if ($select_reviews->rowCount() > 0) {
                while ($fetch_review = $select_reviews->fetch(PDO::FETCH_ASSOC)) {
                    // code...
        ?>

        <div class="box" <?= ($fetch_review['user_id'] == $user_id) ? 'style="order:-1"' : ''; ?>>
    <?php
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_user->execute([$fetch_review['user_id']]);
        while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
    ?>

    <div class="user">
        <?php if($fetch_user['image'] != ''){ ?>
            <img src="uploaded_files/<?= $fetch_user['image']; ?>">
        <?php }else{ ?>
        <h3><?=substr($fetch_user['name'],0,1) ?></h3>
        <?php } ?>
        <div>
            <p><?=$fetch_user['name'];?></p>
            <span><?=$fetch_review['date']; ?></span>
        </div>
    </div>

    <?php } ?>
    <div class="ratings">
        <?php if($fetch_review['rating'] ==1) { ?>
        <p style="background: red;"><i class="bx bxs-star"></i><span><?=$fetch_review['rating'];?></span></p>
    <?php } ?>

    <?php if($fetch_review['rating'] ==2) { ?>
        <p style="background: red;"><i class="bx bxs-star"></i><span><?=$fetch_review['rating'];?></span></p>
    <?php } ?>

    <?php if($fetch_review['rating'] ==3) { ?>
        <p style="background: orange;"><i class="bx bxs-star"></i><span><?=$fetch_review['rating'];?></span></p>
    <?php } ?>

    <?php if($fetch_review['rating'] ==4) { ?>
        <p style="background: green;"><i class="bx bxs-star"></i><span><?=$fetch_review['rating'];?></span></p>
    <?php } ?>

    <?php if($fetch_review['rating'] ==5) { ?>
        <p style="background: green;"><i class="bx bxs-star"></i><span><?=$fetch_review['rating'];?></span></p>
    <?php } ?>
        
    </div>
</div>
        <?php
                }
            } else {
                echo '
                <div class="empty">
                    <p>no reviews added yet!</p>
                </div>
                ';
            }
        ?>
    </div>
</section>
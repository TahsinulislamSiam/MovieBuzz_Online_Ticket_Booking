<?php
      if(isset($_POST['add_to_wishlist'])) {
        if($user_id !=''){

        $id = unique_id();
        $movie_id = $_POST['movie_id'];

        $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND movie_id=?");
        $verify_wishlist->execute([$user_id, $movie_id]);

        if($verify_wishlist->rowCount() > 0){
            $warning_msg[] = "movie already exist in your wishlist";
        } else{
            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(id, user_id, movie_id) VALUES(?, ?, ?)");
            $insert_wishlist->execute([$id, $user_id, $movie_id]);

            $success_msg[] = "movie added to wishlist";
        }
        } else{
            $warning_msg[] = "please login first";
        }
      } 
?>

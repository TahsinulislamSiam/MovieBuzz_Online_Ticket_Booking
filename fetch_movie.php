<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <title>A movie ticket booking website</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

 
  <div class="banner">

        <div class="detail">
            <h1>All Movies</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>All movies</span>
        </div>
    </div>


<div class="show-movie">
    <div class="heading">
        <span>movie listing</span>
        <h1>movies listing in MovieBuzz</h1>
    </div>
    <div class="box-container">
        <?php
        $select_movies = $conn->prepare("SELECT * FROM `movies` WHERE status =  ?");
        $select_movies->execute(['active']);

        if($select_movies->rowCount() > 0) {
            while($fetch_movies = $select_movies->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <form action="" method="post" class="box">
         <img src="uploaded_files/thumbnails/<?php echo htmlspecialchars($fetch_movies['thumbnails']); ?>" class="img1">

            <div class="content">
                <div class="button">
                     <div><h3><?= $fetch_movies['title'] ?></h3></div>
                     <div>
                        <button type="submit" name="add_to_wishlist"><img src="image/heart.png"></button>
                        <a href="<?= $fetch_movies['trailers_url'] ?>" class="bx bx-play"></a>
                       <a href="view_movie.php?pid=<?= $fetch_movies['id'] ?>" class="bx bxs-show"></a>

                     </div>
                </div>
              <div class="rate">
            <p><span><img src="image/tomato.png" alt=""></span>88%</p>
            <p><img src="image/cake.png" alt="">98%</p>
        </div>
        <input type="hidden" name="movie_id" value="<?=$fetch_movies['id'] ?>">
         <a href="select-language?movie_id=<?= $fetch_movies['id'] ?>" class="btn">Book ticket</a>
            </div>
        </form>

        <?php
            }
        } else{
            echo'
             <div class="empty">
        <p>No movies added yet</p>
    </div>
            ';
        }
        ?>
    </div>
</div>











    <?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    <?php 
        include'js/user_script.js';
        ?>
</script>


<?php include 'components/alert.php'; ?>

</body>
</html>
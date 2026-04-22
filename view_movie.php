<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }
    $pid = $_GET['pid'];
    include 'components/add_wishlist.php';
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
            <h1>Movie details</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Movie details</span>
        </div>
    </div>

    <div class="read-movie">
        <div class="heading">
            <h1>movie details</h1>
        </div>
        <div class="container">
            <?php
   
            $select_movies = $conn->prepare("SELECT * FROM `movies` WHERE id = ? AND status = ?");
            $select_movies->execute([$pid,'active']);
            
            if($select_movies->rowCount() > 0) {
                while($fetch_movies = $select_movies->fetch(PDO::FETCH_ASSOC)) {

            
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="movie_id" value="<?=$fetch_movies['id']; ?>">
                <div class="big-img">
                   <img src="uploaded_files/thumbnails/<?php echo htmlspecialchars($fetch_movies['thumbnails']); ?>" class="poster">
                </div>
                <div class="head">
                    <div class="title">movie: <span><?=$fetch_movies['title']; ?></span></div>
                     <div class="title">language: <span><?=$fetch_movies['language']; ?></span></div>
                      <div class="title"><i class="bx bxs-calender"></i><span><?=$fetch_movies['release_year']; ?></span></div>
                       <div class="title"><i class="bx bxs-stopwatch"></i> <span><?=$fetch_movies['duration']; ?></span></div>

                    <a href="<?=$fetch_movies['trailers_url']; ?>"><img src="image/play-button.png"></a>
                </div>
        <div class="flex-btn">
            <a href="select-language.php?movie_id=<?= $fetch_movies['id']; ?>" class="btn">book ticket</a>
            <button type="submit" name="add_to_wishlist" class="btn">add to wishlist</button>
              <a href="fetch_movie.php?movie_id=<?= $fetch_movies['id']; ?>" class="btn">go back</a>
        </div>
               
            </form>
            <?php
              }
            }
            ?>
        </div>
    </div>


     <?php include 'components/reviews.php'; ?>

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
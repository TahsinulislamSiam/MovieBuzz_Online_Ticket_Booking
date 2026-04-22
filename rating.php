<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
        header('location:login.php');
    }

    if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
    } else{
        $get_id = '';
        header('location:my_booking.php');
    }

    if(isset($_GET['get_id']) && !empty($_GET['get_id'])) {
        $booking_id = $_GET['get_id'];

        $select_booking = $conn->prepare("SELECT movie_id FROM booking WHERE id = ?");
        $select_booking->execute([$booking_id]);

        if($select_booking->rowCount()>0){
            $fetch_booking = $select_booking->fetch(PDO::FETCH_ASSOC);
            $movie_id = $fetch_booking['movie_id'];
        } else{
            $warning_msg[] ='booking not found';
        }
    } else{
        header('location:my_booking.php');
        exit();
    }



$movie_stmt = $conn->prepare("SELECT * FROM `movies` WHERE id= ?");
$movie_stmt->execute([$movie_id]);


if ($movie_stmt->rowCount() > 0) {
            while($fetch_movie = $movie_stmt->fetch(PDO::FETCH_ASSOC)){
                $fetch_img = $fetch_movie['thumbnails'];
                $movie_name = $fetch_movie['title'];
                $movie_duration = $fetch_movie['duration'];
                $release_year = $fetch_movie['release_year'];
                $trailers_url = $fetch_movie['trailers_url'];
            }
        }


   if (isset($_POST['add_review'])) {
    if ($user_id != '') {

        $id = unique_id();

        $title = $_POST['title'];
        $title = filter_var($title, FILTER_SANITIZE_STRING);

        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $rating = $_POST['ratings'];
        $rating = filter_var($rating, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id() .'.'. $ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/' .$rename;

       $add_ratings = $conn->prepare("INSERT INTO `reviews`(id, movie_id, user_id, rating, title, description) VALUES(?,?,?,?,?,?)");

$add_ratings->execute([$id, $movie_id, $user_id, $rating, $title, $description]);

           move_uploaded_file($image_tmp_name, $image_folder);

           header('location:my_booking.php');

    }
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
            <h1>Give Reviews</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Give Rating</span>
        </div>
    </div>


    <div class="review" style="padding: 5% 0">
        <div class="heading">
            <h1>Post your review</h1>
             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
           
        </div>
        <div class="img-box">
            <div class="img">
                 <img src="uploaded_files/thumbnails/<?= $fetch_img; ?>" alt="">
            </div>
            <div>
                <p>movie name : <span><?=$movie_name; ?></span></p>
                <p>Duration : <span><?=$movie_duration; ?></span></p>
                <p>release year : <span><?=$release_year; ?></span></p>
            </div>
        </div>

        <div class="form-container">
    <form action="" method="post" class="login" enctype="multipart/form-data">
        <div class="col" style="display: flex;">
            <div class="input-field">
                <p>title <span>*</span></p>
                <input type="text" name="title" placeholder="enter title" required class="box">
            </div>

            <div class="input-field">
                <p>upload image </p>
                <input type="file" name="image" accept="image/*" class="box">
            </div>
        </div>

        <div class="input-field">
            <p>review description <span>*</span></p>
            <textarea name="description" placeholder="enter review description" class="box" required cols="30" rows="10"></textarea>
        </div>
        <div class="input-field">
            <p>Give rating  <span>*</span></p>
            <select class="box" name="ratings" required>
                    <option value="1">1</option>
                     <option value="2">2</option>
                      <option value="3">3</option>
                       <option value="4">4</option>
                        <option value="5">5</option>
            </select>
        </div>
        <div class="flex-btn">
            <button type="submit" name="add_review" class="btn">Post your Review</button>
            <a href="my_booking.php" class="btn">Go back</a>
        </div>
    </form>
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
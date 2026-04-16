<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }
session_start();

$language =  $_SESSION['booking']['language'];
$formate =  $_SESSION['booking']['formate'];
$time = $_SESSION['booking']['time'];
$date = $_SESSION['booking']['date'];

$movie_id = $_GET['movie_id'];
$_SESSION['booking']['movie_id'];
$_SESSION['booking']['show_id'] = $_GET['show_id'];

$movie_stmt = $conn->prepare("SELECT * FROM `movies` WHERE id= ?");
$movie_stmt ->execute([$movie_id]);

if($movie_stmt->rowCount() > 0) {
    while($fetch_movies = $movie_stmt->fetch(PDO::FETCH_ASSOC)) {
        $fetch_img = $fetch_movies['thumbnails'];
        $movie_name = $fetch_movies['title'];
        $movie_language = $fetch_movies['language'];
        $duration = $fetch_movies['duration'];
        $release_year = $fetch_movies['release_year'];
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
            <h1>select show</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Select show</span>
        </div>
    </div>


    <div class="show-container">
             <img src="uploaded_files/thumbnails/<?= $fetch_img; ?>" alt="">
             <div class="movie-detail">
                <h1>movie: <?= $movie_name; ?></h1>
                <p>language: <?= $movie_language; ?></p>
                <p>duration: <?= $duration; ?></p>
                <p>release year: <?= $release_year; ?></p>
             </div>
             <div class="head">
                <p>language: <?= $language; ?></p>
                <p>experience: <?= $formate; ?></p>
                <p>time: <?= $time; ?></p>
                <p>date: <?= $date; ?></p>
             </div>

             <?php
            $select_show = $conn->prepare("SELECT * FROM `shows` WHERE movie_id= ?");
            $select_show -> execute([$movie_id]);

            if($select_show->rowCount() > 0) {
                while($fetch_show = $select_show->fetch(PDO:: FETCH_ASSOC)) {
                    $hall_id = $fetch_show['hall_id'];

                    $select_hall = "
                    SELECT DISTINCT halls.name, halls.city, halls.location
                    FROM halls
                    JOIN shows ON shows.hall_id = halls.id
                    WHERE shows.movie_id = ?
                    ";

                    $fetch_hall = $conn->prepare($select_hall);
                    $fetch_hall -> execute([$movie_id]); 

                    while($hall = $fetch_hall->fetch(PDO::FETCH_ASSOC)){

                  

?>
<form action="save-step2.php" method="post">
    <input type="hidden" name="show_id" value="<?= $fetch_show['id']; ?>">
    <div class="detail">
        <p>hall name: <span><?=$hall['name']; ?></span></p>
        <p>location: <span><?=$hall['location']; ?></span></p>
        <p>city: <span><?=$hall['city']; ?></span></p>

        <button type="submit" class="btn">select</button>
    </div>
</form>

<?php
          }
                }
            } else{
                echo '
                <div class="empty">
                <p>No shows available for this movie !</p>
                </div>
                ';
            }
?>

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
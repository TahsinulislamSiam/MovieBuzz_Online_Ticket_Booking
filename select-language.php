<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }
session_start();

if(isset($_GET['movie_id'])) {
    $_SESSION['booking']['movie_id'] = $_GET['movie_id'];
}

$movie_id = $_SESSION['booking']['movie_id'];

$movie_stmt = $conn->prepare("SELECT * FROM `movies` WHERE id= ?");
$movie_stmt ->execute([$movie_id]);

if($movie_stmt->rowCount() > 0) {
    while($fetch_movies = $movie_stmt->fetch(PDO::FETCH_ASSOC)) {
        $fetch_img = $fetch_movies['thumbnails'];
        $movie_name = $fetch_movies['title'];
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
            <h1>select language</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Select language</span>
        </div>
    </div>


    <div class="select-container">
            <img src="uploaded_files/thumbnails/<?= $fetch_img; ?>" alt="">
            <div class="form">
                        <form action="save-step1.php" method="post">
                            <div class="flex">
                                <div class="col">
                                  <div class="input-field">
                                  <p>language <span>*</span></p>
                                  <select name="language" required class="box">
                                    <option selected disabled>select language</option>
                                    <option value="hindi">hindi</option>
                                    <option value="Bangla">bangla</option>
                                    <option value="english">english</option>
                                    <option value="tamil">tamil</option>
                                  </select>  
                                  </div> 
                                  <div class="input-field">
                                  <p>Experience <span>*</span></p>
                                  <select name="formate" required class="box">
                                    <option selected disabled>select formate</option>
                                    <option value="2d">2d</option>
                                    <option value="3d">3d</option>
                                    <option value="Imax">Imax</option>
                                    <option value="tamil">tamil</option>
                                  </select>  
                                  </div>  
                                </div>
                                <div class="col">
                                     <div class="input-field">
                                  <p>Select show time<span>*</span></p>
                                  <select name="time" required class="box">
                                    <option selected disabled>select show time</option>
                                   <?php
                            $select_time = $conn->prepare("SELECT * FROM `shows`");
                            $select_time->execute();

                            if($select_time->rowCount() > 0) {
                                while($fetch_time = $select_time->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <option value="<?=$fetch_time['show_time']; ?>"><?=$fetch_time['show_time']; ?></option>
                             <?php

   }
                            }
?>

                                   ?>
                                  </select>  
                                  </div>  
                
                    <div class="input-field">
                        <p>date <span>*</span></p>
                        <input type="date" name="date" class="box" required min="<?php echo date('Y-m-d') ?>">
                    </div>
                    <br></br>



                                </div>
                            </div>


                            <div class="flex-btn">
                                <a href="fetch_movie.php" class="btn"><- go back</a>
                                <button type="submit" class="btn">Next -></button>
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
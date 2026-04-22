<?php
include 'components/connect.php';

if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else{
    header('location:login.php');
    exit();
}

if(isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else{
    header('location:my_booking.php');
    exit();
}

if (isset($_POST['canceled'])) {
    $update_booking = $conn->prepare("UPDATE `booking` SET status = ? WHERE id = ? LIMIT 1");
    $update_booking->execute(['canceled', $get_id]);
    header('location:my_booking.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css?v=<?php echo time(); ?>">
    <title>Booking Details</title>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Booking details</h1>
        <span><a href="home.php">home</a> → Booking details</span>
    </div>
</div>

<div class="view-booking">
    <div class="heading">
        <h1>Booking details</h1>
    </div>

    <div class="container">

<?php
$select_booking = $conn->prepare("SELECT * FROM `booking` WHERE id = ? LIMIT 1");
$select_booking->execute([$get_id]);

if($select_booking->rowCount() > 0){

    $fetch_booking = $select_booking->fetch(PDO::FETCH_ASSOC);

    $show_id = $fetch_booking['show_id'];
    $movie_id = $fetch_booking['movie_id'];

    // -------- Fetch Show --------
    $show_stmt = $conn->prepare("SELECT * FROM `shows` WHERE id = ?");
    $show_stmt->execute([$show_id]);
    $fetch_show = $show_stmt->fetch(PDO::FETCH_ASSOC);

    $hall_id = $fetch_show['hall_id'];
    $show_time = $fetch_show['show_time'];
    $show_date = $fetch_show['show_date'];

    // -------- Fetch Hall --------
    $hall_stmt = $conn->prepare("SELECT * FROM `halls` WHERE id = ?");
    $hall_stmt->execute([$hall_id]);
    $fetch_hall = $hall_stmt->fetch(PDO::FETCH_ASSOC);

    $hall_name = $fetch_hall['name'];
    $hall_location = $fetch_hall['location'];
    $hall_city = $fetch_hall['city'];

    // -------- Fetch Movie --------
    $movie_stmt = $conn->prepare("SELECT * FROM `movies` WHERE id = ?");
    $movie_stmt->execute([$movie_id]);
    $fetch_movie = $movie_stmt->fetch(PDO::FETCH_ASSOC);

    $fetch_img = $fetch_movie['thumbnails'];
    $movie_name = $fetch_movie['title'];
    $movie_duration = $fetch_movie['duration'];
    $release_year = $fetch_movie['release_year'];

?>

        <div class="box">
    <img src="uploaded_files/thumbnails/<?= $fetch_img; ?>" alt="">
    <div class="head">
        <div class="title">movie name : <span><?= $movie_name; ?></span></div>
        <div class="title">duration : <span><?= $movie_duration; ?></span></div>
        <div class="title">release year : <span><?= $release_year; ?></span></div>
        <a href="download_ticket.php?booking_id=<?= $fetch_booking['id']; ?>"><i class="bx bx-download"></i></a>
        <a href="<?= $trailer_url ?>"><img src="image/play-button.png" class="img"></a>
    </div>
    <div class="booking-summary">
        <h3>booking summary</h3>
        <div class="detail">
            <p>language : <span><?= $fetch_booking['language']; ?></span></p>
            <p>formate : <span><?= $fetch_booking['formate']; ?></span></p>
            <p>hall name : <span><?= $hall_name; ?></span></p>
            <p>hall location : <span><?= $hall_location; ?></span></p>
            <p>hall city : <span><?= $hall_city; ?></span></p>
            <p>total seat : <span><?= $fetch_booking['total_seat']; ?></span></p>
             <p>seat detail : <span><?= $fetch_booking['seat_details']; ?></span></p>
              <p>total amount : <span><?= $fetch_booking['amount']; ?></span></p>
              <p>date : <span><?= $fetch_booking['date']; ?></span></p>
              <p>time : <span><?= $fetch_booking['time']; ?></span></p>
              <p>payment status : <span><?= $fetch_booking['payment_status']; ?></span></p>
             <p>booking status : <span style="color: <?php if($fetch_booking['status'] == 'confirm'){echo "#31d7a9";}else{echo "red";} ?>"><?= $fetch_booking['status']; ?></span></p>
        </div>
    </div>
    <?php if($fetch_booking['status'] == 'canceled'){ ?>
    <div class="flex-btn">
        <a href="fetch_movie.php?get_id=<?= $fetch_booking['id']; ?>" class="btn">book again</a>
        <a href="my_booking.php?post_id=<?= $fetch_booking['id'] ?>" class="btn">go back</a>
        <a href="rating.php?get_id=<?= $fetch_movie['id'] ?>" class="btn">give ratings</a>
    </div>
<?php }else{ ?>
<form action="" method="post" class="flex-btn">
       <button type="submit" name="canceled" class="btn" onclick="return confirm('do you want to cancelled booking');">cancel</button>
        <a href="my_booking.php?post_id=<?= $fetch_booking['id'] ?>" class="btn">go back</a>
        <a href="rating.php?get_id=<?= $fetch_booking['id'] ?>" class="btn">give ratings</a>
</form>
<?php } ?>
</div>

<?php
}else{
    echo '<p style="text-align:center;">No booking found!</p>';
}
?>

    </div>
</div>

<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
<?php include 'js/user_script.js'; ?>
</script>

<?php include 'components/alert.php'; ?>

</body>
</html>
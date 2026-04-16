<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }

    session_start();

    //get the show_id from url first, fallback to session

    if(isset($_GET['show_id'])) {
        $show_id = $_GET['show_id'];
    } elseif(isset($_SESSION['booking']['show_id'])){
        $show_id = $_SESSION['booking']['show_id'];
    } else{
        die('No show selected');
    }
     // fetch session values
$language =  $_SESSION['booking']['language'];
$formate =  $_SESSION['booking']['formate'];
$time = $_SESSION['booking']['time'];
$date = $_SESSION['booking']['date'];
$movie_id = $_SESSION['booking']['movie_id'];

$movie_stmt = $conn->prepare("SELECT * FROM `movies` WHERE id = ?");
$movie_stmt->execute([$movie_id]);

if($movie_stmt->rowCount()>0) {
    while($fetch_movies = $movie_stmt->fetch(PDO::FETCH_ASSOC)){
        $fetch_img = $fetch_movies['thumbnails'];
        $movie_name = $fetch_movies['title'];
    }
}

$show_stmt = $conn->prepare("SELECT * FROM `shows` WHERE id= ?");
$show_stmt->execute([$show_id]);

if ($show_stmt->rowCount() > 0) {
    while($fetch_show = $show_stmt->fetch(PDO::FETCH_ASSOC)) {

        $hall_id = $fetch_show['hall_id'];

        $select_hall = $conn->prepare("SELECT * FROM `halls` WHERE id = ?");
        $select_hall->execute([$hall_id]);

        if ($select_hall->rowCount() > 0) {
            while($fetch_hall = $select_hall->fetch(PDO::FETCH_ASSOC)) {

                $hall_name = $fetch_hall['name'];
                $hall_location = $fetch_hall['location'];
                $hall_city = $fetch_hall['city'];

            }
        }

    }
}

//fetch seat details

$select_seat = $conn->prepare("SELECT * FROM `seat_details` WHERE user_id = ?");
$select_seat->execute([$user_id]);

if ($select_seat->rowCount() > 0) {
    while($fetch_seat = $select_seat->fetch(PDO::FETCH_ASSOC)) {

        $seat_detail_id = $fetch_seat['id'];
        $total_seats = $fetch_seat['total_seat'];
        $seat_detail = $fetch_seat['selection_seats'];
        $total_price = $fetch_seat['amount'];

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
            <h1>Booking</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Booking</span>
        </div>
    </div>


    <div class="booking-movie-detail">
         <img src="uploaded_files/thumbnails/<?= $fetch_img; ?>" alt="">
         <p>movie name: <span><?= $movie_name; ?></span></p>
    </div>

    <div class="booking-summary">
        <h3>Booking summary</h3>
        <div class="detail">
                <p>language : <span><?=$language;?></span></p>
                <p>formate : <span><?=$formate;?></span></p>
                <p>date : <span><?=$date;?></span></p>
                <p>time : <span><?=$time;?></span></p>
                <p>hall name : <span><?=$hall_name;?></span></p>
                <p>hall location : <span><?=$hall_location;?></span></p>
                 <p>hall city : <span><?=$hall_city;?></span></p>
                  <p>total seat : <span><?=$total_seats;?></span></p>
                   <p>seat details : <span><?=$seat_detail;?></span></p>
                    <p>total amount : <span>$<?=$total_price;?>/-</span></p>
        </div>
    </div>

    <div class="booking form-container">
        <h3>enter your card details</h3>
       <form action="" method="post" class="register">
         <div class="flex">
            <div class="col">
                <div class="input-field">
                    <p>Payment option <span>*</span></p>
                    <select name="payment_method" class="box" required>
                        <option selected disabled>select payment method</option>
                        <option value="credit card">credit card</option>
                        <option value="debit card">debit card</option>
                        <option value="paypal">paypal</option>
                        <option value="paytm">paytm</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>card details <span>*</span></p>
                    <input type="number" name="card-details" class="box" required>
                </div>
            </div>
            <div class="col">
                <div class="input-field">
                    <p>name on card <span>*</span></p>
                    <input type="text" name="card-name" class="box" required>        
                </div>
                <div class="input-field">
                    <p>expiration <span>*</span></p>
                    <input type="date" name="expiratory" min="<?php echo date('Y-m-d') ?>" class="box">        
                </div>
            </div>
        </div>

        <div class="input-field">
                <p>cvv <span>*</span></p>
                <input type="text" name="cvv" class="box" required>
        </div>
        <button type="submit" name="booking" class="btn">make payment</button>
       </form>
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
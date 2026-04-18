<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
        header('location:login.php');
    }

    $select_booking=$conn->prepare("SELECT * FROM `booking` WHERE user_id=?");
    $select_booking->execute([$user_id]);
    $total_booking = $select_booking->rowCount();

     $select_message=$conn->prepare("SELECT * FROM `message` WHERE user_id=?");
    $select_message->execute([$user_id]);
    $total_message = $select_message->rowCount();


   
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
            <h1>Profile</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Profile</span>
        </div>
    </div>

<section class="profile">
            <div class="img-box">
                <h3><?=$fetch_profile['name']; ?></h3>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="details">
                <div>
                    <img src="image/a-icon3.png" alt="">
                    <p>your name : <span><?=$fetch_profile['name']; ?></span></p>
                </div>
                <div>
                    <img src="image/p-icon0.png" alt="">
                    <p>your number : <span><?=$fetch_profile['number']; ?></span></p>
                </div>
                
                <div>
                    <img src="image/p-icon.png" alt="">
                    <p>your email : <span><?=$fetch_profile['email']; ?></span></p>
                </div>
                <div>
                    <img src="image/p-icon2.png" alt="">
                    <p>My booking : <span><?=$total_booking; ?></span></p>
                </div>
                <div>
                    <img src="image/p-icon1.png" alt="">
                    <p>message send : <span><?=$total_message; ?></span></p>
                </div>
                <div>
                    <img src="image/p-icon3.png" alt="">
                    <p>Your password : <span>******</span></p>
                </div>
            </div>
</section>
    







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
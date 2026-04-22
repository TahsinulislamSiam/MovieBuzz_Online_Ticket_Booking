<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])) {
        $admin_id = $_COOKIE['admin_id'];
    } else{
        $admin_id = '';
        header('location:login.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <title>A movie ticket booking website</title>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

 
  <div class="banner">

        <div class="detail">
            <h1>Dashboard</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">admin</a><i class="bx bxs-right-arrow-alt"></i>dashboard</span>
        </div>
    </div>


<div class="dashboard">
    <div class="heading">
        <span>My dashboard</span>
        <h1>dashboard</h1>
    </div>
    <div class="box-container">
        <div class="box">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id=?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>

            <h3>welcome</h3>
            <p><?=$fetch_profile['name'];?></p>
            <a href="update.php" class="btn">Update profile</a>
        </div>
        <div class="box">
    <?php
        $total_income = $conn->query("SELECT SUM(amount) FROM booking")->fetchColumn();
        
        if (!$total_income) {
            $total_income = 0;
        }
    ?>

    <h3>$<?php echo number_format($total_income); ?></h3>
    <p>total revenue</p>
    <i class="bx bx-dollar btn">dollars</i>
</div>
<div class="box">
    <?php
    $select_user = $conn->prepare("SELECT * FROM `users`");
    $select_user ->execute();
    $num_of_users = $select_user->rowCount();
    ?>
    <h3><?=$num_of_users ?></h3>
    <p>registered Users</p>
    <a href="user_account.php" class="btn">View user</a>
</div>
<div class="box">
    <?php
    $select_booking = $conn->prepare("SELECT * FROM `booking`");
    $select_booking ->execute();
    $total_booking = $select_booking->rowCount();
    ?>
    <h3><?=$total_booking ?></h3>
    <p>total booking</p>
    <a href="admin_bookings.php" class="btn">View booking</a>
</div>
<div class="box">
    <?php
    $select_movies = $conn->prepare("SELECT * FROM `movies`");
    $select_movies ->execute();
    $total_movies = $select_movies->rowCount();
    ?>
    <h3><?=$total_movies ?></h3>
    <p>total Movies</p>
    <a href="view_movie.php" class="btn">total movie</a>
</div>
<div class="box">
    <?php
    $select_reviews = $conn->prepare("SELECT * FROM `reviews`");
    $select_reviews ->execute();
    $total_reviews = $select_reviews->rowCount();
    ?>
    <h3><?=$total_reviews ?></h3>
    <p>total review</p>
    <a href="comments.php" class="btn">View reviews</a>
</div>

    </div>
</div>



<?php include '../components/fetch_movie.php'; ?>
<?php include '../components/reserved_seat.php'; ?>

    <?php include '../components/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    <?php 
        include'../js/admin_script.js';
        ?>
</script>


<?php include '../components/alert.php'; ?>

</body>
</html>
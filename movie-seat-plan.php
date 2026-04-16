<?php

use Dom\Document;
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }
session_start();

// show_id get from URL and store in session
if(isset($_GET['show_id'])){
    $_SESSION['booking']['show_id'] = $_GET['show_id'];
}

// use show_id
$show_id = $_SESSION['booking']['show_id'] ?? null;

// safety check
// if(!$show_id){
//     die("Show ID not found");
// }

$language =  $_SESSION['booking']['language'];
$formate =  $_SESSION['booking']['formate'];
$time = $_SESSION['booking']['time'];
$date = $_SESSION['booking']['date'];

$movie_id = $_SESSION['booking']['movie_id'];



$movie_stmt = $conn->prepare("SELECT * FROM `movies` WHERE id= ?");
$movie_stmt ->execute([$movie_id]);
$movie_title = $movie_stmt->fetchColumn();

if(isset($_POST['select_seat'])){
    if($user_id !=''){
        $id = unique_id();

        $total_seats = $_POST['total_seats'];
        $total_seats = filter_var($total_seats, FILTER_SANITIZE_STRING);

         $total_price = $_POST['total_price'];
        $total_price = filter_var($total_price, FILTER_SANITIZE_STRING);

         $selected_seats = $_POST['selected_seats'];
        $selected_seats = filter_var($selected_seats, FILTER_SANITIZE_STRING);


        $stmt = $conn->prepare("INSERT INTO `seat_details` (id, user_id, show_id, total_seat, selection_seats, amount) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->execute([$id,$user_id,$show_id,$total_seats,$selected_seats,$total_price]);


        if($stmt->rowCount()> 0 ) {
            header('location:booking.php?show_id=' .$show_id);
        } else{
            $warning_msg[] = 'failed to book seat please try again';
        }
    } else{
        $warning_msg[] = 'please login first';
    }
}


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
        <div class="select-seat">
            <div class="heading">
                <h1>screen</h1>
            </div>
            <img src="image/screen-thumb.png" alt="">
            <div class="seat-map">
                <?php
          
            $stmt = $conn->prepare("SELECT selection_seats FROM seat_details WHERE show_id = :show_id");
            $stmt->bindParam(':show_id', $show_id);
            $stmt->execute();
            $reservedSeats =  [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $seats = explode(',', $row['selection_seats']);
                $reservedSeats = array_merge($reservedSeats, $seats);
            }

                ?>

                <form action="" method="post">
                    <div id="seat-chart">
                        <?php
                    $rows = ['A', 'B', 'C','D','E','F','G','H','I','J'];
                    $cols = 5;

                    foreach($rows as $row ) {
                        for($col =1; $col <= $cols; $col++){
                            $seatNo = $row . $col;
                            $isReserved = in_array($seatNo, $reservedSeats);

                            $class = $isReserved ? "seat booked" : "seat";
                            $disabled = $isReserved ? "style='pointer-events:none'" : "";

                            echo "<div class='$class' data-seat='$seatNo' $disabled>$seatNo</div>";
                        }
                    }

                        ?>
                    <input type="hidden" name="selected_seats" id="selected-seats">
                    <input type="hidden" name="total_seats" id="total-seats" readonly value="0">
                    <input type="hidden" name="total_price" id="total-price-input" value="0">
                    <div class="detail">
                        <div id="selected-info">No seat selected : 0</div>
                        <div id="total-price">total price : 0</div>
                        <button type="submit" name="select_seat" class="btn">proceed</button>

                    </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>




    

    


    <?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">


const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click',function(){
    const userBox = document.querySelector('.profile');
    userBox.classList.toggle('active')
})

const toggle =  document.querySelector('#menu-btn');
toggle.addEventListener('click',function(){
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
})


let searchForm = document.querySelector('.header .flex .search_form');
document.querySelector('#search_btn').onclick = () =>{
    searchForm.classList.toggle('active');
const profile = document.querySelector('.profile');
    profile.classList.remove('active');
}






    
        const seats = document.querySelectorAll('.seat');
        const selectedInput = document.getElementById('selected-seats');
        const totalSeatsInput = document.getElementById('total-seats');
        const selectedInfo = document.getElementById('selected-info');
        const totalPriceDisplay = document.getElementById('total-price');

        const setPrice = 150 

        seats.forEach(seat =>{
            seat.addEventListener('click', () =>{
                if(!seat.classList.contains('booked')){
                    seat.classList.toggle('selected');
                    updateSelectedSeats();
                }
            })
        })

        function updateSelectedSeats(){
    const selectedSeats = [...document.querySelectorAll('.seat.selected')]
    .map(s => s.dataset.seat);

    selectedInput.value = selectedSeats.join(',');
    totalSeatsInput.value = selectedSeats.length;

    if(selectedSeats.length > 0) {
        selectedInfo.innerHTML = "you have choosed seat : <br> <span>" + selectedSeats.join(', ') + "</span>";
    } else{
        selectedInfo.textContent = "no seats selected";
    }

    const totalPrice = selectedSeats.length * setPrice;

    totalPriceDisplay.innerHTML = "total price : <br> <span>৳" + totalPrice.toLocaleString() + "</span>";

    document.getElementById('total-price-input').value = totalPrice;
}
        
</script>


<?php include 'components/alert.php'; ?>

</body>
</html>
<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }

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

    <div class="home-section">
        <div class="slider">
            <div class="slider__slider slide1">
                <div class="overlay"></div>
                <div class="slider-detail">
                    <h1>book your tickets <br>for <span>thor love and thunder</span></h1>
                    <div class="detail">
                        <p>duration : 2h : 20min</p>
                        <p>release year : 20 april 2026</p>
                    </div>
                    <div class="detail">
                        <p>language : Hindi | English | Bangla | Tamil</p>
                        <p>Adventure | Action | Comedy | Sci-fi</p>
                    </div>
                    <a href="fetch_movie.php" class="btn">Book ticket now</a>
                </div>
            </div>

                        <div class="slider__slider slide2">
                <div class="overlay"></div>
                <div class="slider-detail">
                    <h1>book your tickets <br>for <span>thor love and thunder</span></h1>
                    <div class="detail">
                        <p>duration : 2h : 20min</p>
                        <p>release year : 20 april 2026</p>
                    </div>
                    <div class="detail">
                        <p>language : Hindi | English | Bangla | Tamil</p>
                        <p>Adventure | Action | Comedy | Sci-fi</p>
                    </div>
                    <a href="fetch_movie.php" class="btn">Book ticket now</a>
                </div>
            </div>


                        <div class="slider__slider slide3">
                <div class="overlay"></div>
                <div class="slider-detail">
                    <h1>book your tickets <br>for <span>thor love and thunder</span></h1>
                    <div class="detail">
                        <p>duration : 2h : 20min</p>
                        <p>release year : 20 april 2026</p>
                    </div>
                    <div class="detail">
                        <p>language : Hindi | English | Bangla | Tamil</p>
                        <p>Adventure | Action | Comedy | Sci-fi</p>
                    </div>
                    <a href="fetch_movie.php" class="btn">Book ticket now</a>
                </div>
            </div>


                        <div class="slider__slider slide4">
                <div class="overlay"></div>
                <div class="slider-detail">
                    <h1>book your tickets <br>for <span>thor love and thunder</span></h1>
                    <div class="detail">
                        <p>duration : 2h : 20min</p>
                        <p>release year : 20 april 2026</p>
                    </div>
                    <div class="detail">
                        <p>language : Hindi | English | Bangla | Tamil</p>
                        <p>Adventure | Action | Comedy | Sci-fi</p>
                    </div>
                    <a href="fetch_movie.php" class="btn">Book ticket now</a>
                </div>
            </div>


                        <div class="slider__slider slide5">
                <div class="overlay"></div>
                <div class="slider-detail">
                    <h1>book your tickets <br>for <span>thor love and thunder</span></h1>
                    <div class="detail">
                        <p>duration : 2h : 20min</p>
                        <p>release year : 20 april 2026</p>
                    </div>
                    <div class="detail">
                        <p>language : Hindi | English | Bangla | Tamil</p>
                        <p>Adventure | Action | Comedy | Sci-fi</p>
                    </div>
                    <a href="fetch_movie.php" class="btn">Book ticket now</a>
                </div>
            </div>
            <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
            <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
        </div>
    </div>


    <div class="counter">
        <div class="heading">
            <span>Quick facts</span>
            <h1>fun facts</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur dignissimos quis, blanditiis consequatur quam tenetur cum voluptates consectetur repudiandae cumque rerum, dolorem perspiciatis debitis? Sequi explicabo quam labore voluptatum delectus.</p>
        </div>
        <div class="box-container">
            <div class="item">
                <img src="image/h-icon.png" alt="">
                <h1><span class="count" data-number="300"></span>M+</h1>
                <p>follower</p>
            </div>
                       <div class="item">
                <img src="image/h-icon0.png" alt="">
                <h1><span class="count" data-number="100"></span>+</h1>
                <p>members</p>
            </div>
                       <div class="item">
                <img src="image/h-icon1.png" alt="">
                <h1><span class="count" data-number="690"></span>+</h1>
                <p>follower</p>
            </div>
                       <div class="item">
                <img src="image/h-icon.png" alt="">
                <h1><span class="count" data-number="978"></span>+</h1>
                <p>Subscriber</p>
            </div>
        </div>
    </div>

<div class="box-container">
    <div class="sub-banner">
        <div class="overlay"></div>
        <img src="image/banner_1.jpg" alt="">
    </div>
        <div class="sub-banner">
        <div class="overlay"></div>
        <img src="image/banner_2.jpg" alt="">
    </div>
</div>


<div class="show-movie">
    <div class="heading">
        <span>Movies</span>
        <h1>top movies in theaters</h1>
        <p>at movieBuzz cinema & theater</p>
    </div>

    <div class="box-container">
        <?php
        $select_movies = $conn->prepare("SELECT * FROM `movies` WHERE status= ?");
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
                <button type="submit" name="add_to_wishlist">
                    <img src="image/heart.png" alt=""></button>
                    <a href="<?= $fetch_movies['trailers_url'] ?>" class="bx bx-play"></a>
                    <a href="view_movie.php?pid=<?= $fetch_movies['id'] ?>" class="bx bxs-show"></a>
               </div>
        </div>
        <div class="rate">
            <p><span><img src="image/tomato.png" alt=""></span>88%</p>
            <p><img src="image/cake.png" alt="">98%</p>
        </div>
        <input type="hidden" name="movie_id" value="<?= $fetch_movies['id'] ?>">
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




<div class="about">
    <div class="box-container">
        <div class="detail">
            <div class="heading">
                <span>take look at</span>
                <h1>Out philosophy</h1>
            </div>
            <div class="img-box">
                <div class="box">
                    <img src="image/a-icon3.png" alt="">
                    <h3>honesty & fairness</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est suscipit qui soluta nesciunt vitae cupiditate mollitia modi vel architecto, ipsa esse sit eum! Temporibus fuga in ea repellat odio iure?</p>        
                </div>
                                <div class="box">
                    <img src="image/a-icon2.png" alt="">
                    <h3>clarity & transparency</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est suscipit qui soluta nesciunt vitae cupiditate mollitia modi vel architecto, ipsa esse sit eum! Temporibus fuga in ea repellat odio iure?</p>        
                </div>
                     <div class="box">
                    <img src="image/a-icon3.png" alt="">
                    <h3>Focus on customer</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est suscipit qui soluta nesciunt vitae cupiditate mollitia modi vel architecto, ipsa esse sit eum! Temporibus fuga in ea repellat odio iure?</p>        
                </div>
            </div>
        </div>
    </div>
</div>



<div class="team">
    <div class="heading">
        <span>Meet our most valued</span>
        <h1>Expert team members</h1>
        <p>World is commited to making participation in the event a harasment free experience for everyone, <br>
    regardless of level of experience, gender, gender identity and expression</p>
    </div>
    <div class="box-container">
        <div class="box">
            <img src="image/team.webp" class="img">
            <div class="content">
                <h2>fiona edwards</h2>
                <p>Team manager</p>
            <div class="icons">
        <i class="bx bxl-facebook"></i>
        <i class="bx bxl-instagram-alt"></i>
        <i class="bx bxl-linkedin"></i>
        <i class="bx bxl-twitter"></i>
        <i class="bx bxl-pinterest-alt"></i>
    </div>
            </div>
        </div>

         <div class="box">
            <img src="image/team1.webp" class="img">
            <div class="content">
                <h2>ralph edwards</h2>
                <p>Team manager</p>
            <div class="icons">
        <i class="bx bxl-facebook"></i>
        <i class="bx bxl-instagram-alt"></i>
        <i class="bx bxl-linkedin"></i>
        <i class="bx bxl-twitter"></i>
        <i class="bx bxl-pinterest-alt"></i>
    </div>
            </div>
        </div>

         <div class="box">
            <img src="image/team2.webp" class="img">
            <div class="content">
                <h2>fiona edwards</h2>
                <p>Team manager</p>
            <div class="icons">
        <i class="bx bxl-facebook"></i>
        <i class="bx bxl-instagram-alt"></i>
        <i class="bx bxl-linkedin"></i>
        <i class="bx bxl-twitter"></i>
        <i class="bx bxl-pinterest-alt"></i>
    </div>
            </div>
        </div>

         <div class="box">
            <img src="image/team0.webp" class="img">
            <div class="content">
                <h2>fiona edwards</h2>
                <p>Team manager</p>
            <div class="icons">
        <i class="bx bxl-facebook"></i>
        <i class="bx bxl-instagram-alt"></i>
        <i class="bx bxl-linkedin"></i>
        <i class="bx bxl-twitter"></i>
        <i class="bx bxl-pinterest-alt"></i>
    </div>
            </div>
        </div>
 
      

    </div>
</div>
















    <?php include 'components/user_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    <?php 
        include'js/user_script.js';
        ?>
</script>


<?php include 'components/alert.php'; ?>

</body>
</html>
<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
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
            <h1>about us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>about us</span>
        </div>
    </div>


    <div class="who">
        <bov class="box-container">
            <div class="box">
                <div class="heading">
                    <span>we are MovieBuzz</span>
                    <h1>get to know about us</h1>
                </div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum sapiente incidunt repellat esse eum ipsa saepe tenetur veritatis corporis. Ab totam reiciendis ea maxime beatae incidunt doloremque culpa praesentium neque?
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, voluptatibus quo! Aperiam dolorum, quasi reprehenderit, necessitatibus adipisci eveniet vitae consequatur eius aliquam architecto provident consequuntur, voluptatum est eos aut similique!</p>
                <div class="flex-btn">
                    <a href="fetch_movie.php" class="btn">explore more movies</a>
                    <a href="fetch_movie.php" class="btn">visit our listing</a>
                </div>
            </div>

            <div class="box">
                    <img src="image/about01.png" class="img" alt="">
            </div>
        </bov>
    </div>

    <div class="help">
        <div class="container">
            <div class="heading">
                <span>quality & passion</span>
                <h1>Quality & passion with our services !</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto enim minima tempora nobis accusamus sapiente debitis quisquam unde sed magni. Rerum eos sed officiis, cupiditate qui eligendi perspiciatis quam corrupti.</p>

            </div>
            <div class="box-container">
                <div class="box">
                    <img src="image/icon0.png" alt="">
                    <h1>100% secure payment</h1>
                    <p>feel the summer mood with our latest exclusive cloths collection featuring bright colors and hand-painted ornaments</p>
                </div>
                <div class="box">
                    <img src="image/icon.png" alt="">
                    <h1>bot assistant</h1>
                    <p>feel the summer mood with our latest exclusive cloths collection featuring bright colors and hand-painted ornaments</p>
                </div>
                  <div class="box">
                    <img src="image/icon1.png" alt="">
                    <h1>Help center</h1>
                    <p>feel the summer mood with our latest exclusive cloths collection featuring bright colors and hand-painted ornaments</p>
                </div>
            </div>
        </div>
    </div>



    <div class="counter">
        <div class="heading">
            <span>Quick facts</span>
            <h1>our popularity</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur dignissimos quis, blanditiis consequatur quam tenetur cum voluptates consectetur repudiandae cumque rerum, dolorem perspiciatis debitis? Sequi explicabo quam labore voluptatum delectus.</p>
        </div>
        <div class="box-container">
            <div class="item">
                <img src="image/about-counter01.png" alt="">
                <h1><span class="count" data-number="300"></span>M+</h1>
                <p>Customers</p>
            </div>
                       <div class="item">
                <img src="image/about-counter02.png" alt="">
                <h1><span class="count" data-number="100"></span>+</h1>
                <p>Countries</p>
            </div>
                       <div class="item">
                <img src="image/about-counter03.png" alt="">
                <h1><span class="count" data-number="690"></span>+</h1>
                <p>town & cities</p>
            </div>
                       <div class="item">
                <img src="image/about-counter04.png" alt="">
                <h1><span class="count" data-number="978"></span>+</h1>
                <p>Screens</p>
            </div>
        </div>
    </div>



    <div class="testimonial-container">
        <div class="testimonial">
            <div class="heading">
                <span>clients with</span>
                <h1>reason to smile</h1>
            </div>
            <div class="container">
                <div class="testimonial-item active">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/ourteam0.webp" alt="">
                    <h1>John smith</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo illo alias deleniti nesciunt deserunt dicta incidunt similique culpa sequi, porro corporis rerum exercitationem iusto nam.</p>  
                </div>
                <!--------->
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/ourteam.webp" alt="">
                    <h1>John smith</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo illo alias deleniti nesciunt deserunt dicta incidunt similique culpa sequi, porro corporis rerum exercitationem iusto nam.</p>  
                </div>
                <!--------->
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/ourteam1.webp" alt="">
                    <h1>John smith</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo illo alias deleniti nesciunt deserunt dicta incidunt similique culpa sequi, porro corporis rerum exercitationem iusto nam.</p>  
                </div>
                <!--------->
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/ourteam2.webp" alt="">
                    <h1>Siam smith</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo illo alias deleniti nesciunt deserunt dicta incidunt similique culpa sequi, porro corporis rerum exercitationem iusto nam.</p>  
                </div>
                <!--------->

                <div class="left-arrow" onclick="rightSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                <div class="right-arrow" onclick="leftSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
            </div>
        </div>
    </div>




















    <?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script type="text/javascript">
 let count = document.querySelectorAll('.count');
let arr = Array.from(count);

arr.map(function(item){
    let startNumber = 0;

    function counterUp(){
        startNumber++
        item.innerHTML = startNumber

        if(startNumber == item.dataset.number){
            clearInterval(stop)
        }
    }

    let stop = setInterval(function(){
        counterUp();
    },50)
})

let slide = document.querySelectorAll('.testimonial-item');
let index = 0;

function rightSlide(){
    slide[index].classList.remove('active');
    index = (index+1) % slide.length;
    slide[index].classList.add('active')
}

function leftSlide(){
    slide[index].classList.remove('active');
    index = (index-1+slide.length) % slide.length;
    slide[index].classList.add('active')
}



</script>


<?php include 'components/alert.php'; ?>

</body>
</html>
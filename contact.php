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
            <h1>Contact Us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Contact us</span>
        </div>
    </div>

    <div class="service">
        <div class="heading">
            <h1>Our service</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id atque culpa esse, incidunt consequuntur quos debitis accusantium. Eius architecto quas laboriosam explicabo ad? Ipsam, incidunt! Maxime consequuntur nobis voluptate corrupti?</p>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/s-icon (2).png" alt="">
                <div>
                    <h1>easy canceling</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/s-icon (3).png" alt="">
                <div>
                    <h1>money back guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/s-icon (1).png" alt="">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="contact">
        <div class="heading">
            <h1>get in touch</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id atque culpa esse, incidunt consequuntur quos debitis accusantium. Eius architecto quas laboriosam explicabo ad? Ipsam, incidunt! Maxime consequuntur nobis voluptate corrupti?</p>
        </div>
        <div class="box-container">
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>your name <span>*</span></p>
                        <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
                    </div>
                        <div class="input-field">
                        <p>your email address <span>*</span></p>
                        <input type="email" name="email" required maxlength="100" placeholder="enter your email" class="box">
                    </div>
                    <div class="input-field">
                        <p>subject <span>*</span></p>
                        <input type="text" name="subject" required maxlength="50" placeholder="enter your name" class="box">
                    </div>
                        <div class="input-field">
                        <p>your message <span>*</span></p>
                        <textarea name="message" id="" class="box"></textarea>
                    </div>
                    <button type="submit" name="send_message" class="btn">send message</button>
                </form>
            </div>
            <div class="box">
                <img src="image/contact.jpg" alt="">
            </div>
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
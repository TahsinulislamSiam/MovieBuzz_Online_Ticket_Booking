<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }

    if(isset($_POST['login'])) {
        $id = unique_id();

       
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() > 0) {
            setcookie("user_id", $row["id"], time() + 60*60*24, '/' );
            header('location:home.php');
        } else{
            $warning_msg[] = 'incorrect password or email';
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
            <h1>Login Now</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Register Now</span>
        </div>
    </div>


    <div class="form-container form-area">
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>login now</h3>

            <div class="input-field">
                   <p>your email address <span>*</span></p>
                     <input type="email" name="email" required maxlength="100" placeholder="enter your email" class="box">
            </div>
            
            
                <div class="input-field">
                   <p>your password <span>*</span></p>
                    <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
            </div>
                           
                
            
            <p class="link">do not have an account ? <a href="register.php">register now</a></p>
            <button type="submit" name="login" class="btn">login Now</button>
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
<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else{
        $user_id = '';
    }

    if(isset($_POST['register'])) {
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id() .'.'. $ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/' .$rename;


        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user->execute([$email]);

        if($select_user->rowCount() > 0) {
            $warning_msg[] = 'email already exist';
        } else{
            if($pass != $cpass){
                    $warning_msg[] = 'password not matched';
            } else{
                $insert_user = $conn->prepare("INSERT INTO `users`(id, name, number, email, password, image) VALUES(?,?,?,?,?,?)");
                $insert_user->execute([$id, $name, $number, $email, $cpass, $rename]);



                move_uploaded_file($image_tmp_name, $image_folder);


                if($insert_user){
                    $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email =  ? AND password = ? LIMIT 1");
                    $verify_user->execute([$email,$pass]);
                    $row = $verify_user->fetch(PDO::FETCH_ASSOC);


                    if($verify_user->rowCount() > 0) {
                        setcookie('user_id', $row['id'], time() + 60*60*24*30,'/');
                        header('location:home.php');
                } else{
                    $warning_msg[] = 'something went wrong';
                }
            }
        }
            
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
            <h1>Register Now</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga pariatur deserunt vero in <br>inventore quibusdam repellat aperiam, omnis exercitationem tempora iure autem quidem nihil odio, minus molestias voluptas itaque porro?</p>
            <span><a href="home.php">home</a><i class="bx bxs-right-arrow-alt"></i>Register Now</span>
        </div>
    </div>


    <div class="form-container form-area">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>create an account</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>your name <span>*</span></p>
                        <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
                    </div>
                        <div class="input-field">
                        <p>your email address <span>*</span></p>
                        <input type="email" name="email" required maxlength="100" placeholder="enter your email" class="box">
                    </div>
                        <div class="input-field">
                        <p>your personal number <span>*</span></p>
                        <input type="number" name="number" required maxlength="50" placeholder="+88........" class="box">
                    </div>
                </div>
                <div class="col">
                         <div class="input-field">
                        <p>your password <span>*</span></p>
                        <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
                    </div>
                     <div class="input-field">
                        <p>Confirm password <span>*</span></p>
                        <input type="password" name="cpass" required maxlength="20" placeholder="enter that password" class="box">
                    </div>
                     <div class="input-field">
                        <p>your profile <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                    </div>
                    
                </div>
            </div>
            <p class="link">already have an account ? <a href="login.php">login now</a></p>
            <button type="submit" name="register" class="btn">Register Now</button>
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
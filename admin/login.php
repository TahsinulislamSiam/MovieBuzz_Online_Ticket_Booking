<?php
include '../components/connect.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ?");
    $select_admin->execute([$email, $pass]);
    $row = $select_admin->fetch(PDO::FETCH_ASSOC);

    if ($select_admin->rowCount() > 0) {
        setcookie('admin_id', $row['id'], time() + 60*60*24, '/');
        header('location:dashboard.php');
    } else {
        $warning_msg[] = 'incorrect password';
    }
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



<?php include '../components/alert.php'; ?>

</body>
</html>
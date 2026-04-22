<?php
include '../components/connect.php';

if (isset($_POST['register'])) {

    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
    $select_admin->execute(['email']);

    if($select_admin->rowCount()>0) {
        $warning_msg[] = 'email already exist';
    } else{
        if($pass !=$cpass){
            $warning_msg[]='password not matched';
        } else{
            $insert_admin = $conn->prepare("INSERT INTO `admin`(id, name, email, password, image) VALUES (?,?,?,?,?)");
            $insert_admin->execute([$id,$name,$email,$cpass,$rename]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if($insert_admin) {
                $verify_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password=? LIMIT 1");
                $verify_admin->execute([$email,$pass]);
                $row = $verify_admin->fetch(PDO::FETCH_ASSOC);


                if($verify_admin->rowCount()>0) {
                    setcookie('admin_id', $row['id'], time()+60 * 60 * 24*30, '/');
                    header('location:login.php');
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
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <title>A movie ticket booking website</title>
</head>
<body>
    

    <div class="form-container form-area">
    <form action="" method="post" enctype="multipart/form-data" class="register">
        <h3>create an account</h3>

        <div class="flex">
            <div class="col">
                <div class="input-field">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" required maxlength="50" placeholder="your name" class="box">
                </div>
                <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" required maxlength="50" placeholder="your email" class="box">
                </div>
            </div>
            <div class="col">
                <div class="input-field">
                    <p>your password <span>*</span></p>
                    <input type="password" name="pass" required maxlength="50" placeholder="your password" class="box">
                </div>
                <div class="input-field">
                    <p>confirm password <span>*</span></p>
                    <input type="password" name="cpass" required maxlength="50" placeholder="confirm password" class="box">
                </div>
            </div>
        </div>
        <div class="input-field">
                    <p>your profile <span>*</span></p>
                    <input type="file" name="image" accept="image/*" class="box">
                </div>
                <p class="link">already have an account ? <a href="login.php">Login Now</a></p>
                <button type="submit" name="register" class="btn">register now</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    <?php 
        include'../js/user_script.js';
        ?>
</script>

<?php include '../components/alert.php'; ?>

</body>
</html>
<!---------php handling----------------->
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    include '../dbconnector.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    //$exists = false;
    //check whether this username exists
    $existsql = "SELECT * FROM `username` WHERE Username = '$username'"; 
    $result = mysqli_query($conn, $existsql);
    $numexistrows =mysqli_num_rows($result);
    if($numexistrows > 0){
        echo 'user already exists';
    }
    else{
        if($password == $cpassword ){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql ="INSERT INTO `username` (`Username`, `Password`) VALUES ('$username', '$hash')";
            $result = mysqli_query($conn, $sql);    
        }
        else{
            echo 'passwords do not match';
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header id="header">
        <h2 class="head1">GURUDWARA GORAKHPUR ALONIA</h2>
    </header>
    <section class="first-section">
        <h2>sign up</h2>
        <form action="signup.php" class="form" method="POST">
            <div class="form-1">
                <h3>User Name</h3>
                <input type="text" name="username" id="" placeholder="Enter Your User Name">
            </div>
            <div class="form-1">
                <h3>Password</h3>
                <input type="password" name="password" id="" placeholder="Enter your password">
            </div>
            <div class="form-1">
                <h3>C-Password</h3>
                <input type="password" name="cpassword" id="" placeholder="Enter your c-password">
            </div>
            <div class="form-1">
                <input type="submit" value="sign up">
            </div>
        </form>
    </section>

</body>
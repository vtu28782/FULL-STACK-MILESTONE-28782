<?php
session_start();
include "db.php";

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res->num_rows == 0){
        echo "Email not found";
    } else {
        $user = $res->fetch_assoc();

        if(password_verify($password,$user['password'])){
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Wrong password";
        }
    }
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="box">
<h2>Login</h2>

<form method="post">
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button>
</form>

<a href="register.php">Create Account</a>
</div>
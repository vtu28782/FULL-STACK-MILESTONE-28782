<?php
include "db.php";

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
    header("Location: index.php");
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="box">
<h2>Register</h2>

<form method="post">
<input name="name" placeholder="Name" required>
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button>Register</button>
</form>

<a href="index.php">Login</a>
</div>
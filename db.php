<?php
$conn = new mysqli("localhost","root","","trackwise");

if($conn->connect_error){
    die("DB Failed: " . $conn->connect_error);
}
?>
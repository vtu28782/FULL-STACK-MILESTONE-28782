<?php
session_start();
include "db.php";

$uid = $_SESSION['user_id'];

if(isset($_POST['amount'])){
    $cat = $_POST['category'];
    $amt = $_POST['amount'];
    $desc = $_POST['desc'];
    $date = date("Y-m-d");

    $conn->query("INSERT INTO expenses(user_id,category_id,amount,description,expense_date)
    VALUES($uid,$cat,$amt,'$desc','$date')");
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="box">

<form method="post">

<select name="category">
<?php
$res = $conn->query("SELECT * FROM categories");
while($row=$res->fetch_assoc()){
    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
}
?>
</select>

<input name="amount" type="number" placeholder="Amount" required>
<input name="desc" placeholder="Description">

<button>Add Expense</button>

</form>

<a href="dashboard.php">Back</a>

</div>
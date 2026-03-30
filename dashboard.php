<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['user_id'];

/* GET USER */
$user = $conn->query("SELECT budget FROM users WHERE user_id=$uid")->fetch_assoc();
$budget = $user['budget'] ?? 10000;

/* UPDATE BUDGET */
if(isset($_POST['budget'])){
    $newBudget = $_POST['budget'];
    $conn->query("UPDATE users SET budget=$newBudget WHERE user_id=$uid");
    header("Location: dashboard.php");
    exit();
}

/* TOTAL EXPENSE */
$total = $conn->query("SELECT SUM(amount) t FROM expenses WHERE user_id=$uid")->fetch_assoc()['t'] ?? 0;

$remaining = $budget - $total;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="css/style.css">

<style>
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}
th {
    background: #1e3c72;
    color: white;
}
</style>

</head>

<body>

<div class="container">

<!-- BUDGET SECTION -->
<div class="card">

<?php if($budget == 10000): ?>

<h3>Set Your Budget</h3>
<form method="post">
<input type="number" name="budget" placeholder="Enter Budget" required>
<button>Set Budget</button>
</form>

<?php else: ?>

<h3>Budget: ₹<?php echo $budget; ?></h3>

<form method="post">
<input type="number" name="budget" placeholder="Edit Budget" required>
<button>Update Budget</button>
</form>

<?php endif; ?>

</div>

<!-- SUMMARY -->
<div class="card">
<h3>Total Expense: ₹<?php echo $total; ?></h3>
<h3>Remaining: ₹<?php echo $remaining; ?></h3>
</div>

<!-- ACTIONS -->
<div class="card">
<a href="add_expense.php">➕ Add Expense</a> |
<a href="logout.php">🚪 Logout</a>
</div>

<!-- EXPENSE LIST -->
<div class="card">
<h3>Your Expenses</h3>

<table>
<tr>
<th>Date</th>
<th>Category</th>
<th>Amount</th>
<th>Description</th>
</tr>

<?php
$res = $conn->query("
SELECT e.*, c.category_name 
FROM expenses e
JOIN categories c ON e.category_id=c.category_id
WHERE e.user_id=$uid
ORDER BY e.expense_date DESC
");

while($row=$res->fetch_assoc()){
    echo "<tr>
    <td>{$row['expense_date']}</td>
    <td>{$row['category_name']}</td>
    <td>₹{$row['amount']}</td>
    <td>{$row['description']}</td>
    </tr>";
}
?>

</table>
</div>

</div>

</body>
</html>
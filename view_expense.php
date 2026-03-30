<?php
include 'db.php';

$sql = "SELECT e.id, e.amount, e.description, e.expense_date, 
               c.category_name
        FROM expenses e
        LEFT JOIN categories c ON e.category_id = c.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Expenses</title>
</head>
<body>

<h2>All Expenses</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Amount</th>
    <th>Category</th>
    <th>Description</th>
    <th>Date</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['category_name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['expense_date']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No expenses found</td></tr>";
}
?>

</table>

<br>
<a href="index.html">Add Expense</a>

</body>
</html>
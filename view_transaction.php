<?php
// view_transactions.php
$conn = new mysqli('localhost', 'root', '', 'your_database_name');

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM transactions WHERE buyer_name LIKE '%$search%' OR product_name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
</head>
<body>

<h2>Transactions List</h2>
<form method="GET">
    <input type="text" name="search" placeholder="Search transactions..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<table border="1" cellpadding="10">
    <tr>
        <th>Transaction ID</th>
        <th>Buyer Name</th>
        <th>Product Name</th>
        <th>Date</th>
        <th>Quantity</th>
        <th>Total Amount</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['transaction_id']; ?></td>
        <td><?php echo $row['buyer_name']; ?></td>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['transaction_date']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td>₹<?php echo $row['total_amount']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>

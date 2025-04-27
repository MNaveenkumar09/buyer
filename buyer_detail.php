<?php
// buyer_detail.php
$conn = new mysqli('localhost', 'root', '', 'your_database_name');

$id = $_GET['id'];
$buyer = $conn->query("SELECT * FROM buyers WHERE id='$id'")->fetch_assoc();
$transactions = $conn->query("SELECT * FROM transactions WHERE buyer_id='$id'");
$total_spent = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyer Profile</title>
</head>
<body>

<h2>Buyer Profile: <?php echo $buyer['name']; ?></h2>
<p><strong>Email:</strong> <?php echo $buyer['email']; ?></p>
<p><strong>Phone:</strong> <?php echo $buyer['phone']; ?></p>
<p><strong>Address:</strong> <?php echo $buyer['address']; ?></p>

<h3>Purchase History</h3>
<table border="1" cellpadding="10">
<tr>
    <th>Product</th>
    <th>Amount</th>
    <th>Date</th>
</tr>
<?php while($txn = $transactions->fetch_assoc()) { $total_spent += $txn['total_amount']; ?>
<tr>
    <td><?php echo $txn['product_name']; ?></td>
    <td>₹<?php echo $txn['total_amount']; ?></td>
    <td><?php echo $txn['transaction_date']; ?></td>
</tr>
<?php } ?>
</table>

<h3>Total Spent: ₹<?php echo $total_spent; ?></h3>

</body>
</html>

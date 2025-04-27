<?php
// view_products.php
$conn = new mysqli('localhost', 'root', '', 'your_database_name');

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR category LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        .stock-high { background-color: #d4edda; }
        .stock-low { background-color: #fff3cd; }
        .stock-out { background-color: #f8d7da; }
    </style>
</head>
<body>

<h2>Products List</h2>
<form method="GET">
    <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<table border="1" cellpadding="10">
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock Availability</th>
        <th>Description</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { 
        $stock_class = $row['stock'] > 10 ? 'stock-high' : ($row['stock'] > 0 ? 'stock-low' : 'stock-out');
    ?>
    <tr class="<?php echo $stock_class; ?>">
        <td><a href="product_detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
        <td><?php echo $row['category']; ?></td>
        <td>₹<?php echo $row['price']; ?></td>
        <td><?php echo $row['stock']; ?></td>
        <td><?php echo $row['description']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>

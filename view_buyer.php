<?php
// view_buyers.php
$conn = new mysqli('localhost', 'root', '', 'your_database_name');

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM buyers WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyers</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Buyers List</h2>
<form method="GET">
    <input type="text" name="search" placeholder="Search buyers..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Address</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><a href="buyer_detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['address']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>

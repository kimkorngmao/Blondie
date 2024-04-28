<?php
include('connection.php');

$stmt=$conn->prepare("SELECT * FROM products where product_category='bag' LIMIT 4");

$stmt->execute();

$bag = $stmt->get_result();


?>
<?php

require 'con.php';
if (isset($_POST['productName'])) {
    $productName = $_POST['productName'];

    $query = "SELECT rate FROM products WHERE product_name = '$productName'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rate = $row['rate'];
        echo $rate;
    }
}
mysqli_close($con);
?>
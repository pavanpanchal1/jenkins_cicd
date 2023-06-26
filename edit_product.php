<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'con.php';
if (isset($_GET["action"])) {
    if ($_GET["action"] == 'edit') {
        $product_id = $_GET["product_id"];
        $query = "SELECT * FROM products where product_id=$product_id";
        $result = mysqli_query($con, $query);
        echo $product_id;
    }
}
?>
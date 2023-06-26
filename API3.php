<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'con.php';
$responce = array();
if ('$con') {
    $query = "SELECT * FROM products";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Content-type:JSON");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $responce[$i]['product_id'] = $row['product_id'];
            $responce[$i]['product_name'] = $row['product_name'];
            $responce[$i]['product_type'] = $row['product_type'];
            $responce[$i]['rate'] = $row['rate'];
            $responce[$i]['product_item'] = $row['product_item'];
            $i++;
        }
    }
}
echo json_encode($responce, JSON_PRETTY_PRINT);

?>
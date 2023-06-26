<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'con.php';
$responce = array();

if ($con) {
    $query = "SELECT * FROM purchase";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Content-type:JSON");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $responce[$i]['purchase_id'] = $row['purchase_id'];
            $responce[$i]['customer_name'] = $row['customer_name'];
            $responce[$i]['product_name'] = $row['product_name'];
            $responce[$i]['quantity'] = $row['quantity'];
            $responce[$i]['purchase_date'] = $row['purchase_date'];
            $i++;
        }
        echo json_encode($responce, JSON_PRETTY_PRINT);
    }
} else {
    echo "Connnection failed";
}
?>
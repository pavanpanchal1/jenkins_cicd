<?php
// Connect to the MySQL database
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'con.php';

$query = "SELECT c.customer_name, p.product_name, pu.quantity, (p.rate * pu.quantity) AS total_price
          FROM purchases pu
          INNER JOIN Customers c ON pu.customer_id = c.customer_id
          INNER JOIN products p ON pu.product_id = p.product_id";
$result = $con->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'Customer Name' => $row['customer_name'],
            'Product Name' => $row['product_name'],
            'Quantity' => $row['quantity'],
            'Total Price' => $row['total_price']
        ];
    }
}

$con->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Customer and Product Data</title>
    <link href="https://cdn.jsdelivr.net/npm/gridjs@1.2.0/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/gridjs@1.2.0/dist/gridjs.umd.js"></script>
</head>

<body>
    <div id="grid-container"></div>

    <script>
        // Convert PHP array to JSON
        var jsondata = <?php echo json_encode($data); ?>;

        new gridjs.Grid({
            columns: [
                "Customer Name",
                "Product Name",
                "Quantity",
                "Total Price"
            ],
            data: jsondata,
            pagination: true,
            search: true,
            sort: true,
            language: {
                search: {
                    placeholder: "Search..."
                },
                pagination: {
                    previous: "⬅️",
                    next: "➡️",
                    showing: "Showing",
                    results: () => "Records"
                }
            }
        }).render(document.getElementById("grid-container"));
    </script>
</body>

</html>
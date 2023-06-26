<?php
// Connect to the MySQL database
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'con.php';
$query = "SELECT * FROM products";
$result = $con->query($query);
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array_values($row);
    }
}
$con->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Product Data</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.production.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" />
    <style>
        .del {
            width: 100px;
            height: 30px;
            background-color: rgba(189, 100, 100, 0.8);
            padding: 10px;
            text-decoration: none;
            color: white;
            border-radius: 10px;
        }
    </style>

</head>

<body>
    <div id="wrapper"></div>

    <script>
        function enableEdit(product_id) {
            const product = jsonData.find((item) => item[0] === product_id);

            var id = document.getElementById("product_id").value = product[0];
            var name = document.getElementById("product_name").value = product[1];
            document.getElementById("product_type").value = product[2];
            document.getElementById("rate").value = product[3];
            document.getElementById("product_item").value = product[4];
        }

        var jsonData = <?php echo json_encode($data); ?>;

        new gridjs.Grid({
            columns: [
                "ID",
                {
                    name: 'Product Name',
                    attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
                },
                {
                    name: 'Product Type',
                    attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
                },
                {
                    name: 'Rate',
                    attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
                },
                {
                    name: 'Product Item',
                    attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
                },
                {
                    name: 'Delete',
                    formatter: (_, row) => {
                        const productId = row.cells[0].data;
                        return gridjs.html(`<a href='delete_products.php?action=del&product_id=${productId}' class="del">Delete</a>`);
                    }
                },
            ],
            data: jsonData,
            pagination: { limit: 15 },
            search: true,
            sort: true,
            language: {
                "search": { "placeholder": "Search..." },
                "pagination": { "previous": "⬅️", "next": "➡️", "results": () => "Records" }
            }
        }).render(document.getElementById("wrapper"));
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders history</title>
</head>
<body>
<h1>Orders History</h1>
<a href="home.php">Home</a>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Item</th>
            <th>Address</th>
            <th>Delivery Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            // READ OPERATION

            $filePath = '../data/orders.txt';
            $file = fopen($filePath, 'r');

            if ($file) {
                $lineNumber = 1; // Initialize line number

                while (!feof($file)) {
                    $data = fgets($file);
                    $order = explode(':', $data);

                    // Check if keys exist before accessing them
                    $name = isset($order[0]) ? $order[0] : '';
                    $address = isset($order[1]) ? $order[1] : '';
                    $deliveryBy = isset($order[2]) ? $order[2] : '';
                    $items = array_slice($order, 3); // Get all elements from index 2 to the end
                    if($deliveryBy !== 'delivered'){
                        echo "<tr>
                                <td>{$name}</td>
                                <td>";

                        foreach ($items as $item) {
                            echo "{$item}<br>";
                        }

                        echo "  </td>
                                <td>{$address}</td>
                                <td>{$deliveryBy}</td>
                            </tr>";

                        $lineNumber++; // Increment line number
                    }
                }

                fclose($file); // Close the file handle
            } else {
                echo "Error opening the file.";
            }
        ?>
    </tbody>
</table>
</body>
</html>

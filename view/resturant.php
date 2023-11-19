<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management</title>
</head>
<body>
    <h1>Restaurant Management</h1>
    <a href="home.php">Home</a>
    <br>
    <br>
    <form method='post' action='addRestaurant.php'>
        <label for='newName'>Name:</label>
        <input type='text' name='newName' required>
        <label for='newAddress'>Address:</label>
        <input type='text' name='newAddress' required>
        <label for='newItem'>Item:</label>
        <input type='text' name='newItem' required>
        <input type='submit' value='Add Restaurant'>
    </form>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Items</th>
                <th>Add Item</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // READ OPERATION

                $filePath = '../data/resturant.txt';
                $file = fopen($filePath, 'r');

                if ($file) {
                    $lineNumber = 1; // Initialize line number

                    while (!feof($file)) {
                        $data = fgets($file);
                        $resturant = explode(':', $data);

                        // Check if keys exist before accessing them
                        $name = isset($resturant[0]) ? $resturant[0] : '';
                        $address = isset($resturant[1]) ? $resturant[1] : '';
                        $items = array_slice($resturant, 2); // Get all elements from index 2 to the end

                        // Check if restaurant data is not empty before echoing the table row
                        if (!empty($name) || !empty($address) || !empty($items)) {
                            echo "<tr>
                                    <td>{$name}</td>
                                    <td>{$address}</td>
                                    <td>";

                            foreach ($items as $item) {
                                echo "{$item}<br>";
                            }

                            echo "</td>
                                    <td>
                                        <form method='post' action='updateResturant.php'>
                                            <input type='hidden' name='lineNumber' value='{$lineNumber}'>
                                            <input type='text' name='resturantItem'>
                                            <input type='submit' value='Add Item'>
                                        </form>
                                    </td>
                                    <td>
                                        <form method='post' action='deleteRestaurant.php'>
                                            <input type='hidden' name='lineNumber' value='{$lineNumber}'>
                                            <input type='submit' value='Delete'>
                                        </form>
                                    </td>
                                </tr>";
                        }

                        $lineNumber++; // Increment line number
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newName'], $_POST['newAddress'], $_POST['newItem'])) {
        $newName = $_POST['newName'];
        $newAddress = $_POST['newAddress'];
        $newItem = $_POST['newItem'];

        $filePath = '../data/resturant.txt';

        // Append the new restaurant to the file with a double line break
        file_put_contents($filePath, "\n{$newName}:{$newAddress}:{$newItem}\n", FILE_APPEND | LOCK_EX);

        // Redirect back to the resturant.php page
        header('Location: resturant.php');
        exit();
    } else {
        echo "Invalid request. Please provide all required information.";
    }
} else {
    echo "Invalid request method.";
}
?>

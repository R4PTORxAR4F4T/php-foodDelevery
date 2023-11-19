<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lineNumber'], $_POST['resturantItem'])) {
        $lineNumber = $_POST['lineNumber'];
        $resturantItem = $_POST['resturantItem'];

        $filePath = '../data/resturant.txt';
        $lines = file($filePath, FILE_IGNORE_NEW_LINES);

        if (isset($lines[$lineNumber - 1])) {
            // Append the new item to the existing line
            $lines[$lineNumber - 1] .= ":{$resturantItem}";

            // Save the updated content back to the file
            file_put_contents($filePath, implode(PHP_EOL, $lines));

            // Redirect back to the resturant.php page
            header('Location: resturant.php');
            exit();
        } else {
            echo "Invalid line number.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>

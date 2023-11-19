<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lineNumber'])) {
        $lineNumber = (int)$_POST['lineNumber'];

        $filePath = '../data/resturant.txt';
        $lines = file($filePath, FILE_IGNORE_NEW_LINES);

        // Check if the line number is valid
        if ($lineNumber > 0 && $lineNumber <= count($lines)) {
            // Remove the line from the array
            unset($lines[$lineNumber - 1]);

            // Save the updated content back to the file
            file_put_contents($filePath, implode(PHP_EOL, $lines));

            // Redirect back to the resturant.php page
            header('Location: resturant.php');
            exit();
        } else {
            echo "Invalid line number.";
        }
    } else {
        echo "Invalid request. Please provide all required information.";
    }
} else {
    echo "Invalid request method.";
}
?>

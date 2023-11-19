<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Here you can implement the logic to delete the user from your data file or database.
    // For simplicity, let's assume you are deleting the user from a text file.
    $filePath = '../data/userAccInfo.txt';
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    
    foreach ($lines as $key => $line) {
        $userInfo = explode(':', $line);
        if ($userInfo[0] == $username) {
            // Remove the line from the array
            unset($lines[$key]);
            break;
        }
    }

    // Save the updated content back to the file
    file_put_contents($filePath, implode(PHP_EOL, $lines));
    
    // Check if there is a referer in the HTTP header
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    // Redirect back to the appropriate page
    if (strpos($referer, 'employee.php') !== false) {
        header('Location: employee.php');
    } else {
        // Default redirect to UserManage.php
        header('Location: UserManage.php');
    }
    exit();
} else {
    echo "Invalid request.";
}
?>

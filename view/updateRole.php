<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    // Here you can implement the logic to update the user's role in your data file or database.
    // For simplicity, let's assume you are updating the role in a text file.
    $filePath = '../data/userAccInfo.txt';
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    
    foreach ($lines as &$line) {
        $userInfo = explode(':', $line);
        if ($userInfo[0] == $username) {
            // Update the role (assuming role is stored in the 4th column)
            $userInfo[4] = 'employee';
            $line = implode(':', $userInfo);
            break;
        }
    }

    // Save the updated content back to the file
    file_put_contents($filePath, implode(PHP_EOL, $lines));
    
    echo "Role updated successfully!";
    header('Location: UserManage.php');

} else {
    echo "Invalid request.";
}
?>

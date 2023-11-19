<?php

    // $username = $_POST['username']; 
    // $email = $_POST['createmail'];
    // $password = $_POST['creatpassword'];
    // $confirm_password = $_POST['confirm_password'];

$filename = "../data/userAccInfo.txt";

// Check if the file exists and is readable
if (file_exists($filename) && is_readable($filename)) {
    $file = file($filename);

    if (isset($_POST['submit'])) {
        $creatname = $_POST['creatname'];
        $createmail = $_POST['createmail'];
        $creatpassword = $_POST['creatpassword'];
        $confirm_password = $_POST['confirm_password'];
        
        // Check if the username and email already exist in the file
        foreach ($file as $line) {
            $data = explode(':', $line);
            if ($data[0] == $creatname || $data[1] == $createmail) {
                echo "Username or email already exists.";
?>
                <br>
                <a href="creatAcc.php">Back</a>
<?php
                exit;
            }
        }

        $new_account = $creatname . ":" . $createmail . ":" . $creatpassword . ":" . $confirm_password . ":" . "user" . "\n";
        
        $file = fopen($filename, 'a');
        fwrite($file, $new_account);

        echo "Account created successfully!";
?>
        <br>
        <a href="userLogin.php">SignIn</a>
<?php
    }
} 
else {
    echo "Error: Cannot read the accounts file.";
}


?>

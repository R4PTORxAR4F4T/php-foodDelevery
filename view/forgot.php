<h1>Forgot password</h1>

<form action="" method="post">
    <label for="checkname">User name:</label>
    <input type="text" id="" name="checkname" required><br><br>

    <label for="checkemail">Email:</label>
    <input type="email" id="" name="checkemail" required><br><br>

    <label for="newpassword">Password:</label>
    <input type="password" id="" name="newpassword" required><br><br>

    <label for="confirmNewPassword">Confirm Password:</label>
    <input type="password" id="" name="confirmNewPassword" required><br><br>

    <input type="submit" name="submit" value="submit"> <br>
</form>

<br>
<a href="userLogin.php">SignIn</a>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user inputs
    $checkname = $_POST['checkname'];
    $checkemail = $_POST['checkemail'];
    $newpassword = $_POST['newpassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    $file = fopen('../data/userAccInfo.txt', 'r');
    $userFound = false;

    while (!feof($file)) {
        $line = fgets($file);
        $parts = explode(':', $line);

        if (trim($parts[0]) == $checkname && trim($parts[1]) == $checkemail) {
            $userFound = true;
            $role = trim($parts[4]);

            if ($newpassword == $confirmNewPassword) {
                $data = $checkname . ':' . $checkemail . ':' . $newpassword . ':' . $confirmNewPassword . ':' . $role . "\n";
                $contents = file_get_contents('../data/userAccInfo.txt');
                $contents = str_replace($line, $data, $contents);
                file_put_contents('../data/userAccInfo.txt', $contents);
                echo 'Password updated successfully.';
            } else {
                echo "<script>alert('Passwords didn\'t match.');</script>";
            }
            break;
        }
    }

    fclose($file);

    // Display an alert if the user is not found
    if (!$userFound) {
        echo "<script>alert('Username and email not found.');</script>";
    }
}
?>

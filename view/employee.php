<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Manage</title>
</head>
<body>
<h1>Employee Manage</h1>
<a href="home.php">Home</a>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            // READ OPERATION

            $userInfofile = '../data/userAccInfo.txt';
            
            $file1 = fopen($userInfofile, 'r');
            
            if ($file1) {
                while (!feof($file1)) {
                    $data = fgets($file1);
                    $user = explode(':', $data);

                    // Check if keys exist before accessing them
                    $username = isset($user[0]) ? $user[0] : '';
                    $email = isset($user[1]) ? $user[1] : '';
                    $password = isset($user[2]) ? $user[2] : '';
                    $role = isset($user[4]) ? $user[4] : '';

                    // Only display users with the role "user"
                    if (trim($role) === 'employee') {
                        echo "<tr>
                                <td>{$username}</td>
                                <td>{$email}</td>
                                <td>{$password}</td>
                                <td>{$role}</td>
                                <td>
                                    <a href='deleteUser.php?username={$username}'>Delete User</a>
                                </td>
                              </tr>";
                    }
                }

                fclose($file1); // Close the file handles
            } else {
                echo "Error opening the user file.";
            }
        ?>
    </tbody>
</table>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Information</title>
</head>
<body>
<h1>User Account Information</h1>
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
            <th>Total Order</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            // READ OPERATION

            $userInfofile = '../data/userAccInfo.txt';
            $ordersfile = '../data/orders.txt';
            $file1 = fopen($userInfofile, 'r');
            $file2 = fopen($ordersfile, 'r');

            if ($file1) {
                while (!feof($file1)) {
                    $data = fgets($file1);
                    $user = explode(':', $data);

                    // Check if keys exist before accessing them
                    $username = isset($user[0]) ? $user[0] : '';
                    $email = isset($user[1]) ? $user[1] : '';
                    $password = isset($user[2]) ? $user[2] : '';
                    $role = isset($user[4]) ? $user[4] : '';

                    // Initialize total order for the user
                    $totalOrder = 0;

                    // Read the orders.txt file from the beginning
                    fseek($file2, 0);

                    if ($file2) {
                        while (!feof($file2)) {
                            $data2 = fgets($file2);
                            $order = explode(':', $data2);
                            if (trim($order[0]) === trim($username)) {
                                $totalOrder++;
                            }
                        }
                    } else {
                        echo "Error opening the order file.";
                    }

                    // Only display users with the role "user"
                    if (trim($role) === 'user') {
                        echo "<tr>
                                <td>{$username}</td>
                                <td>{$email}</td>
                                <td>{$password}</td>
                                <td>{$role}</td>
                                <td>{$totalOrder}</td>
                                <td>
                                    <a href='updateRole.php?username={$username}'>Update Role</a>
                                    <a href='deleteUser.php?username={$username}'>Delete User</a>
                                </td>
                              </tr>";
                    }
                }

                fclose($file1); // Close the file handles
                fclose($file2);
            } else {
                echo "Error opening the user file.";
            }
        ?>
    </tbody>
</table>

</body>
</html>

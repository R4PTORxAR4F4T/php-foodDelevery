<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
</head>
<body>
<h1>User Account Information</h1>
<a href="home.php">Home</a>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th>star</th>
            <th>feedback</th>
            <th>componsition</th>
            <th>input field</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            // READ OPERATION

            $filePath = '../data/report.txt';
            $file = fopen($filePath, 'r');

            if ($file) {
                $lineNumber = 1; // Initialize line number

                while (!feof($file)) {
                    $data = fgets($file);
                    $user = explode(':', $data);

                    // Check if keys exist before accessing them
                    $star = isset($user[0]) ? $user[0] : '';
                    $feedback = isset($user[1]) ? $user[1] : '';
                    $compositions = array_slice($user, 2); // Get all elements from index 2 to the end

                    echo "<tr>
                            <td>{$star}</td>
                            <td>{$feedback}</td>
                            <td>";

                    foreach ($compositions as $composition) {
                        echo "{$composition}<br>";
                    }

                    echo "</td>
                            <td>
                                <form method='post' action='updateFeedback.php'>
                                    <input type='hidden' name='lineNumber' value='{$lineNumber}'>
                                    <input type='text' name='newFeedback'>
                                    <input type='submit' value='Update'>
                                </form>
                            </td>
                        </tr>";

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

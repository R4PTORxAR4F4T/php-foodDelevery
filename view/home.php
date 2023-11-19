<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        // Open the file for reading
        $file = fopen('../data/userProfile.txt', 'r');

        // Check if the file is successfully opened
        if ($file) {
            // Read the contents of the file
            $data = fread($file, filesize('../data/userProfile.txt'));    
            $part = explode(':', $data);

            session_start();
            if(isset($_COOKIE['flag'])){
    ?>

    <div class="home-title">
    <h1>Welcome to our website  <?=$_SESSION['username']?></h1>
    </div>

    <div class="feature-cards">
        <?php
            if(trim($part[4]) === "admin"){
                echo "
                    <a class='card-c1' href='UserManage.php'>User Management</a><br>
                    <a class='card-c2' href='resturant.php'>Restaurant Management</a><br>
                    <a class='card-c3' href='report.php'>Report Handling</a><br>
                    <a class='card-c4' href='orders.php'>Order History</a><br>
                    <a class='card-c5' href='delivered.php'>Delivery History</a><br>
                    <a class='card-c5' href='employee.php'>Employee Management</a><br>
                ";
            }
            else if(trim($part[4]) === "employee"){
                echo "
                    You are an employee
                ";
            }
            else if(trim($part[4]) === "user"){
                echo "
                    You are an user
                ";
            }
            else{
                echo "
                    unauthorized. Access Denied
                ";
            }
        ?>
    </div>
    <br>
    <br>
    <div class="logout">
    <a href="logout.php">Log out</a>
    </div>

    <?php
            } else {
                echo "Invalid request, please login first...";
    ?>

    <br>
    <a href="userLogin.php">Try again</a>

    <?php
            }

            // Close the file handle
            fclose($file);
        } else {
            echo "Error opening the file.";
        }
    ?>
</body>
</html>

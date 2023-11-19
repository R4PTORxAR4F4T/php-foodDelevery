<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lineNumber = $_POST['lineNumber'];
    $newFeedback = $_POST['newFeedback'];

    $filePath = '../data/report.txt';
    $file = fopen($filePath, 'r+'); // Open the file for reading and writing

    if ($file) {
        $updatedLines = [];
        $currentLineNumber = 1;

        while (!feof($file)) {
            $data = fgets($file);

            // If the current line number matches the one to be updated, replace the feedback
            if ($currentLineNumber == $lineNumber) {
                $data = rtrim($data) . ":{$newFeedback}\n"; // rtrim to remove trailing newline
            }

            $updatedLines[] = $data;
            $currentLineNumber++;
        }

        // Move the file pointer to the beginning of the file
        fseek($file, 0);

        // Write the updated lines back to the file
        fwrite($file, implode("", $updatedLines));

        fclose($file); // Close the file handle
        header("Location: report.php"); // Redirect back to the report.php page
        exit();
    } else {
        echo "Error opening the file.";
    }
} else {
    echo "Invalid request method.";
}
?>

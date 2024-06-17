<?php
require("./config.php");

//define all valuable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $position = htmlspecialchars($_POST["position"]);
    $message = htmlspecialchars($_POST["message"]);

//for sending to my emailAdd
    $to = "diegoshoya2017@gmail.com";
    $subject = "Hiring Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for applying our company, $name! Please wait for responses!<br>";
    } else {
        echo "Sorry $name, there was an error applying. Please try again later. <br>";
    }

// connect Database
    $conn = new mysqli(DB_SERVER_NAME, DB_USER, DB_PASSWORD, DB_NAME);  //create new database
    if ($conn->connect_error) { //if connection is field
        die("Connection failed");
    }

// upload File to directory
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// check if it upload File to directory
if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars(basename($_FILES["resume"]["name"])) . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    $uploadOk = 0;
}

//The problem is if there are ' in msg return error


// store to DB
if ($uploadOk == 1) {
    $sql = "INSERT INTO user_hiring_tb (name, email, phone, position, message, resume) VALUES ('$name', '$email', '$phone', '$position', '$message', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
        echo "View your uploaded resume: <a href='showPDF.php?file=" . urlencode(basename($target_file)) . "'>View PDF</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// close DB
$conn->close();
}
?>

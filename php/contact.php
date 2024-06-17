<?php
require("./config.php");


//define all valuable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $reason = htmlspecialchars($_POST["reason"]);
    $message = htmlspecialchars($_POST["message"]);

    //for sending to my emailAdd
    $to = "diegoshoya2017@gmail.com";
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for contacting us, $name! We will get back to you soon!<br>";
    } else {
        echo "Sorry $name, there was an error sending your message. Please try again later. <br>";
    }

    // connect Database
    $conn = new mysqli(DB_SERVER_NAME, DB_USER, DB_PASSWORD, DB_NAME);  //create new database
    if ($conn->connect_error) { //if connection is field
        die("Connection failed");
    }

    $uploadOk = 1;
    // store to DB
    if ($uploadOk == 1) {
        $sql = "INSERT INTO user_tb (name, email, phone, reason, message) VALUES ('$name', '$email', '$phone', '$reason', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

// close DB
$conn->close();

}
?>
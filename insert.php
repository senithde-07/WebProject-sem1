<?php

if (isset($_POST['submit'])) {
    if (isset($_POST['username']) &&
        isset($_POST['choice']) && isset($_POST['email']) &&
        isset($_POST['phone'])) {
        
        $username = $_POST['username'];
        $choice = $_POST['choice'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "web-users";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM reserve WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO reserve(username, email, phone, choice) values(?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssss",$username, $email, $phone, $choice);
                if ($stmt->execute()) {
                    header('Location:reservemsg.html');
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                // echo "Someone already registers using this email.";
                echo '<script>alert("Someone already registers using this email.")</script>';
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}

?>
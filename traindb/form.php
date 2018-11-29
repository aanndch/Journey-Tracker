<?php
    $email = filter_input(INPUT_POST, 'email');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    if (!empty($email)) {
        if (!empty($username)) {
            if (!empty($password)) {
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "project";

                // Create connection
                $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

                if (mysqli_connect_error()) {
                    die('Connect Error ('. mysqli_connect_errno() .') '
                    . mysqli_connect_error());
                }
                else {
                    $sql = "INSERT INTO login(email, username, password) values ('$email','$username','$password')";
                    if ($conn->query($sql)){
                        header("Location: train.html");
                    }
                    else {
                        echo "Error: ". $sql ."
                        ". $conn->error;
                    }
                    $conn->close();
                }
            }
            else {
                echo "Password should not be empty";
                die();
            }
        }
        else {
            echo "Username should not be empty";
            die();
        }
    }
    else {
        echo "Email should not be empty";
        die();
    }
?>
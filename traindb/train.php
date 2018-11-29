<?php
    $train_name = filter_input(INPUT_POST, 'train_name');
    $train_class = filter_input(INPUT_POST, 'train_class');
    $from_station = filter_input(INPUT_POST, 'from_station');
    $to_station = filter_input(INPUT_POST, 'to_station');
    $d_day = filter_input(INPUT_POST, 'd_day');
    $d_month = filter_input(INPUT_POST, 'd_month');
    $review = filter_input(INPUT_POST, 'review');
    $rating = filter_input(INPUT_POST, 'rating');

    if (!empty($train_name) || !empty($train_class) || !empty($from_station) || !empty($to_station) || !empty($d_day) ||!empty($d_month) || !empty($review) || !empty($rating)) {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "project";

        //create connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        }
        else {
            $INSERT = "INSERT INTO reviews(review, rating) VALUES(?, ?)";
            $sql1 = $conn->prepare($INSERT);
            $sql1->bind_param("si", $review, $rating);
            $sql1->execute();
            $review_id = $sql1->insert_id;
            $sql1->close();

            $INSERT = "INSERT INTO departures(d_day, d_month) VALUES(?, ?)";           
            $sql2 = $conn->prepare($INSERT);
            $sql2->bind_param("is", $d_day, $d_month);
            $sql2->execute();
            $d_id = $sql2->insert_id;
            $sql2->close();

            $INSERT = "INSERT INTO journeys(from_station, to_station) VALUES(?, ?)";
            $sql3 = $conn->prepare($INSERT);
            $sql3->bind_param("ss", $from_station, $to_station);
            $sql3->execute();
            $journey_id = $sql3->insert_id;
            $sql3->close();
       
            $INSERT = "INSERT INTO trains(train_name, train_class, journey_id, d_id, review_id) VALUES(?, ?, ?, ?, ?)";   
            $sql4 = $conn->prepare($INSERT);
            $sql4->bind_param("ssiii", $train_name, $train_class, $journey_id, $d_id, $review_id);
            $sql4->execute();
            $sql4->close();

            $conn->close();
            
            header("Location: table.php");
        }
    }
    else {
        echo "All fields are required";
        die();
    }
?>
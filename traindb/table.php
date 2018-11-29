<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="table.css">
    <title>Register Form</title>
</head>

<body>

<?php
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "project";

    // Create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
    
    echo '<h1 class="heading">Train Experiences</h1>';

    // CREATE COMMENTS
    $stmt = "SELECT *
            FROM trains
            JOIN journeys ON trains.journey_id = journeys.journey_id
            JOIN departures ON trains.d_id = departures.d_id
            JOIN reviews ON trains.review_id = reviews.review_id
            ORDER BY trains.train_name";

    $res = $conn->query($stmt);

    echo '<div class="container">';

    if ($res->num_rows > 0) {
        echo '<table class="container">'; 
        echo "<tr>"; 
        echo '<th>NAME</th>'; 
        echo '<th>CLASS</th>'; 
        echo '<th>FROM</th>';
        echo '<th>TO</th>';
        echo '<th>DAY</th>';
        echo '<th>MONTH</th>';
        echo '<th>REVIEW</th>';
        echo '<th>RATING</th>';
        echo "</tr>"; 
        while ($row = $res->fetch_array())  
        { 
            echo "<tr>"; 
            echo '<td>'.$row['train_name']."</td>"; 
            echo '<td>'.$row['train_class']."</td>"; 
            echo '<td>'.$row['from_station']."</td>";
            echo '<td>'.$row['to_station']."</td>";
            echo '<td>'.$row['d_day']."</td>";
            echo '<td>'.$row['d_month']."</td>";
            echo '<td class="not_middle">'.$row['review']."</td>";
            echo '<td>'.$row['rating']."</td>";
            echo "</tr>";
        } 
        echo "</table>"; 
        $res->free(); 

        echo '<div class="a-mar">';
        echo '<a href="proc.php"><button type="submit" class="btn btn-primary">Shatabdi Trains</button></a>';
        echo '</div>';
        echo '<div class="a-mar">';
        echo '<a href="tclass.php"><button type="submit" class="btn btn-primary">All Chair Car Trains</button></a>';
        echo '</div>';
        echo '<div class="a-mar">';
        echo '<a href="log.php"><button type="submit" class="btn btn-primary">Users</button></a>';
        echo '</div>';
        echo '</div>';
    } 
    else { 
        echo "No matching records are found."; 
    } 
    $conn->close();
?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="table.css">
    <title>Shatabdi Trains</title>
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
    
    echo '<h1 class="heading">Shatabdi Trains</h1>';

    // CREATE COMMENTS
    $stmt = 'CALL train_src("shatabdi")';

    $res = $conn->query($stmt);
    if ($res->num_rows > 0){
        echo '<table class="container">'; 
        echo "<tr>"; 
        echo '<th class="middle">NAME</th>';
        echo '<th class="middle">CLASS</th>'; 
        echo "</tr>"; 
        while ($row = $res->fetch_array())  
        { 
            echo "<tr>"; 
            echo '<td>'.$row['train_name']."</td>";
            echo '<td>'.$row['train_class']."</td>";
            echo "</tr>";
        } 
        echo "</table>"; 
        $res->free(); 
    } 
    else { 
        echo "No matching records are found."; 
    } 
    $conn->close();
?>

</body>

</html>
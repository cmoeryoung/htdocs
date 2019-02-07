<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guitar Wars - Hight Scores</title>
</head>
<body>
    <h2>Guitar Wars - High Scores</h2>
    <p>Welcome,Guitar Warrior,do you have what it takes to crack the high score
    list?If so,just <a href="addscore.php">add your own score</a>.</p>
    <hr>
    <?php
    // Connect to the database
    $dbc = mysqli_connect('localhost','root','yhx1014','gwdb')
            or die('Connect Mysql Error');

    // Retrieve the score data from MySQL
    $query = "SELECT * FROM guitarwars";
    $data = mysqli_query($dbc,$query) or die("Select Data Error");

    // Loop through the array of score data,formatting it as HTML
    echo '<table>';
    while ($row = mysqli_fetch_array($data)){
        //Display the score data
        echo '<tr><td class=""scoreinfo">';
        echo '<span class="score">'.$row['score'].'</span><br>';
        echo '<strong>Name:</strong>'.$row['name'].'<br>';
        echo '<strong>Date:</strong>'.$row['date'].'</td></tr>';
    }
    echo '</table>';

    mysqli_close($dbc);
    ?>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guitar Wars - Add Your High Score</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Guitar Wars - Add Your Hight Score</h2>

    <?php
    if (isset($_POST['submit'])){
        //Grab the score data from the POST
        $name = $_POST['name'];
        $score = $_POST['score'];

        if (!empty($name) && !empty($score)){
            $dbc = mysqli_connect('localhost','root','yhx1014','gwdb') or die('Connect MySQL Error');

            //Write the data to the database
            $query = "INSERT INTO guitarwars values (0,NOW(),'$name','$score')";
            mysqli_query($dbc,$query) or die('Insert Data Error');

            //Confirm  success with the user
            echo '<p>Thanks for adding your new high score!</p>';
            echo '<p><strong>Name:</strong>'.$name.'<br>';
            echo '<strong>Score:</strong>'.$score.'</p>';
            echo '<p><a href="index.php">&lt;&lt; Back to higt scores</a></p>';

            // Clear the score data to clear the form
            $name = "";
            $score = "";

            mysqli_close($dbc);
        }else{
            echo '<p class="error">Please enter all of the information to add'.'your high score.</p>';
        }
    }
    ?>
    <hr>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"><br>
        <label for="score">Score:</label>
        <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>">
        <hr>
        <input type="submit" value="Add" name="submit">
    </form>
</body>
</html>
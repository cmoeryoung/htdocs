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
    // Define the upload path and maximum file size constants
    define('GW_UPLOADPATH','head first php&mysql/practice/ch05/images');

    if (isset($_POST['submit'])){
        //Grab the score data from the POST
        $name = $_POST['name'];
        $score = $_POST['score'];
        $screenshot = $FILES['screenshot']['name'];

        if (!empty($name) && !empty($score) && !empty($screenshot)){
            // Move the file to the target upload folder
            $target = GW_UPLOADPATH.$screenshot;
            if (move_uploaded_file($_FILES['screenshot']['tmp_name'],$target)){
                // Connect to the database
                $dbc = mysqli_connect('localhost','root','yhx1014','gwdb');

                // Write the data to the database
                $query = "INSERT INTO guitarwars VALUES (0,NOW(),'$name','$score','$screenshot')";
                mysqli_query($dbc,$query);

                // Confirm success with the user
                echo '<p>Thanks for adding your new high score!</p>';
                echo '<p><strong>Name:</strong>'.$name.'<br>';
                echo '<strong>Score:</strong>'.$score.'<br>';
                echo '<img src="'.GW_UPLOADPATH.$screenshot.'" alt="Score image"></p>';
                echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';
            }
        }
    }

    ?>
    <hr>
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="32768">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"><br>
        <label for="score">Score:</label>
        <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>">
        <br>
        <label for="screenshot">Screen shot:</label>
        <input type="file" id="screenshot" name="screenshot">
        <hr>
        <input type="submit" value="Add" name="submit">
    </form>
</body>
</html>
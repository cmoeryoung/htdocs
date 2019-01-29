<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You for Join Elvis Email List</title>
</head>
<body>
    <h1>Thank You for Join Elvis Email List</h1>
    <?php
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $email = $_POST['email'];

        echo 'You First Name is:'.$first_name.'<br>';
        echo 'You Last Name is:'.$last_name.'<br>';
        echo 'You Email is:'.$email;

        $dbc = mysqli_connect('localhost','root','yhx1014','elvis_store')
                or die('Error connecting to MYSQL server');
        $query = "INSERT INTO email_list (first_name,last_name,email)".
            "VALUES ('$first_name','$last_name','$email')";
        $result = mysqli_query($dbc,$query) or die('Error querying');
        mysqli_close($dbc);
    ?>
</body>
</html>
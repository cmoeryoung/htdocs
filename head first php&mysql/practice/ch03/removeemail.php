<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Remove Email</title>
</head>
<body>
<?php
    $email = $_POST['email'];

    $dbc = mysqli_connect('localhost','root','yhx1014','elvis_store')
        or die('Error connecting MYSQL server');
    $query = "DELETE FROM email_list WHERE email = '$email'";
    $result = mysqli_query($dbc,$query)
        or die('Error Querying Database');
    if ($result){
        echo 'SUCCESS';
    }else{
        echo 'FAILE';
    }
?>
</body>
</html>
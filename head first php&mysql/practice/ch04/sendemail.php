<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Make Me Elvis - Send Email</title>
</head>
<body>
<?php
if (isset($_POST['submit'])){
    $from = 'elmer@makemeelvis.com';
    $subject = $_POST['subject'];
    $text = $_POST['elvismail'];
    $output_form = false;

    if (empty($subject) && empty($text)){
        echo 'You forgot the email subject and body text.<br>';
        $output_form = true;
    }
    if (empty($subject) && (!empty($text))){
        echo 'You forgot the email subject.<br>';
        $output_form = true;
    }
    if ((!empty($subject)) && empty($text)){
        echo 'You forgot the email body text.<br>';
        $output_form = true;
    }
    if ((!empty($subject)) && (!empty($text))){
        $dbc = mysqli_connect('localhost','root','yhx1014','elvis_store')
        or die('Error to Connecting MYSQL Server');
        $query = "SELECT * FROM email_list";
        $result = mysqli_query($dbc,$query)
        or die('Error Querying Database');
        while ($row = mysqli_fetch_array($result)){
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $msg = "Dear $first_name $last_name,\n$text";
            $to = $row['email'];
            mail($to,$subject,$msg,'From:'.$from);
            echo 'Email sent to:'.$to.'<br>';
        }
        mysqli_close($dbc);
    }
}else{
    $output_form = true;
}

    if ($output_form) {
        ?>
        <form method="post" action=<?php echo $_SERVER['PHP_SELF' ?>>
            <label for="subject">Subject of email:</label><br/>
            <input id="subject" name="subject" type="text" size="30"/><br/>
            <label for="elvismail">Body of email:</label><br/>
            <textarea id="elvismail" name="elvismail" rows="8" cols="40"></textarea><br/>
            <input type="submit" name="Submit" value="Submit"/>
        </form>

        <?php
    }
?>

</body>
</html>
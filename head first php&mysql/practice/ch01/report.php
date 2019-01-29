<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aliens Abducted Me - Report an Abduction</title>
</head>
<body>
    <h2>Aliens Abducted Me - Report an Abduction</h2>
    <?php
        $when_it_happened = $_POST['whenithappened'];
        $how_long = $_POST['howlong'];
        $alien_description = $_POST['aliendescription'];
        $fang_spotted = $_POST['fangspotted'];
        $email = $_POST['email'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $how_many = $_POST['howmany'];
        $what_they_did = $_POST['whattheydid'];
        $other = $_POST['other'];

//        $to = 'cmoer.young@outlook.com';
//        $subject = 'Aliens Abducted Me - Abduction Report';
//        $msg = "$name was abducted $when_it_happened and was gone for $how_long.\n".
//            "Number of aliens:$how_many\n".
//            "Alien description:$alien_description\n".
//            "What they did:$what_they_did\n".
//            "Fang spotted:$fang_spotted\n".
//            "Other comments:$other";
//        mail($to,$subject,$msg,'From:'.$email);

        $dbc = mysqli_connect('localhost','root','yhx1014','aliendatabase')
            or die('Error connecting to MYSQL server');
        $query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, how_long, ".
            "how_many, alien_description, what_they_did, fang_spotted, other, email)".
            "VALUES ('$first_name','$last_name','$when_it_happened','$how_long','$how_many',".
            "'$alien_description','$what_they_did','$fang_spotted','$other','$email')";
        $result = mysqli_query($dbc,$query)
            or die('Error querying database');
        mysqli_close($dbc);


        echo 'Thanks for submitting the form.<br>';
        echo 'You are abducted: '.$when_it_happened.'<br>';
        echo ' and were gone for: '.$how_long.'<br>';
        echo 'Number of aliens:'.$how_many.'<br>';
        echo 'describe them:'.$alien_description.'<br>';
        echo 'The aliens did this:'.$what_they_did.'<br>';
        echo 'was fang there:?'.$fang_spotted.'<br>';
        echo 'Other comments:'.$other.'<br>';
        echo 'Your email address is: '.$email;


    ?>
</body>
</html>
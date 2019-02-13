<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Remove Email - Elvis Store</title>
</head>
<body>
    <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
    <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
    <p>Please Select the Email Addresses to Delete from the Email List and Click Remove.</p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
            $dbc = mysqli_connect('localhost','root','yhx1014','elvis_store')
                or die('Error connecting to MYSQL server');
            //Display the customer rows with checkboxes for deleting
            $query = "SELECT * FROM email_list";
            $result = mysqli_query($dbc,$query);

            while ($row = mysqli_fetch_array($result)){
                echo '<input type="checkbox" value="'.$row['id'].'" name="todelete[]">';
                echo $row['first_name'];

            }
        ?>
    </form>
</body>
</html>
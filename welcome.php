<?php

include "configuration/config.php";

// checking if user is authentication
check_user_authenticated();

$user_id = $_SESSION['uid']; // storing user id

$user = get_user_id($user_id); // getting user details using user id

if($user != false){
    $fname = $user['user_first_name']; // first name
    $lname = $user['user_last_name']; // last name
    $email = $user['user_email']; // email
    $username = $user['username']; // username
    $fullname = $fname . " " . $lname; // create full name using first name and last name
}

$_SESSION['user_id'] = $user_id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome <?php echo ucfirst($fullname); ?></title>
</head>
<body>
        <p>Hi! <?php echo ucfirst($fname); ?>, Welcome to our ABC classes <a href="emi.php?uid=<?php echo $_SESSION['user_id']; ?>">View EMI</a></p>
        <p><a href="logout.php">Logout</a></p>
</body>
</html>
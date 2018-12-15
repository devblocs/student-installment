<?php 

// TODO: accessing of index page by authenticated user after login or successful registration
// TODO: authenticated user should be redirected to welcome.php if trying to access this file

include "configuration/config.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC Classes | Login and Registration</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="first_name">First name</label>
        <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" />
        <br>
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" />
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your desired email" />
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your desired password" />
        <br>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" />
        <br>
        <input type="submit" name="register" value="Register!">
    </form>

   <?php
     if(count($errors) > 0){
   ?>
    <ul>
        <?php foreach($errors as $key => $value){ ?>
        <li><?php echo $value; ?></li>
        <?php } ?>
    </ul>
        <?php } ?>

    <br />
    <br />
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="userid">Username or Email: </label>
            <input type="text" name="userid" id="userid" placeholder="Enter your email or username" />
            <br />
            <label for="log_password">Password: </label>
            <input type="password" name="log_password" id="log_password" placeholder="Enter your password" />
            <br />
            <input type="submit" value="Login!" name="login" />
    </form>
</body>
</html>
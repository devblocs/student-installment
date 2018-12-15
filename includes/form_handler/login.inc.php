<?php

if(isset($_POST['login'])){
    $login_id = ""; // creating empty username or email variable
    $password = ""; // creating empty password variable

    // checking if the username or email is empty or not
    if(empty($_POST['userid'])){
        $errors['user id empty'] = "Username or email required"; // storing the error in an array
    }else{
        $login_id = trim_string($_POST['userid']); // removing unwanted string
    }

    // checking if the password is empty or not
    if(empty($_POST['log_password'])){
        $errors['Empty login password'] = "Password required to login"; // storing the error in an array
    }else{
        $password = $_POST['log_password']; // storing password in variable
    }

    // checking if $errors are empty
    if(empty($errors)){
        $user = get_user_email_or_username($login_id); // retrieve the user details using email or username

        // if user found
        if($user != false){
            $user_password = $user['user_password']; // store the user password

            // verify the user password
            if(password_verify($password, $user_password)){
                
                $_SESSION['sid'] = session_id(); // store the session id
                $_SESSION['uid'] = $user['user_id']; // store user id

                redirect('welcome'); // redirect user

            }else{
                $errors['email and password'] = "Email or password don't match"; // store the error in $errors array
            }
        }else{
            $errors['invalid user id'] = "Invalid username or email id"; // store the error in $errors array
        }
    }
    

}
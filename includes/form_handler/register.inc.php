<?php

if(isset($_POST['register'])){
    $first_name = ""; // empty variable for first name
    $last_name = ""; // empty variable for last name
    $email = ""; // empty variable for email
    $password = ""; // empty variable for password
    $confirm_password = ""; // empty variable for confirming password
    $created_at = date('Y-m-d H:i:s');

    // checking if the first name is empty or not
    if(empty($_POST['first_name'])){
        $errors['empty first name'] = "First name required";
    }else{
       
        $first_name = escape_string(trim_string($_POST['first_name']));  // escaping first name
        $first_name = strtolower($first_name); // changing the name to lower case

        // checking first name is only letters or not
        if(!preg_match("/^[a-zA-Z]*$/", $first_name)){
            $errors['first name invalid'] = "Only letters allowed first name";
        }

        // checking first name length
        if(strlen($first_name)>25 || strlen($first_name)<3){
            $errors['first name length'] = "First name must be greater than 3 and less than 25";
        }

    }

    // checking the last name is empty or not
    if(empty($_POST['last_name'])){
        $errors['empty last name'] = "Last name required";
    }else{
        $last_name = escape_string(trim_string($_POST['last_name'])); // escaping last name
        $last_name = strtolower($last_name); // changing the name to lower case

        // checking last name is only letters or not
        if(!preg_match("/^[a-zA-Z]*$/", $last_name)){
            $errors["last name invalid"] = "Only letters allowed in last name";
        }

        // checking last name length
        if(strlen($last_name)>25 || strlen($last_name)<3){
            $errors['last name length'] = "Lat name must be greater than 3 and less than 25";
        }
    }

    
    // checking if the email is empty or not
    if(empty($_POST['email'])){
        $errors['empty email'] = "Email required";
    }else{
        $email = escape_string(trim_string($_POST['email'])); // escaping email
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email, FILTER_VALIDATE_EMAIL); // validate email

            // checking email exists or not
            if(check_email_exists($email)>0){
                $errors['email exists'] = "Email already exists";
            }

        }else{
            $errors['email format'] = "Invalid email format"; // invalid email format
        }
    }

    // checking password is empty or not
    if(empty($_POST['password'])){
        $errors['empty password'] = "Password Required";
    }else{
        $password = strip_tags($_POST['password']); // removing html tags from the string

         // checking password length
        if(strlen($password)>30 || strlen($password)<3){
            $errors['password length'] = "Password must be less than 30 and greater than 3";
        }
    }

    // checking if confirming password is empty or not
    if(empty($_POST['confirm_password'])){
        $errors['empty confirm password'] = "Confirm your password";
    }else{
        $confirm_password = strip_tags($_POST['confirm_password']); // removing html tags from the string
    }

    // checking if password match
    if($password != $confirm_password){
        $errors["password don't match"] = "Passwords don't match. Re-enter password";
    }

   
    
    // checking if $errors array is empty
    if(empty($errors)){

        // encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT); 

         // generating unique username using first name and last name
        $username = create_username($first_name, $last_name);

        // creating user
        $create_user = create_user($first_name, $last_name, $email, $username, $password, $created_at);

        // if user is created
        if($create_user){

            $get_user = get_user_username($username); // getting user details using username

            // checking if user found or not
            if($get_user != false){
                $_SESSION['sid'] = session_id(); // creating a session id
                $_SESSION['uid'] = $get_user['user_id']; // storing the user id
                
                create_emi($get_user['user_id']);
                
                redirect('welcome'); // redirect page 
            }
            
            
        }
        
        
    }
}
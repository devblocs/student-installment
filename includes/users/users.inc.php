<?php

// checking email exists or not
function check_email_exists(string $email){
    // query for checking email exists or not
    $check_email = "SELECT user_email FROM users WHERE user_email='$email'";

    // processing the query
    $email_exists = mysqli_query(db_connect(), $check_email);

    // fetching the result in rows
    $rows = mysqli_num_rows($email_exists);

    return $rows;   // return the number of rows affected
}

// generating unique username
function create_username($first_name, $last_name){
    $username = $first_name . "." . $last_name;

    // checking if the username exists or not
    $query = "SELECT COUNT(user_id) AS user_count FROM users WHERE username LIKE '%". $username . "%'";
    $result = mysqli_query(db_connect(), $query);
    $rows = mysqli_fetch_assoc($result);
    $user_count = $rows['user_count'];

    if(!empty($user_count)){
        $username = $username . "." . $user_count;
    }

    return $username;
}

// creating a user
function create_user($fname, $lname, $email, $username, $password, $created_at){
    $query = "INSERT INTO users (user_first_name, user_last_name, user_email, username, user_password, created_at)";
    $query .= " VALUES ('$fname', '$lname', '$email', '$username', '$password', '$created_at')";

    $user = mysqli_query(db_connect(), $query);

    return $user;
}

// getting user details by username
function get_user_username(string $username){
    $query = "SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query(db_connect(), $query);

    if(mysqli_num_rows($result)>0){
        return mysqli_fetch_assoc($result);
    }

    return false;
}

// getting user details by user id
function get_user_id($id){
    $query = "SELECT * FROM users WHERE user_id='$id'";

    $result = mysqli_query(db_connect(), $query);

    if(mysqli_num_rows($result)>0){
        return mysqli_fetch_assoc($result);
    }

    return false;
}

function get_user_email_or_username($username){
    $query = "SELECT * FROM users WHERE (user_email='$username' OR username='$username')";

    $result = mysqli_query(db_connect(), $query);

    if(mysqli_num_rows($result) == 1){
        return mysqli_fetch_assoc($result);
    }

    return false;
}


<?php

// removing unwanted characters in a string
function trim_string(string $data){
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
}

// redirect page
function redirect($page, array $parameters = []){
    if(!empty($parameters)){
        $http_query = http_build_query($parameters);
        return header("Location: {$page}.php?".$http_query);
    }
    return header("Location: {$page}.php");
}

// check if user is authenticated
function check_user_authenticated(){
    if($_SESSION['sid'] !== session_id() || !isset($_SESSION['uid'])){
        redirect('index');
        exit;
    }
}
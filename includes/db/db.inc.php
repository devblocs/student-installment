<?php

// creating a database connection
function db_connect(){
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "practice_fees_installment";

    $db = mysqli_connect($host, $user, $password, $db);

    return $db;
}

// checking the database connection
function check_conection(){
    if(mysqli_connect_errno(db_connect())){
        echo "Connection error: " . mysqli_connect_errno() . ": " . mysqli_connect_error();
    }else{
        echo "Connection made successfully";
    }
}

// escaping unwanted characters in a string
function escape_string(string $data){
    $escaped_string = mysqli_real_escape_string(db_connect(), $data);
    return $escaped_string;
}
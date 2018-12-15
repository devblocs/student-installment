<?php
include "configuration/config.php";

// unset all session variables to an empty array
$_SESSION = [];

// destroying a session
if(session_destroy()){
    redirect('index');
}

exit;
?>

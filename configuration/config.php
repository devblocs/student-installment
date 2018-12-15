<?php
// start output buffering
ob_start();

// starting session
session_start();

// creating an empty errors array
$errors = [];

// rate of interest for emi
$rate_of_interest = 7.5; // 7.5 %

// including files
include "includes/db/db.inc.php";
include "includes/functions.inc.php";
include "includes/users/users.inc.php";
include "includes/emi/emi.inc.php";
include "includes/form_handler/register.inc.php";
include "includes/form_handler/login.inc.php";



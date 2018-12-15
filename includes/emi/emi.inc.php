<?php

// create the fees amount for user
function create_emi($user_id){
   $query = "INSERT INTO emi_details (user_id, total_amount, remaining_amount, emi_status)";
   $query .= " VALUES ('$user_id', '10000', '10000', '1')";

   $result = mysqli_query(db_connect(), $query);

   return $result;
}

// get emi by user id
function emi_user_id($user_id){
    $query = "SELECT * FROM emi_details WHERE user_id='$user_id'";

    $result = mysqli_query(db_connect(), $query);

    if(mysqli_num_rows($result) == 1){
        return mysqli_fetch_assoc($result);
    }

    return false;
}

// select and update the installment amount for the user using user id
function update_installment($user_id, $installment){
    $query = "UPDATE emi_details SET remaining_amount='10000', no_of_installments='$installment' WHERE user_id=$user_id";

    $result = mysqli_query(db_connect(), $query);

    return $result;
}

// calculate emi 
// EMI formula: EMI = (P.r).(1+r)n) / ((1+r)n – 1)
//TODO: Check principal amount meaning. In emi the given output is wrong
function calculate_emi($total_amount, $rate, $no_of_installment){
    $emi; 
  
    // one month interest 
    $rate = $rate / (12 * 100); 
      
    // one month period 
    $no_of_installment = $no_of_installment * 12;  
    $emi_rate = pow(1 + $rate, $no_of_installment) /  (pow(1 + $rate, $no_of_installment) - 1);
    $emi = ($total_amount * $rate) *  $emi_rate;
  
    return $emi; 
}

// update emi amount
function update_emi($user_id, $emi_amount){
    $query = "UPDATE emi_details SET emi_amount='$emi_amount' WHERE user_id=$user_id";

    $result = mysqli_query(db_connect(), $query);

    return $result;
}
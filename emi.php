<?php

include "configuration/config.php";

// checking if user is authentication
check_user_authenticated();

$user_id = $_GET['uid'];

if($user_id == $_SESSION['user_id']){
    $user = get_user_id($user_id);

    if($user != false){
        $fname = $user['user_first_name'];
        
        $emi = emi_user_id($user_id) ; // getting emi details using user id

        if($emi != false){
            $total_amount = $emi['total_amount'];
            $remaining_amount = $emi['remaining_amount'];
            $total_no_installments = $emi['no_of_installments'];
            $emi_status = $emi['emi_status'];
        }
    }

    if(isset($_POST['select_emi'])){
        $installment = $_POST['installment'];
    
        if(update_installment($user_id, $installment)){

            $user_emi = emi_user_id($user_id);

            if($user_emi != false){
                $installments = $user_emi['no_of_installments'];

                $emi_amount = calculate_emi($total_amount, $rate_of_interest, $installments);

                if($emi_amount){
                    if(update_emi($_SESSION['user_id'], $emi_amount)){
                        redirect('emi', ['uid' => $emi_user_id]); 
                    }
    
                }
            }
        }else{
            echo "OOPS! Something went wrong.";
        }
    
    }
}else{
    redirect('emi', ['uid' => $_SESSION['user_id']]); // redirecting user with the authenticated user id
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC Classes | <?php echo $fname; ?> | EMI</title>
</head>
<body>
    <p>Hello! <?php echo ucfirst($fname); ?>, You classes fee is INR <?php echo number_format($total_amount, 2); ?>. </p>

        <?php
            // creating the emi status message
            $unselected_msg = "You have not selected your EMI Scheme.";
        ?>
    <p><?php echo empty($remaining_amount) ? $unselected_msg : "You have an unpaid amount of INR ".number_format($remaining_amount, 2) ;  ?></p>

    <?php if(!empty($remaining_amount)){ ?>
        <p>Pay EMI amount</p>
    <?php }else{ ?>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="installment">Please select your desired EMI scheme: </label>
            <select name="installment" id="installment">
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
            </select>
            <input type="submit" name="select_emi" value="Select EMI" />
        </form>
    <?php } ?>
</body>
</html>
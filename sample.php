<?php
     function pmt($interest, $months, $loan) {
       $months = $months;
       $interest = $interest / 1200;
       $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       return number_format($amount, 2);
     }
 
     $interest = 6.5; //Interest Rate per Year 
     $duration = 30; //Duration of loan (year)
     $loan_capacity = 5000000; //Loan capacity
 
 
     $monthly_payment = pmt($interest,($duration*12),$loan_capacity);
     echo "Monthly Payment Rate : ".$monthly_payment;
?>

<br />
<br />
<br />
<br />


<?php 
// EMI Calculator program in PHP 
  
// Function to calculate EMI 
function emi_calculator($p, $r, $t) 
{ 
    $emi; 
  
    // one month interest 
    $r = $r / (12 * 100); 
      
    // one month period 
    $t = $t * 12;  
      
    $emi = ($p * $r * pow(1 + $r, $t)) /  
                  (pow(1 + $r, $t) - 1); 
  
    return ($emi); 
} 
  
    // Driver Code 
    $principal = 5000000; 
    $rate = 6.5; 
    $time = 30; 
    $emi = emi_calculator($principal, $rate, $time); 
    echo "Monthly EMI is = ", $emi; 
  
// This code is contributed by anuj_67. 
?> 

<br />
<br />
<br />
<br />


<?php 
// EMI Calculator program in PHP 
  
// Function to calculate EMI 
function emi_calc($p, $r, $t) 
{ 
    $emi; 
  
    // one month interest 
    $r = $r / (12 * 100); 
      
    // one month period 
    $t = $t * 12;  
    $emi_rate = pow(1 + $r, $t) /  (pow(1 + $r, $t) - 1);
    $emi = ($p * $r) *  $emi_rate;
  
    return number_format($emi, 2); 
} 
  
    // Driver Code 
    $principal = 10000; 
    $rate = 7.5; 
    $time = 2; 
    $emi = emi_calc($principal, $rate, $time); 
    echo "Monthly EMI is = ", $emi; 
  
// This code is contributed by anuj_67. 
?> 
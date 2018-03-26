<?php
  session_start();
  include("../../includes/db.php");
?>

<?php
/* Displays user information and some useful messages */


// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:../../login/error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];   
}
?>

<?php

    $token = $_GET['token'];

    $sql = "select * from orders where order_timestamp = '$token'";
    
    global $con;
    $run_query = mysqli_query($con , $sql);

    $order_id='';
    $order_status='';
    while($row_query = mysqli_fetch_array($run_query)){
        $order_id = $row_query['order_id'];
        $order_status = $row_query['order_status']; 
    };
                
   $count = mysqli_num_rows($run_query);

   if($count > 0){
        $_SESSION['message'] = "Your order is in ".$order_status;
        header("location:../../login/success.php");    
   }
   else{
        $_SESSION['message'] = "There is no such order";
        header("location:../../login/error.php");    
   }

?>
<?php
session_start();
include("../includes/db1.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $_SESSION['customer_email'] = $_POST['customer_email'];
    
        //set all the post variables
        //set supplier details
        $customer_firstname = $mysqli->real_escape_string($_POST['customer_firstname']);
        $customer_lastname = $mysqli->real_escape_string($_POST['customer_lastname']);
        $customer_email = $mysqli->real_escape_string($_POST['customer_email']);
        $customer_contact = $mysqli->real_escape_string($_POST['customer_contact']);
        $customer_dob = $mysqli->real_escape_string($_POST['customer_dob']);
        
        //set supplier address details
        $address_line1 =$mysqli->real_escape_string($_POST['address_line1']);
        $address_line2 =$mysqli->real_escape_string($_POST['address_line2']);
        $address_city =$mysqli->real_escape_string($_POST['address_city']);
        $address_state =$mysqli->real_escape_string($_POST['address_state']);
        $address_pincode =$mysqli->real_escape_string($_POST['address_pincode']);
        $address_landmark =$mysqli->real_escape_string($_POST['address_landmark']);
        $address_code = hash('sha256',$customer_firstname.$customer_email);

        $sql = "INSERT INTO address (address_line1,address_line2,address_city,address_state,address_pincode,address_landmark,address_code)
                VALUES ('$address_line1','$address_line2','$address_city','$address_state','$address_pincode','$address_landmark','$address_code')";
               
            if ($mysqli->query($sql) === true){
                
                $selection = "SELECT * FROM address WHERE address_code='$address_code'";
                $run_selection = mysqli_query($mysqli , $selection);
                
                $address_id='';
                while($row_selection = mysqli_fetch_array($run_selection)){
                    $address_id = $row_selection['address_id'];   
                };
                

               //insert user data into database
                $sql = "INSERT INTO customer (customer_firstname,customer_lastname,customer_email,customer_contact,customer_dob,address_address_id) 
                        VALUES ('$customer_firstname','$customer_lastname', '$customer_email', '$customer_contact', '$customer_dob','$address_id')";
                
                //if the query is successsful, redirect to welcome.php page, done!
                if ($mysqli->query($sql) === true){
                    if($_SESSION['check_existence'] == 0){
                        header("Location:http://localhost/mydb/admin/order/new_order.php");
                    }
                    echo "<div class='alert alert-error'><h1>Registration succesfull! Added $customer_firstname to the database!</h1></div>";
                    
                }
                else {
                    $sql = "DELETE FROM address WHERE address_code = '$address_code'" ;
                    $mysqli->query($sql);
                    echo "<div class='alert alert-error'><h1>User could not be added to the database!</h1></div>";
                }
                $mysqli->close();          

            }

            
}
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../includes/css/form.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form class="form" action="customer_reg.php" method="post" enctype="multipart/form-data" autocomplete="off">
      
      <input type="text" placeholder="First Name" name="customer_firstname" required />
      <input type="text" placeholder="Last Name" name="customer_lastname" required />
      <input type="email" placeholder="Email" name="customer_email" required />
      <input type="tel" placeholder="Contact No." name="customer_contact" required /> 
      <input type="date" placeholder="Date Of Birth" name="customer_dob" required /> 
   
      <h1>Enter Address Details.</h1>
      <input type="text" placeholder="Address line 1" name="address_line1" required /> 
      <input type="text" placeholder="Address line 2" name="address_line2" required /> 
      <input type="text" placeholder="City" name="address_city" required /> 
      <input type="text" placeholder="State" name="address_state" required /> 
      <input type="text" placeholder="Pincode" name="address_pincode" required /> 
      <input type="text" placeholder="Landmark" name="address_landmark"  /> 

      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
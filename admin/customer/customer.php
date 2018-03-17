<?php
  include("../../includes/db.php");
?>
<link href="../includes/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300|Grand+Hotel" rel="stylesheet" type="text/css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
             global $con;
             $get_pro = "select * from customer order by RAND() LIMIT 0,10";
             $run_pro = mysqli_query($con , $get_pro);

             echo "
                <div class='container'>
                <table class='table'>
                  <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Contact No.</th>
                    <th>Date Of Birth</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>";
       
             while($row_pro = mysqli_fetch_array($run_pro)){

                $customer_firstname = $row_pro['customer_firstname'];
                $customer_lastname = $row_pro['customer_lastname'];
                $customer_email = $row_pro['customer_email'];
                $customer_contact = $row_pro['customer_contact'];
                $customer_dob = $row_pro['customer_dob'];
                $address_address_id = $row_pro['address_address_id'];

                
                $selection = "SELECT * FROM address WHERE address_id='$address_address_id'";
                $run_selection = mysqli_query($con , $selection);

                    $address_line1 = '';
                    $address_line2 = '';
                    $address_city = '';
                    $address_state = '';
                    $address_pincode = '';
                    $address_landmark = '';
                
                while($row_add = mysqli_fetch_array($run_selection)){

                    $address_line1 = $row_add['address_line1'];
                    $address_line2 = $row_add['address_line2'];
                    $address_city = $row_add['address_city'];
                    $address_state = $row_add['address_state'];
                    $address_pincode = $row_add['address_pincode'];
                    $address_landmark = $row_add['address_landmark'];

                }
               
       
               echo "
                  <tr>
                    <td>$customer_firstname</td>
                    <td>$customer_lastname</td>
                    <td>$customer_email</td>
                    <td>$customer_contact</td>
                    <td>$customer_dob</td>
                    <td>$address_line1 $address_line2 , $address_landmark <br> $address_city, $address_state, $address_pincode</td>
                 </tr>
               ";
             }

             echo "</tbody>
                  </table>
                  </div>";  
           ?>
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

  <body>
    <div class="container">
    <form action="customer.php" method="POST" class="form-inline">
      
      <div class="col-6 col-form-label">
        <h3><label for="search">Enter customer email/contact details:</label></h3>
      </div>
      
      <div class="col-4">
        <input type="text" name="search" class="form-control" placeholder="Enter details here">
      </div>
      
      <div class="col-2">
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
      </div>
      
    </form>
    </div>
  </body>

<?php
      if(isset($_POST['search'])){
        
        $search = $_POST['search'];
          if(filter_var($search, FILTER_VALIDATE_EMAIL)) {
              //Email is valid
             global $con;
             $get_customer = "select * from customer where customer_email='$search'";
             $run_customer = mysqli_query($con , $get_customer);

             $count_customer = mysqli_num_rows($run_customer);

            if($count_customer == 0){

              echo "<div class='container'><h2>There is no customer with email $search!</h2></div>";

            }
            else{
              echo "
                <div class='container'>
                <h1>Customer Details Are :</h1>
                <br>
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
              while($row_customer = mysqli_fetch_array($run_customer)){

                $customer_firstname = $row_customer['customer_firstname'];
                $customer_lastname = $row_customer['customer_lastname'];
                $customer_email = $row_customer['customer_email'];
                $customer_contact = $row_customer['customer_contact'];
                $customer_dob = $row_customer['customer_dob'];
                $address_address_id = $row_customer['address_address_id'];

                
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
              }
            }
            
          elseif (filter_var($search, FILTER_VALIDATE_INT)) {
            // number is valid int
            global $con;
            $get_customer = "select * from customer where customer_contact='$search'";
            $run_customer = mysqli_query($con , $get_customer);

            $count_customer = mysqli_num_rows($run_customer);

           if($count_customer == 0){

             echo "<div class='container'><h2>There is no customer with contact $search!</h2></div>";

           }
           else{
             echo "
               <div class='container'>
               <h1>Customer Details Are :</h1>
               <br>
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
             while($row_customer = mysqli_fetch_array($run_customer)){

               $customer_firstname = $row_customer['customer_firstname'];
               $customer_lastname = $row_customer['customer_lastname'];
               $customer_email = $row_customer['customer_email'];
               $customer_contact = $row_customer['customer_contact'];
               $customer_dob = $row_customer['customer_dob'];
               $address_address_id = $row_customer['address_address_id'];

               
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
             }
           }

           else{
            echo "<div class='container'><h2> $search is neither a contact number nor an email. <br> Please enter correct details!!!</h2></div>";
           }

          }
      
        
            /* global $con;
             $get_pro = "select * from customer order by RAND() LIMIT 0,10";
             $run_pro = mysqli_query($con , $get_pro);

             echo "
                <div class='container'>
                <h1>Customer Details Are :</h1>
                <br>
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
                  </div>";  */
           ?>
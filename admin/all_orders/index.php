<?php
  session_start();
  include("../../includes/db.php");
?>
<?php
/* Displays user information and some useful messages */


// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:../login/error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];   
}
?>

<!Doctype html>
<html>
  <head>
    <title>CRM</title>
    <link href="../../includes/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300|Grand+Hotel" rel="stylesheet" type="text/css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="crm">

      <div class="header">
        <div class="col-9 title">
          SnappySanta CRM
        </div>
        <div class="dropdown">
          <button type="button" class="btn dropdown-btn dropdown-toggle" data-toggle="dropdown">
            <?= $first_name.' '.$last_name ?>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="../../login/user_profile.php">Profile</a>
            <a class="dropdown-item" href="#">Update Profile</a>
            <a class="dropdown-item" href="#">Change Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../../login/logout.php">Log Out</a>
          </div>
        </div>
      </div>

      <br/><br/>

      <div class="body">
        <div class="col-3 sidenav">
          <nav class="navbar bg-dark" style="padding:0">
              <ul class="navbar-nav">
                <li class="nav-item ">
                  <a class="nav-link" href="../index.php">INVENTORY</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="../order/index.php">NEW ORDER</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="../customer/customer.php">CUSTOMER DETAILS</a>
                </li>
                <hr/>
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">PENDING ORDERS/COMPLETED</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="../analysis/index.php">MONTH BY MONTH ANALYSIS</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="#">ADD MISCELLANEOUS EXPENSE</a>
                </li>
              </ul>
            </nav>
        </div>
        <div class="col-9 content">
           
           <h1>Pending Orders</h1>
           <?php
             global $con;
             $get_pro = "select * from orders where order_status='process'";
             $run_pro = mysqli_query($con , $get_pro);

             echo "<table class='table'>
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Product SKU</th>
                    <th>Product Quantity</th>
                    <th>Tracking Link</th>
                    <th>Customer Email</th>
                  </tr>
                </thead>
                <tbody>";
       
             while($row_pro = mysqli_fetch_array($run_pro)){

               $product_quantity =$row_pro['product_quantity'];
               $tracking_link = $row_pro['tracking_link'];
               $order_status =$row_pro['order_status'];
               $customer_customer_id =$row_pro['customer_customer_id'];
               $inventory_product_id =$row_pro['inventory_product_id'];
               $customer_email = '';
               $product_name = '';
               $product_sku = '';
               
                    
                    $sql = "select * from customer where customer_id=$customer_customer_id";
                    $run_query = mysqli_query($con , $sql);

                    while($row_query = mysqli_fetch_array($run_query)){
                            $customer_email = $row_query['customer_email'];
                    }
                    
                    $sql = "select * from inventory where product_id=$inventory_product_id";
                    $run_query = mysqli_query($con , $sql);

                    while($row_query = mysqli_fetch_array($run_query)){
                            $product_name = $row_query['product_name'];
                            $product_sku = $row_query['product_sku'];
                    }

                    echo "
                        <tr>
                            <td>$product_name</td>
                            <td>$product_sku</td>
                            <td>$product_quantity</td>
                            <td>$tracking_link</td>
                            <td>$customer_email</td>
                        </tr>
                    ";
                    }

                    echo "</tbody>
                        </table>";
                
          ?>
         
          <!-- Supplier Details -->
           <h1>Completed Orders</h1>
              
           
           <?php
             global $con;
             $get_pro = "select * from orders where order_status='completed'";
             $run_pro = mysqli_query($con , $get_pro);

             echo "<table class='table'>
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Product SKU</th>
                    <th>Product Quantity</th>
                    <th>Tracking Link</th>
                    <th>Customer Email</th>
                  </tr>
                </thead>
                <tbody>";
       
             while($row_pro = mysqli_fetch_array($run_pro)){

               $product_quantity =$row_pro['product_quantity'];
               $tracking_link = $row_pro['tracking_link'];
               $order_status =$row_pro['order_status'];
               $customer_customer_id =$row_pro['customer_customer_id'];
               $inventory_product_id =$row_pro['inventory_product_id'];
               $customer_email = '';
               $product_name = '';
               $product_sku = '';
               
                    
                    $sql = "select * from customer where customer_id=$customer_customer_id";
                    $run_query = mysqli_query($con , $sql);

                    while($row_query = mysqli_fetch_array($run_query)){
                            $customer_email = $row_query['customer_email'];
                    }
                    
                    $sql = "select * from inventory where product_id=$inventory_product_id";
                    $run_query = mysqli_query($con , $sql);

                    while($row_query = mysqli_fetch_array($run_query)){
                            $product_name = $row_query['product_name'];
                            $product_sku = $row_query['product_sku'];
                    }

                    echo "
                        <tr>
                            <td>$product_name</td>
                            <td>$product_sku</td>
                            <td>$product_quantity</td>
                            <td>$tracking_link</td>
                            <td>$customer_email</td>
                        </tr>
                    ";
                    }

                    echo "</tbody>
                        </table>"; 
           
          ?>
            
        </div>  

      </div>

    </div>
  </body>
</html>
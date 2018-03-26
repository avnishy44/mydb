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
                <li class="nav-item active">
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
                <li class="nav-item">
                  <a class="nav-link" href="../all_orders/index.php">PENDING ORDERS/COMPLETED</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="index.php">MONTH BY MONTH ANALYSIS</a>
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
             $total_costprice = 0;
             $total_sellingprice = 0;
             $total_gst =0;
       
             while($row_pro = mysqli_fetch_array($run_pro)){

               $product_quantity =$row_pro['product_quantity'];
               $inventory_product_id =$row_pro['inventory_product_id'];
               $product_costprice=0;
               $product_sellingprice=0;              
                    
                    $sql = "select * from inventory where product_id=$inventory_product_id";
                    $run_query = mysqli_query($con , $sql);

                    while($row_query = mysqli_fetch_array($run_query)){
                            $local_product_costprice = (float)$row_query['product_costprice'];
                            $local_product_sellingprice = (float)$row_query['product_sellingprice'];
                            
                    }

                    $total_costprice = $local_product_costprice * $product_quantity;
                    $total_sellingprice = $local_product_sellingprice * $product_quantity;
            }     

                    $total_gst = 0.18 * $total_costprice;
                    $total_marketing_expense = 0.01 * $total_costprice;

                    $total_profit = $total_sellingprice - $total_costprice - $total_gst - $total_marketing_expense;


                    echo "<table class='table'>
                      <thead>
                      <tr>
                        <th>Analysis Point</th>
                        <th>Rupee</th>
                      </tr>
                    </thead>
                    <tbody>";
                    
                    echo "
                        <tr>
                            <td>Total Costprice</td>
                            <td>$total_costprice</td>
                        </tr>
                        <tr>
                            <td>Total Selling price</td>
                            <td>$total_sellingprice</td>
                        </tr>
                        <tr>
                            <td>Total GST (18%)</td>
                            <td>$total_gst</td>
                        </tr>
                        <tr>
                            <td>Total Marketing Expense (1%)</td>
                            <td>$total_marketing_expense</td>
                        </tr>
                        <tr>
                            <td>Total Profit</td>
                            <td>$total_profit</td>
                        </tr>
                    ";

                    echo "</tbody>
                        </table>";
                
          ?>
            
        </div>  

      </div>

    </div>
  </body>
</html>
<?php
  session_start();
  include("../includes/db.php");
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
    <link href="../includes/css/app.css" rel="stylesheet">
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
            <a class="dropdown-item" href="../login/user_profile.php">Profile</a>
            <a class="dropdown-item" href="#">Update Profile</a>
            <a class="dropdown-item" href="#">Change Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../login/logout.php">Log Out</a>
          </div>
        </div>
      </div>

      <br/><br/>

      <div class="body">
        <div class="col-3 sidenav">
          <nav class="navbar bg-dark" style="padding:0">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">INVENTORY</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="order/index.php">NEW ORDER</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="customer/customer.php">CUSTOMER DETAILS</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="all_orders/index.php">PENDING ORDERS/COMPLETED</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="analysis/index.php">MONTH BY MONTH ANALYSIS</a>
                </li>
                <hr/>
                <li class="nav-item">
                  <a class="nav-link" href="#">ADD MISCELLANEOUS EXPENSE</a>
                </li>
              </ul>
            </nav>
        </div>
        <div class="col-9 content">
            <!-- inventory details -->
            <a href="inventory/insert_product.php" class="btn btn-primary">Insert New Product</a>
              
           
           <?php
             global $con;
             $get_pro = "select * from inventory order by RAND() LIMIT 0,10";
             $run_pro = mysqli_query($con , $get_pro);

             echo "<table class='table'>
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Dimensions</th>
                    <th>Weight</th>
                    <th>Description</th>
                    <th>Colour</th>
                    <th>Stock</th>
                  </tr>
                </thead>
                <tbody>";
       
             while($row_pro = mysqli_fetch_array($run_pro)){

               $product_name =$row_pro['product_name'];
               $product_sku = $row_pro['product_sku'];
               $product_costprice =$row_pro['product_costprice'];
               $product_sellingprice =$row_pro['product_sellingprice'];
               $product_dimensions =$row_pro['product_dimensions'];
               $product_weight =$row_pro['product_weight'];
               $product_description =$row_pro['product_description'];
               $product_colour =$row_pro['product_colour'];
               $product_stock =$row_pro['product_stock'];
       
               echo "
                  <tr>
                 <td>$product_name</td>
                 <td>$product_sku</td>
                 <td>$product_costprice</td>
                 <td>$product_sellingprice</td>
                 <td>$product_dimensions</td>
                 <td>$product_weight</td>
                 <td>$product_description</td>
                 <td>$product_colour</td>
                 <td>$product_stock</td>
                 </tr>
               ";
             }

             echo "</tbody>
                  </table>";  
           
          ?>
         
          <!-- Supplier Details -->
           <a href="supplier/register.php" class="btn btn-primary">Add New Supplier</a>
              
           
           <?php
             global $con;
             $get_supplier = "select * from supplier order by RAND() LIMIT 0,10";
             $run_supplier = mysqli_query($con , $get_supplier);

             echo "<table class='table'>
                  <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Contact Details</th>
                    <th>Email</th>
                    <th>URL</th>
                  </tr>
                </thead>
                <tbody>";
       
             while($row_supplier = mysqli_fetch_array($run_supplier)){

               $supplier_companyname =$row_supplier['supplier_companyname'];
               $supplier_contact = $row_supplier['supplier_contact'];
               $supplier_email =$row_supplier['supplier_email'];
               $supplier_url =$row_supplier['supplier_url'];
               
       
               echo "
                  <tr>
                 <td>$supplier_companyname</td>
                 <td>$supplier_contact</td>
                 <td>$supplier_email</td>
                 <td>$supplier_url</td>
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
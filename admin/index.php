<?php
  session_start();
  include("../includes/db.php");

  //check for message in session
  if(isset($_SESSION['message'])){
  if($_SESSION['message'] !== ''){
    //echo $_SESSION['message'];
    $msg = $_SESSION['message'];
    include("../includes/script.php");
    alert($msg);
    $_SESSION['message'] = '';

  }}
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
            <a class="dropdown-item" href="../login/forgot.php">Change Password</a>
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

        
           
           <form action="index.php" method="POST" class="form-inline">
         
         <div class="col-6 col-form-label">
           <h3><label for="search">Enter product name:</label></h3>
         </div>
         
         <div class="col-4">
           <input type="text" name="search" class="form-control" placeholder="Enter details here">
         </div>
         
         <div class="col-2">
           <input type="submit" class="btn btn-primary" name="submit" value="Submit">
         </div>
         
       </form>

       <div class="col-9 ">
           <hr>
         </div>
   
   <?php
         if(isset($_POST['search'])){
           
           $search = $_POST['search'];
             
                 //Email is valid
                global $con;
                $get_p = "select * from inventory where product_name='$search'";
                $run_p = mysqli_query($con , $get_p);
   
                $count_customer = mysqli_num_rows($run_p);
   
               if($count_customer == 0){
   
                 echo "<div class='container'><h2>There is no product with name $search!</h2></div>";
   
               }
               else{
                 echo "
                   
                   <table class='table'>
                     <thead>
                     <tr>
                     <th>Product Name</th>
                     <th>SKU</th>
                     <th>Cost Price <br> (in Rupees) </br></th>
                     <th>Selling Price <br> (in Rupees) </br></th>
                     <th>Dimensions <br>(in cm)</th>
                     <th>Weight <br>(in gram)</th>
                     <th>Volumetric Weight<br>( cm<sup>3</sup>/5000)</th>
                     <th>Stock</th>
                     <th>Edit</th>
                   </tr>
                   </thead>
                   <tbody>";
                 while($row_pro = mysqli_fetch_array($run_p)){
   
                  $product_name =$row_pro['product_name'];
                  $product_sku = $row_pro['product_sku'];
                  $product_costprice =$row_pro['product_costprice'];
                  $product_sellingprice =$row_pro['product_sellingprice'];
                  $product_weight =$row_pro['product_weight'];
                  $product_length =$row_pro['product_length'];
                  $product_breadth =$row_pro['product_breadth'];
                  $product_height =$row_pro['product_height'];      
                  $product_volume =$row_pro['product_volume'];         
                  $product_stock =$row_pro['product_stock'];
   
                   
                  
                  
          
                  echo "
                  <tr>
                 <td>$product_name</td>
                 <td>$product_sku</td>
                 <td>$product_costprice</td>
                 <td>$product_sellingprice</td>
                 <td>$product_length&lowast;$product_breadth&lowast;$product_height</td>
                 <td>$product_weight</td>
                 <td>$product_volume</td>
                 <td>$product_stock</td>
                 <td><a href='inventory/edit_details.php?sku=$product_sku'>Edit</a></td>
                 </tr>
                  ";
                }
   
                echo "</tbody>
                     </table>
                     </div>
                     ";  
                 }

                }

            ?>
              
        
            
            <!-- inventory details -->
            
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>New product +</button>
            <div class='modal fade' id='myModal'>
                <div class='modal-dialog modal-dialog-centered modal-lg'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h4 class='modal-title'>New Product</h4>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                      <form action='inventory/insert_product.php' method='post' enctype='multipart/form-data' autocomplete='off'>
                        <div class='form-group'>
                          <label for='Name'>Name:</label>
                          <input type='text' class='form-control' id='name' placeholder='Enter Name' name='product_name'>
                        </div>
                        <div class='form-group'>
                          <label for='cp'>Cost Price:</label>
                          <input type='text' class='form-control' id='cp' placeholder='Enter cost price (in Rupee)' name='product_costprice'>
                        </div>
                        <div class='form-group'>
                          <input type='hidden' class='form-control' id='sku' value=$product_sku name='product_costprice'>
                        </div>
                        <div class='form-group'>
                          <label for='sp'>Selling Price:</label>
                          <input type='text' class='form-control' id='sp' placeholder='Enter selling price (in Rupee)'  name='product_sellingprice'>
                        </div>
                        <div class='form-group'>
                          <label for='quan'>Stock:</label>
                          <input type='text' class='form-control' id='quan' placeholder='Enter stock' name='product_stock'>
                        </div>
                        <div class='form-group'>
                          <label for='dimen'>Length:</label>
                          <input type='text' class='form-control' id='dimen' placeholder='Enter length (in cm)' name='product_length'>
                        </div>
                        <div class='form-group'>
                          <label for='dimen'>Breadth:</label>
                          <input type='text' class='form-control' id='dimen' placeholder='Enter breadth (in cm)' name='product_breadth'>
                        </div>
                        <div class='form-group'>
                          <label for='dimen'>Height:</label>
                          <input type='text' class='form-control' id='dimen' placeholder='Enter height (in cm)' name='product_height'>
                        </div>
                        <div class='form-group'>
                          <label for='weight'>Weight:</label>
                          <input type='text' class='form-control' id='weight' placeholder='Enter weight (in grams)' name='product_weight'>
                        </div>
                        <button type='submit' class='btn btn-primary'>Submit</button>                      
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>  
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            
          
            <!-- inventory details -->
          <!--
            <a href="inventory/insert_product.php" class="btn btn-primary">Insert New Product</a>
          -->    
           
           <?php
             global $con;
             $get_pro = "select * from inventory order by RAND() LIMIT 0,10";
             $run_pro = mysqli_query($con , $get_pro);

             echo "<table class='table'>
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Cost Price <br> (in Rupees) </br></th>
                    <th>Selling Price <br> (in Rupees) </br></th>
                    <th>Dimensions <br>(in cm)</th>
                    <th>Weight <br>(in gram)</th>
                    <th>Volumetric Weight<br>( cm<sup>3</sup>/5000)</th>
                    <th>Stock</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>";
       
             while($row_pro = mysqli_fetch_array($run_pro)){

               $product_name =$row_pro['product_name'];
               $product_sku = $row_pro['product_sku'];
               $product_costprice =$row_pro['product_costprice'];
               $product_sellingprice =$row_pro['product_sellingprice'];
               $product_weight =$row_pro['product_weight'];
               $product_length =$row_pro['product_length'];
               $product_breadth =$row_pro['product_breadth'];
               $product_height =$row_pro['product_height'];      
               $product_volume =$row_pro['product_volume'];         
               $product_stock =$row_pro['product_stock'];
               
              //  $modal= modal($product_sku);
       
               echo "
                  <tr>
                 <td>$product_name</td>
                 <td>$product_sku</td>
                 <td>$product_costprice</td>
                 <td>$product_sellingprice</td>
                 <td>$product_length&lowast;$product_breadth&lowast;$product_height</td>
                 <td>$product_weight</td>
                 <td>$product_volume</td>
                 <td>$product_stock</td>
                 <td><a href='inventory/edit_details.php?sku=$product_sku'>Edit</a></td>
                 </tr>
               ";
             }

             echo "</tbody>
                  </table>";  
           
          ?>
         
         <?php 
         /*
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
            
           */
          ?>
        </div>  

      </div>

    </div>
  </body>
</html>
<?php
  function modal($variable){
    return "
    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editModal'>Edit</button>
               <div class='modal fade' id='editModal'>
                   <div class='modal-dialog modal-dialog-centered modal-lg'>
                     <div class='modal-content'>
                       <div class='modal-header'>
                         <h4 class='modal-title'>Edit Product</h4>
                         <button type='button' class='close' data-dismiss='modal'>&times;</button>
                       </div>
                       <div class='modal-body'>
                         <form action='inventory/insert_product.php' method='post' enctype='multipart/form-data' autocomplete='off'>
                           <div class='form-group'>
                             <label for='Name'>Name:</label>
                             <input type='text' class='form-control' id='name' name='product_name'>
                           </div>
                           <div class='form-group'>
                             <label for='cp'>Cost Price:</label>
                             <input type='text' class='form-control' id='cp' placeholder='Enter cost price (in Rupee)' name='product_costprice'>
                           </div>
                           <div class='form-group'>
                             <input type='text' class='form-control'  value='$variable' name='product_costprice'>
                           </div>
                           <div class='form-group'>
                             <label for='sp'>Selling Price:</label>
                             <input type='text' class='form-control' id='sp' placeholder='Enter selling price (in Rupee)'  name='product_sellingprice'>
                           </div>
                           <div class='form-group'>
                             <label for='quan'>Stock:</label>
                             <input type='text' class='form-control' id='quan' placeholder='Enter stock' name='product_stock'>
                           </div>
                           <div class='form-group'>
                             <label for='dimen'>Length:</label>
                             <input type='text' class='form-control' id='dimen' placeholder='Enter length (in cm)' name='product_length'>
                           </div>
                           <div class='form-group'>
                             <label for='dimen'>Breadth:</label>
                             <input type='text' class='form-control' id='dimen' placeholder='Enter breadth (in cm)' name='product_breadth'>
                           </div>
                           <div class='form-group'>
                             <label for='dimen'>Height:</label>
                             <input type='text' class='form-control' id='dimen' placeholder='Enter height (in cm)' name='product_height'>
                           </div>
                           <div class='form-group'>
                             <label for='weight'>Weight:</label>
                             <input type='text' class='form-control' id='weight' placeholder='Enter weight (in grams)' name='product_weight'>
                           </div>
                           <button type='submit' class='btn btn-primary'>Submit</button>                      
                           <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>  
                         </form>
                       </div>
                     </div>
                   </div>
    ";
  }
?>
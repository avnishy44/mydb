<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
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
 
$mysqli = new mysqli("localhost", "root", "avnishy44", "mydb");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
        //set all the post variables
        //set supplier details
        
        $supplier_companyname = $mysqli->real_escape_string($_POST['supplier_companyname']);
        $order_timestamp = time();
        
        //set supplier address details
        $product_sku =$mysqli->real_escape_string($_POST['product_sku']);
        $product_quantity =$mysqli->real_escape_string($_POST['product_quantity']);
        $customer_email = $mysqli->real_escape_string($_POST['customer_email']);
        
        $tracking_link = "http://localhost/mydb/admin/order/order_status.php?token=$order_timestamp";

        $selection1 = "SELECT * FROM supplier WHERE supplier_companyname='$supplier_companyname'";
        $run_selection1 = mysqli_query($mysqli , $selection1);
                
                $supplier_id='';
                while($row_selection1 = mysqli_fetch_array($run_selection1)){
                    $supplier_id = $row_selection1['supplier_id'];   
                };
                
                $count1 = mysqli_num_rows($run_selection1);

        $selection2 = "SELECT * FROM inventory WHERE product_sku='$product_sku'";
        $run_selection2 = mysqli_query($mysqli , $selection2);
                
                $product_id='';
                while($row_selection2 = mysqli_fetch_array($run_selection2)){
                    $product_id = $row_selection2['product_id'];   
                };
                
                $count2 = mysqli_num_rows($run_selection2);
        
        $selection3 = "SELECT * FROM customer WHERE customer_email='$customer_email'";
        $run_selection3 = mysqli_query($mysqli , $selection3);
                
                $customer_id='';
                while($row_selection3 = mysqli_fetch_array($run_selection3)){
                    $customer_id = $row_selection3['customer_id'];   
                };
                
                $count3 = mysqli_num_rows($run_selection3);

        $str = $customer_email.''.$order_timestamp;
        $str = md5($str);
        $str = substr($str,0,10);
  
            if ($count2 > 0){
                
                if($count3 >0){

                    if($count1 >0){

                    //insert user data into database
                    $sql = "INSERT INTO orders (order_id,product_quantity,shipping_company,tracking_link,order_status,order_timestamp,customer_customer_id,inventory_product_id)
                    VALUES ('$str','$product_quantity','$supplier_companyname','$tracking_link','process','$order_timestamp','$customer_id','$product_id')";
                    
                        //if the query is successsful, redirect to welcome.php page, done!
                        if ($mysqli->query($sql) === true){
                            echo "<div class='alert alert-error'><h1>Order has been successfully placed !</h1></div>";
                        }
                        else {
                            echo "<div class='alert alert-error'><h1>Order could not be placed ! $mysqli->error</h1></div>";
                        }

                        $selection = "SELECT * FROM orders WHERE order_timestamp='$order_timestamp'";
                        $run_selection = mysqli_query($mysqli , $selection);
                                
                                $order_id='';
                                while($row_selection = mysqli_fetch_array($run_selection)){
                                    $order_id = $row_selection['order_id'];   
                                };

                        $sql = "INSERT INTO shipper (order_order_id,order_inventory_product_id,supplier_supplier_id)
                        VALUES ('$order_id','$product_id','$supplier_id')";
                        if ($mysqli->query($sql) === true){
                            echo "<div class='alert alert-error'><h1>Shipper is decided !</h1></div>";

                            
                            $_SESSION['message'] = "Your order tracking link is <br>".$tracking_link;
                            header("location:../../login/success.php");    
                            
                        }
                        else {
                            echo "<div class='alert alert-error'><h1>Shipper could not be decided ! $mysqli->error</h1></div>";
                        }
                        $mysqli->close();                 
                    }
                }
            }
}
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../../includes/css/form.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create New Order</h1>
    <form class="form" action="new_order.php" method="post" enctype="multipart/form-data" autocomplete="off">
      
      <input type="text" placeholder="Supplier Company Name" name="supplier_companyname" required />
      
      <input type="text" placeholder="Product SKU" name="product_sku"  required />
      <input type="text" placeholder="Product Quantity" name="product_quantity"  required />
      <?php 
      if (isset($_SESSION['email'])){
        echo "
        <input type='text' placeholder='Customer Email' name='customer_email' value=  '{$_SESSION['customer_email']}' required />
        ";  
      }
      else{
        echo"
        <input type='text' placeholder='Customer Email' name='customer_email' required />
        ";
      }

      ?>
      
      
      <input type="submit" value="Order" name="order" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
<?php
  session_start();
  include("../../includes/db1.php");

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
<html>
    <link href="../../includes/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300|Grand+Hotel" rel="stylesheet" type="text/css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   

    <body>
        <h1>hello</h!>
    </body>

    </html>
<?php
/*
echo $_POST['product_sku'];
if(isset($_POST['product_sku']) && $_POST['product_sku'] !==''){

    $product_sku = $_POST['product_sku'];

    $selection = "select from inventory where product_sku = $product_sku";
        $run_selection = mysqli_query($mysqli , $selection);
                
               
                //while($row = mysqli_fetch_array($run_selection)){
                    $product_name = $_POST['product_name'];
                    $product_costprice = $_POST['product_costprice'];
                    $product_sellingprice = $_POST['product_sellingprice'];
                    $product_length = $_POST['product_length'];
                    $product_breadth = $_POST['product_breadth'];
                    $product_height = $_POST['product_height'];
                    $product_stock = $_POST['product_stock'];
                    $product_weight = $_POST['product_weight'];
                    $product_volume = (float)$product_length * (float)$product_breadth * (float)$product_height / 5000;
                //};

    //insert user data into database
    $sql = "UPDATE inventory 
            SET product_name='$product_name',product_costprice='$product_costprice',
            product_sellingprice='$product_sellingprice',product_weight='$product_weight',product_length='$product_length',product_breadth='$product_breadth',
            product_height='$product_height',product_volume='$product_volume',product_stock='$product_stock'
            where product_sku='$product_sku'";
 
     //if the query is successsful, redirect to welcome.php page, done!
     if ($mysqli->query($sql) === true){
         //echo "<div class='alert alert-error'><h1>Product $product_name successfully added to database !</h1></div>";
         $_SESSION['message'] = "Product $product_name successfully added to database !";
         header("location:../index.php");
     }
     else {
         //echo "<div class='alert alert-error'><h1>Product could not be added to the database! $mysqli->error</h1></div>";
         $_SESSION['message'] = "Product $product_name could not be added to database !";
         header("location:../index.php");
     }
     $mysqli->close();          

}

*/
?>

<?php
echo "hi";

if(isset($_POST['product_sku']) && $_POST['product_sku'] !==''){
    echo "hi";
    $product_sku = $_POST['product_sku'];

    $selection = "select from inventory where product_sku = $product_sku";
        $run_selection = mysqli_query($mysqli , $selection);
                
               
                //while($row = mysqli_fetch_array($run_selection)){
                    $product_name = $_POST['product_name'];
                    $product_costprice = $_POST['product_costprice'];
                    $product_sellingprice = $_POST['product_sellingprice'];
                    $product_length = $_POST['product_length'];
                    $product_breadth = $_POST['product_breadth'];
                    $product_height = $_POST['product_height'];
                    $product_stock = $_POST['product_stock'];
                    $product_weight = $_POST['product_weight'];
                    $product_volume = (float)$product_length * (float)$product_breadth * (float)$product_height / 5000;
                //};

    //insert user data into database
    $sql = "UPDATE inventory 
            SET product_name='$product_name',product_costprice='$product_costprice',
            product_sellingprice='$product_sellingprice',product_weight='$product_weight',product_length='$product_length',product_breadth='$product_breadth',
            product_height='$product_height',product_volume='$product_volume',product_stock='$product_stock'
            where product_sku='$product_sku'";
 
     //if the query is successsful, redirect to welcome.php page, done!
     if ($mysqli->query($sql) === true){
         //echo "<div class='alert alert-error'><h1>Product $product_name successfully updated in database !</h1></div>";
         $_SESSION['message'] = "Product $product_name successfully updated in database !";
         header("location:../index.php");
     }
     else {
         //echo "<div class='alert alert-error'><h1>Product could not be uppdted in the database! $mysqli->error</h1></div>";
         $_SESSION['message'] = "Product $product_name could not be updated in database !";
         header("location:../index.php");
     }
     $mysqli->close();          

}


?>

<?php

if(isset($_GET['sku']) && $_GET['sku']!==''){
    $product_sku = $_GET['sku'];
    echo $product_sku;
    $selection = "select * from inventory where product_sku ='$product_sku'";
        $run_selection = $mysqli->query( $selection);
               
        $product_name = '';
        $product_costprice = '';
        $product_sellingprice = '';
        $product_length = '';
        $product_breadth = '';
        $product_height = '';
        $product_stock = '';
        $product_weight = '';

                while($row = mysqli_fetch_array($run_selection)){
                    $product_name = $row['product_name'];
                    $product_costprice = $row['product_costprice'];
                    $product_sellingprice = $row['product_sellingprice'];
                    $product_length = $row['product_length'];
                    $product_breadth = $row['product_breadth'];
                    $product_height = $row['product_height'];
                    $product_stock = $row['product_stock'];
                    $product_weight = $row['product_weight'];
                    $product_volume = (float)$product_length * (float)$product_breadth * (float)$product_height / 5000;
                
                    
                };
                
               $variable =  "
                <html>
                <body>
                <div  id='myModal'>
                <div class='modal-dialog modal-dialog-centered modal-lg'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h4 class='modal-title'>New Product</h4>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                      <form action='edit_details.php' method='post' enctype='multipart/form-data' autocomplete='off'>
                        <div class='form-group'>
                          <label for='Name'>Name:</label>
                          <input type='text' class='form-control' id='name' value='$product_name' name='product_name'>
                        </div>
                        <div class='form-group'>
                          <label for='cp'>Cost Price:</label>
                          <input type='text' class='form-control' id='cp' value='$product_costprice' name='product_costprice'>
                        </div>
                        <div class='form-group'>
                          
                          <input type='hidden' class='form-control' id='sku' value='$product_sku' name='product_sku'>
                        </div>
                        <div class='form-group'>
                          <label for='sp'>Selling Price:</label>
                          <input type='text' class='form-control' id='sp' value='$product_sellingprice'  name='product_sellingprice'>
                        </div>
                        <div class='form-group'>
                          <label for='quan'>Stock:</label>
                          <input type='text' class='form-control' id='quan' value='$product_stock' name='product_stock'>
                        </div>
                        <div class='form-group'>
                          <label for='dimen'>Length:</label>
                          <input type='text' class='form-control' id='dimen' value='$product_length' name='product_length'>
                        </div>
                        <div class='form-group'>
                          <label for='dimen'>Breadth:</label>
                          <input type='text' class='form-control' id='dimen' value='$product_breadth' name='product_breadth'>
                        </div>
                        <div class='form-group'>
                          <label for='dimen'>Height:</label>
                          <input type='text' class='form-control' id='dimen' value='$product_height' name='product_height'>
                        </div>
                        <div class='form-group'>
                          <label for='weight'>Weight:</label>
                          <input type='text' class='form-control' id='weight' value='$product_weight' name='product_weight'>
                        </div>
                        <button type='submit' class='btn btn-primary'>Submit</button>                      
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>  
                      </form>
                    </div>
                  </div>
                </div>
                </body>
                </html>";

                echo $variable;

                $_GET['sku']='';
}

?>

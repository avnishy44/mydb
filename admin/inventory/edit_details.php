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


?>

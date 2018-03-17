<!DOCTYPE html>
<?php
  session_start();
  include("includes/db.php")
 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles/style.css" media="all" />
  <title>My Online Shop</title>
</head>
<body>

  <!-- Main container starts here -->
  <div class="main_wrapper">

    <!-- Header starts here -->

    <!-- Header ends here -->

    <!-- Navigation bar starts here -->
    
    <!-- Navigation bar ends here -->

    <!-- Content Wrapper starts here -->

        <div id="products_box">
          <?php 
            
                global $con;
                $get_pro = "select * from inventory order by RAND() LIMIT 0,6";
                $run_pro = mysqli_query($con , $get_pro);

                while($row_pro = mysqli_fetch_array($run_pro)){

                    $product_name = $row_pro['product_name'];
                    $product_costprice = $row_pro['product_costprice'];
                    $product_quantity = $row_pro['product_quantity'];
                    $product_sellingprice = $row_pro['product_sellingprice'];
                    $product_dimensions = $row_pro['product_dimensions'];
                    $product_weight = $row_pro['product_weight'];
                
                echo "
                    <div id = 'single_product'>
                    <h3>$product_name</h3>
                    <h3>$product_costprice</h3>
                    <h3>$product_quantity</h3>
                    <h3>$product_sellingprice</h3>
                    <h3>$product_dimensions</h3>
                    <h3>$product_weight</h3>
                    
                    </div>
                ";
            }
        ?>
        </div>
      </div>

    </div>
    <!-- Content Wrapper ends here -->

    <!-- Footer starts here -->
    <div id="footer">

      <h2 style="text-align:center; padding-top:30px;">&copy; 2018 by Avnish Yadav</h2>

    </div>
    <!-- Footer ends here -->

  </div>
  <!-- Main container starts here -->
</body>
</html>

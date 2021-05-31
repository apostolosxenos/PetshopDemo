 <?php

    require('admin_header.php');

    if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {

        $product_id = $_GET['product_id'];

        $sql = "SELECT * FROM `products` WHERE `product_id` = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param('i', $product_id);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();

        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $category = $row['category'];
            $description = $row['description'];
            $image = $row['image'];
            $stock = $row['stock'];
            $price = $row['price'];
        }
    }

    $categories = get_enums($db, 'products', 'category');
    ?>

 <!DOCTYPE html>
 <html lang="gr">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Επεξεργασία Προϊόντος</title>
     <!-- <link rel="stylesheet" href="css/upload_product_image.css"> -->
 </head>

 <body>
     <div class="content-wrapper">

         <div class="container">

             <div class="row">

                 <div class="col-lg">

                     <div class="card mt-1">

                         <div class="card-body">



                             <form method="POST" action="<?php echo htmlspecialchars('product_check.php') ?>" enctype="multipart/form-data">



                                 <div class="form-group">
                                     <label for="device">
                                         <h6>Product ID</h6>
                                     </label>
                                     <input type="text" name="product_id" class="form-control" style="width:max-content" value="<?php echo $product_id ?>" readonly>
                                 </div>



                                 <div class="form-group">
                                     <label for="device">
                                         <h6>Ονομασία</h6>
                                     </label>
                                     <input type="text" name="name" class="form-control" value="<?php echo $name ?>" required>
                                 </div>



                                 <div class="form-group">
                                     <label for="category">
                                         <h6>Κατηγορία</h6>
                                     </label>

                                     <select class="form-control" style="width:max-content" id='<?php echo $product_id ?>'>
                                         <?php foreach ($categories as $c) { ?>
                                             <?php if ($category === $c) { ?>
                                                 <option value="<?php echo $c ?>" selected><?php echo $c ?></option>
                                             <?php } else { ?>
                                                 <option value="<?php echo $c ?>"><?php echo $c ?></option>
                                         <?php }
                                            } ?>
                                     </select>
                                 </div>



                                 <div class="form-group">
                                     <label for="description">
                                         <h6>Περιγραφή</h6>
                                     </label>
                                     <textarea name="description" class="form-control" rows=10 required><?php echo $description ?></textarea>
                                 </div>


                                 <div form-group>

                                     <label for="img">
                                         <h6>Φωτογραφία</h6>
                                     </label>


                                     <div class="preview">
                                         <img src="<?php echo DOMAIN . $image; ?>" id="img" width="100">
                                         <div class="mt-2 mb-4">
                                             <input type="file" id="file" name="file" />
                                             <input type="button" class="button" value="Προεπισκόπηση" id="img_upload_btn">
                                         </div>

                                     </div>
                                 </div>





                                 <div class="form-group">
                                     <label for="stock">
                                         <h6>Απόθεμα</h6>
                                     </label>
                                     <input type="text" name="stock" style="width:max-content" class="form-control" value="<?php echo $stock ?>" required>
                                 </div>


                                 <div class="form-group">
                                     <label for="price">
                                         <h6>Τιμή</h6>
                                     </label>
                                     <input type="text" name="price" style="width:max-content" class="form-control" value="<?php echo nf($price) ?>" required>
                                 </div>


                                 <div class="form-group">
                                     <input class="btn btn-primary" type="submit" name="edit-product" value="Επεξεργασία" style="float: right">
                                 </div>


                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <script src="js/upload_image.js"></script>

 </body>

 </html>
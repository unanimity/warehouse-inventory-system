<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $users = find_all('users');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));

     /**/
       $p_discription  = remove_junk($db->escape($_POST['saleing-discription']));
       $p_type  = remove_junk($db->escape($_POST['saleing-type']));
       $p_value  = remove_junk($db->escape($_POST['saleing-value']));
       $p_dimencion  = remove_junk($db->escape($_POST['saleing-dimencion']));
       $p_owner  = remove_junk($db->escape($_POST['saleing-owner']));
       $p_cell  = remove_junk($db->escape($_POST['saleing-cell']));
       $p_code  = remove_junk($db->escape($_POST['saleing-code']));


     /**/
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date,discription,value,dimension,type,owner,cell,code";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}', '{$p_discription}', '{$p_value}', '{$p_dimencion}', '{$p_type}', '{$p_owner}', '{$p_cell}', '{$p_code}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Product Title">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Select Product Photo</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity" value="0">
                  </div>
                 </div>



                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="buying-price" placeholder="Buying Price" value="0">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>


                   <div class="col-md-4">
                       <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                           <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price" value="0">
                           <span class="input-group-addon">.00</span>
                       </div>
                   </div>




                   <div class="col-md-12">
                       <label>Description</label>
                       <div class="input-group">
                       <textarea class="form-control  "  name="saleing-discription" rows="3"></textarea>
                       </div>
                   </div>



                   <div class="col-md-12">
                       <label for="exampleFormControlSelect1">Type</label>
                       <select class="form-control" id="exampleFormControlSelect1" name="saleing-type" >
                           <option>Component</option>
                           <option>Device</option>
                           <option>Material</option>
                           <option>Liquid</option>
                       </select>
                   </div>


                   <div class="col-md-12">
                       <div class="input-group">
                           <label>Value</label>
                           <input type="number" class="form-control" name="saleing-value" placeholder="value" value="0">
                       </div>
                       <label for="exampleFormControlSelectdimencion10">Dimencion</label>
                       <select class="form-control" id="exampleFormControlSelectdimencion10" name="saleing-dimencion"  >
                           <option>none</option>
                           <option>pF</option>
                           <option>m</option>
                           <option>kg</option>
                           <option>g</option>
                           <option>l</option>
                           <option>V</option>
                       </select>
                   </div>



                   <div class="col-md-12">
                       <label for="saleing-owner">Owner</label>
                       <select class="form-control" name="saleing-owner">
                           <?php foreach ($user as $users ):?>
                               <option value="<?php echo $user['id'];?>"><?php echo ucwords($user['name']);?></option>
                           <?php endforeach;?>
                       </select>
                   </div>


                   <div class="col-md-12">
                       <div class="input-group">
                           <label >Cell</label>
                           <input type="text" class="form-control" name="saleing-cell"  value=" ">

                       </div>
                   </div>


                   <div class="col-md-12">
                       <div class="input-group">
                           <label >Code</label>
                           <input type="text" class="form-control" name="saleing-code"  value="0">

                       </div>
                   </div>



               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>

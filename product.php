<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
$all_categories = find_all('categories');
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
          <div class="col-md-6">
              <select class="form-control" name="product-categorie">
                  <option value="">Select Product Category</option>
                  <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                          <?php echo $cat['name'] ?></option>
                  <?php endforeach; ?>
              </select>
          </div>

          <form class="navbar-form navbar-left">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
          </form>

        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Product Title </th>
                  <th class="text-center" style="width: 10%;"> Categorie </th>
                  <th class="text-center" style="width: 10%;"> Type </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Discription</th>
                  <th class="text-center" style="width: 10%;"> Value </th>
                  <th class="text-center"  > Dimension </th>
                  <th class="text-center"  > Cell </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <a href="<?php echo  "/edit_product.php?id=".remove_junk($product['id']); ?>"><?php echo remove_junk($product['name']); ?></a></td>
                  <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                  <td class="text-center"> <?php echo remove_junk($product['type']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['discription']); ?>
                    <a  href="<?php  echo remove_junk($product['datasheet']); ?>">

                        <?php if ($product['datasheet'])  echo "<i class=\"glyphicon glyphicon glyphicon-share-alt\"></i>" ; ?>

                    </a>
                </td>
                  <td class="text-center"> <?php echo remove_junk($product['value']); ?></td>
                  <td class="text-center"> <?php echo remove_junk($product['dimension']); ?></td>
                  <td class="text-center"> <?php echo remove_junk($product['cell']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?><?php echo read_date($product['owner']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>


            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>


        </div>
      </div>

  </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

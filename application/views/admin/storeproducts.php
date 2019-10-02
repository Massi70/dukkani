<div class="main">
    <div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Grocery &amp; Stores</h2>
                <?php if(isset($msg)) echo $msg; ?>
			 <table class="table store-table">
 <thead>

 <th>Products</th>
 <th class="viewTable">Products Action</th>

 </thead>

 <?php 
   if(is_array($storeproducts) && count($storeproducts)>0){
        $i=1;
        foreach($storeproducts as $data){ 
           // echo '<pre>';print_r($data);
   ?>
 
 <tr>
  <td><?php echo $data['english_name'];?></td>
<td  class="viewTable">
 <a href="<?php echo base_url();?>admin/Products/productDetailsByStore/<?php echo $data['id'];?>"><i class="fa fa-angle-right"></i></a> 
 &nbsp; &nbsp;
 <a href="<?php echo base_url();?>admin/Products/editProduct/<?php echo $data['id'];?>"><i class="fa fa-edit"></i></a>
  &nbsp; &nbsp;
 <a href="<?php echo base_url();?>admin/Products/deleteProductsByStore/<?php echo $data['id'];?>/<?php echo $data['store_id'];?>" onclick="return confirm('Are you sure to delete this Product?');"><i class="fa fa-trash"></i></a>  
 &nbsp; &nbsp;
 <a href="<?php echo base_url();?>admin/Products/flavors/<?php echo $data['id'];?>"><i>Add Flavours</i></a>
 &nbsp; &nbsp;
 <a href="<?php echo base_url();?>admin/Products/weight/<?php echo $data['id'];?>"><i>Add Weight</i></a>
 
 </td>
 </tr>

<?php
        $i++;
        }
    }else{
        ?>
        <td colspan="3" align="center"><?php echo '<b>No Products Found</b>';?></td>
<?php
    }

 ?>

</table> 

<div class="bottom">
<a href="<?php echo base_url();?>admin/Products/addProduct/" class="btn btn-lg btn-primary btn-block button buttonLg">add new Product</a>

</div> 


            </div>
        </div>
	</div>
        <!-- /container -->
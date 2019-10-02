    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Grocery &amp; Stores</h2>
      <?php if(isset($msg)) echo $msg; ?>
               
<table class="table store-table">
<thead>
  <th>#</th>
  <th>Store</th>
  <th>StoreName </th>
  <th>Address</th>
  <th>Contact Name</th>
  <th>Phone</th>
  <th>Products</th>
  <th>Store Action</th>
</thead>
   <?php 
   if(is_array($stores) && count($stores)>0){
        $i=1;
        foreach($stores as $data){ 
          //var_dump($data)
   ?>
   <tr>
     <td><?php echo $i;?></td>
     <td><img src="<?php echo $data['image'];?>" /></td>
     <td> <?php echo $data['store_name'];?></td>
     <td> <?php echo $data['address'];?></td>
     <td> <?php echo $data['contact_name']; ?></td>
     <td> <?php echo $data['phone_number']; ?></td>

     <td>
     <a href="<?php echo base_url();?>admin/Products/getProductsByStore/<?php echo $data['id'];?>"><i class="fa fa-angle-right"></i></a> 
     &nbsp; &nbsp;
     <!-- <a href="javascript:void"><i class="fa fa-edit"></i></a>-->
      &nbsp; &nbsp
     <a href="<?php echo base_url();?>admin/Products/deleteAllProductsByStore/<?php echo $data['id'];?>" onclick="return confirm('Are you sure to delete the Products in Store?');"><i class="fa fa-trash"></i></a>  </td>

     <td>
     <a href="<?php echo base_url();?>admin/Stores/storeDetailsById/<?php echo $data['id'];?>"><i class="fa fa-angle-right"></i></a> 
     &nbsp; &nbsp;
     <a href="<?php echo base_url();?>admin/Stores/storeEdit/<?php echo $data['id'];?>"><i class="fa fa-edit"></i></a>
      &nbsp; &nbsp;
     <a href="<?php echo base_url();?>admin/Stores/deleteStoreById/<?php echo $data['id'];?>" onclick="return confirm('Are you sure to delete this Store?');""><i class="fa fa-trash"></i></a>  </td>   
   </tr>

   <?php
        $i++;
        }
    }else{
        ?>
        <td colspan="7" align="center"><?php echo '<b>No Stores Found</b>';?></td>
<?php
    }

 ?>
 

</table> 

<div class="bottom">
<a href="<?php echo base_url(); ?>admin/Stores/addStore/" class="btn btn-lg btn-primary btn-block button buttonLg">add new store</a>

</div> 


            </div>
        </div>
	</div>
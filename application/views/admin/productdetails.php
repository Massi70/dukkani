<div class="main">
    <div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
      <h2 class="title">Product Details</h2>
                <?php //if(isset($msg)) echo $msg; ?>
       <table class="table store-table" border="0" width="400px" align="center">
 <thead>


 </thead>

 <?php 
 //echo '<pre>';print_r($ProductDetails);exit;
   if(is_array($ProductDetails) && count($ProductDetails)>0){
        $i=0;
       // foreach($ProductDetails as $data){ 
            //echo '<pre>';print_r($ProductDetails);
   ?>
 
 <tr>
  <th>Store Name : </th>
  <td><?php echo $ProductDetails['store_name'];?></td> 
 </tr>

 <tr>
  <th>Product Name : </th>
  <td><?php echo $ProductDetails['english_name'];?></td> 
 </tr>

 <tr>
  <th>Product Price : </th>
  <td><?php echo 'AED '. $ProductDetails['price'];?></td> 
 </tr>

 <tr>
  <th>Product Description : </th>
  <td><?php echo $ProductDetails['description'];?></td> 
 </tr>

  <center><div class="imgsecpro-btn">
      
     <!--  <button type="button" class="btn button buttonMd buttondark">ADD Image</button> -->
      <img src="<?php echo $ProductDetails['image'];?>" alt="product">
      
  </div></center>
 <tr>
  <th>Product Weight(s) : </th>
  <td>
<?php
       foreach ($ProductDetails['Size'] as $value) {
        // echo '<pre>';print_r($value);
  ?>
<?php echo $value['size']. " , ";?>
       

<?php
       }
      ?>
      </td> 
</tr>
 <tr>
  <th>Product Flavor(s) : </th>
  <td>
<?php
       foreach ($ProductDetails['Flavor'] as $value1) {
        // echo '<pre>';print_r($value);
  ?>
<?php echo $value1['flavor']. " , ";?>
       

<?php
       }
      ?>
      </td> 
</tr>

<?php
    }

    $i++;
    //exit;

 ?>

</table> 


            </div>
        </div>
  </div>
        <!-- /container -->
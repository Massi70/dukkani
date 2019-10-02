<div class="main">
    <div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
      <h2 class="title">Store Details</h2>
                <?php //if(isset($msg)) echo $msg; ?>
       <table class="table store-table" border="0" width="400px" align="center">
 <thead>


 </thead>

 <?php 
// echo '<pre>';print_r($storeDetails);exit;
   if(is_array($storeDetails) && count($storeDetails)>0){
      //  $i=1;
       // foreach($ProductDetails as $data){ 
            //echo '<pre>';print_r($ProductDetails);
   ?>
 
 <tr>
  <th>Store Name : </th>
  <td><?php echo $storeDetails['store_name'];?></td> 
 </tr>

 <tr>
  <th>Store Contact: </th>
  <td><?php echo $storeDetails['contact_name'];?></td> 
 </tr>

 <tr>
  <th>Store Address : </th>
  <td><?php echo $storeDetails['address'];?></td> 
 </tr>

 <tr>
  <th>Store Phone Number : </th>
  <td><?php echo $storeDetails['phone_number'];?></td> 
 </tr>

 <tr>
  <th>Product Description : </th>
  <td><?php echo $storeDetails['description'];?></td> 
 </tr>

  <center><div class="imgsecpro-btn">
      
     <!--  <button type="button" class="btn button buttonMd buttondark">ADD Image</button> -->
      <img src="<?php echo $storeDetails['image'];?>" alt="product">
      
  </div></center>

<?php
       // }
    }

 ?>

</table> 


            </div>
        </div>
  </div>
        <!-- /container -->
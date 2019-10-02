<?php 
$userAdmin=$this->session->userdata(APP_NAME.'_admin');
//if(isset($userAdmin))
   //echo('Admin'.$userAdmin);
        //if($this->session->userdata(APP_NAME.'_admin')!=false){
?>
<script type='text/javascript' language='javascript'>
function changeStatus(status,order_number,admin_id){
  //alert(admin_id);
  $.ajax({
      url : '<?php echo base_url();?>admin/Orders/changeStatus/',
      type:'post',
      data: {status: status,order_number:order_number,admin_id:admin_id},
      dataType: 'text',
      success: function(msg){
       // alert(data);
          $('#result').html(msg);
          $('#admin_update').show();
        } // End of success function of ajax form
      }); // End of ajax call 
}
</script>
  <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Order Managements</h2>
      <center><span id="result" style="color:#F00"> </span></center>
<table class="table order-deatils-list-table">
 <thead>
 <tr>
 <th>&nbsp;</th>
 <th>Name</th>
 <th>Order Id</th>
 <th>Address</th>
 <th class="text-center">Items</th>
  <th class="text-center">Qty</th>
  <th class="text-center">Price Per Item</th>
    <th class="text-center">Total Price</th>
    <th>&nbsp;</th>
</tr>
 </thead>

 <?php 
   if(is_array($orderUserdetails) && count($orderUserdetails)>0){
        foreach($orderUserdetails as $user){ 
          //echo '<pre>';print_r($user);
      
   ?>
 
 <tr>
 <td><img src="<?php echo $user['Userimage']; ?>" /></td>
  <td class="noborder text-left"><?php echo $user['UserName']; ?></td>
 <td class="noborder text-left"><?php echo $user['order_number']; ?></td>
  <td class="noborder text-left"><?php echo $user['street_address'] ." ". $user['villa_address']; ?></td>
</tr>
  <?php 
    }
  }

 $price = 0;
 $total = 0;
 // echo '<pre>';print_r($orderdetails);exit();

   if(is_array($orderdetails) && count($orderdetails)>0){
        $i=0;
        foreach($orderdetails as $data){ 
          //echo '<pre>';print_r($data);
      
   ?>
<tr>
  <td colspan="4" class="noborders">&nbsp; </td>
  <td><?php echo $data['english_name']; ?></td>
  <td><?php echo $data['quantity']; ?></td>
   <td><?php echo $data['product_price']; ?></td>
    <td><?php echo $data['price_per_quantity']; ?></td>
 <?php 
 $price += ($data['product_price'] * $data['quantity']);
 $total = $price;
 ?>


 </tr>

<?php 
    }
    $i++;
?>

<tr>
<td colspan="6" class="noborders">&nbsp; </td>
 <td> <b>Total</b></td>
  <td><?php echo "<b>AED ".$total."</b>"; ?></td>
</tr>

<tr>
<td colspan="3" class="noborders">&nbsp; </td>
 <?php if($data['admin_id'] > 0){
  if($userAdmin == '1'){
  ?>
 <td id="admin_update"> <b> Last Updated Admin id is : <?php echo $data['admin_id'];?></b></td>
 <?php }
 } ?>
</tr>
<p align="right">
chage Status : <select name="status" id="status" onchange="changeStatus(this.value,'<?php echo $data['order_number'];?>','<?php echo $userAdmin;?>')" >
<option value="">Select Status:</option>
<option value="pending">Pending</option>
<option value="delivered">Delivered</option>
<option value="cancelled">Cancelled</option>
</select>
</p>
<?php 
  }
?>
<h5> <a href="<?php echo base_url();?>admin/Orders/export/<?php echo $data['order_number'];?>">Download Order</a></h5>

</table>               
			   

            </div>
        </div>
	</div>
        <!-- /container -->
<script type='text/javascript' language='javascript'>
function pending(){
  $.ajax({
      url : '<?php echo base_url();?>admin/Orders/pendingOrders/',
      type:'post',
      //data: {status: status,order_number:order_number},
      dataType: 'text',
      success: function(msg){
       // alert(data);
         // $('#result').html(msg);
        } // End of success function of ajax form
      }); // End of ajax call 
}

function today(){
  $.ajax({
      url : '<?php echo base_url();?>admin/Orders/todayOrders/',
      type:'post',
      //data: {status: status,order_number:order_number},
      dataType: 'text',
      success: function(msg){
       // alert(data);
         // $('#result').html(msg);
        } // End of success function of ajax form
      }); // End of ajax call 
}

function cancelled(){
  $.ajax({
      url : '<?php echo base_url();?>admin/Orders/cancelledOrders/',
      type:'post',
      //data: {status: status,order_number:order_number},
      dataType: 'text',
      success: function(msg){
       // alert(data);
         // $('#result').html(msg);
        } // End of success function of ajax form
      }); // End of ajax call 
}

function delivered(){
  $.ajax({
      url : '<?php echo base_url();?>admin/Orders/deliveredOrders/',
      type:'post',
      //data: {status: status,order_number:order_number},
      dataType: 'text',
      success: function(msg){
       // alert(data);
         // $('#result').html(msg);
        } // End of success function of ajax form
      }); // End of ajax call 
}
</script>

    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Orders Management</h2>
            <?php //echo '<pre>';print_r($orders);exit();?>
            <div  id="orders">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs user-tab" role="tablist">
    <li role="presentation" class="active"><a href="#today-order" aria-controls="today-order" role="tab" data-toggle="tab" onClick="today();">Today's Order</a></li>
    <li role="presentation"><a href="#delivered" aria-controls="delivered" role="tab" data-toggle="tab" onClick="delivered();">Delivered</a></li>
    <li role="presentation"><a href="#cancelled" aria-controls="canceled" role="tab" data-toggle="tab" onClick="cancelled();">Cancelled</a></li>
 <li role="presentation"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab" onClick="pending();">Pending</a></li>
  </ul>
  
  </div>
            
            </div>
         
         <div class="clearfix"></div>   
            
             <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="today-order">
 <table class="table orders-table">
 <thead>
<th class="imgTable">&nbsp;</th>
 <th class="nameTable">Name</th>
 <th class="storeTable">Store</th>
 <th class="idTable">Order Id</th>
 <th class="orderTable">Orders</th>
 <th class="viewTable">&nbsp;</th>

 </thead>

 <?php 
   if(is_array($orders) && count($orders)>0){
        $i=1;
        foreach($orders as $data){ 
          //echo '<pre>';print_r($data);exit();
      
   ?>
 <tr>
 <td><img src="<?php echo $data['Userimage'];?>" /></td>
 <td><?php echo $data['english_name'];?></td>
  <td><img src="<?php echo $data['Storeimage'];?>"/></td>
 <td><?php echo $data['order_number'];?></td>
 <td><?php echo $data['TotalOrders'];?></td>
 <td><a href="<?php echo base_url();?>admin/Orders/getOrderByNumber/<?php echo $data['order_number'];?>"><i class="fa fa-angle-right"></i></a> </td>
 
 </tr>
 
 <?php
        }
    }
 ?>

</table>
    
    </div>
    <div role="tabpanel" class="tab-pane" id="delivered">
     <table class="table orders-table">
 <thead>
<th class="imgTable">&nbsp;</th>
 <th class="nameTable">Name</th>
 <th class="storeTable">Store</th>
 <th class="idTable">Order Id</th>
 <th class="orderTable">Orders</th>
 <th class="viewTable">&nbsp;</th>

 </thead>

  <?php 
   if(is_array($deliveredOrders) && count($deliveredOrders)>0){
        $i=1;
        foreach($deliveredOrders as $delivered){ 
          //echo '<pre>';print_r($data);exit();
      
   ?>
 
 <tr>
  <td><img src="<?php echo $delivered['Userimage'];?>" /></td>
 <td><?php echo $delivered['english_name'];?></td>
  <td><img src="<?php echo $delivered['Storeimage'];?>"/></td>
 <td><?php echo $delivered['order_number'];?></td>
 <td><?php echo $delivered['TotalOrders'];?></td>
 <td><a href="<?php echo base_url();?>admin/Orders/getOrderByNumber/<?php echo $delivered['order_number'];?>"><i class="fa fa-angle-right"></i></a> </td>
 
 </tr>
 <?php
        }
    }
 ?>
</table>
    
    </div>
    
    <div role="tabpanel" class="tab-pane" id="cancelled">
  <table class="table orders-table">
 <thead>
<th class="imgTable">&nbsp;</th>
 <th class="nameTable">Name</th>
 <th class="storeTable">Store</th>
 <th class="idTable">Order Id</th>
 <th class="orderTable">Orders</th>
 <th class="viewTable">&nbsp;</th>

 </thead>
  <?php 
   if(is_array($cancelledOrders) && count($cancelledOrders)>0){
        $i=1;
        foreach($cancelledOrders as $cancelled){ 
          //echo '<pre>';print_r($data);exit();
      
   ?>
 <tr>
  <td><img src="<?php echo $cancelled['Userimage'];?>" /></td>
 <td><?php echo $cancelled['english_name'];?></td>
  <td><img src="<?php echo $cancelled['Storeimage'];?>"/></td>
 <td><?php echo $cancelled['order_number'];?></td>
 <td><?php echo $cancelled['TotalOrders'];?></td>
 <td><a href="<?php echo base_url();?>admin/Orders/getOrderByNumber/<?php echo $cancelled['order_number'];?>"><i class="fa fa-angle-right"></i></a> </td>
 
 </tr>
 <?php
        }
    }
 ?>

</table>
    
    </div>
     <div role="tabpanel" class="tab-pane" id="pending">
   <table class="table orders-table">
 <thead>
<th class="imgTable">&nbsp;</th>
 <th class="nameTable">Name</th>
 <th class="storeTable">Store</th>
 <th class="idTable">Order Id</th>
 <th class="orderTable">Orders</th>
 <th class="viewTable">&nbsp;</th>

 </thead>
 <?php 
   if(is_array($pendingOrders) && count($pendingOrders)>0){
        $i=1;
        foreach($pendingOrders as $pending){ 
          //echo '<pre>';print_r($data);exit();
      
   ?>
 <tr>
  <td><img src="<?php echo $pending['Userimage'];?>" /></td>
 <td><?php echo $pending['english_name'];?></td>
  <td><img src="<?php echo $pending['Storeimage'];?>"/></td>
 <td><?php echo $pending['order_number'];?></td>
 <td><?php echo $pending['TotalOrders'];?></td>
 <td><a href="<?php echo base_url();?>admin/Orders/getOrderByNumber/<?php echo $pending['order_number'];?>"><i class="fa fa-angle-right"></i></a> </td>
 
 </tr>
 <?php
        }
    }
 ?>

</table>
    
    </div>
    
  </div>
               
			   

</div>
<!-- // orders -->
            </div>
        </div>
	</div>
        <!-- /container -->
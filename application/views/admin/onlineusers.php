    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Online Users</h2>
               
			 <table class="table user-table">
 <thead>
     <th class="imgTable">&nbsp;</th>
     <th class="nameTable">Name</th>
     <th class="idTable">Id</th>
     <th class="orderTable">Orders</th>
     <th class="viewTable">&nbsp;</th>
 </thead>
  <?php 
  //echo '<pre>';print_r($viewUsers);
   if(is_array($viewUsers) && count($viewUsers) > 0){
    //echo '<pre>';print_r($viewUsers);
        $i=0;
        foreach($viewUsers as $users){ 
           //echo '<pre>';print_r($users);
   ?>
 
 <tr>
 <td><img src="<?php echo $users['image'];?>" height="37px" width="37" /></td>
  <?php  ?>
 <td><?php echo $users['english_name'];?></td>
 <?php  ?>
 
 <td><?php echo $users['id']; ?></td>
 <td><?php echo $users['TotalOrders']; ?></td>
 <td><a href="<?php echo base_url();?>admin/Users/getUserDetails/<?php echo $users['id'];?>"><i class="fa fa-angle-right"></i></a> </td>
 
 </tr>
 
<?php $i++;  
}


}

?>
</table>  



            </div>
        </div>
	</div>
  <!-- /container -->
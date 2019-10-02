<?php 
//echo 'Sub-Admin Page';
//print_r($subAdmins);
//exit;

?>

    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Sub-admins</h2>
               <?php if(isset($msg)) echo $msg; ?>
			 <table class="table admin-table">
                 <thead>
                     <tr>
                        <!--  <th class="imgTable">&nbsp;</th> -->
                         <th class="nameTable">Name</th>
                         <th class="nameTable">Email</th>
                         <th class="idTable">Id</th>
                       <!--   <th class="orderTable">Orders</th> -->
                         <th class="viewTable">&nbsp;</th>
                    </tr>
                </thead>

                <?php
                if(is_array($subAdmins) && count($subAdmins)>0){
                    //echo "<pre>";print_r($subAdmins);
                    foreach($subAdmins as $data){ 

                    ?>
 
                     <tr>
                        <!--  <td><img src="<?php //echo base_url();?>assets/img/pic-1.png" /></td> -->
                         <td><?php echo $data['name']  ; ?></td>
                         <td><?php echo $data['email']  ; ?></td>
                         <td><?php echo $data['id']  ; ?></td>
                         <!-- <td><?php //echo $data['name']  ; ?>- Orders</td> -->
                         <td><!--<a href="<?php //echo base_url();?>admin/Users/editUser/<?php //echo $data['id'];?>"><i class="fa fa-edit"></i></a>  -->
                         &nbsp;
                         <a href="<?php echo base_url();?>admin/Users/deleteSubAdmin/<?php echo $data['id'];?>" onclick="return confirm('Are you sure to delete this Sub Admin?');"><i class="fa fa-trash"></i></a>
                         </td>
                     
                     </tr>
                 <?php 
                    } 
                 

                 }else{
              ?>
             <tr align="center">
                <td colspan="4">No data found</td>
            </tr>
                <?php
                }   
            ?>

</table>  
<div class="bottom">
<a href="<?php echo base_url();?>admin/Users/addSubAdmin" class="btn btn-lg btn-primary btn-block button buttonLg">Add Sub-admin</a>

</div>

            </div>
        </div>
	</div>
        <!-- /container -->
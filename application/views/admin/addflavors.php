<script>
 $(document).ready(function(){
    $('#form').submit(function(){
    var flavors = $('#flavor').val();
    //alert(flavors);
    $('.error').hide();
        

        if(flavors==''){
            $('.error').html('Please enter Flavors ');
            $('.error').show();
            return false;
        }
        
    });
});

 </script>
<div class="main">
<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Add Flavors</h2>
            <?php //print_r($stores['store_id']);exit();

            //if(isset($msg)) echo $msg; ?>
<span class="error" style="color:#F00"> </span>
<br><br>

<form action="<?php echo base_url()?>admin/Products/addFlavor/" method="post" class="form" id="form">
<div class="col-md-8  col-xs-12">
<div class="col-md-6 col-xs-12">
<label for="select-name">Add Flavors</label>
<input type="text" id="flavor" name="flavor" class="form-control" placeholder="Chocolate,Strwaberry"  >
<i>Add Comma (,) for multiple flavors</i>
<br>&nbsp;
<i class="icon"></i>
</div>
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" >
<input type="hidden" name="store_id" value="<?php echo $stores['store_id']; ?>" >


<div class="clearfix"></div>
<div class="col-md-6 col-xs-12">
<input type="submit" value="Add Flavor" class="btn text-uppercase btn-block button buttonLg" >
</div>
</div>

</form>               

            </div>
        </div>
	</div>
        <!-- /container -->
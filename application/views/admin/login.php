    <div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
                <form class="login" id="loginForm" method="Post" action="<?php echo base_url();?>index.php/admin/Index/Login">
                    <input type="hidden" id="loginDo" name="loginDo" class="form-control" >

                    <h2 class="heading">Login</h2>
                     <span style="color:red;font-weight:bold;margin: 0 auto;width: 400px;"> 
                        <?php if(isset($msg)) echo $msg;?>
                    </span><br>
                    <label for="Email">Email</label>
                    <input type="email" id="Email" name="email" class="form-control" placeholder="me@example.com" required>
                    <label for="inputPassword">Password</label>
                    <input type="password" id="Password" class="form-control" name="password" placeholder="**********"  required>
                    <a href="#" class="forget">Forgot Password?</a>
 
                    <button class="btn btn-lg btn-primary btn-block button" type="submit">Login</button>
                </form>

            </div>
        </div>
        <!-- /container -->

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
       
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
         <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets/js/main.js"></script>

<script type="text/javascript">
// validate login form on keyup and submit
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 4
                },
                
            },
            messages: {
                
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 4 characters long"
                },
                
                email: "Please enter a valid email address",
                
            }
        });

</script>
</body>

</html>
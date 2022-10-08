
<div id="content" class="clearfix">

    <div class="clear"></div>
    <div class="tmp"></div>
<?php
if(!empty($include_params)){
 
 if($include_params['login_status']){ 
 ?>
  
	<div id="alert" class="success"> Successfully logged in. You will be redirected in 3 seconds!  </div>
	<script type="text/javascript">
	$(document).ready(function(){$('.form').remove();});
	</script>



<?php
	}else{
	?> 
	<div id="alert" class="error"> Username Or Password Incorrect </div>

	
	<?php
	}
 }
?>

  <div class="form clearfix">
    <div class="form-header">
        <h2 class="form-title">Login</h2>
    </div>


    
<form id="login" action="index.php?action=login<?php if(isset($_GET['ret'])){ echo '&ret='.urlencode($_GET['ret']);}?>" method="post">
	
	<div>
		<label>Email</label>
		<input name="user" id="email" class="wide" type="text">
	</div>
	
	<div>
		<label>Password</label>
		<input name="password" id="password" class="wide" type="password">
	</div>

	<div class="clearfix button-container">
            <div class="button large"><input value="Login" type="submit"></div>
    </div>
	
</form>
</div></div>
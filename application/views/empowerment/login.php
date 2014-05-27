<?php echo br(10);?>

<div class="log">
<div id="logo">
    <div class="login-head">
<?php $image_properties = array
 			(
          'src' => 'images/logo.jpg',
          'alt' => 'International Central Gospel Church, Rhode Island',
          'class' => 'logo_images',
 		  'width'=> '80px',
 		  'height'=> '67px',
          'title' => 'International Central Gospel Church'
			);
    echo img($image_properties,TRUE);
    ?>
    </div><div class="loginhead"><center><span ><b>Rhode Island Assembly</b></span></center>
	    <hr id="sr">
            <center><small>Empowerment Temple</small></center>
	</div></div>

<div id="login-details">
<span><?php echo $message; ?></span>
<?php 
echo nbs(3);
echo form_open('central/login_validation');
$data = array(
	'name'=>'username',
	'id'=>'username',
	'title'=>'Enter User Name',
	'size'=>40,
	'placeholder'=>'Enter your Username'
);
echo '<p>';
echo form_input($data);
echo form_error('username','<div id="error">','</div>');
echo '</p>';
$data1 = array(
	'name'=>'password',
	'id'=>'password',
	'size'=>40,
	'placeholder'=>'Enter Password',
	'type'=>'password',
	'title'=> 'Password should have at least 1 uppercase and at least 1 number. The minimum characters is 8 and the maximum characters is 12'
);
echo '<p>';
echo form_input($data1);
echo form_error('password','<div id="error">','</div>');
echo '</p>';
echo form_submit('submit','>>> Login');
echo nbs(15);
echo form_reset('reset','>>> Reset');
echo '<p>';
echo anchor('central/forgot_password','Forgot Password?');
echo nbs(5);
echo anchor('central/forgot_username','Forgot Username?');
echo '</p>';
echo nbs(1);
?>
</div>

</div>
    <?php echo br(10);?>
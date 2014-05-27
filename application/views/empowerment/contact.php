<?php echo doctype('html5'); ?>
<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta name="description" content="Conact Us - Empowerment Temple, Send Us a Message - Empowerment Temple" />
<meta name="keywords" content="Central Gospel, Pastor Nana Qanquah, Empowerment Temple,ICGC, ICGC USA, ICGC Rhode's Island, ICGC Empowerment Temple, International Central Gospel Church - Empowerment Temple, Empowerment Temple Rhode's Island" />
<title><?php echo $title; ?></title>
<link rel="icon" type="image/ico" href="<?php echo base_url().'images/icon.ico'?>"/>

<script type="text/javascript"  
src="http://api.maps.yahoo.com/ajaxymap?v=3.8&appid=YOYgTozV34ELuWjBlG.XwnnEFeNRI2..G3ZCB4vFNDgvh2pmRIgjZjHFrCmtkTutP4Rr5WI-"></script>
<script src=<?php echo base_url().'js/jquery.js'?>></script>
<script src=<?php echo base_url().'js/jquery.ui.core.js'?>></script>
<script src=<?php echo base_url().'js/jquery_form.js'?>></script>
<script src=<?php echo base_url().'js/validate.js'?>></script>
<link rel="stylesheet" href=<?php echo base_url().'/css/flexslider.css'?> type="text/css">
<link rel="stylesheet" href=<?php echo base_url().'/css/style.css'?> type="text/css">
<script type="text/javascript" src="<?= base_url() ?>js/jquery.flexslider.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   $('.flexslider').flexslider({ 
       animation: "slider"
    });
    

    $('#btncontact').click(function(){
        contact();
    });
 function contactValidate()
{
    $('form').validate({
        rules :{
            your_name :{
                required: true
            },
            location : {
                required : true
            },
            email : {
                required: true,
                email: true
            },
            message : {
                required: true,
                maxlength: 500
            }
        }
    });
         if(!$('form').valid())
         return false;
     return true;
}
function contact()
{
    if(contactValidate()) saveContact();
  
}
function saveContact()
{
    var dat = {
        name: $('#your_name').val(),
        location : $('#location').val(),
        email : $('#email').val(),
        phone : $('#phone').val(),
        message : $('#message').val()
    }
    $.ajax({
        type: "POST",
        url: "send_contact",
        data: dat,
        dataType: "html",
        beforeSend: function(){
            $('#results').text("Sending.....")
        },
        success: function(d){
            $('#contact_form').slideUp();
            $('#btncontact').hide();
            document.getElementById('results').innerHTML = d;
        }
    });
}
});
function saveContact()
{
    var dat = {
        name: $('#your_name').val(),
        location : $('#location').val(),
        email : $('#email').val(),
        phone : $('#phone').val(),
        message : $('#message').val()
    }
    $.ajax({
        type: "POST",
        url: "send_contact",
        data: dat,
        dataType: "html",
        beforeSend: function(){
            $('#results').text("Sending.....")
        },
        success: function(d){
            
            
            document.getElementById('results').innerHTML = d;
        }
    });
}

function contactValidate()
{
    $('form').validate({
        rules :{
            your_name :{
                required: true
            },
            location : {
                required : true
            },
            phone : {
                phoneUs: true
            },
            email : {
                required: true,
                email: true
            }
        }
    });
         if(!$('form').valid())
         return false;
     return true;
}
function contact()
{
    if(contactValidate()) saveContact();
  
}
</script>
</head>
<body>
    <div id="contain">

<div class="first-head">
    <div class="icgc-logo"><img  src=<?php echo base_url().'/images/logo.jpg';?>><div class="head">International Central Gospel Church - Rhode Island Assembly</div><div class="temple"> <center>Empowerment Temple</center></div></div></div>
<div class="links">
			<ul>
                                <li><a href="<?php echo base_url('central/index');?>">Home</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/church');?>">About Us</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/sermons');?>">Sermons</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/leaders');?>">Leadership</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/media');?>">Gallery</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/connect');?>">Connect with Us</a></li>&nbsp;&nbsp;
                                <li style="border-bottom: 4px solid blue">Contact Us</li>&nbsp;&nbsp;
			</ul>
</div>
</div>
<div class="contact">
<div class="other-contact">
    <br />
<div>
<small>
<p><b>By Phone</b></p>
<p>(401) 282-9168 or (508) 340-9745</p>
</small></div>
<div><small>
<p><b>Mailing Address</b></p>
P.O. Box 40456<br>
Providence, RI 02940</small>
</div>
<div><small>
<p><b>Meeting Place:</b></p>
<p>30 East Dunnell Lane<br>
Pawtucket, RI 02860</p>
<p><b>Email Address:</b>&nbsp;contactus@centralgospelri.com</p>
    </small></div>
    <div id="map"></div>
    <script type="text/javascript">  
    // Create a map object  
    var map = new YMap(document.getElementById('map'));  
  
    // Add map type control  
    map.addTypeControl();  
  
    // Add map zoom (long) control  
    map.addZoomLong();  
  
    // Add the Pan Control  
    map.addPanControl();  
  
    // Set map type to either of: YAHOO_MAP_SAT, YAHOO_MAP_HYB, YAHOO_MAP_REG  
    map.setMapType(YAHOO_MAP_REG);  
  
    // Display the map centered on a geocoded location  
    map.drawZoomAndCenter("28 East Dunnell Lane, Pawtucket", 2);  
    var currentGeoPoint = new YGeoPoint( 41.86513, -71.37159 );  
            map.addMarker(currentGeoPoint);
</script>
</div>

<div class="contact-form">
    <div id="results"><b><?php echo $message; ?></b></div>
<div id="contact_form">
<div><b><small>Send Us a Message</small></b><hr id="sr"></div>

<form id="formC">
<?php 
echo 'Your Name';
echo '<br>';
echo form_error('your_name','<span id="error">','</span>');
$data = array(
	'name'=>'your_name',
	'id'=>'your_name',
	'size'=> 50,
	'placeholder'=>'Or Enter a Name you wish to be known as'
);
echo form_input($data);
echo '<br>';
echo 'Location';
echo '<br>';
echo form_error('location','<span id="error">','</span>');
$data1 = array(
	'name'=>'location',
	'id'=>'location',
	'size'=> 50,
	'placeholder'=>'Your City and State or Country'
);
echo form_input($data1);
echo '<br>';
echo 'Email Address';
echo '<br>';
echo form_error('email','<span id="error">','</span>');
$data2 = array(
	'name'=>'email',
	'id'=>'email',
	'size'=> 30,
	'placeholder'=>''
);
echo '<br>';
echo form_input($data2);
echo '<br>';
echo 'Phone Number';
echo '<br>';
echo form_error('phone','<span id="error">','</span>');
$data3 = array(
	'name'=>'phone',
	'id'=>'phone',
	'size'=> 30,
	'placeholder'=>'Optional'
);

echo form_input($data3);
echo '<br>';
echo 'Message';
echo '<br>';
echo form_error('message','<span id="error">','</span>');
$data4 = array(
	'name'=>'message',
	'id'=>'message',
	'cols'=> 40,
	'rows'=> 10,
	'placeholder'=>'Tell us about Sunday Service, Comments, Suggestion or any other information that you would like us to know.'
);
echo form_textarea($data4);
echo '<br>';
?>
    </form>
<input type="submit" value="Send Message" id="btncontact">

</div>
</div>
</div>
<br>
<br>
</body>
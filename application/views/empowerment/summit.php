<?php echo doctype('html5'); ?>
<html>
<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta name="description" content="International Central Gospel Church - Rhode Island Assembly , Empowerment Temple, Empowerment Summit 2013." />
<meta name="keywords" content="Empowerment Summit 2013, Pastor Nana Qanquah, Empowerment Temple,ICGC, ICGC USA, ICGC Rhode's Island, ICGC Empowerment Temple, International Central Gospel Church - Empowerment Temple, Empowerment Temple Rhode's Island" />
<title><?php echo $title; ?></title>
<link rel="icon" type="image/ico" href="<?php echo base_url().'images/icon.ico'?>"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<link rel="stylesheet" href=<?php echo base_url().'/css/flexslider.css'?> type="text/css">
<script type="text/javascript" src="<?= base_url() ?>js/jquery.flexslider.js"></script>
<?php
$link = array(
          'href' => 'css/style.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
);
echo link_tag($link);
?>
</head>
<body>
<div class="container">
<div class="first-head">
    <div class="icgc-logo"><img  src=<?php echo base_url().'/images/logo.jpg';?>><div class="head">International Central Gospel Church - Rhode Island Assembly</div><div class="temple"> <center>Empowerment Temple</center></div></div></div>
<div class="links">
			<ul>
                                <li><a href="<?php echo base_url('central/index');?>">Home</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/church');?>">About Us</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/sermons');?>">Sermons</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/leaders');?>">Leadership</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/media');?>">Gallery</a></li>&nbsp;&nbsp;
				<li><a href="<?php echo base_url('central/connect');?>">Get Involved</a></li>&nbsp;&nbsp;
                                <li><a href="<?php echo base_url('central/contact');?>">Contact Us</a></li>&nbsp;&nbsp;
			</ul>

</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
    <br>
    <div class="gallery">
        <h1>Carol's Night 2013 with Arts and Music</h1>
        <div class="programme-detail">
        <p><h3>Dates:</h3><span id="heading">Saturday December 21st, 2013</span></p>
        <p><h3>Ministration:</h3><li id="heading"> Empowerment Voices</li><li id="heading">Empowerment Children's Ministry</li></p>     
        </div>
    <div ><img style="width:1000px; text-align: center;"src="<?php echo base_url().'images/events/crossover13.jpg'; ?>"></div>
    
   </div>
</body>
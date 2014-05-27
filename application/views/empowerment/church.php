<?php echo $message;?>
<div class="church">
<h1>Church Information</h1>
<hr id="hr">
<div class="church_setup">
<?php
echo form_open('central/church_validation');
echo 'Church Name:<br>';
$data = array(
    'name'=>'church_name',
    'id'=>'church_name',
    'class'=>'name',
    'size'=> 30,
    'title'=> 'Official Church Name'
);
echo form_input($data);
echo form_error('church_name', '<div id="error">', '</div>');
echo '<br>';
echo '<br>';
echo 'Church Branch:';
$data7 = array(
    'name'=>'branch',
    'id'=>'branch',
    'class'=>'name',
    'size'=> 30,
    'title'=> 'Branch or Campus of the Church'
);
echo '<br>';
echo form_input($data7);
echo form_error('branch', '<div id="error">', '</div>');
echo '<br>';
echo '<br>Address:<br>';
$data1 = array(
    'name'=>'address1',
    'id'=>'address1',
    'size'=> 30,
    'title'=> 'Address of Church'
);
echo form_input($data1);
echo '<br>';
$data7 = array(
    'name'=>'address2',
    'id'=>'address2',
    'size'=> 30,
    'placeholder'=>'Optional',
    'title'=> 'Address - Optional'
);
echo form_input($data7);
echo form_error('address1', '<div id="error">', '</div>');
echo '<br>City, State and Zip Code<br>';
$data2 = array(
    'name'=>'city',
    'id'=>'city',
    'size'=> 15,
    'title'=> 'City where the church has its location.'
);
echo form_input($data2);
$data3 = array(
    'name'=>'state',
    'id'=>'state',
    'value'=>'Rhode Island',
    'size'=> 10,
    'title'=> 'State'
);
echo form_input($data3);
$data4 = array(
    'name'=>'zipcode',
    'id'=>'zipcode',
    'size'=> 5,
    'title'=> 'Enter ZipCode of Church Location'
);
echo form_input($data4);
echo form_error('city', '<div id="error">', '</div>');
echo form_error('state', '<div id="error">', '</div>');
echo form_error('zipcode', '<div id="error">', '</div>');
echo '<br>Email Address:<br>';
$data5 = array(
    'name'=>'email',
    'id'=>'email',
    'size'=> 30,
    'title'=> 'Enter Email Address'
);
echo form_input($data5);
echo form_error('email', '<div id="error">', '</div>');
echo '<br>Phone Number:';
$data6 = array(
    'name'=>'phone',
    'id'=>'phone',
    'size'=> 19,
	'placeholder'=>'Format: XXX-XXX-XXXX',
    'title'=> 'Phone Number'
);
echo form_input($data6);
echo 'Fax Number:';
$data8 = array(
    'name'=>'fax',
    'id'=>'fax',
    'size'=> 10,
	'placeholder'=>'Optional',
    'title'=> 'Fax Number'
);
echo form_input($data8);
echo form_error('phone', '<div id="error">', '</div>');
echo form_error('fax', '<div id="error">', '</div>');
echo '<br>Slogan:<br>';
$data9 = array(
    'name'=>'slogan',
    'id'=>'slogan',
    'rows'=> 5,
	'cols'=>30,
    'title'=> 'Church Slogan'
);
echo form_textarea($data9);
echo form_error('slogan', '<div id="error">', '</div>');
echo '<p>';
echo '<hr id="hr">';
echo form_submit('submit','Save...','id="save_church"');
echo form_button('button','Cancel Edit','id="cancel_edit"');
echo '</p>';
?>
</div>
</div>
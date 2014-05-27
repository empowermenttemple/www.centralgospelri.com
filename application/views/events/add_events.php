<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
       $('#fdate').datepicker({
		      showWeek: true,
		      firstDay: 1
		});
		$('#tdate').datepicker({
		      showWeek: true,
		      firstDay: 1

		});

    });
    
</script>

<div class="event_form" id="event_form">

    <h3>Create New Event or Programme</h3>
<?php
echo form_open('central/add_events');
echo '<p>';
echo 'Event or Programme Name:';
$data = array(
	'name'=>'event',
	'id'=>'event',
	'size'=> 30,
        'required'=> true
		);
echo form_input($data);
echo form_error('event','<div id="error">','</div>');
echo '</p>';
echo '<p>';
echo 'Date From:';
echo nbs(1);
$data1 = array(
	'name'=>'fdate',
	'id'=>'fdate',
	'readonly'=>true,
	'size'=> 10,
        'required'=> true
		);
echo form_input($data1);
echo form_error('fdate','<span id="error">','</span>');
echo '</p><p>';
echo 'Starts at:';
echo nbs(5);
$data5 = array(
	'name'=>'ftime',
	'id'=>'ftime',
	'size'=> 10,
        'required'=> true
		);
echo form_input($data5);

echo nbs(9);
echo 'Ends at:';
$data6 = array(
	'name'=>'ttime',
	'id'=>'ttime',
	'size'=> 10,
        'required'=> true
		);
echo form_input($data6);
echo nbs(15);
echo form_error('ftime','<div id="error">','</div>');
echo form_error('ttime','<div id="error">','</div>');
echo '</p><p>';
echo 'Speaker:';
$data2 = array(
	'name'=>'speaker',
	'id'=>'speaker',
	'size'=> 50,
        'required'=> true
		);
echo form_input($data2);
echo form_error('speaker','<div id="error">','</div>');
echo '</p>';
echo 'Event or Programme Notes:<br>';
$data3 = array(
	'name'=>'notes',
	'id'=>'notes',
	'rows'=> 4,
	'cols'=>30
		);
echo form_textarea($data3);
echo form_error('notes','<div id="error">','</div>');
echo '<div id="btnevents">';
echo form_submit('submit','Save Event','id="btnevent"');
echo nbs(15);
echo anchor(base_url('central/cancel_events'),'Cancel');
echo '</div>';
echo form_close();
?>
</div>
<script>
$(document).ready(function(){
   $('#events_table table tbody tr').on("mouseover",function(){
       $(this).css("background-color",'lavender');
   }) ;
   $('#events_table table tbody tr').on("mouseout",function(){
       $(this).css("background-color",'white');
   }) ;
   
   $('#btnpurge').click(function(){
       $.ajax({
       type: "GET",
       url: 'purge_event',
       data: {memberID: $("#memberID").val()},
       dataType: "html",
       beforeSend: function(){
           document.getElementById("results").innerHTML = "processing....";
       },
       success: function(d){
           document.getElementById("results").innerHTML = d;
           
       }
   });
   });
});
</script> 
<div class="events">
<?php echo $message;?>
<h2>Events</h2>
<div id="results"></div>
<div id="events_table">
    <table>
        <thead>
            <tr>
                <th id="event_td">Event Number</th>
                <th> Event Name</th>
                <th>Date</th>
                <th>Speaker</th>
                <th>Purge Event</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($events as $row) { $key=$row->eventsID; ?>
            <tr>
                
                <td id="event_td"><?php echo $row->eventsID; ?></td>
                <td><?php echo $row->event_name; ?></td>
                <td><?php echo $row->fdate;?></td>
                <td><?php echo $row->speaker;?></td>
                <td><a href="<?php echo base_url().'central/purge/'.$key; ?>"><img width="50" src=<?php echo base_url().'/images/delete.png'?>></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<div class="events"><?php echo $this->pagination->create_links();?></div>
</div>
</div>
<center><?php echo form_open('central/create_event');
echo form_submit('submit','Create New Event');?></center><br>
<?php echo form_close();?>


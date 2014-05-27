
<script type="text/javascript">
$(document).ready(function() {
jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, ""); 
    return this.optional(element) || phone_number.length > 9 &&
        phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");
    

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
            },
            phone :{
                phoneUS:true,
                required: false
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
    };
    $.ajax({
        type: "POST",
        url: "send_contact",
        data: dat,
        dataType: "html",
        beforeSend: function(){
            $('#results').text("Sending.....");
        },
        success: function(d){
            document.getElementById('results').innerHTML = "<div data-alert class=\"alert-box info radius\">"+d+"<a href=\"#\" class=\"close\">&times;</a></div>";
       clear();
    }
    });
}

function clear(){
        $('#your_name').text("");
        $('#location').text("");
        $('#email').text("");
        $('#phone').text("");
        $('#message').text("");
}
});

</script>
</head>
<body>
<div class="main-container">
        <div class="gap_10"></div>
        <div>
        <img src="<?php echo base_url(). 'images/contactus.jpg' ?>" alt="Contact Empowerment Temple" />
    </div>
            <div class="gap_10"></div>
<div class=" row">
<div class="large-6 columns">
    <div  id="results"></div>
<div id="contact_form">
<h1 class="subheader">Send us your Message</h1>

<form>
<div>
    <div>
    <label for="your_name">Full Name:</label>
<input type="text" name="your_name" id="your_name" />
    </div>
    <div>
        <label for="location">
            City , State and/or Country:
        </label>
        <input type="text" name="location" id="location" />
    </div>
    <div>
        <label for="email">Email Address:
        <input type="email" name="email" id="email" />
        </label>
    </div>
    <div>
        <label for="phone">Phone Number (Optional) :
        <input type="text" name="phone" id="phone" size="30"/>
        </label>
    </div>
    <div>
        <label for="message">Message:
        <textarea rows="10" cols="30" name="message" id="message">Message</textarea>
        </label>
    </div>
    <div class="gap_10">
 <input type="button" class="button radius" value="Send Message" id="btncontact">  
</form>
       
    </div>


</div>
</div>
</div>

  <div class="large-6 columns"  data-equalizer>
    <ul class="pricing-table" data-equalizer-watch>
        <li  class="title">Contact Us by Phone</li>
        <li class="bullet-item"><b>(401) 282-9168 </b></li>
        
    </ul>    

    <ul class="pricing-table" data-equalizer-watch>
        <li  class="title">Contact Us by Mail:</li>
        <li class="bullet-item">P.O. Box 40456</li>
        <li class="bullet-item">Providence, RI 02940</li>
    </ul>    
      
    <ul class="pricing-table" data-equalizer-watch>
        <li  class="title">Place of Worship</li>
        <li class="bullet-item">30 East Dunnell Lane</li>
        <li class="bullet-item">Pawtucket, RI 02860</li>
    </ul> 
 
  </div>
</div>
</div>
</body>
 <script src="<?= base_url() ?>js/foundation/foundation.js"></script>
  <script src="<?= base_url() ?>js/foundation/foundation.equalizer.js"></script>
  <!-- Other JS plugins can be included here -->

  <script>
    $(document).foundation();
  </script>
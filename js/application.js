/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function copyright(){
    var cdate = new Date();
    var vdate = cdate.getYear();
    if(vdate < 2000){
        vdate += 1900;
    }
    document.write(vdate);
}


function sidebar(){
var event = "<div class=\"main-page-events\">";
    event += "<div class=\"alert-box success radius subheading\">Upcoming Events</div>";
    event += "<div class=\"event-details\">";
    event += "<div class=\"full-grid\">";
    event += "<div class=\"left padding-right-10\">";
    event += "<img width=\"50\" height=\"40\" src=\"../images/gallery/icon-events.png\" alt=\"slide 1\">";
    event += " </div>";
    event += "<div class=\"blueColor\">The Way, the Truth and the Life - <b>Health Week</b></div>";
    event += "<div><small>Saturday, March 29th, 2014</small></div>";
    event += "<div class=\"subheading\"><small> 5pm prompt</small></div>";
    event += "</div></div>";
    event += "<div class=\"event-details\">";
    event += "<div class=\"gap_1\"></div>";
    event += "<div class=\"full-grid\">";
    event += "<div class=\"left padding-right-10\">";
    event += "<img width=\"50\" src=\"../images/gallery/icon-events.png\" alt=\"slide 1\"></div>";
    event += "<div class=\"blueColor\">Half Night Service</div>";
    event += "<div><small>Friday April 25, 2014</small></div>";
    event += "<div><small>Time: 10:30pm - 1.00am</small></div>";
    event += "</div> </div> </div>";
    event += " <div class=\"gap_10\"></div>";
    event += "<div class=\"main-page-events \">";
    event += "<span class=\"alert-box success radius\"> Weekly Schedule</span>";
    event += "<div class=\"event-details\">";
    event += "<div class=\"gap_1\"></div>";
    event += "<div class=\"full-grid\">";
    event += "<div class=\"left padding-right-10\">";
    event += "<img width=\"50\" src=\"../images/gallery/icon-events.png\" alt=\"slide 1\">";
    event += " </div><div class=\"blueColor\">Sunday Service</div>";
    event += "<div><small>10:00am - 12:30pm</small></div>";
    event += "<div><small>Every Sunday</small></div>";
    event += "</div></div>";
    event += "<div class=\"event-details\">";
    event += "<div class=\"gap_1\"></div>";
    event += "<div class=\"full-grid\">";
    event += "<div class=\"left padding-right-10\">";
    event += "<img width=\"50\" src=\"../images/gallery/icon-events.png\" alt=\"slide 1\">";
    event += "</div><div class=\"blueColor\">Conference Call Prayer Mtg</div>";
    event += "<div><small>#712-432-0080 Code 958682#</small></div>";
    event += "<div><small>9:00pm - 9:30pm</small></div>";
    event += "<div><small>Mon, Tues, Thurs and Fri</small></div>";
    event += "</div></div><div class=\"event-details\">";
    event += "<div class=\"gap_1\"></div>";
    event += "<div class=\"full-grid\">";
    event += "<div class=\"left padding-right-10\">";
    event += "<img width=\"50\" src=\"../images/gallery/icon-events.png\" alt=\"slide 1\">";
    event += "</div><div class=\"blueColor\">Wednesday Bible Study</div>";
    event += "<div><small>Every Wednesday</small></div>";
    event += "<div><small>6pm - 8pm</small></div>";
    event += "</div>";
    event += " </div>";
    event += "</div>";        
    document.write(event);
    /*****/
}

function header(){
    var header = '';
    header += '<div class="header">';
    header += '<div class="header-container">';
    header += '<div class="churchName">International Central Gospel Church</div>';
    header += '<div class="templeLocation">Rhode Island Assembly</div>';
    header += '<div class="templeName">Empowerment Temple</div>';
    header += '</div>';
    header += '<div class="links">';
    header += '<nav>';
    header += '<ul>';
    header += '<li class="header-links"><a href="<?php echo base_url(\'central/index\');?>">Home </a>&nbsp; |</li>';
    header += '<li class="header-links"><a href="<?php echo base_url(\'central/church\');?>">About Us</a> &nbsp; |</li>';
    header += '<li class="header-links"><a href="<?php echo base_url(\'central/connect\');?>">Connect with Us</a> &nbsp; |</li>';
    header += '<li class="header-links"><a href="<?php echo base_url(\'central/contact\');?>">Contact Us</a> &nbsp; |</li>';
    header += '<li class="header-links"><a href="<?php echo base_url(\'central/contact\');?>">Contact Us</a> </li>';
    header += '</ul>';
    header += '</nav>';
    header += '<div>';
    header += '</div>';
    header += '</div>';
    header += '</div>';
    
    document.write(header);
}
function photo_links(){
    var photo = '<div>Photo Links</div>';
        photo += '<div class="gap_10"></div>';
        photo += '<p><a href="<?php echo base_url(\'central/carols_night\'); ?>">Crossroads Shelter</a></p>';
        photo += '<p><a href="<?php echo base_url(\'central/carols_night\'); ?>">Carol\'s Night</a></p>';
        photo += '</div>';     
document.write(photo);
}


function countdown(){
var endDate = "April 19, 2014 09:00:00";
        $('.countdown.styled').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("</div><div>" + this.leadingZeros(data.days, 3) + " <span>days</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>hrs</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>min</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>sec</span></div>");
          }
        });


}      


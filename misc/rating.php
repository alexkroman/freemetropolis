<?php
include_once('../includes/conf.php');
?>
//
// Freemetropolis Dynamic Rating 
//
// This feature was inspired by the NetFlix Starbar and is made 
// possible by Brent Ashley's (http://www.ashleyit.com) excellent JSRS
// library.
//
// CM -- 2003.10.17
//
var barImages;                // Pre-loaded array of rating bars
var clickQ = {};              // Click queue and cache
var IW = 13.8;                  // Width of each 1/3 of the plus-bar
var IH = 12;                  // Height of the plus-bar

var toolTips;

toolTips = new Array('Click to rate this place as 1 star',
                     'Click to rate this place as 2 star',
                     'Click to rate this place as 3 star',
                     'Click to rate this place as 4 star',
                     'Click to rate this place as 5 star');

function loadFM() {
   //
   // Pre-load the rating images
   //
   barImages = new Array();

   for (i=0; i<=5; i++) {
      barImages[i]     = new Image();
      barImages[i].src = "images/plus" + i + ".gif";
   }
}

function rateLink(img, linkid, rating, type) {
   //
   // Before sending the rating to the server make sure that we
   // haven't sent the same rating for the same link before.  If not,
   // add the Image object to the Click Queue.
   //
	
	
	
   if ( !clickQ[linkid] || clickQ[linkid] != rating ) {
	   clickQ[linkid] = img;
	   jsrsExecute('<?php echo $base_url;?>/blink.php', confirm, "rate", linkid+"_"+rating+"_"+type);
   }
}

function confirm(mesg) {
   //
   // Check server callback; if OK, accept the rating, change the 
   // image and cache the new rating in the Click Queue.
   //
   feedback = new Array();
   feedback = mesg.split("_");
   if (document.images && feedback[0] == "OK") {
      linkid = feedback[1];
      rating = feedback[2];
	  type = feedback[3];
	  
      if (typeof(clickQ[linkid]) == typeof(Image)) {
         clickQ[linkid].src = barImages[rating].src;
         clickQ[linkid] = rating;
      }
   }
   else {
      alert("Could not register your rating! Please reload this page!")
   }
}

function mouseOver(rating) {
   window.status = toolTips[rating-1];
}

function mouseOut(rating) {
   window.status = "";
}

function writePlus(linkid,type) {
   //
   // Spit out the HTML/JS needed for each rating bar
   //
	
   with (document) {
      imgname = "img" + linkid;
      write("<map name='map" +linkid + "'>");
      for (i=0; i<5 ; i++) {
		  
         write("<area href='javascript:rateLink(document.images."+ imgname + 
               ", " + linkid + ", " + (i+1) + ", " + type + ")' alt='" + toolTips[i] + "' " +
               "onMouseOver='mouseOver(" + (i+1) + "); return true;' onMouseOut='mouseOut(" + (i+1) +
               "); return true;' nomouseover='mouseOut(" + (i+1) + "); return true;' " +
               "shape='rect' coords='" + i*(IW+1) + ",0," + (i+1)*IW + "," + IH + "'>");
      }
      write("</map>");
      write("<img name='" + imgname + "' height='" + IH + "' width='" + 5*IW +
            "' alt='Click here to rate this article' border=0 usemap='#map" + linkid + 
            "' src='images/plus0.gif'>");
   }
}

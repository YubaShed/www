<?php if ( isset($_COOKIE["Dismiss"]) ) { if ($_COOKIE["Dismiss"] == "0"): ?>

	<script type="text/javascript">
    
		function getCookie(c_name) {
			var c_value = document.cookie;
			var c_start = c_value.indexOf(" " + c_name + "=");
			if (c_start == -1) {
				c_start = c_value.indexOf(c_name + "=");
			} 
			if (c_start == -1) {
				c_value = null;
			} else	{
				c_start = c_value.indexOf("=", c_start) + 1;
				var c_end = c_value.indexOf(";", c_start);
				if (c_end == -1) {
					c_end = c_value.length;
				}
				c_value = unescape(c_value.substring(c_start,c_end));
			}
			return c_value;
		}
			
		function setCookie(c_name,value,exdays) {
			var exdate=new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
			document.cookie=c_name + "=" + c_value;
		}
    
    </script>
    
	<div id="browser-alert-wrapper" style="position: fixed;
	_position:absolute;
	top: 0;
 	_top:expression(eval(document.body.scrollTop));
  	left: 0;
	width: 100%;
	background-color: black;
	opacity: .75;
	filter:alpha(opacity=75);
	color: white;
	z-index: 9999;">
    	<div id="browser-alert" style="width: 700px;
	min-height: 300px;
	margin: 0 auto;
	position: relative;
	left: -20px;
	padding: 30px;">
            <h2 style="font-weight: bold;">Your browser is out of date.</h2>
            <p>Many functions of this site&#8212particularly maps&#8212;do not work well or at all in your browser. Click one of the icons below if you would like to upgrade to a compatible browser:</p>
            <div id="browser-options" style="width: 560px;
	height: 150px;
	margin: 0 auto;
	clear: both;">
            	<div id="ie9" style="float: left;
	text-align: center;
	width: 100px;
	margin: 0 20px;">
                	<a href="http://windows.microsoft.com/en-us/internet-explorer/downloads/ie-9/worldwide-languages" target="_blank">
	                	<img src="/sites/default/themes/yubatheme/images/browser-icons/ie9.png" width="100" height="100" alt="IE 9 icon" /><br />
                        Internet Explorer 9
                    </a>
                 </div>
            	<div id="ie10" style="float: left;
	text-align: center;
	width: 100px;
	margin: 0 20px;">
                	<a href="http://windows.microsoft.com/en-us/internet-explorer/ie-10-worldwide-languages" target="_blank">
	                	<img src="/sites/default/themes/yubatheme/images/browser-icons/ie10.png" width="100" height="100" alt="IE 10 icon" /><br />
                        Internet Explorer 10
                    </a>
                 </div>
            	<div id="firefox" style="float: left;
	text-align: center;
	width: 100px;
	margin: 0 20px;">
                	<a href="http://firefox.com/" target="_blank">
	                	<img src="/sites/default/themes/yubatheme/images/browser-icons/firefox.png" width="100" height="100" alt="Firefox icon" /><br />
                        Firefox
                    </a>
                 </div>
            	<div id="chrome" style="float: left;
	text-align: center;
	width: 100px;
	margin: 0 20px;">
                	<a href="http://www.google.com/chrome" target="_blank">
	                	<img src="/sites/default/themes/yubatheme/images/browser-icons/chrome.png" width="100" height="100" alt="Chrome icon" /><br />
                        Chrome
                    </a>
                 </div>            
            </div>
            <p id="dismiss" style="text-align: right;"><a href="#" style="padding:10px; border: 1px solid #333; background-color: #aaa;" onClick="setCookie('Dismiss','1'); jQuery('#browser-alert-wrapper').css('display', 'none'); return false;">Dismiss</a>
    	</div>
    </div> 
    
<?php endif; } ?>
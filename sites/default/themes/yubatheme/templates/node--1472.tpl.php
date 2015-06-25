<?php

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<div id="node-<?php print $node->nid; ?>" class="PASSTHROUGH <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  


<?php
	drupal_add_js('http://maps.google.com/maps/api/js?sensor=false','external');
	drupal_add_js('http://d3js.org/d3.v2.js','external');
	drupal_add_css('sites/default/themes/yubatheme/yubatheme.css','file');
?>

    <div id="maptab" style="width: 100%; height: 340px;"></div>    
    
    <script type="text/javascript">
	//<![CDATA[

    var sites = [
                 //{name: "test", nid: 1, lat: 37.76487, lon: -122.41948},
                 {name: 'Jackson Meadows', lat: 39.50900, lon: -120.55200, stationcat: 'MY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Deer Creek near Smartville', lat: 39.22400, lon: -121.26800, stationcat: 'SYT', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba NF below Goodyears Bar', lat: 39.52500, lon: -120.93700, stationcat: 'NY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba MF near Jackson Meadows', lat: 39.51100, lon: -120.55400, stationcat: 'MY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba SF below Spaulding', lat: 39.31900, lon: -120.65800, stationcat: 'SY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba Canyon Ck/Bowman Lk', lat: 39.44000, lon: -120.66100, stationcat: 'SYT', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba River near Smartville', lat: 39.23517, lon: -121.27412, stationcat: 'LY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'N Yuba R below Goodyears Bar', lat: 39.52489, lon: -120.93800, stationcat: 'NY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba River at Jones Bar', lat: 39.29200, lon: -121.10400, stationcat: 'SY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Oregon Creek below Log Cabin', lat: 39.44500, lon: -121.05800, stationcat: 'MYT', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba River near Marysville', lat: 39.17572, lon: -121.52496, stationcat: 'LY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Englebright-Narrows', lat: 39.23300, lon: -121.26700, stationcat: 'LY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'N Yuba R below Bullards Bar Dam', lat: 39.39100, lon: -121.14300, stationcat: 'MS', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'N Yuba R above Slate Ck near Strawberry', lat: 39.52470, lon: -121.09060, stationcat: 'NY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Middle Yuba River below Our House Dam', lat: 39.41200, lon: -120.99700, stationcat: 'MY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'},
                 {name: 'Yuba River at Parks Bar Bridge', lat: 39.23060, lon: -121.28170, stationcat: 'LY', popup: '<h3>Jackson Meadows</h3><p><strong>Operator:</strong> Nevada County<br /><strong>Elevation:</strong> 6037 ft</p>'}
                ];
				
				//]]>

var stationcats = [];
for (i=0; i < sites.length; i++) {
	if (jQuery.inArray(sites[i].stationcat, stationcats) == -1)
		stationcats[i] = sites[i].stationcat;
}

//var siteColors = ["#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000"];
colorComponents=new Array('00','CC','33','66','99','FF');
var siteColors = [];
var siteColorsProtoIndex=0;
for(i=0;i<6;i++){
	for(j=0;j<6;j++){
		for(k=0;k<6;k++){
			siteColors[siteColorsProtoIndex] = '#' + colorComponents[k] + colorComponents[j] + colorComponents[i];
			siteColorsProtoIndex++;
		}
	}
}

// Create the Google Map�
var map = new google.maps.Map(d3.select("#maptab").node(), {
  zoom: 10,
  center: new google.maps.LatLng(39.438459, -120.812336),
  mapTypeId: google.maps.MapTypeId.TERRAIN
});


// Zoom and center the map to fit the markers
var bounds = new google.maps.LatLngBounds();
for (index in sites) {
  var data = sites[index];
  bounds.extend(new google.maps.LatLng(data.lat, data.lon));
}
map.fitBounds(bounds);

var overlay = new google.maps.OverlayView();
var infowindow = new google.maps.InfoWindow({
    content: "",
	maxWidth: "180px"
});

// Add the container when the overlay is added to the map.
overlay.onAdd = function() {
	  var layer = d3.select(this.getPanes().overlayMouseTarget)
	  .append("div")
	  .attr("class", "stations");
	  
	    // Draw each marker as a separate SVG element.
	    // We could use a single SVG, but what size would it have?
	  overlay.draw = function() {
	    var projection = this.getProjection(),
	        padding = 10;

	    var marker = layer.selectAll("svg")
	        .data(sites)
	        .each(transform) // update existing markers
	      .enter().append("svg:svg")
	        .each(transform)
	        .attr("class", "marker");

	    // Add a circle.
	    marker.append("svg:circle")
	        .attr("r", 4.5)
	        .attr("cx", padding)
	        .attr("cy", padding)
	        .attr("id", function(d) { return "circle_" + d.nid})
	        .attr("fill", function(d) { 
		        var stationcatIndex = jQuery.inArray(d.stationcat, stationcats);
				return siteColors[stationcatIndex];
//				var colorSelector = parseInt(stationcatIndex * siteColors.length / sites.length);
//				console.log(d.stationcat + '(' + stationcatIndex + '): ' + colorSelector);
//		        return siteColors[colorSelector];
		        })
	        .attr("stroke", function(d) { 
		        var stationcatIndex = jQuery.inArray(d.stationcat, stationcats);
				return siteColors[stationcatIndex];
		     })
		    .on("mouseover", function(d) { 
				var photo = '';
			    var content = d['popup'];
			    infowindow.setContent(content);
			    infowindow.setPosition(new google.maps.LatLng(d.lat, d.lon));
			    infowindow.open(map);
				jQuery('.popup-output').parent().css('overflow','hidden');
			    				    
		    });

	    function transform(d) {
		   // var style = "width: " + getWidth(d.title);
	      d = new google.maps.LatLng(d.lat, d.lon);
	      d = projection.fromLatLngToDivPixel(d);
	      return d3.select(this)
	          .style("left", (d.x - padding) + "px")
	          .style("top", (d.y - padding) + "px");
	    }
			  
	  };
	  

};

var subbasins = new google.maps.KmlLayer((location.protocol || 'http:') + '//' + (location.hostname || 'localhost') + '/sites/default/files/subwatersheds-symbolized.kmz');

// Bind our overlays to the map
subbasins.setMap(map);
overlay.setMap(map);
    </script>
    
    
    <!--end watershed_data section-->
    
    
    
    
    

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
  
  <?php 
      //var_dump($field_data_table);
      //var_dump($field_data_table[0]['tabledata']);

  ?>

</div>

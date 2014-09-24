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
<div id="node-<?php print $node->nid; ?>" class="MNWASHERE PASSTHROUGH <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  


<?php
	//drupal_add_js('http://maps.google.com/maps/api/js?sensor=false','external');
	drupal_add_js('http://d3js.org/d3.v2.js','external');
	drupal_add_css('sites/default/themes/yubatheme/yubatheme.css','file');
?>

    <div id="maptab" style="width: 100%; height: 340px;"></div>    
    
    <script type="text/javascript">
	//<![CDATA[

    var sites = [
                 //{name: "test", nid: 1, lat: 37.76487, lon: -122.41948},
                 //{nid: 486, name: "07 : Jackson Mdws", lat: 39.515839, lon: -120.563843},
                 //{nid: 487, name: "08 : Plumbago Xing", lat: 39.438459, lon: -120.812336},
                 //{nid: 488, name: "09 : Foote's Xing", lat: 39.416999, lon: -120.95288},
                 //{nid: 516, name: "37 : Milton Reservior", lat: 39.522248, lon: -120.592387},
                 //{nid: 533, name: "55 : Abv Oregon Ck", lat: 39.394239, lon: -121.083029},
                 //{nid: 534, name: "56 : Our House", lat: 39.413122, lon: -120.995091}

                 
<?php 

	$q = 'select field_data_field_ais_location.entity_id as nid, node.title as title, field_ais_location_lat as lat, field_ais_location_lon as lon, field_data_field_species_observed.field_species_observed_value as species, field_data_field_conservation_status.field_conservation_status_value as status from field_data_field_ais_location inner join node on field_data_field_ais_location.entity_id = node.nid left outer join field_data_field_species_observed on field_data_field_species_observed.entity_id = node.nid left outer join field_data_field_conservation_status on field_data_field_conservation_status.entity_id = node.nid where field_data_field_conservation_status.field_conservation_status_value = "Invasive";';
	$results = db_query($q);
	  
	foreach($results as $result) {
	   
	   //$popup = check_markup($result->title, 'full_html');
	   //$cleanpopup = json_encode($popup);
	   echo "{nid: {$result->nid}, title: '" .htmlentities($result->title, ENT_QUOTES) ."', lat: {$result->lat}, lon: {$result->lon}, species: '{$result->species}' , popup: '{}', url: '" . 
	   url(drupal_get_path_alias('node/' . $result->nid), array('absolute' => TRUE))
	   . "'},\n";
	   
	}
 

	 //echo "        {nid: {$nid}, name: {$name}, lat: {$lat}, lon: {$lon} }\n";

	 ?>

                ];
				
				//]]>

var species = [];
var speciesIndex = 0;
for (i=0; i < sites.length; i++) {
	if (jQuery.inArray(sites[i].species, species) == -1)
		species[speciesIndex++] = sites[i].species;
}
console.log("species.length: " + species.length);

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

console.log(siteColors);


// Create the Google Map

var map = new google.maps.Map(d3.select("#maptab").node(), {
  zoom: 10,
  center: new google.maps.LatLng(39.438459, -120.812336),
  mapTypeId: google.maps.MapTypeId.TERRAIN
});


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
		        var speciesIndex = jQuery.inArray(d.species, species);
				return siteColors[speciesIndex * 4];
//				var colorSelector = parseInt(stationcatIndex * siteColors.length / sites.length);
//				console.log(d.stationcat + '(' + stationcatIndex + '): ' + colorSelector);
//		        return siteColors[colorSelector];
		        })
	        .attr("stroke", function(d) { 
		        var speciesIndex = jQuery.inArray(d.species, species);
				return siteColors[speciesIndex * 4];
		     })
		    .on("mouseover", function(d) { 
				var photo = d.popup.substr(5, d.popup.length - 8);
			    var content = '<div class="popup-output"><a href="' + d.url + '">' + d.title + '</a><br />' + photo + '</div>';
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

var subbasins = new google.maps.KmlLayer((location.protocol || 'http:') + '//' + (location.hostname || 'localhost') + '/sites/default/files/subwatersheds-symbolized.kmz', 
		{
                      suppressInfoWindows: true,
                      map: map,
                      preserveViewport: true
                  }
);

// Bind our overlays to the map
subbasins.setMap(map);
overlay.setMap(map);

// Zoom and center the map to fit the markers
var bounds = new google.maps.LatLngBounds();
for (index in sites) {
  var data = sites[index];
  bounds.extend(new google.maps.LatLng(data.lat, data.lon));
}
map.fitBounds(bounds);


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


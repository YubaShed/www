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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  


<?php

//drupal_add_library('system', 'ui.tabs');
//drupal_add_js('http://maps.googleapis.com/maps/api/js?key=AIzaSyBEsRU9fWQRM8Y4bhvn4uWsoGWVUkVZxkA&sensor=false','external');
//drupal_add_js('jQuery(document).ready(function(){jQuery("#datatabs").tabs(); });', 'inline');
////drupal_add_js('sites/default/themes/yubatheme/datamap.js',array('type' => 'file', 'group' => 'JS_THEME'));
////{select: function(event, ui) {chart.invalidateSize();}}
//drupal_add_css('#datatabs { width: 100%: } #datatabs .tab { height: 350px; width: 100% } .ui-tabs .ui-tabs-panel { padding: 1em 0; }','inline');
drupal_add_css('sites/default/themes/yubatheme/yubatheme.css','file');
//drupal_add_css('sites/default/themes/yubatheme/css/jquery.ui.theme.css','file');
////drupal_add_css('sites/default/themes/yubatheme/css/jquery.ui.tabs.css','file');
////drupal_add_css('sites/default/themes/yubatheme/css/colors.css','file');
////drupal_add_css('#logo img {padding: 15px 0 0 0;}');
////drupal_add_css('.ui-tabs .ui-tabs-panel { padding: 1em 0; }');


//var_dump($field_data_table);

$showMap = false;
$showChart = false;

if(count($field_stationcat) > 0) {
 $showMap = true;
 drupal_add_js('http://maps.google.com/maps/api/js?sensor=false','external');

 echo '    <div id="maptab" style="width: 100%; height: 340px;"></div><br/> ';

}

if(isset($field_data_table[0]['tabledata'])){
 $showChart = true;
 drupal_add_js('http://d3js.org/d3.v2.js','external');

 echo '    <div id="charttab" style="width: 100%; height: 410px; padding-top: 50px;"></div>  ';


    $libname = 'amcharts';
    $path = libraries_get_path($libname);
    drupal_add_js($path ."/amcharts.js");
    $imgPath = $path . "/images/";


    $datas = $field_data_table[0]['tabledata'];
    $numDatas = count($datas);

if(!isset($datas) || $numDatas == 0) {

	continue;
}

$paramName = $field_ref_param[0]['node']->title;

$start = new DateTime($datas[1][0]);

$hasDays = (count(explode("-",$start->format("Y-m-d"))) == 3);
echo "<!--\n hasDays: ". count(explode("-",$start->format("Y-m-d"))) ."  \n start: " .$start->format("Y-m-d"). " \n  -->\n";

//echo " start: " . $start->format("Y-m");

$end = new DateTime($datas[$numDatas-1][0]);

//echo " end: " . $end->format("Y-m");

$diff = $start->diff($end);
//echo " diff: " . $diff->format("%Y-%m");


// get site and chart val names
$numSites = count($datas[0]) - 1;
$siteNames = array();
$valNames = array();
for($i = 0; $i < $numSites; $i++) {
	$siteNames[] = $datas[0][$i + 1];
	$valNames[] = "val" . $i;
	//$valNamesC[] = $siteNames[$i];
}


// find number of months, inclusive, between first and last data point

$numMonths = (($diff->y * 12) + $diff->m + 1);
$numDays = $diff->days + 1;

echo "<!-- days: " . $numDays . "-->";

// var for incrementing start to get x axis dates
$cur = clone $start;


//var for holding x axis dates

$xdates = array();


// increment months, add to xdates[], and format for display

if($hasDays){
  for($i = 0; $i < $numDays; $i++){
    $xdates[$i] = $cur->format("Y-m-d");
    $cur->add(new DateInterval('P1D'));
  }
} else {
  for($i = 0; $i < $numMonths; $i++){
  	$xdates[$i] = $cur->format("Y-m");
  	$cur->add(new DateInterval('P1M'));
  }
}

//generate javascript chart data array
?>

          <script type="text/javascript">
            var chart;
            var graph;

            // note, some of the data points will be missing
            var chartData = [
              <?php 

//$lastDate = 1;

// cycle through xdates and create a chart data row
foreach($xdates as $xdate) {

	echo"{date: new Date('{$xdate}')";
	
	// cycle through data dates and add chart values if any exist for the current xdate
  for($i = 1; $i < count($datas); $i++) {
		if($datas[$i][0] == $xdate) {
			//$lastDate = $datas[$i][0];
			
			// loop through sites and add values if they exist
			for($s = 0; $s < $numSites; $s++){
			  $valName = $valNames[$s];
			  $xval = $datas[$i][$s + 1];
				if($xval != "") {
					echo "
				        ,{$valName}: {$xval}";
				}
			}
		}
  }
	echo "
              },
	            ";
	
}
echo "];";

?>

var lastIndex = -1;
var siteColors = [];

//siteColors["test1"] = "#546546";

AmCharts.ready(function () {
    // SERIAL CHART
    chart = new AmCharts.AmSerialChart();
    chart.pathToImages = "<?php echo url($imgPath, array('absolute' => TRUE)); ?>";
    chart.marginTop = 0;
    chart.marginRight = 0;
    chart.dataProvider = chartData;
    chart.categoryField = "date";
    chart.zoomOutButton = {
        backgroundColor: '#000000',
        backgroundAlpha: 0.15
    };

    chart.addListener("changed", function(e) {

    	//e == {type:"changed", index:Number, zooming:Boolean, chart:AmChart}

    	if(e.index != lastIndex)
        {
            lastIndex = e.index;
            //console.log("index: " + e.index + ", date: " + chartData[e.index].date + ", val0: " + chartData[e.index].val0 + ", val1: " + chartData[e.index].val1 + ", val2: " + chartData[e.index].val2 + ", val3: " + chartData[e.index].val3);
            var logStr = "index: " + e.index + ", date: " + chartData[e.index].date <?php
             
   			// loop through sites and add valnames to log string
   			for($s = 0; $s < $numSites; $s++){
   			   $valName = $valNames[$s];
   			   echo ' + ", ' . $valName . ': " + chartData[e.index]["' . $valName . '"]';
  			}
  			echo ';';
   			?>

		console.log(logStr);
        }
    });

    var legend = new AmCharts.AmLegend();
    chart.addLegend(legend);

    // AXES
    // category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
    <?php if($hasDays) { ?>
    categoryAxis.minPeriod = "DD"; // our data is monthly, so we set minPeriod to MM
    <?php } else {?>
    categoryAxis.minPeriod = "MM"; // our data is monthly, so we set minPeriod to MM
    <?php } ?>
    categoryAxis.dashLength = 1;
    categoryAxis.axisAlpha = .5;
    categoryAxis.showLastLabel = false;

    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.axisAlpha = .5;
    valueAxis.dashLength = 1;
    valueAxis.inside = false;
    valueAxis.title = "<?php echo $paramName; ?>";
    valueAxis.titleBold = false;
    chart.addValueAxis(valueAxis);

    // SCROLLBAR
    var chartScrollbar = new AmCharts.ChartScrollbar();
    chart.addChartScrollbar(chartScrollbar);


    <?php 
    for($s = 0; $s < $numSites; $s++){

    ?>
    // GRAPH
    graph = new AmCharts.AmGraph();
    //graph.lineColor = "#b6d278";
    //graph.negativeLineColor = "#487dac"; // this line makes the graph to change color when it drops below 0
    graph.bullet = "round";
    graph.bulletSize = 5;
    graph.connect = false; // this makes the graph not to connect data points if data is missing
    graph.lineThickness = 2;
    graph.valueField = "<?php echo $valNames[$s]; ?>";
    graph.title = "<?php echo $siteNames[$s]; ?>";
    chart.addGraph(graph);
    siteColors["<?php echo $siteNames[$s]; ?>"] = graph.lineColor;

    //console.log("lineColor: " + graph.lineColor);
    <?php 
		}
    ?>

    var guide;
    <?php 

    //var_dump($nid);
    //echo " YEEEAAAHHH\n\n";
    //echo "paramConfigNid: " . $paramConfigNid . "\n\n";
    
    //var_dump($field_ref_param);
    $paramConfig = $field_ref_param[0]['node']->field_chart_config['und'][0]['value'];
    
    //$q = 'SELECT field_param_config_value as value from field_data_field_param_config where entity_id = :nid;';
    //$q = 'SELECT field_chart_config_value from field_data_field_chart_config where entity_id = :nid;';
    
    //echo "q: " . $q . "\n\n";
    
    //$paramConfig = db_query($q, array(':nid' => $paramConfigNid))->fetchField(0);
    //var_dump($paramConfig);
      
//      $q = 'SELECT field_data_field_location.entity_id as nid, node.title as title, field_location_lat as lat, field_location_lon as lon
//      FROM node, field_data_field_location, field_data_field_stationcat
//      WHERE node.nid = field_data_field_location.entity_id
//      AND field_data_field_location.entity_id = field_data_field_stationcat.entity_id
//      AND field_data_field_stationcat.field_stationcat_value = :stationcat;';
      
//      $results = db_query($q, array(':stationcat' => $stationcat));
      
//      foreach($results as $result) {
    
//       echo "        {nid: {$result->nid}, title: '" .htmlentities($result->title, ENT_QUOTES) ."', lat: {$result->lat}, lon: {$result->lon}, url: '" .
//       url(drupal_get_path_alias('node/' . $result->nid), array('absolute' => TRUE))
//       . "'},\n";
    
//      }
     
    
//     $chartConfigs = $field_param_config[$lang][0]['value'];
     $dataTypeConfigs = explode(";", $paramConfig);
     
    foreach($dataTypeConfigs as $dtc){
     $pcfgs = explode("|", trim($dtc));
     if(trim($pcfgs[0]) == 'QALINE'){
      //echo "QALINE!: " . $pcfgs[1];
      ?>

      guide = new AmCharts.Guide();
      guide.lineColor = 'red';
      guide.lineAlpha = .5;
      //guide.lineThickness = 2;
      guide.value = "<?php echo trim($pcfgs[1]); ?>";
      guide.label = "<?php echo trim($pcfgs[1]); ?>";
      valueAxis.addGuide(guide);
      
      <?php 
     }
    }
    
    ?>
    
    
    // CURSOR  
    var chartCursor = new AmCharts.ChartCursor();
    chartCursor.cursorAlpha = .5;
    chartCursor.cursorPosition = "mouse";
    <?php if($hasDays) { ?>
    chartCursor.categoryBalloonDateFormat = "MMM D, YYYY";
    <?php } else {?>
    chartCursor.categoryBalloonDateFormat = "MMM YYYY";
    <?php } ?>
    chart.addChartCursor(chartCursor);

    // WRITE
    chart.write("charttab");
    //chart.write("chartdiv");

 // Bind our overlay to the map…
 <?php if($showMap) { ?>
    overlay.setMap(map);
 <?php } ?>
    
});
</script>
    
    
<?php if($showMap) { // begin if($showMap) section ?>
    
    <script type="text/javascript">

    var sites = [
                 //{name: "01: Example Site", nid: 1, lat: 37.76487, lon: -122.41948},

                 
<?php 

	  $stationcat = $field_stationcat[0]["value"];
	  
	  $q = 'SELECT field_data_field_location.entity_id as nid, node.title as title, field_location_lat as lat, field_location_lon as lon 
	  FROM node, field_data_field_location, field_data_field_stationcat 
	  WHERE node.nid = field_data_field_location.entity_id 
	  AND field_data_field_location.entity_id = field_data_field_stationcat.entity_id
	  AND field_data_field_stationcat.field_stationcat_value = :stationcat;';
	  
	  $results = db_query($q, array(':stationcat' => $stationcat));
	  
	  foreach($results as $result) {
	   
	   echo "        {nid: {$result->nid}, title: '" .htmlentities($result->title, ENT_QUOTES) ."', lat: {$result->lat}, lon: {$result->lon}, url: '" . 
	   url(drupal_get_path_alias('node/' . $result->nid), array('absolute' => TRUE))
	   . "'},\n";
	   
	  }

	 //echo "        {nid: {$nid}, name: {$name}, lat: {$lat}, lon: {$lon} }\n";

	 ?>

                ];

// Create the Google Map…
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
    content: "test content"
});


//function setText(textElmt,str) {
//	   textElmt.textContent = str;
//	   var box = textElmt.getBBox();
//	   var rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
//	   rect.setAttribute('class','yourCustomBackground');
//	   for (var n in box) { rect.setAttribute(n,box[n]); }
//	   textElmt.parentNode.insertBefore(rect,textElmt);
//	}
	
// Add the container when the overlay is added to the map.
overlay.onAdd = function() {
	console.log("overlay.onadd");

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
		        var siteName = "Site " + d.title.substring(0, d.title.indexOf(" :"));
		         //console.log("siteName: " + siteName + ", siteColor: " + siteColors[siteName]); 
		        return siteColors[siteName];
		        })
	        .attr("stroke", function(d) { 
		        var siteName = "Site " + d.title.substring(0, d.title.indexOf(" :"));
		         //console.log("siteName: " + siteName + ", siteColor: " + siteColors[siteName]); 
		        return siteColors[siteName];
		        })
	        .on("mouseover", function(e) { 
		        // show text
		        console.log("circle:hover");
			    var content = '<a href="' + d.url + '">' + d.title + '</a>' ;
			    infowindow.setContent(content);
			    infowindow.setPosition(new google.maps.LatLng(d.lat, d.lon));
			    infowindow.open(map);
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


    </script>
    
    <?php } // if($showMap) section ?>
    
    
    <?php } // end watershed_data section?>
    
    
    
    
    

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

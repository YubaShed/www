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
  
  <?php if($type == 'watershed_data') : ?>
  
  
    <?php 

    $libname = 'amcharts';
    $path = libraries_get_path($libname);
    // Do something with the library, knowing the path, for instance:
    // drupal_add_js($path . '/example.js');
    drupal_add_js($path ."/amcharts.js");
    $imgPath = $path . "/images/";
    
    //var_dump($field_data_table[0]['tabledata']);

    $datas = $field_data_table[0]['tabledata'];
    $numDatas = count($datas);

if(!isset($datas) || $numDatas == 0) {
	continue;
}

$start = new DateTime($datas[1][0]);
echo " start: " . $start->format("Y-m");
$end = new DateTime($datas[$numDatas-1][0]);
echo " end: " . $end->format("Y-m");
$diff = $start->diff($end);
echo " diff: " . $diff->format("%Y-%m");

// get site and chart val names
$numSites = count($datas[0]) - 1;
$siteNames = array();
$valNames = array();
for($i = 0; $i < $numSites; $i++) {
	$siteNames[] = $datas[0][$i + 1];
	$valNames[] = "val" . $i;
}

///*

// find number of months, inclusive, between first and last data point
$numMonths = (($diff->y * 12) + $diff->m + 1);
echo " months: " . $numMonths;

// var for incrementing start to get x axis dates
$cur = clone $start;

//var for holding x axis dates
$xdates = array();

// increment months, add to xdates[], and format for display
for($i = 0; $i < $numMonths; $i++){
	$xdates[$i] = $cur->format("Y-m");
	$cur->add(new DateInterval('P1M'));
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



// for($s = 1; $s < $datas[0]; $s++) {
// 	for($d = 1; $d< $datas; $d++){
// 		if( isset($xdates[$i]) && isset($valsBySite[$site]) && is_array($valsBySite[$site]) && array_key_exists($xdates[$i], $valsBySite[$site]) )
// 			$datas[$site][] = $valsBySite[$site][$xdates[$i]];
// 		else
// 			$datas[$site][] = null;
// 	}
// }





//*/

?>


AmCharts.ready(function () {
    // SERIAL CHART
    chart = new AmCharts.AmSerialChart();
    chart.pathToImages = "<?php echo $imgPath; ?>";
    chart.marginTop = 0;
    chart.marginRight = 0;
    chart.dataProvider = chartData;
    chart.categoryField = "date";
    chart.zoomOutButton = {
        backgroundColor: '#000000',
        backgroundAlpha: 0.15
    };

    // AXES
    // category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
    categoryAxis.minPeriod = "MM"; // our data is monthly, so we set minPeriod to MM
    categoryAxis.dashLength = 1;
    categoryAxis.axisColor = "#DADADA";

    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.axisAlpha = 0;
    valueAxis.dashLength = 1;
    valueAxis.inside = true;
    chart.addValueAxis(valueAxis);

    <?php 
    for($s = 0; $s < $numSites; $s++){
    	$valName = $valNames[$s];
    ?>
    // GRAPH
    graph = new AmCharts.AmGraph();
    //graph.lineColor = "#b6d278";
    //graph.negativeLineColor = "#487dac"; // this line makes the graph to change color when it drops below 0
    graph.bullet = "round";
    graph.bulletSize = 5;
    graph.connect = false; // this makes the graph not to connect data points if data is missing
    graph.lineThickness = 2;
    graph.valueField = "<?php echo $valName; ?>";
    chart.addGraph(graph);
    <?php 
		}
    ?>

    // CURSOR  
    var chartCursor = new AmCharts.ChartCursor();
    chartCursor.cursorAlpha = 0;
    chartCursor.cursorPosition = "mouse";
    chartCursor.categoryBalloonDateFormat = "MM";
    chart.addChartCursor(chartCursor);

    // WRITE
    chart.write("chartdiv");
});
</script>
    
  <div id="chartdiv" style="width:100%; height:400px;"></div>
    
  <?php endif; ?>
  
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

</div>

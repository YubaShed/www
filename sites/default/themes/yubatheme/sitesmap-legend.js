<script type="text/javascript">
var legend = '<h3>Legend</h3><div id="stationcat-legend"></div>';
document.write(legend);
for(i=0; i<stationcats.length; i++) {
	if (stationcats[i]) {
		jQuery('#stationcat-legend').append('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="legend"><circle cx="10" cy="10" r="4.5" stroke="' + siteColors[i] + '" stroke-width="2" fill="' + siteColors[i] + '"></circle><p class="legend">: ' + stationcats[i] + '</p></svg>');
	}
}
var legendEnd = '<p class="legend">Ex: SYT = South Yuba Tributaries</p><p class="legend">Ex: MS-Upper = Main Stem Upper</p>';
jQuery('#stationcat-legend').append(legendEnd);
</script>
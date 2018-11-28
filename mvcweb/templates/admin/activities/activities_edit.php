<?php
	require_once("activities_categories.php");

	$resort_xml = new SimpleXMLElement(get_option("MVC_RESORTS_INDEX"));
	$resort = $resort_xml->xpath("//resort[@code='" . strtoupper($_GET['code']) . "']")[0];

	$option_code = "MVC_OSA_" . $_GET['code'];

	$activities_data = get_option($option_code);
	$activities = new SimpleXMLElement($activities_data);

	$GLOBALS["sortby"] = $_GET["sortby"];

	$activity_rows = $activities->xpath("//Row");

	function string_sort_func_asc($a, $b) {
		return strcmp($a->xpath($GLOBALS["sortby"])[0], $b->xpath($GLOBALS["sortby"])[0]);
	}

	function string_sort_func_desc($a, $b) {
		return strcmp($b->xpath($GLOBALS["sortby"])[0], $a->xpath($GLOBALS["sortby"])[0]);
	}

	$direction = 1;
	$new_direction = 0;

	if($_GET["sortby"]) {
		$direction = (int)$_GET["dir"];
		$new_direction = $direction == 1 ? 0 : 1;
		usort($activity_rows, "string_sort_func_" . ($direction== "1" ? "asc" : "desc"));
	}

	function render_sort_col($prop, $dir, $text) {
		return '<a href="?page=mvc_activities_edit&code=' . $_GET["code"] . '&sortby=' . $prop . '&dir=' . $dir . '">' . $text . "</a>";
	}
?>
<div>
	<h1>Onsite Activities - <?php echo $resort[0]; ?></h1> 
</div>
<table>
	<tr>
		<td colspan="7" style="text-align:right; padding-bottom:20px;">
			(<a href="?page=mvc_activity_edit&code=<?php echo $_GET['code']; ?>&sortby=<?php echo $_GET['sortby']; ?>&dir=<?php echo $_GET['dir']?>">create</a>)
		</td>
	</tr>
	<tr>
		<td>Image</td>
		<td>
			<b><?php echo render_sort_col("ActivityTitle", $new_direction, "Activity Title");?></b>
		</td>
		<td><?php echo render_sort_col("startDate", $new_direction, "Start Date/Time");?></td>
		<td><?php echo render_sort_col("endDate", $new_direction, "End Date/Time");?></td>
		<td><?php echo render_sort_col("featured", $new_direction, "Featured?");?></td>
		<td><?php echo render_sort_col("active", $new_direction, "Active?");?></td>
		<td><?php echo render_sort_col("currencyPrice", $new_direction, "Price");?></td>
	</tr>
<?php foreach ($activity_rows as $activity) {
	?>
	<tr>
		<td style="width: 150px;">
			<img height="60" src="<?php echo $activity->xpath("photo")[0];?>"/>
		</td>
	<td style="width: 300px;">
		<a href="?page=mvc_activity_edit&code=<?php echo $_GET['code']; ?>&id=<?php echo $activity->xpath('@id')[0];?>&sortby=<?php echo $_GET['sortby'];?>&dir=<?php echo $_GET['dir']; ?>"><?php echo $activity->xpath("ActivityTitle")[0]; ?>
	</td>

	<td style="width: 150px;"><?php echo $activity->xpath("startDate")[0]; ?></td>
	<td style="width: 150px;"><?php echo $activity->xpath("endDate")[0]; ?></td>
	<td style="width: 100px;"><?php echo $activity->xpath("featured")[0]; ?></td>
	<td><?php echo $activity->xpath("active")[0]; ?></td>
	<td><?php echo $activity->xpath("currencyPrice")[0]; ?></td>
	</tr>
<?php } ?>
</table>
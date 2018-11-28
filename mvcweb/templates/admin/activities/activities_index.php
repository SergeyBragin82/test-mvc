<h1>Edit Onsite Activities</h1>

<a href="/wp-content/plugins/mvcweb/templates/admin/activities/activities.xml" download="activities.xml" style="font-size: 16px;">Export all Activities</a><br/>

<style>
    #import_activities p,
    #delete_all_activities p{
        margin : 10px 0;
    }
    #import_activities #import_file,
    #delete_all_activities #delete_all_file {
        display : none;
    }
    #import_activities #import_label,
    #delete_all_activities #delete_all_label{
        font-size: 16px;
        cursor : pointer;
        color: #0073aa;
        text-decoration: underline;
    }
</style>

<form id="import_activities" action="admin-post.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="import_all_activities"/>
    <p><label id="import_label"><input id="import_file" name="import_file" type="file">Import all Activities</label></p>
</form>

<form id="delete_all_activities" action="admin-post.php" method="POST" >
    <input type="hidden" name="action" value="delete_all_activity"/>
    <p><label id="delete_all_label" onclick="deleteAllActivity();">Delete all Activities</label></p>
    <input id="delete_all_file" name="delete_all" type="submit">
</form>
<br/>

<script type="text/javascript">

    jQuery("#import_file").change(function(){

        var filename = jQuery("#import_file").val();
        var extension = filename.replace(/^.*\./, '');

        if (extension == filename) {
            extension = '';
        } else {
            extension = extension.toLowerCase();
        }
        if ( extension != 'xml') {
            alert("The file extension must be .xml!)");
        } else {
            jQuery("#import_activities").submit();
        }

    });
    
    function deleteAllActivity() {
        if (confirm("Delete All Activity?")) {
            jQuery("#delete_all_activities").submit();
        }
    }

</script>


<?php

	$resorts = new SimpleXMLElement(get_option("MVC_RESORTS_INDEX"));

	foreach ($resorts->xpath("//resort") as $resort) {
		?>
			<a href="?page=mvc_activities_edit&code=<?php echo strtolower($resort->xpath("@code")[0]); ?>"><?php echo $resort->xpath("text()")[0]; ?></a><br/>
		<?php
	}


        $dom = new DomDocument('1.0','utf-8'); 
        $_res = $dom->appendChild($dom->createElement('Activities'));

        foreach ($resorts->xpath("//resort") as $resort) {
            try{
                $resort_code = strtolower($resort->xpath("@code")[0]);
                $activities = new SimpleXMLElement(get_option("MVC_OSA_".$resort_code));
                if( !empty( $activities ) ) {
                    $_activ = $_res->appendChild($dom->createElement('OSARowCollection'));
                    foreach ($activities as $activity ) {
                        $resort_id = $activity->xpath("@id")[0];
                        $_activity = $_activ->appendChild($dom->createElement('Row'));
                        $_activity->setAttribute("id", $resort_id);
                        $_activity->setAttribute("code", $resort_code);
                        $_activity->appendChild($dom->createElement('code', $resort_code));
                        $_activity->appendChild($dom->createElement('id', $resort_id['id']));
                        foreach ($activity as $activity_key => $activity_val) {
                            $_activity_data = $_activity->appendChild($dom->createElement($activity_key));
                            $_activity_data->appendChild($dom->createTextNode($activity_val));

                        }
                    }
                }

            }catch(Exception $e){
                    // do nothing... php will ignore and continue    
            }
	}
        
        
        $dom->formatOutput = true;
        $dom->save(dirname(__DIR__)."/activities/activities.xml");
        
?>

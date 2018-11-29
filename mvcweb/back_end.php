<?php
	add_action('admin_menu', 'mvc_admin_menu');

	// Add Marriott Menu Item
	function mvc_admin_menu() {
		add_menu_page( "MVC Admin", "MVC Administration", "manage_options", "mvc_admin", 'mvc_render', NULL, 0 );
		add_submenu_page("mvcadmin", "MVC Publishing", "MVC Publishing", "manage_options", "mvc_publishing", 'mvc_publishing_render');
		add_submenu_page("mvcadmin", "MVC Publish Data", "MVC Publish Data", "manage_options", "mvc_publishing_do", 'mvc_publishing_do_render');
		add_submenu_page("mvcadmin", "MVC Resales Data", "MVC Resales Data", "manage_options", "mvc_publishing_update_resales", 'mvc_publishing_update_resales');
		add_submenu_page("mvcadmin", "MVC Resales Data", "MVC Resales Data Submit", "manage_options", "mvc_publishing_update_resales_submit", 'mvc_publishing_update_resales_submit');
	}


	function mvc_render () {
		?>
			<h1>MVC Administration Console</h1>
			<a href="?page=mvc_publishing">Publishing</a><br>
			<a href="?page=mvc_publishing_update_resales">Update Resales Data</a><br>
		<?php
	}

	function mvc_publishing_update_resales () {
		?>
		<h1>Update Resales Data</h1>
		<form action="?page=mvc_publishing_update_resales_submit" method="POST" enctype="multipart/form-data">
			New File: <input type="file" name="new_file[]"/><br/>
			<input type="submit" value="Upload"/>
		</form>
		<?php
	}

	function mvc_publishing_update_resales_submit() {
		ini_set("file_uploads", "On");
		echo "<h1>Update Resales Data</h1>";
		$uploads_dir = "/user/resales";

		if(!file_exists($uploads_dir)) {
			mkdir($uploads_dir);
		}
		echo "Scanning for uploads.<BR>";
		foreach ($_FILES["new_file"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		    	echo "File uploading to: " . $uploads_dir . "/resales.csv<br>";
		        $tmp_name = $_FILES["new_file"]["tmp_name"][$key];
		        // basename() may prevent filesystem traversal attacks;
		        // further validation/sanitation of the filename may be appropriate
		        move_uploaded_file($tmp_name, "$uploads_dir/resales.csv");
		    } else {
		    	echo "ERROR: File not found<br>";
		    }
		}
		?>Upload complete. The resales data will become available upon the next publishing of the site.<?php
	}

	function mvc_publishing_render() {
			?>
				<h1>Publishing Console</h1>
				<h3><a href="?page=mvc_publishing_do">Publish Site Data</a></h3>
			<?php

			$options = wp_load_alloptions();
			foreach($options as $key => $value) {
				echo $key . ": " . $value . "<BR>";
			}
	}

	function mvc_publishing_do_render() {
			include('util/publish.php');
			perform_publish();
	}


?>

<?php 
	echo horizontalBreak(); 
?>
<div class="container general-info terms-of-use">
	<?php
		echo htmlspecialchars_decode($context->xpath("//page_data/.")[0]->asXML());
	?>
</div>
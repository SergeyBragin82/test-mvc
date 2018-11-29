 <div id="sidebar-wrapper">
 	<div class="sidebar-header">
 		<a href="#" data-toggle="sidebar" style="position:absolute; top: 30px; right: 20px;">
			<svg width="26px" height="26px" viewBox="0 0 16 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			    <g id="MI-Hertz-Landing---Mobile-" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			        <g id="MI-----Nav-item-Expanded" transform="translate(-342.000000, -33.000000)" fill="#FFFFFF">
			            <rect id="Rectangle-3-Copy-3" transform="translate(350.000000, 41.500000) rotate(-316.000000) translate(-350.000000, -41.500000) " x="340" y="40" width="20" height="3" rx="1"></rect>
			            <rect id="Rectangle-3-Copy-4" transform="translate(350.000000, 41.500000) rotate(-224.000000) translate(-350.000000, -41.500000) " x="340" y="40" width="20" height="3" rx="1"></rect>
			        </g>
			    </g>
			</svg>
 		</a>
 		
 	<div class="navbar-header p-4" style="padding-top:3rem">
 			<h3 class="baskerville white-fg">Vacation Packages</h3>
	</div>

	</div>
 	<div class="navlinks py-4 pl-4 pr-2" id="navGroup">
 		<?php
 			navlink("/landing/cc/offers-b/newport/?fid=" . $loc["main_npc_fid"] ."&loc=" . $loc["main_npc_loc"] . "&main_loc=" . $loc_set, "Newport Coast, California", 0, false, $loc_set);
 			navlink("/landing/cc/offers-b/newyorkcity/?fid=" .  $loc["main_nyc_fid"] . "&loc=" . $loc["main_nyc_loc"]  . "&main_loc=" . $loc_set, "New York City, New York", 1, true, $loc_set);
 			navlink("/landing/cc/offers-b/orlando/?fid=" . $loc["main_orl_fid"]  . "&loc=" .  $loc["main_orl_loc"] . "&main_loc=" . $loc_set, "Orlando, Florida", 2, false, $loc_set);
 			navlink("/landing/cc/offers-b/palmbeaches/?fid=" .  $loc["main_sin_fid"] . "&loc=" .  $loc["main_sin_loc"] . "&main_loc=" . $loc_set , "The Palm Beaches, Florida" , 3, false, $loc_set);
 			
 		?>
    </div>
</div>
<script type="text/javascript">
		$(document).ready(function() {
			$(".nlink").on("click", function(e) {
				$("#wrapper").addClass("toggled");
			});
		});
	</script>
<?php 

function navlink($url, $title, $index, $ishotel) {
	$class = "";

	if(strpos($_SERVER["REQUEST_URI"], $url) !== false) {
		$class = " active";

	}

	?>
	<div class="p-0 card-header d-flex justify-content-between" id="headingCollapse<?php echo $index; ?>">
	    <div>
	        <a class="<?php echo $class; ?> collapsed" data-toggle="collapse" href="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
	            <?php echo $title; ?>
	        </a>
	    </div>
	    <div>
	        <a data-toggle="collapse" class="collapsed btn-xs text-right" href="#collapse<?php echo $index; ?>" aria-label="<?php echo $title; ?>" aria-expanded="false" role="button">
	        	<div class="pull-right pt-0">
	      	      <i class="fa" aria-hidden="true"></i>
		        </div>
	            <span class="sr-only"><?php echo $title; ?></span>
	        </a>
	    </div>
	</div>
	<div id="collapse<?php echo $index; ?>" class="collapse" aria-labelledby="headingCollapse<?php echo $index; ?>" data-parent="#navGroup">
	    <div class="card-body">
	        <ul>
				<li><a class="nlink" href="<?php echo $url; ?>">Get Offer</a></li>
				<li><a class="nlink" href="<?php echo $url; ?>#about">About the <?php echo $ishotel==true ? "Hotel" : "Resort"; ?></a></li>
				<li><a class="nlink" href="<?php echo $url; ?>#attractions">Area Attractions</a></li>
				<li><a class="nlink" href="/landing/cc/offers/details?loc=<?php echo $loc_set;?>">Details of Participation</a></li>
			</ul>
	    </div>
	</div>
<?php } ?>
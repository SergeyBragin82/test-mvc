<?php

  $loc_table = array(
    "IM59*1-IPDRF3" => array(
      "main_home_loc" => "IM59*1-IPDRF3",
      "main_home_phone" => "855-762-0330",
      "main_npc_loc" => "CO08*1-IYU303",
      "main_npc_fid" => "IM59*1-IVMRDB",
      "main_npc_phone" => "855-762-0294",
      "main_orl_loc" => "CO08*1-IYU306",
      "main_orl_fid" => "IM59*1-IVMRDE",
      "main_orl_phone" => "855-762-0321",
      "main_sin_loc" => "CO08*1-IYU309",
      "main_sin_fid" => "IM59*1-IVMRHD",
      "main_sin_phone" => "855-762-0329",
      "main_nyc_loc" => "CO08*1-IYU30C",
      "main_nyc_fid" => "IM59*1-IVMRHG",
      "main_nyc_phone" => "855-762-0525",
      "legal" => "745347-5/MDC-18-179",
      "legal_copy" => "Residents of Maine are not eligible for this offer."
    ),
    "IM59*1-JG9J3I" => array(
      "main_home_loc" => "IM59*1-JG9J3I",
      "main_home_phone" => "855-279-6619",
      "main_npc_loc" => "CO08*1-JFE6WH",
      "main_npc_fid" => "IM59*1-IVMRDB",
      "main_npc_phone" => "855-279-6619",
      "main_orl_loc" => "CO08*1-JFE6WH",
      "main_orl_fid" => "IM59*1-IVMRDE",
      "main_orl_phone" => "855-279-6619",
      "main_sin_loc" => "CO08*1-JFE6WH",
      "main_sin_fid" => "IM59*1-IVMRHD",
      "main_sin_phone" => "855-279-6619",
      "main_nyc_loc" => "CO08*1-JFE6WH",
      "main_nyc_fid" => "IM59*1-IVMRHG",
      "main_nyc_phone" => "855-279-6619",
      "legal" => "MDC-18-216",
      "legal_copy" => "Residents of Maine are not eligible for this offer."
    ),
    "IM59*1-K068OX" => array(
      "main_home_loc" => "IM59*1-K068OX",
      "main_home_phone" => "855-385-2311",
      "main_npc_loc" => "CO08*1-K0C2V1",
      "main_npc_fid" => "IM59*1-IVMRDB",
      "main_npc_phone" => "855-385-2311",
      "main_orl_loc" => "CO08*1-K0C2V1",
      "main_orl_fid" => "IM59*1-IVMRDE",
      "main_orl_phone" => "855-385-2311",
      "main_sin_loc" => "CO08*1-K0C2V1",
      "main_sin_fid" => "IM59*1-IVMRHD",
      "main_sin_phone" => "855-385-2311",
      "main_nyc_loc" => "CO08*1-K0C2V1",
      "main_nyc_fid" => "IM59*1-IVMRHG",
      "main_nyc_phone" => "855-385-2311",
      "legal" => "MG-18-194",
      "legal_copy" => "Residents of Maine, Alabama, Hawaii, Idaho, Missouri, North Dakota, Ohio, Washington and West Virginia are not eligible for this offer."
    ),
    "IM59*1-KE6WOI" => array(
      "main_home_loc"   => "IM59*1-KE6WOI",
      "main_home_phone" => "855-762-0236",
      "main_npc_loc"    => "CO08*1-KE4EKS",
      "main_npc_fid"    => "IM59*1-IVMRDB",
      "main_npc_phone"  => "855-762-0236",
      "main_orl_loc"    => "CO08*1-KE4EKS",
      "main_orl_fid"    => "IM59*1-IVMRDE",
      "main_orl_phone"  => "855-762-0236",
      "main_sin_loc"    => "CO08*1-KE4EKS",
      "main_sin_fid"    => "IM59*1-IVMRHD",
      "main_sin_phone"  => "855-762-0236",
      "main_nyc_loc"    => "CO08*1-KE4EKS",
      "main_nyc_fid"    => "IM59*1-IVMRHG",
      "main_nyc_phone"  => "855-762-0236",
      "legal"           => "MG-18-194",
      "legal_copy"      => "Residents of Maine, Alabama, Hawaii, Idaho, Missouri, North Dakota, Ohio, Washington and West Virginia are not eligible for this offer."
    )

  );


  function find_main_set($loc_table, $fid, $loc) {
    $loc_found = false;
    $fid_found = false;

    $loc_set = "IM59*1-KE6WOI";

    foreach($loc_table as $set_key => $set) {
      foreach($set as $key => $value) {
        // check loc
        if (strpos($key, '_loc') !== false) {
          if($value==$loc) {
            $loc_found = true;
          }
        }

        // check fid
        if (strpos($key, '_fid') !== false) {
          if($value==$fid) {
            $fid_found = true;
          }
        }

        if($loc_found&&$fid_found) {
          $loc_set = $set_key;
          return $loc_set;
        }
      }
    }
    return $loc_set;
  }

  $loc_set = "IM59*1-KE6WOI";

  if($_GET["main_loc"]) {
    $loc_set = $_GET["main_loc"];
  } else if ($_GET["loc"]&&!$_GET["fid"]) {
    $loc_set = $_GET["loc"];
  } else {
    $loc_set = find_main_set($loc_table, $_GET["fid"], $_GET["loc"]);
  }

  $loc = $loc_table[$loc_set];

  if(!$loc) {
    $loc = $loc_table["IM59*1-KE6WOI"];
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' id='marriott-css'  href='/wp-content/plugins/mvcweb/assets/mvcweb/css/marriott.css?ver=1531423087' type='text/css' media='all' />
    <link rel='stylesheet' id='webfonts-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/mvcweb/css/webfonts.css?ver=4.9.7' type='text/css' media='all' />
    <link rel="stylesheet" type="text/css" href="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing.css?ver=1.2">
    <link rel='stylesheet' id='slick-css-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/slick/slick.css?ver=4.9.7' type='text/css' media='all' />
<link rel='stylesheet' id='slick-theme-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/slick/slick-theme.css?ver=4.9.7' type='text/css' media='all' />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/jquery/js/jquery-3.2.1.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/jquery-ui-1.12.1/jquery-ui.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/jquery-ui-touch-punch.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/popper/popper.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/bootstrap-4.0.0-dist/js/bootstrap.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/slideout.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/slick/slick.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/jquery.sticky.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/javascript/utils.js?ver=1531423087'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/jquery.twbsPagination.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/readmore/readmore.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/moment.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/store.everything.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/js.cookie.js?ver=4.9.7'></script>
<script type="text/javascript">
function satelliteTrack2(trackName, customFunction) {
  console.log("satelliteTrack");
  if (!trackName) {
    console.log("No tracking name");
    return;
  }

  if (typeof customFunction !== "undefined" && customFunction) {
    customFunction();
  }  else {
    console.log  ("No custom function");
  }

  if (typeof _satellite !== "undefined" && _satellite) {
    _satellite.track(trackName);
    console.log('satellite fired with: ', trackName);
  } else {
    console.log("no satellite");
  }
}

</script>
<?php
  global $post;
  $context = simplexml_load_string(get_post_field( 'post_content', $post->ID));
		$post_slug = strtolower(str_replace('-shtml', '', $post->post_name));
		$split = array();
		if(strpos($post_slug, '-')) {
			$split = array_filter(explode('-', $post_slug), function($value) { return $value !== ''; });
    }

    $digitalLayerData = json_decode(file_get_contents(dirname(__FILE__) . "/digitalLayerData.json"));
    if(isset($digitalLayerData->$post_slug)) {
      // If a slug is found, then read the info for that page
        $digitalLayerObj = array();
        foreach($digitalLayerData->$post_slug as $key=>$value) {
          $digitalLayerObj[$key] = $value;
        }
      }
?>
<script type='text/javascript'>
var digitalData = <?php echo json_encode($digitalLayerObj, JSON_PRETTY_PRINT); ?> || {};
  if (digitalData.pageInfo && digitalData.pageInfo.errorCode && digitalData.pageInfo.errorCode === '404') {
    digitalData.pageInfo.pageName += window.location.href;
  }

  digitalData.pageInfo = {};
  digitalData.pageInfo.pageName = "<?php echo $pagename; ?>";
  digitalData.pageInfo.siteSection = "MVC - Landing Pages";
  digitalData.pageInfo.formID = "<?php echo $_GET["fid"];?>";
  digitalData.pageInfo.formLOC = "<?php echo $_GET["loc"];?>";

  <?php
    if($isform) {?>
      digitalData.pageInfo.formSerial = getUniqueID();
    <?php } ?>

  var benefitLevelCookie = Cookies.get('ownerBenefitLevel');
  ownerTypeCookie = Cookies.get('ownershipType');
  digitalData.userInfo = {
    benefitLevel: benefitLevelCookie || "No OBL",
    ownerType: ownerTypeCookie || "Non-Owner",
    mrwNumber: ""
  };
  if (digitalData.pageInfo && digitalData.pageInfo.formLOC){
    var newLoc = getUrlParam('loc');
    digitalData.pageInfo.formLOC = newLoc || digitalData.pageInfo.formLOC;
  }
</script>

  <title><?php echo $context->xpath("//template/@title")[0];?></title>
  <?php
			$siteUrl = get_site_url();
			echo "<!-- Site URL: " . $siteUrl . "---> \n\r";
      if(strpos($siteUrl, 'https://www.marriottvacationclub.com') !== FALSE || strpos($siteUrl, 'https://marriottvacationclub.com') !== FALSE) {
		?>
			<script src="//assets.adobedtm.com/launch-EN31aa2451be744634a8b3889f449cad55.min.js"></script>
			<?php
			} else if(strpos($siteUrl, 'tps1') !== FALSE) {
		?>
				<script src="//assets.adobedtm.com/launch-EN6f46b9a9181745c9b45662985c793fec-staging.min.js"></script>
				<?php
			} else {
		?>
					<script src="//assets.adobedtm.com/launch-EN2cfbf54f3d8a4243b590278c8c6aa32e-development.min.js"></script>
					<?php
			}
		?>
</head>
  <body id="wrapper_offers_b" <?php body_class(); ?> >
    <div id="wrapper" class="toggled">
  <?php include("nav.php"); ?>
         <!-- Page Content -->
 <div id="page-content-wrapper">

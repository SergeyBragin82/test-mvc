<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head class="test">
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel='stylesheet' id='marriott-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/mvcweb/css/marriott.css?ver=1531423087' type='text/css' media='all' />-->
    <link rel='stylesheet' id='webfonts-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/mvcweb/css/webfonts.css?ver=4.9.7' type='text/css' media='all' />
    <link rel='stylesheet' id='slick-css-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/slick/slick.css?ver=4.9.7' type='text/css' media='all' />
<link rel='stylesheet' id='slick-theme-css'  href='https://s23040.pcdn.co/wp-content/plugins/mvcweb/assets/slick/slick-theme.css?ver=4.9.7' type='text/css' media='all' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/wp-content/plugins/mvcweb/assets/mvcweb/css/mvc-wifi.css?ver=1.6">
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
<!--<script type="text/javascript">
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

</script>-->
<?php
//  global $post;
//  $context = simplexml_load_string(get_post_field( 'post_content', $post->ID));
//		$post_slug = strtolower(str_replace('-shtml', '', $post->post_name));
//		$split = array();
//		if(strpos($post_slug, '-')) {
//			$split = array_filter(explode('-', $post_slug), function($value) { return $value !== ''; });
//    }
//    
//    $digitalLayerData = json_decode(file_get_contents(dirname(__FILE__) . "/digitalLayerData.json"));
//    if(isset($digitalLayerData->$post_slug)) {
//      // If a slug is found, then read the info for that page
//        $digitalLayerObj = array();
//        foreach($digitalLayerData->$post_slug as $key=>$value) {
//          $digitalLayerObj[$key] = $value;
//        }
//      }
?>
<script type='text/javascript'>
var digitalData = <?php echo json_encode($digitalLayerObj, JSON_PRETTY_PRINT); ?> || {};
  if (digitalData.pageInfo && digitalData.pageInfo.errorCode && digitalData.pageInfo.errorCode === '404') {
    digitalData.pageInfo.pageName += window.location.href;
  }

  digitalData.pageInfo.pageName = "<?php echo $pagename; ?>";
  digitalData.pageInfo.siteSection = "MVC - Landing Pages";

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
<title>Wi-Fi | Marriott's <?php echo $context->xpath("//template/@title")[0];?></title>
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
    <?php } else if(strpos($siteUrl, 'tpd4') !== FALSE) { ?>
      <script src="//assets.adobedtm.com/launch-ENeed993cb01724d478b7e027697974699-development.min.js" async></script>
    <?php } else if(strpos($siteUrl, 'tpd5') !== FALSE) { ?>
      <script src="//assets.adobedtm.com/launch-EN443eb51a6c1444d0952ea6fbc3deb478-development.min.js" async></script>
        <?php
      } else {
    ?>
          <script src="//assets.adobedtm.com/launch-EN2cfbf54f3d8a4243b590278c8c6aa32e-development.min.js"></script>
          <?php
      }
    ?>
</head>
    <body>
        <div id="wrapper-wifi">
            <!-- Page Content -->
            <div id="page-content-wrapper-wifi">

<?php
	 /*
	Plugin Name: Marriott Vacation Club
	Plugin URI: http://www.marriottvacationclub.com
	Description: The MVCWeb Plugin
	Version: 1.0
	Author: Marriott Vacation World
	Author URI: http://www.marriottvacationsworldwide.com/
	*/
	# Ensure that only wordpress is loading this php file
	if (!function_exists('write_log')) {
	 function write_log ( $log )  {
			if ( is_array( $log ) || is_object( $log ) ) {
				 error_log( print_r( $log, true ) );
			} else {
				 error_log( $log );
			}
	 }
	}
	if(!function_exists('get_file_mod_time')) {
		function get_file_mod_time($filePath) {
			return filemtime($filePath);
		}
	}
	if(!function_exists('register_style')) {
		function register_style($styleName, $styleUrl, $deps = array(), $styleVer = false) {
			wp_deregister_style($styleName);
			wp_register_style(
				$styleName,
				$styleUrl,
				$deps,
				$styleVer
			);
			wp_enqueue_style($styleName);
		}
	}
	if(!function_exists('register_script')) {
		function register_script($scriptName, $scriptUrl, $deps = array(), $scriptVer = false) {
			wp_deregister_script($scriptName);
			wp_register_script(
				$scriptName,
				$scriptUrl,
				$deps,
				$scriptVer
			);
			wp_enqueue_script($scriptName);
		}
	}

	function add_query_vars_filter( $vars ){
		$vars[] = "keyword";
		$vars[] = "pagination";
		$vars[] = "pulse";
	 return $vars;
	}
	function add_xfs_header() {
		header("X-Frame-Options: DENY");
	
	}
	function set_loc_cookie() {
		$path = $_SERVER['REQUEST_URI'];
		$currUrl = get_site_url() . $path;
		$query = parse_url($currUrl, PHP_URL_QUERY);
		parse_str($query, $queryArr);
		$noCaseQuery = array_change_key_case($queryArr);
		if (array_key_exists('loc', $noCaseQuery)) {
			// setting cookie expiration to 30 days
			setcookie('loc', $noCaseQuery['loc'], time()+60*60*24*30, "/");
		}
	}
	//Add custom query vars
	add_filter( 'query_vars', 'add_query_vars_filter', 10, 3);
	add_action('send_headers', 'add_xfs_header');
	add_action('send_headers', 'set_loc_cookie');
	defined( 'ABSPATH' ) or die();
	if(!defined('PHP_INT_MIN')) {
		define('PHP_INT_MIN', ~PHP_INT_MAX);
	}
	include(dirname(__FILE__) . '/util/form-processing.php');
	include(dirname(__FILE__) . '/util/booking-processing.php');

	function mvc_router() {
		if (!is_admin()) {
			add_action( 'wp_enqueue_scripts', 'mvcweb_front_end_scripts' );
			add_filter( 'template_include', 'mvcweb_front_end_template' );
			
			load_xml_data();
		} else if (is_user_logged_in()) {
			add_action( 'get_header', 'remove_admin_login_header' );
			add_action( 'wp_enqueue_scripts', 'mvcweb_back_end_scripts' );
			include('back_end.php');
		}
	}

	function remove_admin_login_header() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}


	function mvcweb_back_end_scripts () {

register_script('jquery', plugins_url('assets/jquery/js/jquery-3.2.1.min.js', __FILE__));
		
		register_script(
			'flatpickr',
			'https://cdn.jsdelivr.net/npm/flatpickr'
		);

		register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
	}

	function mvcweb_front_end_scripts() {
		if(strpos($_SERVER['SERVER_NAME'], 'localhost') === false){
			$GLOBALS['img_path'] = '/wp-content/images/';
		} else {
			$GLOBALS['img_path'] = 'https://s23039.pcdn.co/wp-content/images/';
		}
		$GLOBALS['asset_path'] = plugins_url('/assets/', __FILE__);
		$GLOBALS['olapic_customer_id'] = '216967';
		$GLOBALS['valid_activities_icons'] = array(
			0 => 'beach',
			1 => 'dining',
			2 => 'featured',
			3 => 'golf',
			4 => 'recreation',
			5 => 'services',
			6 => 'shopping',
			7 => 'ski',
			8 => 'spa',
			9 => 'themarketplace',
			10 => 'themepark',
			11 => 'urban',
		);

//		register_style('bootstrap', plugins_url('assets/bootstrap-4.0.0-dist/css/bootstrap.min.css', __FILE__));

		register_style('jqueryUIStyle', plugins_url('assets/jquery-ui-1.12.1/jquery-ui.min.css', __FILE__));

		register_style('icofont', plugins_url('assets/mvcweb/css/icofont.css', __FILE__));

		register_style('webfonts', plugins_url('assets/mvcweb/css/webfonts.css', __FILE__));

		register_style('icomoon', plugins_url('assets/mvcweb/css/icomoon.css', __FILE__));

		register_style('slick-css', plugins_url('assets/slick/slick.css', __FILE__));

		register_style('slick-theme', plugins_url('assets/slick/slick-theme.css', __FILE__));

		register_style('icomoon', plugins_url('assets/mvcweb/css/icomoon.css', __FILE__));

		register_style('hamburgers', plugins_url('assets/mvcweb/css/hamburgers/hamburgers.css', __FILE__));

		register_style('marriott', plugins_url('assets/mvcweb/css/marriott.css', __FILE__), array(), get_file_mod_time(dirname(__FILE__) . '/assets/mvcweb/css/marriott.css'));

		register_script('jquery', plugins_url('assets/jquery/js/jquery-3.2.1.min.js', __FILE__));

		register_script(
			'jqueryUI',
			plugins_url('assets/jquery-ui-1.12.1/jquery-ui.min.js', __FILE__)
		);

		register_script(
			'jqueryUITouchPunch',
			plugins_url('assets/jquery-ui-touch-punch.js', __FILE__)
		);

		register_script('popper', plugins_url('assets/popper/popper.min.js', __FILE__));
		register_script('bootstrap-js', plugins_url('assets/bootstrap-4.0.0-dist/js/bootstrap.min.js', __FILE__));
		

		register_script('slideout-js',
		plugins_url('assets/slideout.min.js', __FILE__));

		register_script('slick-js',
		plugins_url('assets/slick/slick.min.js', __FILE__));

		register_script('sticky-js',
		plugins_url('assets/jquery.sticky.js', __FILE__));

		register_script('mvcwebUtils',
		plugins_url('assets/javascript/utils.js', __FILE__), array(), get_file_mod_time(dirname(__FILE__).'/assets/javascript/utils.js'));

		register_script('pagination',
		plugins_url('assets/jquery.twbsPagination.min.js', __FILE__));

		register_script(
			'readmore-js',
			plugins_url('assets/readmore/readmore.min.js', __FILE__)
		);
		register_script(
			'moment-js',
			plugins_url('assets/moment.min.js', __FILE__)
		);
		register_script(
			'store-js',
			plugins_url('assets/store.everything.min.js', __FILE__)
		);
		register_script(
			'cookie-js',
			plugins_url('assets/js.cookie.js', __FILE__)
		);

		register_script(
			'activitites',
			plugins_Url('assets/javascript/activities.js', __FILE__)
		);
	}

	function mvcweb_front_end_template($template) {
		include ('front_end.php');
	}

	function load_xml_data() {
		$mvcXmlData = simplexml_load_file(dirname(__FILE__) . '/data/output.xml');
		$resortDataList = $mvcXmlData->ResortCollection;
		$GLOBALS['resort_data'] = $resortDataList;
	}

	function get_param($param) {
		return get_option("MVC_CONFIG_" . $param);
	}

	function reduce_url($url) {
		// /[^a-zA-Z0-9 ]/g
		return preg_replace('/[^a-z0-9]/i', '_', $url);
	}

	function mvc_redirect_logic(){
    if( is_404() ){
			// find existing url
			$lookup = reduce_url($_SERVER['REQUEST_URI']);
			// Try to see if we can redirect
			$new_location = get_option("MVC_REDIRECT_" . $lookup);
			if (is_null($new_location) || empty($new_location)) {
				header('HTTP/1.1 404 Not Found');
				$_GET['e'] = 404;
				include ('front_end.php');
			} else {
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: " . $new_location);
			}
			die();
			
		} else {
			if(isset($_GET['pulse']) && !empty($_GET['pulse'])) {
				if($_GET['pulse'] === 'true') {
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: " . get_site_url() . '/destinations/marriott-vacationclub-club-resorts-pulse');
					die();
				}
			}
		}
	}
	add_action( 'template_redirect', 'mvc_redirect_logic' );
	add_action('init', 'mvc_router');

	
	function changeHeadersForICS( $headers )
	{
	    $headers['Content-Type'] = 'text/calendar; charset=utf-8';
	    $headers['Content-Disposition'] = 'attachment; filename="activity.ics"';
	    $headers['Content-Transfer-Encoding'] = 'binary';
	    return $headers;
	}
	if ( substr( $_SERVER['REQUEST_URI'], 0, 14 ) === '/activity-ics/' ) add_filter('wp_headers', 'changeHeadersForICS');
?>

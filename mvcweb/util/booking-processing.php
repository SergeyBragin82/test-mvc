<?php
add_action( 'admin_post_nopriv_booking_form', 'handle_booking_form');
add_action( 'admin_post_booking_form', 'handle_booking_form' );

function handle_booking_form() {
  if(isset($_POST)) {
    unset($_POST['action']);
    $bookingRedirect = 'https://www.marriott.com/reservation/availabilitySearch.mi?' . http_build_query($_POST);
    write_log($bookingRedirect);
    header("location: " . $bookingRedirect);
  }
}
 ?>

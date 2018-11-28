<?php

// Make it a plain text file
header('Content-Type:text/plain');

// Output based on HTTP host
if( "www" === explode('.', $_SERVER['HTTP_HOST'])[0] ) {

    // Production robots.txt
?>
# robots.txt for https://www.marriottvacationclub.com

User-agent: *
Disallow: /resales/includes/footer_disclaimer.shtml
Disallow: /ajax/
Disallow: /ap/
Disallow: /ap/landing/
Disallow: /ebrochures/
Disallow: /errors/
Disallow: /friendshare/
Disallow: /kauailagoons/
Disallow: /ko-tr/
Disallow: /landing/
Disallow: /marriott-rewards/
Disallow: /mh/
Disallow: /nc/
Disallow: /sr/
Disallow: /sweeps/
Disallow: /test/
Disallow: /wi/

<?php
} else {

    // Test site robots.txt
?>

# robots.txt for tpd1, tpd2, tps1

User-agent: *
Disallow: /

<?php } ?>

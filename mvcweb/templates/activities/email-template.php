<!DOCTYPE html>
<html>
	<head>
		<title>Marriott Vacation Club</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Libre+Baskerville);
            @import url('https://fonts.googleapis.com/css?family=Poppins:200');

            @media screen and (-webkit-min-device-pixel-ratio:0) {
                h1{
                    font-family: 'Libre Baskerville', serif;
                }
                h2{
                    font-family: 'Poppins', sans-serif;
                }
            }
		</style>
	</head>

	<body style="margin: 0;color: #645f5a;font-size: 14px;">
		<div style="max-width: 700px;min-width: 670px;margin: 0 auto;background-color: #f5f8fa;padding: 0 25px 25px 25px;">
			<div style="text-align: center;">
				<a href="https://www.marriottvacationclub.com/" style="width: 100px; height:25px;display: block;margin: 0 auto;">
					<img alt="Marriott Vacation Club Logo" style="width: 100%"
						src="cid:mvc-logo"/>
				</a>
			</div>
			<div style="background-color: #fff;padding: 100px 40px 25px;">
				<h1 style="font-family: 'Libre Baskerville',serif;text-align: center;font-size: 2.5rem;margin: 1rem 0;color: #645f5a;">Lovely collections to enjoy</h1>
				<h2 style="font-family: Poppins,sans-serif;text-align: center;font-size: 1.5rem;font-weight: 200;margin: .7rem 0;color: #645f5a;">Amazing activities saved for you!</h2>
				<hr style="background-color: #c7b299;width: 75px;height: 7px;margin: 0 auto;border: none;"/>
				<p id="message" style="font-family: Arial, Helvetica, sans-serif;color: #645f5a;line-height: 1.5;text-align: left;font-size: 1rem;margin-bottom: 2rem;`">
					<?php echo $message; ?>
				</p>
				<h3 id="from" style="text-align: left;font-family: Arial, Helvetica, sans-serif;color: #645f5a;font-size: 20px;padding-bottom: 12px;font-weight: bold;">
					Here’s what <?php echo ucfirst($from); ?> has shared with you
				</h3>
				<ul style="display: block;margin: 0;padding: 0;border-bottom: 1px solid #dddddd;list-style: none;">
					<?php foreach ( $occurrences as $occ ):?>
					<li style="box-sizing: border-box;border-top: 1px solid #dddddd;min-height: 120px;padding: 20px 0;line-height: 1.5em;margin: 0;">
						<a href="<?php echo get_permalink( $_POST['sharing_page']); ?>#<?php echo $occ->data->xpath("@id")[0] . '_' . $occ->occurenceDate->format('YmdHi'); ?>" style="font-family: Arial, Helvetica, sans-serif;color: #159486;float: right;"><i class="fa fa-heart"></i>&nbsp;Visit Activity</a>
						<div style="display: inline-block;float: left;width: 100px;margin-right: 10px;">
							<img src="cid:img_<?php echo $occ->data->xpath("@id")[0]; ?>" alt="<?php echo $occ->data->ActivityTitle; ?>" style="width: 100%;">
						</div>
						<h3 style="font-family: Arial, Helvetica, sans-serif;color: #645f5a;font-size: 1.4rem;font-weight: 500;text-transform: uppercase;margin: 5px 0;">
							<?php echo $occ->data->ActivityTitle; ?>
						</h3>
						<p style="font-family: Arial, Helvetica, sans-serif;color: #645f5a;margin: 5px 0;"><?php
						if ( $occ->occurenceDate->format( 'G' ) == '0' ){ // if it's fist hour of day php DateTime::format generate wrong string
				            $fakeDate = clone $occ->occurenceDate;
                            $fakeDate->sub( new DateInterval( 'P1D' ) );
                            echo  $fakeDate->format( 'l M jS Y - 12:i\p\m' );
                        } else {
                            echo $occ->occurenceDate->format( 'l M jS Y - g:ia' );
                        }
                        ?></p>
                        <p style="font-family: Arial, Helvetica, sans-serif;color: #645f5a;margin: 5px 0;">
                        	<?php echo $occ->data->ActivityDescription; ?>
                        </p>
						
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div style="padding: 20px 40px;text-align: center;">
				<div style="font-size: 14px;font-weight: bold;">
					<a href="#" style="font-family: Arial, Helvetica, sans-serif;color: #159486;text-decoration: none;">HELP CENTER</a>
					<span style="margin: 0 1rem;">•</span>
					<a href="#" style="font-family: Arial, Helvetica, sans-serif;color: #159486;text-decoration: none;">SUPPORT 24/7</a>
					<span style="margin: 0 1rem;">•</span>
					<a href="#" style="font-family: Arial, Helvetica, sans-serif;color: #159486;text-decoration: none;">ACCOUNT</a>
				</div>
				<div>
					<p style="font-family: Arial, Helvetica, sans-serif;color: #645f5a;font-size: 17px;font-weight: 500;">© Copyright 2018, Marriott Vacation Club International. All rights reserved.</p>
				</div>
				<div>
					<a href="mailto:owner.services@vacationclub.com" target="_blank" style="font-family: Arial, Helvetica, sans-serif;color: #159486;text-decoration: none;font-size: 17px;font-weight: 500;">
						owner.services@vacationclub.com
					</a>
					&nbsp;|&nbsp; 
					<a href="tel:800-307-7312" target="_blank" style="font-family: Arial, Helvetica, sans-serif;color: #159486;text-decoration: none;font-size: 17px;font-weight: 500;">800-307-7312</a>
				</div>
			</div>
		</div>
	
	</body>
</html>

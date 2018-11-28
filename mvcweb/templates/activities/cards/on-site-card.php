<?php
    $activity_row = $event->data;

    $photo_map = $activity_row->xpath("photo_map")[0];
    $photo_map_x = $activity_row->xpath("photo_map_x")[0];
    $photo_map_y = $activity_row->xpath("photo_map_y")[0];
    
    $activityId = $event->data->xpath("@id")[0];
    $occurrenceId = $activityId .'_'.$event->occurenceDate->format('YmdHi');
?>
<div class="card position-relative"
		data-tags="<?php echo $event->data->xpath("tags")[0]; ?>"
		data-start="<?php echo $event->occurenceDate->format('Y-m-d') ?>"
		data-start-time="<?php echo $event->occurenceDate->format('H:i') ?>"
		data-end="<?php echo $activity_row->xpath("endDate")[0]?>"
		<?php // echo ($activity_row->xpath("frequency")[0]=="weekly" ? "data-day='" . $activity_row->xpath("dayOfWeek")[0] . "'" : ""); ?>
		data-frequency="<?php echo $event->data->frequency; ?>"
		data-resort-code = "<?php echo $context->xpath("//code")[0]?>"
		data-activity-id="<?php echo $activityId; ?>"
		data-occurence-id="<?php echo $occurrenceId; ?>"
		style="order: <?php echo $order_counter++; ?>">
    <?php if($activity_row->xpath("reservations")[0]=="yes") { ?>
    <div class="card-label px-2 py-1">
        Requires reservation
    </div>
    <?php } ?>
    <div class="card-header position-relative bg-transparent px-3 py-2">
        <div class="activities-title-block pt-3">
        	<div class="title-wrapper">
                <h6 class="card-title text-uppercase mb-2 mr-2">
                    <?php echo ($activity_row->xpath("ActivityTitle")[0]); ?>
                </h6>
                <div class="date mb-2">
                    <?php
                    if ( $event->occurenceDate->format( 'G' ) == '0' ){ // if it's fist hour of day php DateTime::format generate wrong string
                        $fakeDate = clone $event->occurenceDate;
                        $fakeDate->sub( new DateInterval( 'P1D' ) );
                        echo  $fakeDate->format( 'l M jS Y - 12:i\p\m' );
                    } else {
                        echo $event->occurenceDate->format( 'l M jS Y - g:ia' );
                    }
                    ?>
                    <?php if ( isset( $event->repeatAt ) ) echo "<br class=\"layout-table-only\">\nand " . $event->repeatAt; ?>
                </div>
            </div>
            <div class="action-block d-flex justify-content-start align-items-center">
                <div class="dropdown btn-group action-icon" id="ddCalWrapper">
                    <a href="#" data-toggle="dropdown" id="dropdownCalendar" aria-haspopup="true" aria-expanded="false" data-boundary="ddCalWrapper">
                        <i class="icon icon-calendar-plus-o"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownCalendar">
                        <a class="dropdown-item link-underlined" href="javascript:void();" data-export-type="ics">
                            <i class="icon icon-apple"></i>APPLE CALENDAR
                        </a>
                        <a class="dropdown-item link-underlined" target="_blank" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php
                                    echo $event->data->ActivityTitle;
                                    ?>&details=<?php echo $event->data->ActivityDescription;
                                    ?>&dates=<?php echo $event->occurenceDate->format('Ymd\THis\Z') .'/'.$event->occurenceDate->format('Ymd\THis\Z');
                                    ?>&location=<?php echo $location; ?>">
                            <i class="icon icon-google"></i>GOOGLE
                        </a>
                        <a class="dropdown-item link-underlined" href="javascript:void();" data-export-type="ics">
                            <i class="icon icon-windows8"></i>OUTLOOK
                        </a>
                        <!-- <a class="dropdown-item link-underlined" target="_blank" href="https://outlook.live.com/owa/?path=/calendar/view/Month&rru=addevent&startdt=<?php
                                    echo $event->occurenceDate->format('Y-m-d\THis\Z');
                                    ?>&subject=<?php echo $event->data->ActivityTitle;
                                    ?>&body=<?php echo $event->data->ActivityDescription; ?>">
                            <i class="icon icon-windows8"></i>Outlook.com
                        </a> -->
                    </div>
                </div>
                <a class="action-icon" href="tel:<?php echo $activity_row->xpath("ActivityPhone")[0] !='' ? $activity_row->xpath("ActivityPhone")[0] : $context->Resort->ResortAddress->phone;?>" aria-haspopup="true" aria-expanded="false">
                    <i class="icon icon-phone-square"></i>
                </a>
                <a class="action-icon" href="#" aria-haspopup="true" aria-expanded="false" data-image="<?php echo $photo_map; ?>" data-x="<?php echo $photo_map_x; ?>" data-y="<?php echo $photo_map_y; ?>">
                    <i class="icon icon-social-google-map"></i>
                </a>
                <a class="action-icon add-to-favorites js-add-to-favorites"
                   href="#" aria-haspopup="true" aria-expanded="false">
                    <i class="icon icon-heart added"></i>
                    <i class="icon icon-heart-stroke not-added"></i>
                </a>
            </div>
            <div class="card-text layout-list-only read-more-wrapper collapsed js-read-more-block">
                <span class="text-ellipsis js-text-ellipsis"><?php echo $event->data->ActivityDescription ?></span>
                <a href="#" class="pl-1 link-underlined js-read-more read-more">
                    <span class="show-more">read more</span>
                    <span class="hide-more">close</span>
                </a>
            </div>
        </div>
        <div class="text-center price-block" style="<?php if (!floatval($activity_row->xpath("currencyPrice")[0])>0) {?>display: none;<?php }?>">
            <div class="price-container">
            	<?php $currency = $activity_row->xpath("currency")[0]; ?>
                <span class="price"><?php echo $currency ?><?php echo $activity_row->xpath("currencyPrice")[0]; ?></span><br/>
                <span class="currency"><?php echo $currency == '$' ? 'USD' : 'EUR'?></span>
            </div>
        </div>
    </div>
    <div class="card-img-top layout-table-only" alt="" style="background:url('<?php echo $activity_row->xpath("photo")[0];?>'); background-size: cover;"></div>
    <!-- <img class="card-img-top layout-table-only" src="<?php echo $activity_row->xpath("photo")[0];?>" alt=""> -->
    <div class="card-body px-3 pt-4 pb-3 layout-table-only">
        <div class="info-accent"></div>
        <p class="card-text js-read-more-container"><?php echo $activity_row->xpath("ActivityDescription")[0]; ?></p>
    </div>
</div>
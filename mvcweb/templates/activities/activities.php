<?php
    require_once(dirname(__DIR__) . '/admin/activities/activities_categories.php');
    $categories = $GLOBALS["activities_categories_" . strtolower($context->xpath("//code")[0])];
?>
<div id="activities-block" class="activities-block">
    <div class="container">
        <div class="activities-info-block">
            <h2 class="activities-title mb-4">
                Activities
                <div class="activities-title-underline"></div>
            </h2>
            <p class="text-center">
                To help you plan your ideal vacation, we've curated the most popular activities that can be found both
                at our resort and
                in the surrounding<br>
                area. Simply select "Off–Site" or "On–Site" and the category of activities that you're interested in and
                we'll do
                the legwork for you!<br>
                All onsite activities are complimentary unless noted by a $ or €.
            </p>
        </div>
    </div>
    <div class="container container-wide position-relative overflow-hidden">
        <div class="row">
            <div class="filters-overlay js-filters-overlay d-none"></div>
            <div class="col-lg-2 d-lg-block activities-filters-wrapper js-activities-filters-wrapper">
                <div class="d-flex flex-column activities-filters-block ">
                    <div class="d-flex activities-filters-header">
                        <i class="icon icon-filter d-none d-lg-inline"></i>Filters
                        <span class="btn-closed-filters">
                            <svg width="12px" height="15px" viewBox="0 0 16 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="MI-Hertz-Landing---Mobile-" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="MI-----Nav-item-Expanded" transform="translate(-342.000000, -33.000000)" fill="#645f5a">
                                        <rect id="Rectangle-3-Copy-3" transform="translate(350.000000, 41.500000) rotate(-316.000000) translate(-350.000000, -41.500000) " x="340" y="40" width="20" height="3" rx="1"></rect>
                                        <rect id="Rectangle-3-Copy-4" transform="translate(350.000000, 41.500000) rotate(-224.000000) translate(-350.000000, -41.500000) " x="340" y="40" width="20" height="3" rx="1"></rect>
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="scrollable">
                        <div id="on-site-filters">
                            <?php
                            foreach($categories as $key => $category) {?>
                                <div class="activities-filter">
                                    <!-- BEGIN -->
                                    <button class="btn btn-block btn-link"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#<?php echo $key; ?>"
                                            aria-expanded="false"
                                            aria-controls="age">
                                        <?php echo $key; ?>
                                        <span class="icon">
                                        <span class="line line-1"></span>
                                        <span class="line line-2"></span>
                                    </span>
                                    </button>
                                    <div class="activities-filter-list collapse" id="<?php echo $key; ?>">
                                        <?php foreach($category as $subkey => $subcategory) {?>
                                            <div class="form-check">
                                                <input class="form-check-input js-filter" name="<?php echo $subkey; ?>" type="checkbox" id="cat_<?php echo $subkey; ?>">
                                                <label class="form-check-label" for="cat_<?php echo $subkey; ?>"><?php echo $subcategory; ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                        <div class="activities-filter" id="off-site-filters" style="display:none;">
                            <button class="btn btn-block btn-link"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#yelp"
                                    aria-expanded="false"
                                    aria-controls="yelp">
                                Categories
                                <span class="icon">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                            </span>
                            </button>
                            <div class="activities-filter-list collapse" id="yelp">
                                <div class="form-check">
                                    <input class="form-check-input js-filter" name="cat_1" type="checkbox" id="cat_1" checked>
                                    <label class="form-check-label" for="cat_1">Sports &amp; Recreation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input js-filter" name="cat_2" type="checkbox" id="cat_2" checked>
                                    <label class="form-check-label" for="cat_2">Arts &amp; Entertainment</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input js-filter" name="cat_3" type="checkbox" id="cat_3" checked>
                                    <label class="form-check-label" for="cat_3">Restaurants &amp; Bars</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input js-filter" name="cat_4" type="checkbox" id="cat_4" checked>
                                    <label class="form-check-label" for="cat_4">Nightlife</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input js-filter" name="cat_5" type="checkbox" id="cat_5" checked>
                                    <label class="form-check-label" for="cat_5">Shopping</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input js-filter" name="cat_6" type="checkbox" id="cat_6" checked>
                                    <label class="form-check-label" for="cat_6">Kid Fun</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-10">
                <div class="activities-content-block">
                    <div class="activities-top-bar mb-2 d-none d-lg-block">
                        <div class="d-flex align-items-center">
                            <div class="activities-toggle">
                                <span class="js-activity-toggle-mode mode-toggler" data-type="onSite">ON-SITE</span>
                                <span class="js-activity-toggle-mode mode-toggler active" data-type="offSite">OFF-SITE</span>
                            </div>
                            <div class="activities-top-bar-right">
                                <div class="row no-gutters px-2 py-1">
                                    <div class="col-lg-3 pr-2">
                                        <div class="activities-date">
                                            <div class="input-group icon-right">
                                                <input type="text"
                                                       class="form-control"
                                                       id="activityDate"
                                                       title="Activity Date"
                                                       placeholder="Jump To Date"
                                                />
                                                <div class="input-group-append js-datepicker-trigger datepicker-trigger">
                                                    <span class="input-group-text"><i class="icon-calendar2"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 pr-3">
                                        <div class="activities-sort">
                                            <div class="input-group ui-front">
                                                <select id="sort-by" class="custom-select js-sorting" name="sortBy" title="Sort activities">
                                                    <option disabled selected value="">Sort by...</option>
                                                    <option value="favourites">Favorites</option>
                                                    <option value="asc">Ascending Dates</option>
                                                    <option value="desc">Descending Dates</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pr-2 align-items-center justify-content-between d-flex">
                                        <div id="share-button" class="activities-share">
                                            <i class="icon-share2 mr-1"></i>
                                            Share Favorites
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between layout-options">
                                            <button type="button" class="layout-option mr-2 js-layout-option" data-type="list">
                                                <i class="icon-list3"></i>
                                            </button>
                                            <button type="button" class="layout-option js-layout-option active" data-type="table">
                                                <i class="icon-table2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="activities-top-bar-mobile d-lg-none">
                        <div class="px-4 py-2 text-center position-relative activities-top-bar-title">
                            <div class="d-flex align-items-center filters-mobile">
                                <button type="button" class="btn btn-action js-mobile-filters">
                                    <i class="icon icon-filter position-absolute icon-left"></i>
                                </button>
                            </div>
                            Activities
                            <div class="d-flex align-items-center layout-options-mobile">
                                <button type="button" class="btn btn-action js-layout-option" data-type="list">
                                    <i class="icon icon-list-numbered"></i>
                                </button>
                                <button type="button" class="btn btn-action js-layout-option active" data-type="table">
                                    <i class="icon icon-image"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex position-relative justify-content-between border-bottom py-2 activities-top-bar-menu">
                            <button type="button"
                                    class="btn btn-action with-border activity-toggle-mode-mobile js-activity-toggle-mode"
                                    data-type="onSite">
                                <i class="icon icon-building-o"></i>
                                Onsite
                            </button>
                            <button type="button"
                                    class="btn btn-action with-border active activity-toggle-mode-mobile js-activity-toggle-mode"
                                    data-type="offSite">
                                <i class="icon icon-building-o"></i>
                                Offsite
                            </button>
                            <button type="button" data-target="dropdownCalendar"
                                    class="btn btn-action with-border js-slide-down">
                                <i class="icon icon-calendar2"></i> Calendar
                            </button>
                            <button type="button" data-target="dropdownSortBy"
                                    class="btn btn-action with-border js-slide-down">
                                <i class="icon icon-sort-amount-asc2"></i> Sort By
                            </button>
                            <button type="button" data-toggle="modal"
                                    data-target="#share-modal"
                                    class="btn btn-action">
                                <i class="icon icon-heart"></i> Share
                            </button>
                            <div class="d-none justify-content-center slide-down-dropdown js-slide-down-dropdown"
                                 id="dropdownSortBy">
                                <button type="button" class="btn py-1 btn-action with-border js-sort-by-option" data-value="favourites">
                                    Favorite
                                    <i class="icon icon-heart"></i>
                                </button>
                                <button type="button" class="btn py-1 btn-action with-border js-sort-by-option" data-value="asc">
                                    Date
                                    <i class="icon icon-play4"></i>
                                </button>
                                <button type="button" class="btn py-1 btn-action with-border js-sort-by-option" data-value="desc">
                                    Date
                                    <i class="icon icon-play4"></i>
                                </button>
                            </div>
                            <div id="dropdownCalendar" class="d-none slide-down-dropdown dropdown-calendar-mb">
                                <div class="horizontal-calendar-wrapper">
                                    <div class="horizontal-calendar js-horizontal-calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="activities-grid-wrapper">
                        <div class="activities-grid js-activities-grid layout-table">
                            <div class="card-deck flex-wrap js-card-deck off-site-card-deck active" id="off-site-container" data-type="offSite">

                            </div>
                            <div class="card-deck flex-wrap on-site-card-deck js-card-deck" id="on-site-container" data-type="onSite">
                              <?php
                                  $addr = $context->Resort->ResortAddress;
                                  $location = $context->Resort->altName . '. '
                                        . $addr->country . ' '
                                        . $addr->state . ', '
                                        . $addr->street1
                                        . '(lat: ' . $addr->latitude . '; lon: ' . $addr->longitude . ')';
                                  $order_counter=0;
                                  require_once 'activity-events.php';
                                  $data = new SimpleXMLElement(get_option("MVC_OSA_" . strtolower($context->xpath("//code")[0])));
                                  $events = getActivitiesOccurences( $data->xpath("//OSARowCollection/Row[active='yes']") );
                                  foreach ( $events as $et => $event ){
                                      include('cards/on-site-card.php');
                                  }
                              ?>
                            </div>
                        </div>
                        <div class="gradient d-none d-lg-block js-gradient"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('cards/off-site-card.php'); ?>

<!--<div id="shareFavouritesDialog" class="" title="Share favorites by email">-->
<!--   	<form action="/activity.share" method="post">-->
<!--   		<input type="hidden" name="code" value="--><?php //echo $context->xpath("//code")[0]; ?><!--"/>-->
<!--   		<div id="share-emails">-->
<!--   			<fieldset class="only-one"><input type="email" name="mailto[]"/><span class="remove-row">X</span></fieldset>-->
<!--   		</div>-->
<!--   		<input type="submit" value="send email" class="marriott-btn"/><span class="add-row">add recipient</span>-->
<!--   	</form>-->
<!--</div>-->



<script type="text/javascript">
    var server_prefix = <?php echo json_encode(get_site_url()); ?>;
    var yapi = null;
    var img_path= '<?php echo $GLOBALS['img_path']; ?>';
    var activity_module;

    var resort = {
        latitude: <?php echo $context->xpath("//ResortAddress/latitude")[0]; ?>,
        longitude: <?php echo $context->xpath("//ResortAddress/longitude")[0]; ?>,
    };
    var category_id;

    $(document).ready(function(e) {
        activity_module = new ActivityModule(document.getElementById('activities-block'));
        activity_module.options.filters = ["1", "2", "3", "4", "5", "6"];
        activity_module.getData();

        if ( window.location.hash && window.location.hash.length > 1 ){

        	$( 'span.js-activity-toggle-mode[data-type="onSite"]' ).click();
        }

		$( "#share-button" ).on( "click", function(){
            $('#share-modal').modal('show');
		});

		$( "#share-modal").on( "click", ".send", function() {
            $("#share-form").submit();
            $("#share-modal .close").click();
        });

        $( ".action-icon").on( "click", ".icon-social-google-map", function(event) {
            event.preventDefault();
            event.stopPropagation();

            var parent = $(this).parent();
            var img_src = parent.attr('data-image');
            var x = parent.attr('data-x');
            var y = parent.attr('data-y');

            if (img_src != ""){

                $("#map-modal .img-map").attr("src", img_src);
                $("#map-modal .pin").css("display", "block");
                $("#map-modal .pin").css("left", x + "%");
                $("#map-modal .pin").css("top", y + "%");
            } else {
                $("#map-modal .img-map").attr("src", "/wp-content/plugins/mvcweb/assets/images/NO_IMG.png");
                $("#map-modal .pin").css("display", "none");
            }

            $('#map-modal').modal('show');
        });

    });
    $( document ).on( "click", function() {
        if ( $('.js-activities-filters-wrapper').hasClass('mobile-active') ){
            $('footer').addClass('filter-active');
        } else {
            $('footer').removeClass('filter-active');
        }

    });

</script>
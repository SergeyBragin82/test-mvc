<?php
$pagetitle = "Offers";
$pagename = "MVC - Landing Pages | Call Center | Offers | C";
include("header.php");
?>
<div class="mainheader">
    <div class="header-desktop">
        <img class ="mlogo" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/Marriott_logo_horiz.svg" alt="Marriott logo">
        <a href="javascript:void();" data-toggle="sidebar">
            <img width="35" height="35" class ="hamburgermenu" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/hamburger.svg" alt="hamburger">
        </a>

    </div>
    <div class="header-mobile">
        <img class ="mlogo" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/Marriott_logo_horiz.svg" alt="Marriott logo">
        <a href="javascript:void();" data-toggle="sidebar">
            <img width="35" height="35" class ="hamburgermenu" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/hamburger.svg" alt="hamburger">
        </a>
    </div>
    <div class="d-flex">
        <div class="headerrectangle py-3 px-4 align-self-center">
            <div class="rectanglecopy">
                <div container="toprectanglecopy">
                    <div class="d-flex">
                        <div class="whiteline align-self-center"></div>
                        <h4 class="percentoff align-self-center my-0 py-0 mx-2">Up to 70% off</h4>
                        <div class="whiteline align-self-center"></div>
                    </div>
                </div>
                <h1>4 Day, 3 Night<br/>Vacations</h1><br />
                <div class="d-flex">
                    <div class="whiteline whiteline-from align-self-center"></div>
                    <h3 class="from align-self-center my-0 py-0 mx-2">from</h3>
                    <div class="whiteline whiteline-from align-self-center"></div>
                </div>
                <span class="rectanglemoney"><h2>$199-$598</h2></span>
                <p class="perstay-money">per stay</p>
                <p class="retailvalue-money">average retail value $680-$1,896</p>

            </div>
        </div>
    </div>
</div>
<div class="tealdiv mb-0 mt-0 d-block d-md-none"></div>

<div class="marriottpackages">
    <div class="container container-mobile">
        <div class="row">
            <div class="col-sm-12 col-lg-6 choice-is-yours">
                <div class="mt-2 mt-md-4 pl-3 pr-3 pl-md-0 pr-md-0">
                    <h1>The Choice Is Yours.</h1>
                    <h4><span class="vacayexperience">SELECT YOUR VACATION EXPERIENCE.</span></h4>
                    <span class="timeshare">Attendance at a 90-minute timeshare sales presentation is required.</span>
                    <div class="participationdetails">
                        <h4><p class="particpationclick pt-0 mt-0">
                                <a class="desktop-block" href="/landing/cc/offers-c/details?loc=<?php echo $loc_set; ?>">Details of Participation</a>
                                <a class="mobile-block" href="/landing/cc/offers-c/details?loc=<?php echo $loc_set; ?>">Details of Participation</a>
                            </p></h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 callusat-mob">
                <div class="goldline mt-md-5 mt-2 mx-md-0"></div>
                <h6><p class="callat">CALL US AT:</p></h6>
                <h5><p class="phone mt-3"><a class="teal-fg" href="tel:+<?php echo $loc["main_home_phone"];?>"><?php echo $loc["main_home_phone"];?></a></p></h5>
            </div>
        </div>
        <hr class="d-none d-lg-block">
        <div class="row mt-1 mt-md-5">
            <div class="col-lg text-center mb-5">
                <a class="a-link" href="/landing/cc/offers-c/newport/?fid=<?php echo $loc["main_npc_fid"];?>&loc=<?php echo $loc["main_npc_loc"];?>&main_loc=<?php echo $loc_set;?>">
                    <div class="image-description-border pb-5">
                        <img class="img-fluid" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/newport_thumb.jpg" alt="Photo of a Hotel"><br/>
                        <div class="pl-3 pr-3 pb-3">
                            <span class="resortinfo"><h1>Marriott's Newport Coast<sup>&reg;</sup> Villas</h1></span>
                            <span class="location"><h6>Newport, California</h6></span>
                            <span class="days"><h4>4 days, 3 nights</h4></span>
                            <span class="money"><h4>From  <span> $299 per stay</span></h4></span>
                        </div>
                    </div>
                </a>

                <a class="btn marriott-btn" href="/landing/cc/offers-c/newport/?fid=<?php echo $loc["main_npc_fid"];?>&loc=<?php echo $loc["main_npc_loc"];?>&main_loc=<?php echo $loc_set;?>">GET OFFER</a>
            </div>
            <div class="col-lg text-center mb-5">
                <a class="a-link" href="/landing/cc/offers-c/newyorkcity/?fid=<?php echo $loc["main_nyc_fid"];?>&loc=<?php echo $loc["main_nyc_loc"];?>&main_loc=<?php echo $loc_set;?>">
                    <div class="image-description-border pb-5">
                        <img class="img-fluid" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/newYork_thumb.jpg" alt="Photo of a Hotel"><br/>
                        <div class="pl-3 pr-3 pb-3">
                            <span class="resortinfo"><h1>New York Marriott<sup>&reg;</sup>, East Side</h1></span>
                            <span class="location"><h6>New York City, New York</h6></span>
                            <span class="days"><h4>4 days, 3 nights</h4></span>
                            <span class="money"><h4>From  <span> $499 per stay</span></h4></span>
                        </div>
                    </div>
                </a>
                <a class="btn marriott-btn" href="/landing/cc/offers-c/newyorkcity/?fid=<?php echo $loc["main_nyc_fid"];?>&loc=<?php echo $loc["main_nyc_loc"];?>&main_loc=<?php echo $loc_set;?>">GET OFFER</a>
            </div>


        </div>
        <div class="row">
            <div class="col-lg text-center mb-5">
                <a class="a-link" href="/landing/cc/offers-c/orlando/?fid=<?php echo $loc["main_orl_fid"];?>&loc=<?php echo $loc["main_orl_loc"];?>&main_loc=<?php echo $loc_set;?>">
                    <div class="image-description-border pb-5">
                        <img class="img-fluid" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/cypress_thumb.jpg" alt="Photo of a Hotel"/><br/>
                        <div class="pl-3 pr-3 pb-3">
                            <span class="resortinfo"><h1>Marriott's Cypress Harbor</h1></span>
                            <span class="location"><h6>Orlando, Florida</h6></span>
                            <span class="days"><h4>4 days, 3 nights</h4></span>
                            <span class="money"><h4>From  <span> $199 per stay</span></h4></span>
                        </div>
                    </div></a>
                <a class="btn marriott-btn" href="/landing/cc/offers-c/orlando/?fid=<?php echo $loc["main_orl_fid"];?>&loc=<?php echo $loc["main_orl_loc"];?>&main_loc=<?php echo $loc_set;?>">GET OFFER</a>
            </div>
            <div class="col-lg text-center mb-5">
                <a class="a-link" href="/landing/cc/offers-c/palmbeaches/?fid=<?php echo $loc["main_sin_fid"];?>&loc=<?php echo $loc["main_sin_loc"];?>&main_loc=<?php echo $loc_set;?>">
                    <div class="image-description-border pb-5">
                        <img class="img-fluid" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/oceana_thumb.jpg" alt="Photo of a Hotel"><br/>
                        <div class="pl-3 pr-3 pb-3">
                            <span class="resortinfo"><h1>Marriott's Oceana Palms</h1></span>
                            <span class="location"><h6>The Palm Beaches, Florida</h6></span>
                            <span class="days"><h4>4 days, 3 nights</h4></span>
                            <span class="money"><h4>From  <span> $199 per stay</span></h4></span>
                        </div>
                    </div></a>
                <a class="btn marriott-btn" href="/landing/cc/offers-c/palmbeaches/?fid=<?php echo $loc["main_sin_fid"];?>&loc=<?php echo $loc["main_sin_loc"];?>&main_loc=<?php echo $loc_set;?>">GET OFFER</a>
            </div>
        </div>
    </div>
<!--    <div class="participationdetails text-center mb-4">
        <h4><p class="particpationclick pt-0 mt-0">
                <a class="desktop-block" href="/landing/cc/offers-c/details/details?loc=<?php// echo $loc_set; ?>">Click Here for Details of Participation</a>
                <a class="mobile-block" href="/landing/cc/offers-c/details/details?loc=<?php// echo $loc_set; ?>">Click Here for Details of Participation</a>
            </p>
        </h4>
    </div>-->
</div>

<?php include("footer.php"); ?>
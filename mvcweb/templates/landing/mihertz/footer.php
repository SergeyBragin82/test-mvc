<div class="participationdetails">
        <hr>
    </div>
    <div class="infodetails row">
        <img class="desktop-block" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/doily_3.png" alt="doily image">
      <div class="companyinfo mr-4  ">
        <h6><p class="infoheader kessel-book">COMPANY INFORMATION</p></h6>
        <h6><p class="infop"><a href="//www.marriottvacationsworldwide.com/company/about-us.shtml" target='_blank'>Corporate Info</a><br/></p></h6>
        <h6><p class="infop"><a href="/careers">Careers</a></p></h6>
      </div>
    <div class="legalinfo">
      <h6><p class="infoheader kessel-book">LEGAL INFORMATION</p></h6>
        <h6><p class="infop"><a href="/state-and-legal-disclosures">State and Legal Disclosures</a><br/></p></h6>
        <h6><p class="infop"><a href="/privacy">Privacy Policy</a><br/></p></h6>
        <h6><p class="infop"><a href="/terms-of-use">Terms of Use</a></p></h6>
    </div>
</div>
<div class="teal-bg text-center py-4" onclick="javacript:btp();">
    <img class="arrow d-block mx-auto" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/uparrow.svg" alt="up arrow">
    <a class="white-fg reg-link mb-4" href="javascript:void();">BACK TO TOP</a><br/><br/>
</div>
<script>
    function btp() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
<footer class="mainfooter">
    <div class="mainfooterinfo1">
        <p>Marriott Vacation Club International and the programs and products provided under the Marriott Vacation Club brand are not owned, developed or sold by Marriott International, Inc. Marriott Vacation Club International uses the Marriott marks under license from Marriott International, Inc. and its affiliates.<br />
            This is neither an offer to sell timeshare nor a solicitation to buy timeshare to residents in jurisdictions in which registration requirements have not been fulfilled, including any Member State of the European Union, and your eligibility to purchase may depend upon your residency. All requests originating in Member States of the European Union will not be carried out by Marriott Vacation Club. Visit <a class="teal-fg" href="https://www.MarriottVacationClub.eu">MarriottVacationClub.eu</a> for Marriott Vacation Club products available for purchase by residents of the European Union.</p>
    </div>
    <div class="mainfooterinfo2">
        <span><img width="50" class="housinglogo" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/equal_housing_logo.png" alt="Housing Logo"></span>
        <p class="mt-1"><b>THIS ADVERTISING MATERIAL IS BEING USED FOR THE PURPOSE OF SOLICITING THE SALE OF TIMESHARE PERIODS. ANY NAMES AND ADDRESSES ACQUIRED WILL BE USED FOR THE PURPOSE OF SOLICITING THE SALE OF TIMESHARE PERIODS. THE COMPLETE OFFERING TERMS ARE IN AN OFFERING PLAN AVAILABLE FROM MARRIOTT OWNERSHIP RESORTS, INC. D/B/A MARRIOTT VACATION CLUB INTERNATIONAL.</b>
        </p>
    </div>
    <div class="mainfooterinfo3 pt-2">
        <p>Images depicted may be developer's conceptual renderings and the description above may include features, furnishings and amenities that are proposed and subject to change at any time.</p>
        <p>&copy; Copyright 2018, Marriott Vacation Club International. All rights reserved.</p>
    </div>
</footer>
</div><!-- /.container -->
<!-- Menu Toggle Script -->
<script>
    $('[data-toggle="sidebar"]').click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    if (typeof (_satellite) !== 'undefined') {
        _satellite.pageBottom();
    }
</script>
<!-- Modal External Link Confirm -->
<div class="modal fade marriott-modal" id="legalExternalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="legal-text-copy" style="font-size: 14px !important">By clicking "Yes" below, you acknowledge being transferred to a website that is not owned, operated or controlled by Marriott Vacation Club (MVC), and that MVC is not responsible for information or activities associated with such website. Further, you acknowledge that MVC shall not be liable to you or any third party for any claims, damages, or losses of any kind that may result from your use of such website.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class='marriott-btn' id='modalLegalConfirm'>yes</button>
                <button type="button" class="marriott-btn" id='modalLegalClose'>no</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#modalLegalClose').click(function () {
        $('#legalExternalModal').modal('hide');
    });
    $('#modalLegalConfirm').click(function () {
        openLinkNewTab($(this).attr('data-link'));
        $('#legalExternalModal').modal('hide');
    });
</script>
</body>
</html>

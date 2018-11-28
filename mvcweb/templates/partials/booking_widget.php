<?php function bookingWidget($propertyCode, $childResorts, $parentName = '') {
	$bookingWidgetAction = esc_url(admin_url('admin-post.php'));
	$childResortDropdown = '';
	$propertyCodeInput = "<input type='hidden' name='propertyCode' value='" . $propertyCode . "'>";
	if ($childResorts !== NULL && count($childResorts) > 0) {
		$childResortDropdown .= '<div class="row"><div class="col"><div class="form-group"><label for="childResorts">Property Name</label><select class="form-control booking-form-element" name="propertyCode" id="childResorts"><option value="'. $propertyCode .'" selected>' . $parentName . '</option>';
		foreach($childResorts as $childResort) {
			$isSelected = $childResort->marshaHotelCode === $propertyCode ? 'selected' : '';
			$childResortDropdown .= "<option value='" . (string)$childResort->marshaHotelCode . "' ".$isSelected. " >" . $childResort->resortDisplayName . "</option>";
		}

		$childResortDropdown .= '</select></div></div></div>';
		$propertyCodeInput = '';
	}
	return <<<HTML
		<div class='calendar'>
			<h3 class='header-text'>book this resort</h3>
			<div class='btn-toolbar  option-menu-text' role='toolbar' aria-label='Book options'>
				<a role="button" class="btn btn-block book-btn book-btn-active resort-selection-active" href="#" id='rent-booking'>
					<span>rent
					<i class='icon-rounded-down'></i>
						
					</span>
				</a>
				<a role="button" class="btn book-btn" href="https://owners.marriottvacationclub.com/timeshare/mvco/getProductSummary" target='_blank' id='ownership-booking'>
				use your ownership
				</a>
			</div>
			<div class='calendar-body'>
				<form id='booking-form' action="$bookingWidgetAction" method='POST'>
					<input type='hidden' name='pid' value=''>
					<input type='hidden' name='scid' value=''>
					<input type='hidden' name='isSearch' value='false'>
					<input type='hidden' name='useRewardsPoints' value='false'>
					$propertyCodeInput
					<div class="container">
						$childResortDropdown
						<div class="row">
							<div class="col-12 col-sm-6 col-md-6">
								<div class="form-group">
									<label for="checkInDate">Check in</label>
									<input id="checkInDate" class="form-control booking-form-element" name='fromDate' readonly/>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6">
								<div class="form-group">
									<label for="checkOutDate">Check out</label>
									<input id="checkOutDate" class="form-control booking-form-element" name='toDate' readonly/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-6 col-md-6">
								<div class="form-group">
									<label for="numberRooms">Number of Rooms</label>
									<select class="form-control booking-form-element" name="numberOfRooms" id="numberRooms">
										<option value="1" selected>1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6">
								<div class="form-group">
									<label for="adultsRoom">Adults per Room</label>
									<select class="form-control booking-form-element" name="numberOfGuests" id="adultsRoom">
										<option value="1">1</option>
										<option value="2" selected>2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-6 col-md-6">
								<div class="form-group">
									<label for="specialCode">Special Rates Code</label>
									<select class="form-control booking-form-element" name="clusterCode" id="specialCode">
										<option value='' style='display: none;'>Enter Code</option>
										<option value="NONE">None</option>
										<option value="AAA">AAA/CAA</option>
										<option value="S9R">Senior Discount</option>
										<option value="GOV">Government &amp; Military</option>
										<option value="corp">Corporate/Promo</option>
									</select>
									<input class="form-control booking-form-element corporate-code-input" type="text" id="corporateCodeInput" name="corporateCode" placeholder="Enter Code Here" style="display: none;">
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6">
								<a role="button" type="submit" class="btn btn-booking-submit" id='booking-submit'>
									SUBMIT
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" name='isRateCalendar' value="true" id="flexibleDatesBooking">
									<input name='isRateCalendar' type='hidden' value='false'>
									<label class="custom-control-label" for='flexibleDatesBooking'>Flexible Dates</label>
								</div>
							</div>
								<div class="col-6">
									<a href="https://www.marriott.com/reservation/lookupReservation.mi" target="_blank">View Existing Reservation</a>
								</div>
						</div>
					</div>
				</form>
			</div>
		</div>
HTML;
}

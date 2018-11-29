<script src="<?php echo $GLOBALS['asset_path'] . 'javascript/carouselCenter.js'?>"></script>
<script>
	$(function () {
		$('.resort-menu-container').sticky({
			topSpacing: 65,
			zIndex: 120,
		});

		$('.resort-menu-container').on('sticky-start', function() {
			$('.resort-menu-container').css({
				margin: 0,
			}).insertAfter($('header'));
		});
		$('.resort-menu-container').on('sticky-end', function() {
			$('.resort-menu-container').css({
				margin: '7px 0 0',
			}).appendTo($('#sticky-wrapper'));
		});
		//$('.resort-submenu').append($('.resort-header-container'));
		function setupDatePicker() {
			var checkInDateWidget, checkOutWidget;
			var bookingForm = $('#booking-form');

			bookingForm.submit(function (e) {
				e.preventDefault();
				var formActionUrl = $(this).attr('action');
				var params = $.param($(this).serializeArray());
				var endPoint = "https://www.marriott.com/reservation/availabilitySearch.mi?" + params;
				window.open(endPoint);
			})
			// jQuery UI DatePicker setup
			$.datepicker.setDefaults($.datepicker.regional['en']);
			$.datepicker.setDefaults({
				dateFormat: 'mm/dd/yy',
				dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
				showOn: 'both',
				buttonText: '',
				showOtherMonths: true,
				selectOtherMonths: false,
				inline: true,
				nextText: "",
				prevText: "",
				showAnim: 'fadeIn',
			});

			$('#checkInDate').datepicker({
				minDate: 0,
				beforeShow: function (input, inst) {
					setTimeout(function () {
						if (getScreenSize().x < 576) {
							inst.dpDiv.outerWidth($(input).outerWidth());
							inst.dpDiv.css('left', '' + $(input).offset().left + 'px');
						}
					});
				},
				onClose: function (selectedDate, inst) {
					var newDate = new Date(selectedDate);
					$('#checkOutDate').datepicker("option", {
						minDate: new Date(newDate.setTime(newDate.getTime() + 1 * 86400000))
					});
					$('#checkOutDate').datepicker("refresh");
				},
				onChangeMonthYear: function (year, month, inst) {
					if (getScreenSize().x < 576) {
						setTimeout(function () {
							inst.dpDiv.outerWidth($('#checkInDate').outerWidth());
							inst.dpDiv.css('left', '' + $('#checkInDate').offset().left + 'px');
						});
					}
				}
			});
			$('#checkOutDate').datepicker({
				minDate: 1,
				beforeShow: function (input, inst) {
					setTimeout(function () {
						if (getScreenSize().x < 576) {
							inst.dpDiv.outerWidth($(input).outerWidth());
							inst.dpDiv.css('left', '' + $(input).offset().left + 'px');
						}
					});
				},
				onChangeMonthYear: function (year, month, inst) {
					if (getScreenSize().x < 576) {
						setTimeout(function () {
							inst.dpDiv.outerWidth($('#checkOutDate').outerWidth());
							inst.dpDiv.css('left', '' + $('#checkOutDate').offset().left + 'px');
						});
					}
				}
			});
			$('#checkInDate').datepicker('setDate', new Date());
			$('#checkOutDate').datepicker('setDate', "+1d");

			$('#booking-submit').click(function () {
				bookingForm.submit();
			});
			$('#corporateCodeInput').change(function() {
				var val = $(this).val();
				$(this).val(val.trim());
			});
			$('#specialCode').change(function () {
				var selectedVal = $(this).val();
				var selectedName = $(this).find(':selected').text();
				if (selectedVal === 'corp' && selectedName === 'Corporate/Promo') {
					$('#corporateCodeInput').show();
				} else {
					$('#corporateCodeInput').val('');
					$('#corporateCodeInput').hide();
					if (selectedVal === 'NONE') {
						$(this).val($("#specialCode option:first").val());
					}
				}
			});
		}

		function getCurrentSubpageLocation() {
			var pathName = window.location.pathname;
			if (pathName[pathName.length - 1] === '/') {
				pathName = pathName.substr(0, pathName.length - 1).replace('.shtml', '').replace('features', 'accommodations');
			}
			return pathName.substr(pathName.lastIndexOf('/') + 1);
		}

		function findActiveMenuTab() {
			var selector = '#resort-menu-' + getCurrentSubpageLocation();
			if ($(selector).length !== 0) {
				$(selector).addClass('resort-selection-active');
			} else {
				// edge case of resort overview
				selector = '#resort-menu';
			}
			return $(selector);
		}

		function setMenuTabActive(target) {
			$('.resort-menu').children('.resort-menu-option').each(function (index) {
				$(this).removeClass('resort-selection-active');
			});
			var toTarget = target || findActiveMenuTab();
			toTarget.addClass('resort-selection-active');
		}

		function setTripadvisorReviews(taData) {
			var taReviewLink =
				setupLegalPopup(
					$('<a>')
					.attr({
						href: data.web_url,
					})
				);
			var taReviewImg =
				$('<img>')
				.attr({
					id: 'taReviewImg',
					alt: 'tripadvisor ratings',
					src: data.rating_image_url,
				});
			var taReviewCount =
				$('<span>')
				.attr({
					id: 'taReviewNumber',
				})
				.html(data.num_reviews + " Reviews");
			var taReviewElement =
				$('.ta-container-review')
				.append(
					taReviewLink.append(
						taReviewImg,
						taReviewCount
					)
				)
				.fadeIn()
				.css({
					visibility: 'visible',
				})
				.resize();
		}

		function setTripAdvisorQuote(taData) {
			if (!taData.reviews) {
				return;
			}
			var filtered = taData.reviews.filter(function (review) {
				return review.rating >= 5;
			});
			var container = $('#taQuoteContainer');
			var containerCol = $('#quoteCol');
			var review = filtered[Math.floor(Math.random() * filtered.length)];
			var publishedDate = moment(review.published_date);
			var reviewText = review.text;
			var indexCutoff = Math.min(reviewText.length, 100);
			if (reviewText[indexCutoff] !== ' ') {
				indexCutoff = reviewText.indexOf(' ', indexCutoff);
			}
			reviewText = reviewText.substr(0, indexCutoff) + "...<span class='quote-more'>more</span>";
			var reviewContent =
				setupLegalPopup($('<a>').attr('href', review.url)
					.append(
						$('<blockquote class="ta-quote-content">')
						.append($('<h4>').addClass('quote-title').html("&ldquo;" + review.title + "&rdquo;"))
						.append($('<p>').addClass('quote-text').html(reviewText))
						.append(
							$('<img>')
							.attr('src', review.rating_image_url)
						)
						.append(
							$('<span>')
							.addClass('quote-meta')
							.html(
								"Reviewed by a TripAdvisor traveler, " +
								publishedDate.format('MM/DD/YYYY')
							)
						)
					));
			container.fadeIn();
			$('<div class="quote-content">').appendTo(containerCol)
				.append(
					reviewContent
				);
		}

		function retrieveTripadvisorData() {
			api("/api/tripadvisor", "GET", {
				taCode: <?php echo json_encode((string)$context->xpath('//tripAdvisorCode')[0]); ?>
			}, function (result) {
				try {
					data = JSON.parse(result);
					if (data) {
						setTripadvisorReviews(data);
						setTripAdvisorQuote(data);
					}
				} catch (e) {
					console.error('error trying to parse json response', result);
				}
				
			});
		}

		function checkForCorpCode() {
			if (sessionStorage.getItem('corporateCode')) {
				var corpCode = sessionStorage.getItem('corporateCode').trim();
				if (corpCode) {
					$('#specialCode').val('corp').change();
					$('#corporateCodeInput').val(corpCode).change();
				}
			}
		}

		setupDatePicker();
		setMenuTabActive();
		focusMobileMenuTab($('.resort-menu'), findActiveMenuTab());
		checkForCorpCode();

		var resortCode = <?php echo json_encode((string)$context->xpath("Resort/code")[0]);?>;
		// Disabling tripadvisor for Empire Palace resort
		if (resortCode !== 'BK' && resortCode !== 'TD') {
			retrieveTripadvisorData();
		}

		function removeMobileTouchHover(element, delay) {
			$(element.currentTarget).removeClass('resort-mobile-touch');
		}

		function focusMobileMenuTab(container, element) {
			if (!container || !element) {
				return;
			}
			$(container).animate({
				scrollLeft: $(element).position().left
			}, 500);
		} 

		$(window).resize(setPanelTop);

		$('.resort-menu-option').on({
			click: function() {
				setMenuTabActive($(this));
				focusMobileMenuTab($('.resort-menu'), $(this));
			},
			touchstart: function(event) {
				var option = $(this);
				if(!option.hasClass('resort-mobile-touch'))
					option.toggleClass('resort-mobile-touch');
			},
			touchend: removeMobileTouchHover,
			touchcancel: removeMobileTouchHover
		})
		$('#rent-booking').click(function (e) {
			e.preventDefault();
			if (getScreenSize().x < 768) {
				$(this).toggleClass('book-btn-up');
				$('.calendar-body').toggleClass('calendar-body-active');
			}
		});
		setPanelTop();
	});
</script>

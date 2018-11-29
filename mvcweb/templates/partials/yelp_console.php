<?php
	$activities = new SimpleXMLElement(get_option("MVC_ACTIVITY_DATA"));
	$activities_xml = $activities->xpath("//activity");

	$toReturn = "<div class='activities-menu' id='activitiesMenu' style='display: none;'>";

	foreach ($activities_xml as $activity) {
		$toReturn .= "<div class='activities-menu-option' id='" . $activity['id'] . "'><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='" . $activity['id'] . "' checked /><label class='form-check-label' for='".$activity['id']."'>" . $activity['name'] . "</label></div></div>";
	}
	$toReturn .= "</div>";
	echo $toReturn;
?>

	<div id='activitiesItemClone' style='display: none;'>
		<div class='activities-list-item'>
			<a href='' target='_blank'>
				<div class='container'>
					<div class='row'>
						<div class='col-lg-3 activities-list-item-picture pr-0'>
							<img src='' alt=''>
						</div>
						<div class='col-lg-9 activities-list-item-content'>
							<div style='position: relative;'>
								<h3 class='activities-list-item-header'>
								</h3>
								<div class='activities-list-item-stars'>
									<img class='activities-list-item-yelp-rating' src='' alt='yelp-star-rating'>
								
									<span>
									</span>
								
								</div>
							
							</div>
							<div class='activities-list-item-extra'>
								<span id='price'></span>
							
								<span class='activities-list-item-categories' id='categories'></span>
								
							</div>
						</div>
					</div>
				
				</div>

			</a>
		</div>
		<div class='break'>
			<hr />
		</div>
	</div>

	<script>
		$('.activities-menu-container').append($('#activitiesMenu'));
		$('#activitiesMenu').show();
		$('.activities-map-container-offsite').append($('#map'));

		var markersArray = [];
		var results = {};
		var yelpNotFoundImageSrc = '';

		function refreshHtml() {
			populateHtml();
			handleMapBounds();
		}

		function handleMapBounds() {
			var bounds = new google.maps.LatLngBounds();
			Object.keys(results).forEach(function (key) {
				if (results[key].display) {
					results[key].businesses.forEach(function (result) {
						if (result.mapMarker) {
							markersArray.push(result.mapMarker);
						}
					})
				}
			});
			for (var i = 0; i < markersArray.length; i++) {
				bounds.extend(markersArray[i].getPosition());
			}

			if (markersArray.length > 0) {
				map.fitBounds(bounds);
			} else {
				map.setCenter(new google.maps.LatLng('<?php echo((string)$context->xpath(' //latitude')[0]) ?>', '<?php echo((string)$context->xpath('//longitude')[0]) ?>'));
						$(".activities-list-container-offsite").html("No activities found. Please expand your search."); activateActivityContainer(
							"onsite", $("#onSiteActivities"));
					}
				}

				function retrieveActivities(activityId) {
					yelp_search('<?php echo((string)$context->xpath(' //latitude')[0]) ?>', '<?php echo((string)$context->xpath('//longitude')[0]) ?>', activityId);
					}

					function getYelpStarsImage(numOfStars) {
						var yelpStarsImage = "<?php echo $GLOBALS['img_path'] . 'yelp/regular_'; ?>";
						var starHalf = numOfStars - Math.floor(numOfStars);
						var starWhole = numOfStars - starHalf;
						var halfNameAdd = starHalf !== 0 ? '_half' : '';
						return yelpStarsImage + starWhole + halfNameAdd + '.png';
					}

					function populateHtml() {
						var htmlItems = results.businesses.map(
							function (element) {
								if (element.mapMarker) {
									element.mapMarker.setMap(map);
								}
								var yelpStarsImageSrc = getYelpStarsImage(element.rating);
								var listItemObj = $('#activitiesItemClone').clone().css('display', 'block');
								listItemObj.find('a').attr('href', element.url);
								if (!element.imageUrl) {
									element.imageUrl = "<?php echo $GLOBALS['img_path'] . '/yelp/Yelp-nophoto-Small.png'; ?>";
								}
								listItemObj.find('.activities-list-item-picture > img').attr('src', element.imageUrl || yelpNotFoundImageSrc,
									'alt', element.id);
								listItemObj.find('.activities-list-item-header').html(element.name);
								var starsParent = listItemObj.find('.activities-list-item-stars');
								starsParent.find('.activities-list-item-yelp-rating').attr('src', yelpStarsImageSrc);
								starsParent.find('span').html(element.reviewCount);
								listItemObj.find('#price').html(element.price);
								listItemObj.find('#categories').html(element.categories);
								return listItemObj;
							}
						);

						$(".activities-list-container-offsite").html(htmlItems);
						$(".activities-list-container-offsite").children().last().find('.break').css('display', 'none');

					}

					var yapi;

					function yelp_search(latitude, longitude, category_id) {


						if (results && results.businesses) {
							results.businesses.forEach(function (business) {
								if (business.mapMarker) {
									business.mapMarker.setMap(null);
								}
							});
						}
						markersArray.length = 0;
						results = {
							display: true,
							businesses: [],
						};

						$("#yelp_results").html("");

						if (yapi) 
							yapi.abort();

						yapi = api(<?php echo json_encode(get_site_url() . '/api/yelp/'); ?>, "GET", {
							lat: latitude,
							long: longitude,
							cat_id: category_id,
							radius: 10000
						}, function (result) {
							data = JSON.parse(result);
							if (data.businesses) {
								data.businesses.sort(function (a, b) {
									return b.rating - a.rating;
								});
								data.businesses.filter(function (business) {
									return business.rating >= 4;
								}).forEach(function (business) {
									var mapMarker = null;
									if (map) {
										mapMarker = new google.maps.Marker({
											position: {
												lat: parseFloat(business.coordinates.latitude),
												lng: parseFloat(business.coordinates.longitude),
											},
											map: map,
										});
										markersArray.push(mapMarker);
									}
									results.businesses.push({
										id: business.id,
										name: business.name,
										imageUrl: business.image_url,
										url: business.url,
										reviewCount: business.review_count,
										rating: business.rating,
										mapMarker: mapMarker,
										price: business.price,
										phone: business.phone,
										categories: business.categories.map(function (category) {
											return category.title;
										}).join(', '),
									})
								});
								populateHtml();
								handleMapBounds();
							} else {
							}
						});
					}

					$(".form-check").each(function (activity) {
						$(this).on("click", function (e) {
							var catID = $(this).find('.form-check-input').attr('id');
							markersArray.length = 0;
							if ($(e.target).closest('input[type="checkbox"]').length <= 0) {
								$(this).find('.form-check-input').prop('checked', !($(this).find('.form-check-input').prop('checked')));
								markersArray.length = 0;
							}

							var catList = [];
							$(".form-check-input").each(function (e) {
								if ($(this).prop("checked") == true) {
									catList.push($(this).attr('id'));
								}
							});


							var catIDs = catList.join(',');
							retrieveActivities(catIDs);
						});
					});

					retrieveActivities("1,2,3,4,5,6");
	</script>

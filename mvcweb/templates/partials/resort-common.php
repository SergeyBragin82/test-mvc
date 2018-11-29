<?php
function resortMenu($context) {
  $permalink = $context->xpath('/mvcweb/Resort/permalink')[0];
  return <<<HTML
  <!-- Resorts Overview Carousel Menu -->
  <div class="resort-menu-container">
    <div class="resort-menu">
      <a class="resort-menu-option" href="/vacation-resorts/$permalink" id="resort-menu" tabindex="0">
        <span>
          overview
        </span>
      </a>
      <a class="resort-menu-option" href="/vacation-resorts/$permalink/accommodations" id="resort-menu-accommodations" tabindex="0">
        <span>
          accommodations
        </span>
      </a>
      <a class="resort-menu-option" href="/vacation-resorts/$permalink/amenities" id="resort-menu-amenities" tabindex="0">
        <span>
          amenities
        </span>
      </a>
      <a class="resort-menu-option" href="/vacation-resorts/$permalink/activities" id="resort-menu-activities" tabindex="0">
        <span>
          activities
        </span>
      </a>
      <a class="resort-menu-option" href="/vacation-resorts/$permalink/map" id="resort-menu-map" tabindex="0">
        <span>
          map
        </span>
      </a>
    </div>
  </div>
HTML;
}

function resortMenuEbrochure($context) {
  global $post;

  $permalink = $context->xpath('/mvcweb/Resort/permalink')[0];
  
  return <<<HTML
  <!-- Resorts Overview Carousel Menu -->
  <div class="resort-menu-container">
    <div class="resort-menu">
      <a class="resort-menu-option" href="/ebrochures/$permalink/" id="resort-menu" tabindex="0">
        overview
      </a>
      <a class="resort-menu-option" href="/ebrochures/$permalink/accommodations" id="resort-menu-accommodations" tabindex="0">
        accommodations
      </a>
      <a class="resort-menu-option" href="/ebrochures/$permalink/amenities/" id="resort-menu-amenities" tabindex="0">
        amenities
      </a>
      <a class="resort-menu-option" href="/ebrochures/$permalink/activities/" id="resort-menu-activities" tabindex="0">
        activities
      </a>
       <a class="resort-menu-option" href="/ebrochures/$permalink/map" id="resort-menu-map" tabindex="0">
        <span>
          map
        </span>
      </a>
    </div>
  </div>
HTML;
}

function resortHeader($resortName, $resortTemperature, $context) {

  $ebrochure = $context->xpath("//@ebrochure_mode")[0]=="true";
  $permalink = $context->xpath('Resort/permalink')[0];
  $phone = $context->xpath('//phone')[0];
  $city = $context->xpath('//city')[0];
  $state = $context->xpath('//state')[0];
  $country = $context->xpath('//country')[0];
  $submenu = '';
  $location = [];
  if(!emptyOrNull($city) && strpos($resortName, 'Pulse') === FALSE) {
    $location[] = $city;
  }
  if(!emptyOrNull($state)) {
    $location[] = $state;
  }
  if(!emptyOrNull($country) && $country !== 'USA') {
    $location[] = $country;
  }
  $header = $resortName . ', ' . implode(', ', $location);

  $trust = "<a href=\"/state-and-legal-disclosures/#legal6\" class=\"resort-header-link\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Marriott Vacation Club Trust\">T</a>";

  $exchange = "<a href=\"/state-and-legal-disclosures/#legal6\" class=\"resort-header-link\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Marriott Vacation Club Destination Exchange Program\">E</a>";

  if($context->xpath("//mvwcTrustResorts")[0]=="false") $trust = "";
  if($context->xpath("//mvwcExchangeResorts")[0]=="false") $exchange = "";

  if (!$ebrochure) {
    $submenu = resortMenu($context);
  return <<<HTML
    <div class="container-fluid resort-header-container">
      <div class="resort-info">
        <div class="resort-header">
          <h1>
            $header
            $trust
            $exchange
          </h1>
        </div>
        <div class="resort-header-actions">
          <!--
          <div class="resort-action resort-action-divider">
            <i class="icon-location"></i>
            <a href="/vacation-resorts/$permalink/map" class="resort-action-link">
              location
            </a>
          </div>
          -->
          <div class='resort-action resort-action-divider ta-container-review'></div>
          <div class="resort-action resort-action-divider">
            <i class="icon-mobile-phone"></i>
            <a href="tel:$phone" class="resort-action-link">
              call
            </a>
          </div>
          <div class="resort-action">
            <i class="icon-sun-rise"></i>
            <span class="resort-action-weather">$resortTemperature&deg;F</span>
          </div>
          <a href='/vacation-resorts' class='resort-header-back'>
            view all resorts
          </a>
        </div>
      </div>
    </div>
    $submenu
HTML;
  } else {
    $submenu = resortMenuEbrochure($context);
    return <<<HTML
    <div class="container-fluid resort-header-container">
      <div class="resort-info">
        <div class="resort-header">
          <h1>
            $header
            $trust
            $exchange
          </h1>
        </div>
        <div class="resort-header-actions d-none">
          <!--
          <div class="resort-action resort-action-divider">
            <i class="icon-location"></i>
            <a href="/vacation-resorts/$permalink/map" class="resort-action-link">
              location
            </a>
          </div>
          
          <div class="resort-action resort-action-divider">
            <i class="icon-mobile-phone"></i>
            <a href="tel:$phone" class="resort-action-link">
              call
            </a>
          </div>-->
          <div class="resort-action">
            <i class="icon-sun-rise"></i>
            <span class="resort-action-weather">$resortTemperature&deg;F</span>
          </div>
        </div>
      
      </div>
      $submenu
    </div>
HTML;
  }
}

function resortBookingSection($brandCode, $propertyCode, $resortCode, $disclaimer, $title, $paragraph, $stylingClass = '', $extraTitle = '', $extraContent = '', $childResorts = NULL, $resortName = '', $ebrochure = false) {
  if($resortCode !== 'BK' && !$ebrochure) {
    $bodyHtml = '<div class="container resort-booking-container ' . $stylingClass . '"><div class="row"><div class="col-xs-12 col-sm-12 col-md-5" id="bookingInfo">';
  } else {
    $bodyHtml = '<div class="container resort-booking-container ' . $stylingClass . '"><div class="row"><div class="col-12 text-center" id="bookingInfo">';
  }
  
  if(!emptyOrNull($title)) {
    $bodyHtml .= '<h2 class="title-text">' . $title . '</h2>';
  }
  if(!emptyOrNull($paragraph)) {
    if($resortCode !== 'BK' && !$ebrochure) {
      $bodyHtml .= '<p class="vacation-text">' . $paragraph . '</p>';
    } else {
      $bodyHtml .= '<p class="vacation-text vacation-greatness-content">' . $paragraph . '</p>';
    }
  }
  if(!emptyOrNull($disclaimer)) {
    $bodyHtml .= $disclaimer;
  }
  if(!emptyOrNull($extraContent)) {
    $bodyHtml .= $extraContent;
  }
  $bodyHtml .= '</div>';
  if (($brandCode !== 'RCC' || $propertyCode === 'WHRLH') && $resortCode !== 'BK' && !$ebrochure) {
    $bodyHtml .= '<div class="col-xs-12 col-sm-12 col-md-7">' . bookingWidget($propertyCode, $childResorts, $resortName) . '</div>';
  }
  $bodyHtml .= '</div></div>';
  return $bodyHtml;
}
function tripAdvisorQuote2() {
  return tripAdvisorQuote();
}

function tripAdvisorQuote() {
  return <<<HTML
    <div class='container ta-container-quote' id='taQuoteContainer'>
      <div class='row'>
        <div class='col-xs-12 col-sm-12 col-md-8 offset-md-2' id='quoteCol'>
        <div class="white-bg ta-quote"><img height="20" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/open_quote.svg"/></div>
        <div class="white-bg ta-quote-up"><img height="20" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/close_quote.svg"/></div>
        </div>
      </div>
    </div>
HTML;
}

function tripAdvisorQuoteOffers() {
    return <<<HTML
    <div class='container ta-container-quote' id='taQuoteContainer'>
      <div class='row'>
        <div class='col-xs-12' id='quoteCol'>
        <div class="resort-action resort-action-divider ta-container-review pt-4"></div>
        <div class="white-bg ta-quote"><img height="20" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMi4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAzMi4xIDIyLjMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMyLjEgMjIuMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2VuYWJsZS1iYWNrZ3JvdW5kOm5ldyAgICA7fQ0KCS5zdDF7ZmlsbDojMDA5Njg3O30NCjwvc3R5bGU+DQo8ZyBjbGFzcz0ic3QwIj4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMTIuMywyLjJDOS42LDMuNCw3LjUsNC45LDYuMiw2LjdjLTEuMywxLjgtMi4xLDMuOC0yLjEsNi4yYzAuNi0wLjQsMS4yLTAuNywxLjctMC45YzAuNi0wLjIsMS4yLTAuMywxLjktMC4zDQoJCWMxLjUsMCwyLjYsMC41LDMuNSwxLjVzMS4zLDIuMiwxLjMsMy44cy0wLjYsMi45LTEuNywzLjljLTEuMSwxLTIuNSwxLjUtNC4yLDEuNWMtMiwwLTMuNi0wLjctNC45LTIuMkMwLjYsMTguNywwLDE2LjgsMCwxNC4zDQoJCUMwLDExLDAuOSw4LjIsMi44LDUuOEM0LjcsMy41LDcuNSwxLjUsMTEuMywwTDEyLjMsMi4yeiBNMzEuOSwyLjJDMjkuMSwzLjUsMjcsNSwyNS43LDYuOGMtMS40LDEuOC0yLjEsMy44LTIuMiw2LjINCgkJYzAuNi0wLjQsMS4yLTAuNywxLjgtMC45czEuMy0wLjMsMS45LTAuM2MxLjQsMCwyLjYsMC41LDMuNSwxLjVzMS4zLDIuMiwxLjMsMy44cy0wLjYsMi45LTEuNywzLjljLTEuMSwxLTIuNSwxLjUtNC4yLDEuNQ0KCQljLTIsMC0zLjYtMC43LTQuOC0yLjJzLTEuOC0zLjQtMS44LTUuOWMwLTMuMywwLjktNi4xLDIuOC04LjVjMS45LTIuNCw0LjctNC4zLDguNS01LjhMMzEuOSwyLjJ6Ii8+DQo8L2c+DQo8L3N2Zz4NCg=="/></div>
        <div class="white-bg ta-quote-up"><img height="20" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMi4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAzMi4xIDIyLjMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMyLjEgMjIuMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2VuYWJsZS1iYWNrZ3JvdW5kOm5ldyAgICA7fQ0KCS5zdDF7ZmlsbDojMDA5Njg3O30NCjwvc3R5bGU+DQo8ZyBjbGFzcz0ic3QwIj4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMC4yLDIwLjFDMywxOC45LDUsMTcuMyw2LjQsMTUuNmMxLjQtMS44LDIuMS0zLjgsMi4yLTYuMkM4LDkuOCw3LjQsMTAuMSw2LjgsMTAuM3MtMS4zLDAuMy0xLjksMC4zDQoJCWMtMS40LDAtMi42LTAuNS0zLjUtMS41UzAsNi45LDAsNS40czAuNi0yLjksMS43LTMuOUMyLjgsMC41LDQuMiwwLDUuOSwwYzIsMCwzLjYsMC43LDQuOCwyLjJzMS44LDMuNCwxLjgsNS45DQoJCWMwLDMuMy0wLjksNi4xLTIuOCw4LjVjLTEuOSwyLjQtNC43LDQuMy04LjUsNS44TDAuMiwyMC4xeiBNMTkuNywyMC4xYzIuOC0xLjMsNC44LTIuOCw2LjItNC41YzEuMy0xLjgsMi4xLTMuOCwyLjEtNi4yDQoJCWMtMC42LDAuNC0xLjIsMC43LTEuNywwLjlzLTEuMiwwLjMtMS45LDAuM2MtMS41LDAtMi42LTAuNS0zLjUtMS41cy0xLjMtMi4yLTEuMy0zLjhzMC42LTIuOSwxLjctMy45YzEuMS0xLDIuNS0xLjUsNC4yLTEuNQ0KCQljMiwwLDMuNiwwLjcsNC45LDIuMmMxLjIsMS40LDEuOCwzLjQsMS44LDUuOWMwLDMuMy0wLjksNi4xLTIuOCw4LjVjLTEuOSwyLjQtNC43LDQuMy04LjUsNS44TDE5LjcsMjAuMXoiLz4NCjwvZz4NCjwvc3ZnPg0K"/></div>
        </div>
      </div>
    </div>
HTML;
}
?>

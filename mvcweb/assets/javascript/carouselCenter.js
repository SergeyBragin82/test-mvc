$(function(){var e=$("<div></div>").addClass("new-arrows-center").insertAfter("#carousel-center"),t=$('<div><div class="dots-info" id="carousel-dots-info">1 of 24</div></div>').addClass("carousel-center-dots").insertAfter("#carousel-center"),d=$(".ta-img-container"),n=$("#carousel-center"),o=$(".logo"),i=function(e,t){return 991<t?(e.width()+convertRemToPixels(2)).toString()+"px":"15%"};n.on("init",function(e,t){var n=$(t.$slides[0]);n.find(".center-image-slide-container").addClass("gradient-inactive"),$(".new-arrows-center").appendTo("#carousel-center"),$(".carousel-center-dots").appendTo(".carousel-center");var o=t.$slides.length;if(1<o){var i=(t.currentSlide+1).toString()+" of "+o.toString();$("#carousel-dots-info").html(i)}else $("#carousel-dots-info").hide();d&&n.append(d.fadeIn().css("display","flex")),"undefined"!=typeof forceShowCaption&&n.find(".gallery-caption").show().effect("slide",{direction:"right"}).dequeue(),$("#carousel-center").fadeIn()}),n.slick({adaptiveHeight:!1,appendArrows:e,appendDots:t,centerMode:!0,centerPadding:getScreenSize().x<768?"0":i(o,getScreenSize().x),lazyLoad:"progressive",prevArrow:"<button type='button' class='carousel-prev' aria-label='Previous slide' type='button'><i class='icon-rounded-left' aria-hidden='true' /></button>",nextArrow:"<button type='button' class='carousel-next' aria-label='Next slide' type='button'><i class='icon-rounded-right' aria-hidden='true' /></button>",respondTo:"min",autoplay:!0,slidesToScroll:1,autoplaySpeed:1e4}),n.on("beforeChange",function(e,t,n,o){var i=t.$slides.length,r=$(t.$slides[n]),a=($(t.$slides[o]),(o+1).toString()+" of "+i);$("#carousel-dots-info").html(a),r.find(".gallery-caption").fadeOut(),0===n&&d&&d.hide()}),n.on("lazyLoaded",function(e,t,n,o){$(n).attr("alt",$(n).attr("data-alt"))}),n.on("lazyLoadError",function(e,t,n,o){$(n).attr("alt",$(n).attr("data-alt"))}),n.on("afterChange",function(e,t,n){var o=$(t.$slides[n]);o&&(0!==n||"undefined"!=typeof forceShowCaption&&forceShowCaption)?o.find(".gallery-caption").show().effect("slide",{direction:"right"}).dequeue():0===n&&d&&d.fadeIn()}),onWindowResize(function(){n.slick("slickSetOption","centerPadding",getScreenSize().x<768?"0":i(o,getScreenSize().x),"true")},50)});
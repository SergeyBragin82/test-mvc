$(function(){var e=$("<ul></ul>").addClass("villa-carousel-dots").insertAfter("#villa-carousel-container");$("#villa-carousel-container").on("init",function(a,l){for(var i=l.$slides.length,o=0;o<i;++o)e.append('<li class="villa-carousel-dot"></li>');e.children().first().addClass("dot-active"),$(".villa-carousel-dots").appendTo("#villa-carousel-container"),$(".villa-carousel-dot").click(function(){var a=e.children().index(this);e.children().removeClass("dot-active"),$(this).addClass("dot-active"),$("#villa-carousel-container").slick("slickGoTo",a)})}),$("#villa-carousel-container").slick({lazyLoad:"progressive",arrows:!1,appendDots:e,autoplay:!0}),$("#villa-carousel-container").on("beforeChange",function(a,l,i,o){e.children().removeClass("dot-active"),$(e.children()[o.toString()]).addClass("dot-active")})});
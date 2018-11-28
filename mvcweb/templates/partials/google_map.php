<?php
	if (!isset($google_map_config)) {
		$google_map_config = array(
			"css_override" => "locations-map",
			"use_style" => "false",
			"hide_ui" => "false"
		);
	}
	$map_key = get_param("GOOGLE_MAPS_API_KEY");
?>
<div id="map" class="<?php echo $google_map_config['css_override']?>" data-slideout-ignore></div>
    <script>
    var aliases = {
    	northWesternUSA: "NORTH WEST",
    	southWesternUSA: "SOUTH WEST",
    	northEasternUSA: "NORTH EAST",
    	centralUSA: "CENTRAL",
    	southEasternUSA: "SOUTH EAST"
    };

    var cluster_aliases = {
    	world_unitedStates2: "world_unitedStates"
    };

    var map_hash = {};

    var map_styles = [
  {
    "stylers": [
      {
        "color": "#7f7a75"
      }
    ]
  },
  {"elementType": 'labels.text.fill', "stylers": [{"color": '#242f3e'}]},
  {"elementType": 'labels.text.stroke', "stylers": [{"visibility": 'off'}]},
  {
    "featureType": "administrative",
    "stylers": [
      {
        "visibility": "on"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "visibility": "on"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels",
    "stylers": [
      {
        "color": "#333333"
      },
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#635f5b"
      },
      {
        "visibility": "on"
      }
    ]
  },
    {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#635f5b"
      },
      {
        "visibility": "on"
      }
    ]
  },
    {
    "featureType": "administrative.city",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#666666"
      },
      {
        "visibility": "on"
      }
    ]
  },
      {
    "featureType": "administrative.city",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#333333"
      },
      {
        "visibility": "off"
      }
    ]
  },
  {
  "featureType": 'poi',
  "elementType": 'labels.text.fill',
  "stylers": [{"color": '#ffffff'}]
},
  {
    "featureType": "administrative.province",
    "elementType": "labels.text",
    "stylers": [
      {
        "color": "#333333"
      },
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "stylers": [
      {
        "color": "#b9cdd5"
      }
    ]
  }
];

	var map;
	var markers = [];
	var maxZoom = 7;
	var minZoom = window.innerWidth<400 ? 4 : 3;


    function CustomMarker(clusterObj) {
		this.latlng = clusterObj.latlng;
		this.args = clusterObj;
		this.setMap(map);
		markers.push(this);
	}

	function instersect_rect (r1, r2) {
		nw1 = r1.getNorthWest();
		se1 = r1.getSouthEast();

		nw2 = r2.getNorthWest();
		se2 = r2.getSouthEast();

		il = Math.max(nw1.lon(), nw2.lon());
		ir = Math.min(se1.lon(), se2.lon());
		it = Math.max(nw1.lat(), nw2.lat());
		ib = Math.min(se1.lat(), se2.lat());
		
		return new LatLngBounds();
	}

	function recalculateMap() {
		var containedClusters = [];

		var keys = Object.keys(map_hash);
		for(var i=0; i<keys.length; i++) {
			var current_map = map_hash[keys[i]];
			if (map.getBounds().contains(current_map.bounds.getNorthEast())&&map.getBounds().contains(current_map.bounds.getSouthWest())) {
				containedClusters.push(current_map);
			}
		}

		containedClusters.sort(function(a, b) { return a.depth - b.depth });

		//console.log("contained clusters: " + containedClusters.length);
		if (containedClusters.length>0) {
			var potential_cluster = containedClusters[0];
			console.log("top cluster: " + potential_cluster.name + " " + potential_cluster.depth);
			if (potential_cluster.depth<=current_cluster.depth && potential_cluster != current_cluster) {

				current_cluster = potential_cluster;
				
				for(var i=markers.length-1;i>=0;i--) {
					var m = markers[i];
					m.destroy();
				}

				markers = [];

				var clusterObj = potential_cluster;
	
				if(clusterObj.marker)
					clusterObj.marker.destroy();
	
				if (clusterObj.children.length>0) {
					clusterObj.children.forEach(function (c2) {
						marker = new CustomMarker(c2);
						c2.marker = marker;
					});
				}
				return;
			}
		}

		formatLabelsForZoom();
	}

	function formatLabelsForZoom() {
		var currentZoom = map.getZoom();
		$(".region-label").css({"font-size": "18px", "display": "block", "width": "150px"});	
		console.log("ZOOM: " + currentZoom);
		switch(currentZoom) {
			case 4:
				console.log("level 4");
				console.log("regions: " + $(".region-label").length);
				$(".region-label").css({"font-size": "10px", "width":"100px"});	
				break;
			case 3:
			case 2:
			case 1:
				$(".region-label").css({"display": "none"});	
				break;
		}
	}

      function initMap() {
        // Create a map object and specify the DOM element for display.
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 31.922959, lng: -45.8607185},
          <?php
          	if ($google_map_config['hide_ui']==="true") {
          ?>
	          disableDefaultUI: true,
	          gestureHandling: 'greedy',
	      <?php } else {?>
	      		disableDefaultUI: false,
				gestureHandling: 'greedy',
          <?php
          	}
          ?>
          disableDoubleClickZoom: true,
          scrollwheel: false,
          zoomControl: false,
          zoom: 3,
          draggable: true,
          <?php if ($google_map_config['use_style']!="false") {
          	?>styles: map_styles<?php
          }?>
        });

        google.maps.event.addListener(map, 'dragend', function () {
			recalculateMap();
		});

		google.maps.event.addListener(map, 'zoom_changed', function () {
			recalculateMap();
		});


        markers = [];

        
		google.maps.event.addListenerOnce(map, 'idle', function(){
			refreshMap();

			if (window.innerWidth<400) {
				map.setZoom(3);
				map.setCenter(new google.maps.LatLng(43.0902, -99.7129), 13);

				/*
				$(".map_nav_zoom").css({display: "none"});
				*/
			}
		});

	 
        CustomMarker.prototype = new google.maps.OverlayView();

        CustomMarker.prototype.destroy = function() {
        	this.setMap(null);
        }

        CustomMarker.prototype.redraw = function () {
        	var self = this;

			var div = this.div;

			if(div) {
				div.parentNode.removeChild(div);
			}

			var colorArray = ['#88b7c5', '#299f8a', '#b38a86', '#b6a885'];
			var count;
			var color;

			var cluster = create_cluster(this.args);
			cluster.addClass("map_marker");
			
			div = this.div = cluster.get(0);

			if (typeof(self.args.marker_id) !== 'undefined') {
				div.dataset.marker_id = self.args.marker_id;
			}

			google.maps.event.addDomListener(div, "click", function(event) {
				google.maps.event.trigger(self, "click");
			});

			var panes = this.getPanes();
			panes.overlayImage.appendChild(div);

			//console.log("Flourishing: " + this.args.name);
			flourish_cluster(cluster.find(".cluster"));	
			formatLabelsForZoom();
			this.reposition();
        }

		CustomMarker.prototype.draw = function() {
			if(!this.div) {
				this.redraw();
			} else {
				this.reposition();
			}
		};

		CustomMarker.prototype.reposition = function() {
			var point = this.getProjection().fromLatLngToDivPixel(new google.maps.LatLng(this.args.latlng[0], this.args.latlng[1]));

			if (point) {
				this.div.style.position = "absolute";
				this.div.style.left = point.x + 'px';
				this.div.style.top = point.y + 'px';
			}
		}

		CustomMarker.prototype.remove = function() {
			if (this.div) {
				this.div.parentNode.removeChild(this.div);
				this.div = null;
			}
		};

		CustomMarker.prototype.getPosition = function() {
			return this.latlng;
		};

		if (typeof centerControlDiv !== "undefined") {
			centerControlDiv.style.display = "block";
	        centerControlDiv.index = 1;
	        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);

	        for(var i=0;i<4;i++) {
	        	var toggle = $("#map_toggle_" + i);
	        	toggle.on("click", function () {
	        		toggleIndex = $(this).attr("id").split("_")[2];
	        		toggleArray[toggleIndex] = !toggleArray[toggleIndex];
							$(this).find(".map-check").css({outline: toggleArray[toggleIndex] ? "solid 2px #7f7a75" : "none"});
	        		markers.forEach(function(e) {
	        			e.redraw();
	        		});
	        	});
	        }
		}

		if (typeof mapNavDiv !== "undefined") {
			mapNavDiv.style.display = "block";
	        mapNavDiv.index = 1;
	        map.controls[google.maps.ControlPosition.TOP_LEFT].push(mapNavDiv);

		}
    }

    function zoomIn() {
    	if (map.getZoom()<=maxZoom) {
    		map.setZoom(map.getZoom()+1);
    		google.maps.event.addListenerOnce(map, 'idle', function(){ recalculateMap(); });

    	} 

    	refreshButtons();
    }

    function refreshButtons() {

    	var modifier = "";

    	if (map.getZoom()>maxZoom) {
    		modifier = "_disabled";
    	} 
    	$("#map_zoom_in").attr("src", "/wp-content/plugins/mvcweb/assets/images/map_zoomin" + modifier + ".png");

    	if (map.getZoom()<minZoom) {
    		modifier = "_disabled";
    	} else {
    		modifier = "";
    	}

    	$("#map_zoom_out").attr("src", "/wp-content/plugins/mvcweb/assets/images/map_zoomout" + modifier + ".png");
    	
    }

    function zoomOut() {
    	if(map.getZoom()>=minZoom) {
    		map.setZoom(map.getZoom()-1);
    		google.maps.event.addListenerOnce(map, 'idle', function(){ recalculateMap(); });
    	}


    	refreshButtons();
    }

    function resetMap() {
    	refreshMap();
		if (window.innerWidth<400) {
				map.setZoom(3);
				map.setCenter(new google.maps.LatLng(43.0902, -99.7129), 13);
		}
    	refreshButtons();
    }

    function is_in_map_children(key, parent) {
        	if (parent) {
	        	for(var i=0;i<parent.children.length;i++) {
	        		var e = parent.children[i];
	        		if (e.name==key) {
	        			return e;
	        		}
	        	}
        	}
        	return null;
        }

        function get_map_by_name(name, map) {
        	var returnNode;
        	map.children.forEach(function (e) {
        		if (!returnNode) {
	        		if(e.name==name) {
	        			returnNode = e; 
	        		} else {
	        			var searchNode = get_map_by_name(e);

	        			if (searchNode) {
	        				returnNode = searchNode;
	        			}
	        		}        			
        		}
        	});
        	return returnNode;
        }

        function process_cluster2(e) {
			e.forEach(function(ec) {
				var new_map = {
					children: [],
					name: e.name,
					dots: [],
					latlng: ec.Coordinates,
					parent: map_cursor,
				};

				if (ec.ExperienceCountByCollection) {
					ec.ExperienceCountByCollection.forEach(function(e2) {
						new_map.dots.push({
							count: e2
						});
					});			
				} 
			});

			e.forEach(function (ec) {
				process_cluster3(ec);
			});
        }

        function process_cluster3(e) {
        	// assign to 
        }

        function process_cluster(e, depth) {
					depth = depth || 1;
			if (e.Clusters) {
				e.Clusters.forEach(function(ec) {
					//console.log("Processing: " + ec.Name);
					var name_array = ec.Name.split("_");
					var map_cursor = map_data;
					name_array.forEach(function(ed, i) {
						//console.log("processing " + ed + " " + i);
						var ret_map = is_in_map_children(ed, map_cursor);
						if (ret_map==null) {
							// create map node
							var new_map = {
								children: [],
								name: ed,
								dots: [],
								latlng: ec.Coordinates,
								parent: map_cursor,
								depth: i
							};

							map_hash[ec.Name] = new_map;

							if (ec.ExperienceCountByCollection) {
								ec.ExperienceCountByCollection.forEach(function(e2, i2) {
									new_map.dots.push({
										count: e2,
										index: i2
									});
								});			
							} 
							
							if (cluster_aliases[ec.Name]) {
								var source_map = map_hash[cluster_aliases[ec.Name]];
								if (source_map) {
									new_map.children = source_map.children;
								}
							}

							map_cursor.children.push(new_map);
							map_cursor = new_map;
						} else {
							map_cursor = ret_map;
						}
					});

					process_cluster(ec);
				});
			}
        }

	    function refreshMap() {
			// First pass - obtain world top level items
			markers.forEach(function (e) {
				e.destroy();
			});
			
			markers = [];

			map_data = {
				children: [
					{
						children: [],
						name: "world",
						depth: 0
					}
				],
				depth: 0,
				bounds: null
			};

			map_hash["world"] = map_data.children[0];
			if (typeof(map_data_raw) !== 'undefined' && map_data_raw) {
				map_data_raw.forEach(function (e) {
	    		process_cluster(e);
				});
			}
	    	// calculate all bounds
			Object.keys(map_hash).forEach(function (key) {
					var current_map = map_hash[key];
					var current_bounds = new google.maps.LatLngBounds();
					current_map.children.forEach(function (e) {
						current_bounds.extend(new google.maps.LatLng(parseFloat(e.latlng[0]), parseFloat(e.latlng[1])));
					});
					current_map.bounds = new google.maps.LatLngBounds(current_bounds.getSouthWest(), current_bounds.getNorthEast());
			});

			var bounds = new google.maps.LatLngBounds();

			var children_nodes = map_data.children[0].children;
			
			current_cluster = map_data.children[0];

			// bypass middle layers
			if(children_nodes.length==1) {
				children_nodes = children_nodes[0].children;
				if(children_nodes.length==0)
					return;
			}

			children_nodes.forEach(function (c2) {
				//clusterJObj.css({top: clusterObj.latlng[0], left: clusterObj.latlng[1]});
				//TweenLite.to(clusterJObj, FLOURISH_TIME, {x: c.latlng[0], y: c.latlng[1]});
				bounds.extend(new google.maps.LatLng(c2.latlng[0], c2.latlng[1]))
			});

			if(bounds) {
				map.fitBounds(bounds);
				fitBoundsWithPadding(map, bounds, {left:0, right:0, top:0, bottom: 0});		
				google.maps.event.addListenerOnce(map, 'idle', function(){
					console.log("adding " + children_nodes.length + " markers");
					children_nodes.forEach(function (c2) {
						marker = new CustomMarker(c2);
						c2.marker = marker;
					});
				}); 
			}
	    }

    	var toggleArray = [true, true, true, true];
		var colorArray = ['#b38a86','#88b7c5','#b6a885','#299f8a'];

		function create_cluster(clusterObject) {
			var wrapperObj = $("<div/>");
			var returnObj = $("<div/>");
			returnObj.addClass("cluster");
			wrapperObj.append(returnObj);
			var index = 0;
			returnObj.data("data", clusterObject);

			sort_cluster(clusterObject);

			clusterObject.dots.forEach(function(obj) {
				if(obj.count>0) {
					if(toggleArray[obj.index]==true) {
						returnObj.append(create_dot(obj, (clusterObject.children.length > 0)));
					}
				}
			});

			if(aliases[clusterObject.name]) {
				var titleOffset = aliases[clusterObject.name].length * 10;
				var titleObj = $('<span/>');
				/*
					font-family: "Kessel_105 W05 Book", sans-serif;
					font-weight: bold;
					position: "absolute";
					color: "#333333";
					width: "150px";
					text-align: "center";
					transform: "translate(-40%, 0%)";
					white-space: "nowrap";
					font-size: "16px";
					font-weight: "bold";*/

				titleObj.css({left: "40px", "font-family": "\"Kessel_105 W05 Book\", sans-serif", "font-weight": "bold", color: "white", width: "150px", "text-align": "left", "white-space": "nowrap", "font-size": "18px", "letter-spacing": "3px", "position": "absolute"});
				titleObj.addClass("region-label");
				titleObj.html(aliases[clusterObject.name]);
				wrapperObj.append(titleObj);	
			}
			wrapperObj.css({position: "absolute"});
			return wrapperObj;
		}

		function create_dot(dotObject, hasKids) {
			//color, count, outer_radius
			var color = colorArray[dotObject.index];
			var count = dotObject.count;
			var outer_radius = count >= 10000 ? 24 : count >=1000 ? 22 : count >= 100 ? 20 : count >= 10 ? 15 : 10;
			font_size = count >= 10000 ? 18 : count >=1000 ? 15 : count >= 100 ? 14 : count >= 10 ? 12 : 10;
			inner_radius = outer_radius - 3;
			
			dotObject.radius = outer_radius;
			var strokeColor = hasKids == true ? "white" : color;

			var xmlString = '<svg style="position: absolute; z-index:0; width: ' + (outer_radius*2) + 'px; height: ' + (outer_radius*2) + 'px;"><circle r="' + outer_radius + '" fill="' + color + '" cx="' + (outer_radius) + '" cy="' + (outer_radius) + '"/><circle r="' + inner_radius  + '" fill="none" stroke="' + strokeColor + '" stroke-width="1" cx="' + (outer_radius) + '" cy="' + (outer_radius) + '"></svg><div style="position: absolute; z-index:1; width: ' + (outer_radius) +'px; height: '+ (outer_radius) + 'px"><div class="dot_number" style="width:auto; height: auto; white-space: nowrap; font-size: ' + font_size + 'px; color:white; display:inline-block; position: absolute; transform: translate(-50%, -50%); top: ' + outer_radius + 'px; left: ' + outer_radius + 'px;">' + count + '</div></div>';
		  	var returnObj = $("<div/>");
		  	returnObj.css({cursor: "pointer", display: "inline-block", position:"absolute", margin:0, padding:0, width: outer_radius, height: outer_radius});
		  	returnObj.html(xmlString);
		  	var countObject = returnObj.find(".dot_number")[0];
		  	returnObj.data("data", dotObject);
			return returnObj;
		}

		function sort_cluster(cluster) {
			cluster.dots.sort(function(a, b) { return b.count - a.count });
		}

	function flourish_cluster (cluster) {
		var children = cluster.children().length;
		
		if(children==0)
			return;

		var originObj = cluster.children("div:first-child");
		var origin = originObj.data("data");
		var anchor = {x: origin.radius, y: origin.radius};
		cluster.children().each(function (i, objEl) {
			// ignore first child, it is always in the center
			if(i>0) {
				var obj = $(objEl);
				var dotRadius = obj.data("data").radius;
				$(this).css({top: anchor.x-dotRadius, left: anchor.y-dotRadius});					
			} 


			$(this).on("click", function () { 
				split_cluster(cluster);	
			});
		});

		var tweenObj = {scaleInterp:0, rotInterp: 0};
		var FLOURISH_TIME = 0.5;

		TweenLite.to(tweenObj, FLOURISH_TIME, {
			scaleInterp: 1,
			rotInterp: 2.5,
			onUpdateParams: [tweenObj],
			ease: Circ.easeOut,
			onUpdate: function (tObj) {
				cluster.children().each(function (i, objEl) {
					// ignore first child, it is always in the center
					var jObj = $(objEl);
					if(i>0) {
						var dotRadius = (origin.radius + (jObj.data("data").radius/2))*tObj.scaleInterp;
						var currentRad = tObj.rotInterp*(i*((2*Math.PI)/children));
						jObj.css({top: Math.floor(Math.sin(currentRad) * dotRadius), left: Math.floor(Math.cos(currentRad) * dotRadius), transform: "scale(" + tObj.scaleInterp + ") translate(-50%, -50%)"});
						jObj.attr("radian", currentRad);
					} else {
						jObj.css({transform: "scale(" + tObj.scaleInterp + ") translate(-50%, -50%)"});
					}
				});
			}, onComplete: function () {
				centerControlDiv.style.opacity = 1;
				mapNavDiv.style.opacity = 1;
			}
		});
	}

	var current_cluster;

	function split_cluster(cluster) {
		var c_data;

		c_data = cluster.data("data");

		current_cluster = c_data;

		if (c_data.children.length==0) {
			return;
		} 

		var children = cluster.children().length;
		var tweenObj = {
			scaleInterp: 1,
			rotInterp: 2.5,
		};

		for(var i=markers.length-1;i>=0;i--) {
			var m = markers[i];
			if(m!=c_data.marker) {
				m.destroy();
			}
		}

		markers = [];

		var FLOURISH_TIME = 0.3;
		TweenLite.to(tweenObj, FLOURISH_TIME, {
			scaleInterp: 0,
			rotInterp: 5,
			onUpdateParams: [tweenObj],
			ease: Back.easeIn.config(1),
			onUpdate: function (tObj) {

				cluster.children().each(function (i, objEl) {
					// ignore first child, it is always in the center
					var jObj = $(objEl);
					if(i>0) {
						var dotRadius = jObj.data("data").radius*.70*tObj.scaleInterp;
						var currentRad = tObj.rotInterp*(i*((2*Math.PI)/children));
						jObj.css({top: Math.floor(Math.sin(currentRad) * (45*tObj.scaleInterp)), left: Math.floor(Math.cos(currentRad) * (45*tObj.scaleInterp)), transform: "scale(" + tObj.scaleInterp + ") translate(-50%, -50%)"});
						jObj.attr("radian", currentRad);
					} else {
						jObj.css({transform: "scale(" + tObj.scaleInterp + ") translate(-50%, -50%)"});
					}
				});
			}, onComplete: function () {
				var clusterObj = cluster.data("data");
				clusterObj.marker.destroy();
				if (clusterObj.children.length>0) {
					var bounds = new google.maps.LatLngBounds();

					var children_nodes = clusterObj.children;
					
					// bypass middle layers
					if(children_nodes.length==1) {
						children_nodes = children_nodes[0].children;
						if(children_nodes.length==0)
							return;
					}

					if(children_nodes.length>1) {
						children_nodes.forEach(function (c2) {
							//clusterJObj.css({top: clusterObj.latlng[0], left: clusterObj.latlng[1]});
							//TweenLite.to(clusterJObj, FLOURISH_TIME, {x: c.latlng[0], y: c.latlng[1]});
							bounds.extend(new google.maps.LatLng(c2.latlng[0], c2.latlng[1]))
						});
						if(bounds) {
							map.fitBounds(bounds);
							fitBoundsWithPadding(map, bounds, {left:40, right:40, top:40, bottom: 40});		
						}
					} else {											
						map.setCenter(new google.maps.LatLng(children_nodes[0].latlng[0], children_nodes[0].latlng[1]));
				        map.setZoom(6);
					}
					google.maps.event.addListenerOnce(map, 'idle', function(){
								children_nodes.forEach(function (c2) {
									marker = new CustomMarker(c2);
									c2.marker = marker;
								});
								refreshButtons();
							}); 
				}
			}
		});
	}

	function fitBoundsWithPadding(gMap, bounds, paddingXY) {
        var projection = gMap.getProjection();
        if (projection) {
            if (!$.isPlainObject(paddingXY))
                paddingXY = {x: 0, y: 0};

            var paddings = {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            };

            if (paddingXY.left){
                paddings.left = paddingXY.left;
            } else if (paddingXY.x) {
                paddings.left = paddingXY.x;
                paddings.right = paddingXY.x;
            }

            if (paddingXY.right){
                paddings.right = paddingXY.right;
            }

            if (paddingXY.top){
                paddings.top = paddingXY.top;
            } else if (paddingXY.y) {
                paddings.top = paddingXY.y;
                paddings.bottom = paddingXY.y;
            }

            if (paddingXY.bottom){
                paddings.bottom = paddingXY.bottom;
            }

            // copying the bounds object, since we will extend it
            bounds = new google.maps.LatLngBounds(bounds.getSouthWest(), bounds.getNorthEast());

            // SW
            var point1 = projection.fromLatLngToPoint(bounds.getSouthWest());
            gMap.fitBounds(bounds);

            var point2 = new google.maps.Point(
                ( (typeof(paddings.left) == 'number' ? paddings.left : 0) / Math.pow(2, gMap.getZoom()) ) || 0,
                ( (typeof(paddings.bottom) == 'number' ? paddings.bottom : 0) / Math.pow(2, gMap.getZoom()) ) || 0
            );

            var newPoint = projection.fromPointToLatLng(new google.maps.Point(
                point1.x - point2.x,
                point1.y + point2.y
            ));

            bounds.extend(newPoint);

            // NE
            point1 = projection.fromLatLngToPoint(bounds.getNorthEast());
            point2 = new google.maps.Point(
                ( (typeof(paddings.right) == 'number' ? paddings.right : 0) / Math.pow(2, gMap.getZoom()) ) || 0,
                ( (typeof(paddings.top) == 'number' ? paddings.top : 0) / Math.pow(2, gMap.getZoom()) ) || 0
            );
            newPoint = projection.fromPointToLatLng(new google.maps.Point(
                point1.x + point2.x,
                point1.y - point2.y
            ));

            bounds.extend(newPoint);

            gMap.fitBounds(bounds);
        }
    }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php print $map_key; ?>&callback=initMap" defer></script>
